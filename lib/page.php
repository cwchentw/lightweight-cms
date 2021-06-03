<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/const.php";

use Pagerange\Markdown\MetaParsedown;


function parsePage($page) {
    $result = array();

    # Reject invalid pages.
    if ("/" != substr($page, 0, 1))
        return $result;

    # Parse a `$page` while a while loop.
    $len = strlen($page);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($page, $i, 1)) {
            $j = $i + 1;

            # Iterate until next "/" or the end of `$page`.
            while ($j < $len && "/" != substr($page, $j, 1))
                ++$j;

            # Extract a part of `$page`.
            $part = substr($page, $i+1, $j-$i-1);

            # Discard trailing empty strings.
            if ("" != $part)
                array_push($result, $part);

            # Reset the counter.
            $i = $j;
        }
        else {
            ++$i;
        }
    }

    return $result;
}

function getPath($page, $ext) {
    $result = "";

    $arr = parsePage($page);
    $len = count($arr);
    if (0 == $len) {
        # Pass.
    }
    else if (1 == $len) {
        $result = __DIR__ . "/../"
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . $ext;
    }
    else {
        $file = array_pop($arr);
        $directory = join("/", $arr);

        $result = __DIR__ . "/../"
            . CONTENT_DIRECTORY . "/"
            . $directory . "/"
            . $file . $ext;
    }

    return $result;
}

function readPage($page) {
    $result = array();

    # Initialize the fields of a post.
    $result[MDCMS_POST_TITLE] = "";
    $result[MDCMS_POST_CONTENT] = "";
    $result[MDCMS_POST_STATUS] = 404;

    $htmlPath = getPath($page, HTML_FILE_EXTENSION);
    $markdownPath = getPath($page, MARKDOWN_FILE_EXTENSION);

    # Here we simply set higher priority for HTML pages.
    #  We may change it later.
    if (file_exists($htmlPath)) {
        $rawContent = file_get_contents($htmlPath);

        # `$rawContent` is not a full HTML document.
        # Therefore, we don't use a HTML parser but some regex pattern.
        preg_match("/<h1[^>]*>(.+)<\/h1>/", $rawContent, $matches);
        if (isset($matches)) {
            $result[MDCMS_POST_TITLE] = $matches[1];

            # Remove <h1>-level titles from the content.
            $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $rawContent);
        }
        else
            $result[MDCMS_POST_CONTENT] = $rawContent;

        $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }
    else if (file_exists($markdownPath)) {
        $rawContent = file_get_contents($markdownPath);

        $metaParser = new MetaParsedown();

        # Extract metadata from a content.
        $metadata = $metaParser->meta($rawContent);

        # Strip metadata from a content.
        $stripedContent = $metaParser->stripMeta($rawContent);

        if (isset($metadata["title"])) {
            $result[MDCMS_POST_TITLE] = $metadata["title"];

            # Remove a <h1>-level title from the content.
            # Here we assume there is only one <h1> title per document.
            $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
        }
        else {
            preg_match("/^# (.+)/", $stripedContent, $matches);

            if (isset($matches)) {
                $result[MDCMS_POST_TITLE] = $matches[1];

                # Remove a <h1>-level title from the content.
                # Here we assume there is only one <h1> title per document.
                $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
            }
            else
                $result[MDCMS_POST_CONTENT] = $stripedContent;
        }

        # Convert the Markdown document into a HTML document.
        $parser = new Parsedown();
        $result[MDCMS_POST_CONTENT] = $parser->text($result["content"]);

        $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }

    return $result;
}
