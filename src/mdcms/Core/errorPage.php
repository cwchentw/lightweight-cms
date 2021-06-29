<?php
namespace mdcms\Core;
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

    $post[MDCMS_POST_TITLE] = $title;
    $post[MDCMS_POST_CONTENT] = $content;
    $post[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
    $post[MDCMS_POST_MTIME] = time();
    $post[MDCMS_POST_STATUS] = $status;

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

        $link[MDCMS_LINK_PATH] = SITE_PREFIX . "/";
        $link[MDCMS_LINK_TITLE] = BREADCRUMB_HOME;

        array_push($breadcrumb, $link);
    }

    {
        $link = array();

        $link[MDCMS_LINK_TITLE] = $title;

        array_push($breadcrumb, $link);
    }

    return $breadcrumb;
}
