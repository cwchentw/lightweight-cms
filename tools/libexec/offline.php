<?php
# An offline.html generator of mdcms.
#
# offline.html is utilized by service worker for mdcms.


$sep = DIRECTORY_SEPARATOR;

# Get the absolute path of a local mdcms.
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

$post[MDCMS_POST_TITLE] = "Site is Offline";
$post[MDCMS_POST_CONTENT] = "Our site is offline for a while. Sorry for inconvenience.";
$post[MDCMS_POST_STATUS] = 404;

# Create breadcrumbs dynamically.
$breadcrumb = array();

{
    $link = array();

    $link[MDCMS_LINK_PATH] = SITE_PREFIX . "/";
    $link[MDCMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($breadcrumb, $link);
}

{
    $link = array();

    $link[MDCMS_LINK_TITLE] = "Site is Offline";

    array_push($breadcrumb, $link);
}

# Pass global variables to the layout of a post.
$GLOBALS[MDCMS_POST] = $post;
$GLOBALS[MDCMS_BREADCRUMB] = $breadcrumb;
$GLOBALS["file"] = __FILE__;

loadPost();
