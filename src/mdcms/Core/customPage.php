<?php
namespace mdcms\Core;

function loadCustomPage($uri)
{
    # Get the root path of mdcms.
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
    # Get the root path of mdcms.
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
    $result[MDCMS_POST_TITLE] = "";
    $result[MDCMS_POST_CONTENT] = "";
    $result[MDCMS_POST_AUTHOR] = "";
    $result[MDCMS_POST_STATUS] = 200;

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
        $result[MDCMS_POST_META] = $metadata;
    }
    else {
        $result[MDCMS_POST_META] = array();
    }

    if (isValidField($metadata, METADATA_TITLE)) {
        $result[MDCMS_POST_TITLE] = $metadata[METADATA_TITLE];
    }
    else {
        # `$stripedContent` is not a full HTML document.
        # Therefore, we don't use a HTML parser but some regex pattern.
        if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $stripedContent, $matches)) {
            $result[MDCMS_POST_TITLE] = $matches[1];
        }
        else {
            $pages = parseURI($uri);
            $title = preg_replace("/\/|-+/", " ", array_pop($pages));
            $title = ucwords($title);  # Capitalize a title.
            $result[MDCMS_POST_TITLE] = $title;
        }
    }

    # Set the author of a post.
    if (isValidField($metadata, METADATA_AUTHOR)) {
        $result[MDCMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
    }
    else {
        $result[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
    }

    # Set the mtime of a post.
    if (isValidField($metadata, METADATA_MTIME)) {
        $result[MDCMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
    }
    else {
        $result[MDCMS_POST_MTIME] = filemtime($phpPath);
    }

    # Set weight of a post if any.
    if (isValidField($metadata, METADATA_WEIGHT)) {
        $result[MDCMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
    }

    return $result;
}