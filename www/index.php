<?php
# The router of mdcms.

require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";
require_once __DIR__ . "/../" . PLUGIN_DIRECTORY . "/autoload.php";
require_once __DIR__ . "/../" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";
# TODO: Load Xdebug on a development environment.


# TODO: Check essential variables on a development environment.

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

    loadPost();
}
# Render the home page.
else if (isHome($loc)) {
    $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
    $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
    $GLOBALS[MDCMS_POSTS] = getPosts($loc);

    loadHome();
}
# Render a section page.
else if (isSection($loc)) {
    $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
    $GLOBALS[MDCMS_SECTION] = getSection($loc);
    $GLOBALS[MDCMS_SECTIONS] = getSections($loc);
    $GLOBALS[MDCMS_POSTS] = getPosts($loc);

    loadSection();
}
# Render a post.
else {
    $post = readPost($loc);

    # If HTTP status 404, generate a page on-the-fly.
    if (404 == $post[MDCMS_POST_STATUS]) {
        # Mutate `$post` to generate a new page.
        $post = array();

        $post[MDCMS_POST_TITLE] = "Page Not Found";
        $post[MDCMS_POST_CONTENT] = "The page doesn't exist on our server.";
        $post[MDCMS_POST_STATUS] = 404;
        $post[MDCMS_POST_WORD_COUNT] = 7;

        # Create mock breadcrumbs.
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

        $GLOBALS[MDCMS_POST] = $post;
        $GLOBALS["breadcrumb"] = $breadcrumb;
    }
    # Load a normal page.
    else {
        $GLOBALS[MDCMS_POST] = $post;
        $GLOBALS["breadcrumb"] = getBreadcrumb($loc);
    }

    loadPost();
}