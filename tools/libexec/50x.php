<?php
# A HTTP status 50x error page generator of mdcms.
#
# A 50x.html should be always static because some error
#  occurs unexpectedly. In such case, a PHP-based dynamic page
#  won't render well.

# Get the absolute path of a local mdcms.
$rootDirectory = __DIR__ . "/../..";

# Get global setting.
require_once $rootDirectory . "/setting.php";

# Load required libraries.
require_once $rootDirectory . "/" . LIBRARY_DIRECTORY . "/autoload.php";
# Load plugin(s) if any.
require_once $rootDirectory . "/" . PLUGIN_DIRECTORY . "/autoload.php";
# Load site theme.
require_once $rootDirectory . "/" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";


# Create a post dynamically.
$post = array();

$post[MDCMS_POST_TITLE] = "Internal Server Error";
$post[MDCMS_POST_CONTENT] = "Some error occurs on our server";
$post[MDCMS_POST_STATUS] = 500;
$post[MDCMS_POST_WORD_COUNT] = 6;

# Create breadcrumbs dynamically.
$breadcrumb = array();

{
    $link = array();

    $link[MDCMS_LINK_PATH] = "/";
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
