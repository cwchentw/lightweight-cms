<?php
# An offline.html generator for Lightweight CMS.
#
# offline.html is utilized by the service worker for Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load global settings.
require_once $rootDirectory . $sep . "setting.php";

# Load required libraries.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load plugin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
# Load site theme.
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


# Create a post dynamically.
$post = array();

$post[LIGHTWEIGHT_CMS_POST_TITLE] = "Site is Offline";
$post[LIGHTWEIGHT_CMS_POST_CONTENT] = "Our site is offline for a while. Sorry for inconvenience.";
$post[LIGHTWEIGHT_CMS_POST_STATUS] = 404;

# Create breadcrumbs dynamically.
$breadcrumb = array();

{
    $link = array();

    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
    $link[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($breadcrumb, $link);
}

{
    $link = array();

    $link[LIGHTWEIGHT_CMS_LINK_TITLE] = "Site is Offline";

    array_push($breadcrumb, $link);
}

# Pass global variables to the layout of a post.
$GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
$GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;
$GLOBALS["file"] = __FILE__;

loadPost();
