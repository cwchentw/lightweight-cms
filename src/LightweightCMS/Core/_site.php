<?php
namespace LightweightCMS\Core;
# Private functions used by site.php.


function getPageFromPath($path)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";

    $contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;
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

function isPostFile($path)
{
    return strpos($path, HTML_FILE_EXTENSION)
        || strpos($path, MARKDOWN_FILE_EXTENSION)
        || strpos($path, ASCIIDOC_FILE_EXTENSION)
        || strpos($path, RESTRUCTUREDTEXT_FILE_EXTENSION)
        || strpos($path, ".php");
}
