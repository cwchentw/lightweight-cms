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
    if (preg_match("/^\/(\d+)\/$/", $uri, $matches)) {
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
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";

    $path = $rootDirectory . "/" . CONTENT_DIRECTORY . "/" . $uri;

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
