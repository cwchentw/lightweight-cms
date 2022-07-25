<?php
namespace LightweightCMS\Core;
# Generate error pages dynamically.


function errorPage($title, $content, $status)
{
    $rootDirectory = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";
    # Load site settings.
    require_once $rootDirectory . DIRECTORY_SEPARATOR . "setting.php";
    # Load local script(s).
    require_once __DIR__ . DIRECTORY_SEPARATOR . "const.php";

    # Create a post dynamically.
    $post = array();

    $post[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
    $post[LIGHTWEIGHT_CMS_POST_CONTENT] = $content;
    $post[LIGHTWEIGHT_CMS_POST_STATUS] = $status;

    return $post;
}

function errorPageBreadcrumb($title)
{
    $rootDirectory = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";
    # Load site settings.
    require_once $rootDirectory . DIRECTORY_SEPARATOR . "setting.php";
    # Load local script(s).
    require_once __DIR__ . DIRECTORY_SEPARATOR . "const.php";

    # Create a breadcrumb dynamically.
    $breadcrumb = array();

    {
        $link = array();

        $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
        $link[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

        array_push($breadcrumb, $link);
    }

    {
        $link = array();

        $link[LIGHTWEIGHT_CMS_LINK_TITLE] = $title;

        array_push($breadcrumb, $link);
    }

    return $breadcrumb;
}
