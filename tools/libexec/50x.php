<?php
# A HTTP status 50x error page generator of mdcms.
#
# A 50x.html should be static because some error occurs unexpectedly.
#  In such case, a dynamic page won't render well.
$rootDirectory = __DIR__ . "/../..";
require_once $rootDirectory . "/setting.php";
require_once $rootDirectory . "/" . LIBRARY_DIRECTORY . "/autoload.php";
require_once $rootDirectory . "/" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";


$post = array();

$post[MDCMS_POST_TITLE] = "Internal Server Error";
$post[MDCMS_POST_CONTENT] = "Some error occurs on our server";
$post[MDCMS_POST_STATUS] = 500;
$post[MDCMS_POST_WORD_COUNT] = 6;

$breadcrumb = array();

{
    $link = array();

    $link[MDCMS_LINK_PATH] = "/";
    $link[MDCMS_LINK_TITLE] = SITE_BREADCRUMB_HOME;

    array_push($breadcrumb, $link);
}

{
    $link = array();

    $link[MDCMS_LINK_TITLE] = "Internal Server Error";

    array_push($breadcrumb, $link);
}

$GLOBALS[MDCMS_POST] = $post;
$GLOBALS["breadcrumb"] = $breadcrumb;
$GLOBALS["file"] = __FILE__;

loadPost();
