<?php
namespace mdcms\Core;
# Section related function(s).


function readSection($page)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Load third-party libraries.
    require_once $rootDirectory . "/vendor/autoload.php";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/uri.php";
    require_once __DIR__ . "/utils.php";

    $result = array();

    # Initialize the data of a section.
    $result[MDCMS_SECTION_TITLE] = "";
    $result[MDCMS_SECTION_CONTENT] = "";
    $result[MDCMS_SECTION_STATUS] = 200;  # HTTP 200 OK.

    $indexPage = $rootDirectory . "/" . CONTENT_DIRECTORY
        . $page . "/" . SECTION_INDEX;

    # If a section index exists, extract data from it.
    if (file_exists($indexPage)) {
        $rawContent = file_get_contents($indexPage);

        $parser = new \Mni\FrontYAML\Parser();

        $document = $parser->parse($rawContent);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        # Strip metadata from a post.
        $stripedContent = $document->getContent();

        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[MDCMS_SECTION_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[MDCMS_SECTION_TITLE] = $metadata[METADATA_TITLE];

            $stripedContent = preg_replace("/^# (.+)/", "", $stripedContent);

            $parser = new \Parsedown();
            $result[MDCMS_SECTION_CONTENT] = $parser->text($stripedContent);
        }
        else {
            preg_match("/^# (.+)/", $stripedContent, $matches);
            if ("" != $matches[1]) {
                $result[MDCMS_SECTION_TITLE] = $matches[1];

                $stripedContent = preg_replace("/^# (.+)/", "", $stripedContent);

                $parser = new \Parsedown();
                $result[MDCMS_SECTION_CONTENT] = $parser->text($stripedContent);
            }
            else {
                $parser = new \Parsedown();
                $result[MDCMS_SECTION_CONTENT] = $parser->text($rawContent);

                goto extract_title_from_page;
            }
        }
    }
    # Otherwise, extract data from the directory name.
    else {
        extract_title_from_page:
        $pages = parseURI($page);
        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_SECTION_TITLE] = $title;
    }

    preg_match_all("/<p[^>]*>(.+)<\/p>/", $result[MDCMS_SECTION_CONTENT], $matches);
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

        $result[MDCMS_SECTION_EXCERPT] = $excerpt;
    }
    else {
        $result[MDCMS_SECTION_EXCERPT] = "";
    }

    return $result;
}
