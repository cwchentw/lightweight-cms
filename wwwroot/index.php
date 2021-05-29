<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# TODO: Check whether `$_SERVER["REQUEST_URI"]` works well.
goto uri;

# Check whether the ?page query is set.
if (!isset($_GET["page"])) {
    $post = array();
    $post[MDCMS_POST_TITLE] = "Bad Request Error";
    $post[MDCMS_POST_CONTENT] = "Invalid URL";
    $post[MDCMS_POST_STATUS] = 400;
    goto render;
}

# TODO: Check it later.
uri:

# Filter the page parameter.
#$loc = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

# TODO: Check it later.
$loc = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $post = array();
    $post[MDCMS_POST_TITLE] = "Bad Request Error";
    $post[MDCMS_POST_CONTENT] = "Invalid URL";
    $post[MDCMS_POST_STATUS] = 400;
    goto render;
}

render:
    # Render an error page.
    if (isset($post) && 200 != $post["status"]) {
        # Currently, we use a superglobal variable to pass data.
        $GLOBALS[MDCMS_POST] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
    # Render a home page.
    else if (isHomePage($loc)) {
        $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
        $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
        $GLOBALS[MDCMS_PAGES] = getPages($loc);

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . HOME_LAYOUT;
    }
    # Render a section page.
    else if (isSection($loc)) {
        $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
        $GLOBALS[MDCMS_SECTION] = getSection($loc);
        $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
        $GLOBALS[MDCMS_PAGES] = getPages($loc);

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . LIST_LAYOUT;
    }
    # Render a post.
    else {
        $post = readPage($loc);

        # Fallback to a HTTP 404 page if no valid post.
        if (404 == $post[MDCMS_POST_STATUS]) {
            $post[MDCMS_POST_TITLE] = "Page Not Found";
            $post[MDCMS_POST_CONTENT] =
                "The post doesn't exist on the site. "
                . "Visit our <a href=\"/\">home</a> instead.";
        }

        # Currently, we use a superglobal variable to pass data.
        $GLOBALS[MDCMS_POST] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
