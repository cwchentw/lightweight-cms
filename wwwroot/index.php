<?php
# The router of mdcms.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";
require_once __DIR__ . "/../" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";


# Filter the input URI.
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
    $GLOBALS[MDCMS_POST] = $post;

    # TODO: Create a mock breadcrumb.

    loadLayout(POST_LAYOUT);
}
# Render the home page.
else if (isHome($loc)) {
    $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
    $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
    $GLOBALS[MDCMS_POSTS] = getPosts($loc);

    loadLayout(HOME_LAYOUT);
}
# Render a section page.
else if (isSection($loc)) {
    $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
    $GLOBALS[MDCMS_SECTION] = getSection($loc);
    $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
    $GLOBALS[MDCMS_POSTS] = getPosts($loc);

    loadLayout(SECTION_LAYOUT);
}
# Render a post.
else {
    $post = readPost($loc);

    # Redirect to a static 404.html.
    # TODO: Test the code.
    if (404 == $post[MDCMS_POST_STATUS]) {
        header("Location: " . "/404.html");
        die();
    }

    $GLOBALS[MDCMS_POST] = $post;
    $GLOBALS["breadcrumb"] = getBreadcrumb($loc);

    loadLayout(POST_LAYOUT);
}
