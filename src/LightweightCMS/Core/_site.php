<?php
namespace LightweightCMS\Core;
# Private functions used by site.php.


function getPageFromPath ($path)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";

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

    return str_replace("\\", "/", $page);
}

function isPostFile ($path)
{
    return strpos($path, HTML_FILE_EXTENSION)
        || strpos($path, MARKDOWN_FILE_EXTENSION)
        || strpos($path, ASCIIDOC_FILE_EXTENSION)
        || strpos($path, RESTRUCTUREDTEXT_FILE_EXTENSION)
        || strpos($path, ".php");
}
