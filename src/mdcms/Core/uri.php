<?php
namespace mdcms\Core;
# URIs related functions.


# Check whether the page is the home page of a site.
function isHome($uri)
{
    return "/" == $uri;
}

function isPageInHome($uri)
{
    if (preg_match("/^\/(\d+)\/$/", $uri)) {
        return true;
    }

    return false;
}

# Check whether the page is a section.
#
# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($uri)
{
    $sep = DIRECTORY_SEPARATOR;

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";

    $path = $rootDirectory . $sep . CONTENT_DIRECTORY . $sep . str_replace("/", $sep, $uri);

    return is_dir($path);
}

function isPageInSection($uri)
{
    if (preg_match("/^\/(.+)\/(\d+)\/$/", $uri, $matches)) {
        return isSection("/" . $matches[1] . "/");
    }

    return false;
}

function isCustomPage($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    require_once __DIR__ . "{$sep}_uri.php";

    $path = getPath($uri, ".php");

    return file_exists($path);
}

function isPost($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    require_once __DIR__ . "{$sep}_uri.php";

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";

    $htmlPath = getPath($uri, HTML_FILE_EXTENSION);
    $markdownPath = getPath($uri, MARKDOWN_FILE_EXTENSION);

    return file_exists($htmlPath) || file_exists($markdownPath);
}
