<?php
# A HTTP status 50x error page generator of mdcms.
#
# A 50x.html should be always static because some error
#  occurs unexpectedly. In such case, a PHP-based dynamic page
#  won't render well.


# Get the absolute path of a local mdcms.
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

$post[MDCMS_POST_TITLE] = "Internal Server Error";
$post[MDCMS_POST_CONTENT] = "Some error occurs on our server";
$post[MDCMS_POST_STATUS] = 500;

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

    $link[MDCMS_LINK_TITLE] = "Internal Server Error";

    array_push($breadcrumb, $link);
}

# Pass global variables to the layout of a post.
$GLOBALS[MDCMS_POST] = $post;
$GLOBALS[MDCMS_BREADCRUMB] = $breadcrumb;
$GLOBALS["file"] = __FILE__;

loadPost();
