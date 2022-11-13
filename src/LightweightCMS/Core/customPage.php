<?php
namespace LightweightCMS\Core;

function loadCustomPage($uri)
{
    $rootDirectory = __DIR__ . "/../../..";

    # Load third-party libraries.
    require_once $rootDirectory . "/vendor/autoload.php";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/_uri.php";

    $phpPath = getPath($uri, ".php");

    $rawContent = file_get_contents($phpPath);

    $parser = new \Mni\FrontYAML\Parser();

    # Parse raw content.
    $document = $parser->parse($rawContent, false);

    # Strip metadata from a post.
    $stripedContent = $document->getContent();

    # Create a new PHP script from scripted content.
    $tempFileName = tempnam(sys_get_temp_dir(), "my_php_script_");
    file_put_contents($tempFileName . ".php", $stripedContent);

    # Load newly created PHP script.
    require $tempFileName . ".php";
}

function readCustomPage($uri)
{
    $rootDirectory = __DIR__ . "/../../..";

    # Load third-party libraries.
    require_once $rootDirectory . "/vendor/autoload.php";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/_uri.php";
    require_once __DIR__ . "/_utils.php";

    $result = array();

    # Initialize the fields of a post.
    $result[LIGHTWEIGHT_CMS_POST_TITLE] = "";
    $result[LIGHTWEIGHT_CMS_POST_CONTENT] = "";
    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = "";
    $result[LIGHTWEIGHT_CMS_POST_STATUS] = 200;

    $phpPath = getPath($uri, ".php");

    $rawContent = file_get_contents($phpPath);

    $parser = new \Mni\FrontYAML\Parser();

    # Parse raw content.
    $document = $parser->parse($rawContent, false);

    # Extract metadata from a post.
    $metadata = $document->getYAML();

    # Strip metadata from a post.
    $stripedContent = $document->getContent();

    # Expose metadata of a post. No matter it is empty or not.
    if (!is_null($metadata)) {
        $result[LIGHTWEIGHT_CMS_POST_META] = $metadata;
    }
    else {
        $result[LIGHTWEIGHT_CMS_POST_META] = array();
    }

    if (isValidField($metadata, METADATA_TITLE)) {
        $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];
    }
    else {
        # `$stripedContent` is not a full HTML document.
        # Therefore, we don't use a HTML parser but some regex pattern.
        if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $stripedContent, $matches)) {
            $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];
        }
        else {
            $pages = parseURI($uri);
            $title = preg_replace("/\/|-+/", " ", array_pop($pages));
            $title = ucwords($title);  # Capitalize a title.
            $result[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
        }
    }

    # Set the author of a post.
    if (isValidField($metadata, METADATA_AUTHOR)) {
        $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
    }
    else {
        $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
    }

    # Set the mtime of a post.
    if (isValidField($metadata, METADATA_MTIME)) {
        $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
    }
    else {
        $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($phpPath);
    }

    # Set weight of a post if any.
    if (isValidField($metadata, METADATA_WEIGHT)) {
        $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
    }

    return $result;
}
