<?php
namespace mdcms\Core;
# Private functions used by site.php.


function getPageFromPath($path)
{
    # Get the root path of mdcms.
    $rootDirectory = __DIR__ . "/../../..";

    $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY;
    $page = substr($path, strlen($contentDirectory));

    $fileParts = pathinfo($page);
    if (isset($fileParts["extension"])) {
        $page = substr($page, 0, -(strlen($fileParts["extension"])+1));
    }

    /* Add a trailing slash if no any. */
    if ("/" != substr($page, strlen($page)-1, 1)) {
        $page .= "/";
    }

    return $page;
}

function getHTMLPathFromPage($page)
{
    # Get the root path of mdcms.
    $rootDirectory = __DIR__ . "/../../..";

    $path = $rootDirectory
        . "/" . CONTENT_DIRECTORY
        . "/" . $page;

    /* Remove a trailing "/" */
    if ("/" == substr($path, strlen($path)-1, 1)) {
        $path = substr($path, 0, strlen($path)-1);
    }

    return $path . HTML_FILE_EXTENSION;
}

function readHTMLLink($uri)
{
    require_once __DIR__ . "/post.php";

    return readPost($uri);
}

function readMarkdownLink($uri)
{
    require_once __DIR__ . "/post.php";

    return readPost($uri);
}

function readDirectoryLink($uri)
{
    require_once __DIR__ . "/section.php";

    return readSection($uri);
}

function isHTMLFile($path)
{
    return strpos($path, HTML_FILE_EXTENSION);
}

function isMarkdownFile($path)
{
    return strpos($path, MARKDOWN_FILE_EXTENSION);
}

function isPHPFile($path)
{
    return strpos($path, ".php");
}
