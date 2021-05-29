<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";

# Remove it later.
$loc = "/";
goto render;

# Check whether the ?page query is set.
if (!isset($_GET["page"])) {
    $post = array();
    $post[MDCMS_POST_TITLE] = "Bad Request Error";
    $post[MDCMS_POST_CONTENT] = "Invalid URL";
    $post[MDCMS_POST_STATUS] = 400;
    goto render;
}

# Get page location in the ?page query param.
$loc = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $post = array();
    $post[MDCMS_POST_TITLE] = "Bad Request Error";
    $post[MDCMS_POST_CONTENT] = "Invalid URL";
    $post[MDCMS_POST_STATUS] = 400;
    goto render;
}

render:
    if (isset($post) && 200 != $post["status"]) {
        # Currently, we use a superglobal variable to pass data.
        $GLOBALS[MDCMS_POST] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
    else if (isHomePage($loc)) {
        $GLOBALS[MDCMS_SECTIONS] = getSections();
        $GLOBALS[MDCMS_PAGES] = getPages();

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . INDEX_LAYOUT;
    }
    else if (isSection($loc)) {
        $GLOBALS[MDCMS_SECTION] = getSection($loc);
        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . LIST_LAYOUT;
    }
    else {
        $post = readPage($loc);

        # HTTP 404 Page.
        if (404 == $post[MDCMS_POST_STATUS]) {
            $post[MDCMS_POST_TITLE] = "Page Not Found";
            $post[MDCMS_POST_CONTENT] = "The post doesn't exist on the website";
        }

        # Currently, we use a superglobal variable to pass data.
        $GLOBALS[MDCMS_POST] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
