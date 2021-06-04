<?php
# A HTTP status 404 error page generator of mdcms.
#
# A 404.html may be either static or dynamic. Here we create a static one.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


$post = array();

$post[MDCMS_POST_TITLE] = "Page Not Found";
$post[MDCMS_POST_CONTENT] = "The page doesn't exist on our server";
$post[MDCMS_POST_STATUS] = 404;
$post[MDCMS_POST_WORD_COUNT] = 7;

$breadcrumb = array();

{
    $link = array();

    $link[MDCMS_LINK_PATH] = "/";
    $link[MDCMS_LINK_TITLE] = SITE_BREADCRUMB_HOME;

    array_push($breadcrumb, $link);
}

{
    $link = array();

    $link[MDCMS_LINK_TITLE] = "Page Not Found";

    array_push($breadcrumb, $link);
}

$_GLOBALS[MDCMS_POST] = $post;
$_GLOBALS["breadcrumb"] = $breadcrumb;

require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
