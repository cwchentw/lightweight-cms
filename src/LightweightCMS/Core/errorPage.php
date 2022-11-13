<?php
namespace LightweightCMS\Core;
# Generate error pages dynamically.


function errorPage($title, $content, $status)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load the constants.
    require_once __DIR__ . $sep . "const.php";

    # Create a post dynamically.
    $post = array();

    $post[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
    $post[LIGHTWEIGHT_CMS_POST_CONTENT] = $content;
    $post[LIGHTWEIGHT_CMS_POST_STATUS] = $status;

    return $post;
}

function errorPageBreadcrumb($title)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load the constants.
    require_once __DIR__ . $sep . "const.php";

    # Create a breadcrumb dynamically.
    $breadcrumb = array();

    $home = array();

    $home[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
    $home[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($breadcrumb, $home);

    $page = array();

    $page[LIGHTWEIGHT_CMS_LINK_TITLE] = $title;

    array_push($breadcrumb, $page);

    return $breadcrumb;
}
