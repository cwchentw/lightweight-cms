<?php
# A HTTP status 50x error page generator for Lightweight CMS.
#
# A 50x.html should be always static because some error
#  occurs unexpectedly. In such case, a PHP-based dynamic page
#  won't render well.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";

# Load the built-in libraries.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load the plugin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
# Load a site theme.
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


# Create a post dynamically.
$post = array();

$post[LIGHTWEIGHT_CMS_POST_TITLE] = "Internal Server Error";
$post[LIGHTWEIGHT_CMS_POST_CONTENT] = "Some error occurs on our server";
$post[LIGHTWEIGHT_CMS_POST_STATUS] = 500;

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

    $link[LIGHTWEIGHT_CMS_LINK_TITLE] = "Internal Server Error";

    array_push($breadcrumb, $link);
}

# Pass global variables to the layout of a post.
$GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
$GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;
$GLOBALS["file"] = __FILE__;

loadPost();
