<?php
namespace mdcms\Core;

# Post related function(s).

# Get the root path of mdcms.
$rootDirectory = __DIR__ . "/../../..";

# Load third-party libraries.
require_once $rootDirectory . "/vendor/autoload.php";
# Get global setting.
require_once $rootDirectory . "/setting.php";
# Load local libraries.
require_once __DIR__ . "/const.php";
require_once __DIR__ . "/page.php";

use Pagerange\Markdown\MetaParsedown;

# The implementation is too long. We may refactor it later.
function readPost($page)
{
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
        else {
            $result[MDCMS_POST_CONTENT] = $rawContent;
        }

        # TODO: Test the code.
        preg_match_all("/<p[^>]*>(.+)<\/p>/", $result[MDCMS_POST_CONTENT], $matches);
        if (isset($matches)) {
            $text = "";

            for ($i = 0; $i < count($matches[1]); ++$i) {
                # Reduce multiple spaces into single space.
                $paragraph = preg_replace("/[ ]+/", " ", $matches[1][$i]);
                $text .= $paragraph;

                if ($i < count($matches[1]) - 1) {
                    $text .= " ";
                }
            }

            $words = explode(" ", $text);
            # Currently, we only count words for English articles.
            # TODO: Count words for posts in other languages.
            $result[MDCMS_POST_WORD_COUNT] = count($words);

            $excerpt = "";
            for ($i = 0; $i < count($words); ++$i) {
                if (strlen($excerpt) <= EXCERPT_THRESHOLD) {
                    $excerpt .= $words[$i];
                }
                else {
                    break;
                }

                if ($i < count($words) - 1) {
                    $excerpt .= " ";
                }
            }

            $result[MDCMS_POST_EXCERPT] = $excerpt;
        }
        else {
            $result[MDCMS_POST_WORD_COUNT] = 0;
            $result[MDCMS_POST_EXCERPT] = "";
        }

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
            else {
                $result[MDCMS_POST_CONTENT] = $stripedContent;
            }
        }

        # Convert the Markdown document into a HTML document.
        $parser = new \Parsedown();
        $result[MDCMS_POST_CONTENT] = $parser->text($result["content"]);

        # TODO: Test the code.
        preg_match_all("/<p[^>]*>(.+)<\/p>/", $result[MDCMS_POST_CONTENT], $matches);
        if (isset($matches)) {
            $text = "";

            for ($i = 0; $i < count($matches[1]); ++$i) {
                # Reduce multiple spaces into single space.
                $paragraph = preg_replace("/[ ]+/", " ", $matches[1][$i]);

                # Remove all HTML tags inside.
                $paragraph = strip_tags($paragraph);

                $text .= $paragraph;

                if ($i < count($matches[1]) - 1) {
                    $text .= " ";
                }
            }

            $words = explode(" ", $text);
            # Currently, we only count words for English articles.
            # TODO: Count words for posts in other languages.
            $result[MDCMS_POST_WORD_COUNT] = count($words);

            $excerpt = "";
            for ($i = 0; $i < count($words); ++$i) {
                if (strlen($excerpt) <= EXCERPT_THRESHOLD) {
                    $excerpt .= $words[$i];
                }
                else {
                    break;
                }

                if ($i < count($words) - 1) {
                    $excerpt .= " ";
                }
            }

            $result[MDCMS_POST_EXCERPT] = $excerpt;
        }
        else {
            $result[MDCMS_POST_WORD_COUNT] = 0;
            $result[MDCMS_POST_EXCERPT] = "";
        }

        $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }

    # Add id for each subtitle if none.
    if (ENABLE_TOC) {
        $result[MDCMS_POST_CONTENT]
            = preg_replace_callback(
                "/<h2>(.+)<\/h2>/",
                function ($matches) {
                    $id = preg_replace("/[ ]+/", "-", $matches[1]);
                    $id = strtolower($id);
                    return "<h2 id=\"" . $id . "\">" . $matches[1] . "</h2>";
                },
                $result[MDCMS_POST_CONTENT]
            );
    }

    # Prevent search engine bots from following links.
    if (NO_FOLLOW_EXTERNAL_LINK) {
        $result[MDCMS_POST_CONTENT]
            = preg_replace_callback(
                "/<a href=\"([^\"]+)\">(.+)<\/a>/",
                function ($matches) {
                    $href = $matches[1];

                    # Do nothing on local links.
                    if ("http" != substr($href, 0, 4)) {
                        return $matches[0];
                    }

                    # Do nothing on the links of the same domain.
                    if (strpos($href, SITE_BASE_URL)) {
                        return $matches[0];
                    }

                    $title = $matches[2];
                    return "<a href=\"" . $href . "\" target=\"_blank\""
                        . "rel=\"noopener nofollow\">"
                        . $title . "</a>";
                },
                $result[MDCMS_POST_CONTENT]
            );
    }

    return $result;
}
