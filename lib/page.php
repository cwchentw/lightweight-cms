<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/const.php";

function parsePage($page) {
    $result = array();

    # Reject invalid pages.
    if ("/" != substr($page, 0, 1))
        return $result;

    $len = strlen($page);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($page, $i, 1)) {
            $j = $i + 1;

            while ($j < $len && "/" != substr($page, $j, 1))
                ++$j;

            $part = substr($page, $i+1, $j-$i-1);

            # Discard trailing empty strings.
            if ("" != $part)
                array_push($result, $part);

            $i = $j;
        }
        else {
            ++$i;
        }
    }

    return $result;
}

function getPath($page, $ext) {
    $arr = parsePage($page);
    $result = "";

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

    # Initialize the fields.
    $result[MDCMS_POST_TITLE] = "";
    $result[MDCMS_POST_CONTENT] = "";
    $result[MDCMS_POST_STATUS] = 404;

    $html_path = getPath($page, HTML_FILE_EXTENSION);
    $markdown_path = getPath($page, MARKDOWN_FILE_EXTENSION);

    # Here we simply set higher priority for HTML pages.
    # We may change it later.
    if (file_exists($html_path)) {
        $raw_content = file_get_contents($html_path);

        # `$raw_content` is not a full HTML document.
        # Therefore, we don't use a HTML parser.
        preg_match("/<h1[^>]*>(.+)<\/h1>/", $raw_content, $matches);
        if (isset($matches)) {
            $result[MDCMS_POST_TITLE] = $matches[1];
            $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $raw_content);
        }
        else
            $result[MDCMS_POST_CONTENT] = $raw_content;

        $result[MDCMS_POST_STATUS] = 200;
    }
    else if (file_exists($markdown_path)) {
        $raw_content = file_get_contents($markdown_path);

        preg_match("/^# (.+)/", $raw_content, $matches);
        if (isset($matches)) {
            $result[MDCMS_POST_TITLE] = $matches[1];
            $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $raw_content);
        }
        else
            $result[MDCMS_POST_CONTENT] = $raw_content;

        $parser = new Parsedown();
        $result[MDCMS_POST_CONTENT] = $parser->text($result["content"]);

        $result[MDCMS_POST_STATUS] = 200;
    }

    return $result;
}
