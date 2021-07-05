<?php
namespace mdcms\Core;
# Section related function(s).


function readSection($page)
{
    $sep = DIRECTORY_SEPARATOR;

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    # Load third-party libraries.
    require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";
    # Load local scripts.
    require_once __DIR__ . "{$sep}const.php";
    require_once __DIR__ . "{$sep}uri.php";
    require_once __DIR__ . "{$sep}utils.php";
    # Load private scripts.
    require_once __DIR__ . "{$sep}_uri.php";
    require_once __DIR__ . "{$sep}_utils.php";

    $result = array();

    # Initialize the data of a section.
    $result[MDCMS_SECTION_TITLE] = "";
    $result[MDCMS_SECTION_CONTENT] = "";
    $result[MDCMS_SECTION_STATUS] = 200;  # HTTP 200 OK.

    $indexPage = $rootDirectory . $sep . CONTENT_DIRECTORY
        . str_replace("/", $sep, $page) . $sep . SECTION_INDEX;

    # If a section index exists, extract data from it.
    if (file_exists($indexPage)) {
        $rawContent = file_get_contents($indexPage);

        $parser = new \Mni\FrontYAML\Parser();

        $document = $parser->parse($rawContent);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        # Strip metadata from a post.
        $stripedContent = $document->getContent();

        # Expose metadata of a section. No matter it is empty or not.
        # Expose metadata of a section. No matter it is empty or not.
        if (!is_null($metadata)) {
            $result[MDCMS_POST_META] = $metadata;
        }
        else {
            $result[MDCMS_POST_META] = array();
        }

        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[MDCMS_SECTION_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        if (isValidField($metadata, METADATA_TITLE)) {
            $result[MDCMS_SECTION_TITLE] = $metadata[METADATA_TITLE];

            $stripedContent = preg_replace("/^# (.+)/", "", $stripedContent);

            $parser = new \Parsedown();
            $result[MDCMS_SECTION_CONTENT] = $parser->text($stripedContent);
        }
        else {
            preg_match("/<h1>(.+)<\/h1>/", $stripedContent, $matches);
            if ("" != $matches[1]) {
                $result[MDCMS_SECTION_TITLE] = $matches[1];

                $stripedContent = preg_replace("/<h1>(.+)<\/h1>/", "", $stripedContent);

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
        # Dummy metadata of a section.
        $result[MDCMS_SECTION_META] = array();

        extract_title_from_page:
        $pages = parseURI($page);
        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_SECTION_TITLE] = $title;
    }

    # Prevent search engine bots from following links.
    if (NO_FOLLOW_EXTERNAL_LINK
        && array_key_exists(MDCMS_SECTION_CONTENT, $result))
    {
        $output = noFollowLinks($result[MDCMS_SECTION_CONTENT]);
        $result[MDCMS_SECTION_CONTENT] = $output;
    }

    return $result;
}
