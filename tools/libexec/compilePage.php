<?php
# Static page generator for Lightweight CMS.

error_reporting(E_ERROR);

$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load global settings.
require_once $rootDirectory . $sep . "setting.php";
# Load builtin library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load plugin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
# Load a theme.
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


if (count($argv) <= 1) {
    fwrite(STDERR, "No valid URI" . PHP_EOL);
    exit(1);
}

$loc = $argv[1];
# Trick for PHP CLI.
$_SERVER["REQUEST_URI"] = $loc;

if ("" != SITE_PREFIX) {
    $origLoc = $loc;
    $loc = substr($loc, strlen(SITE_PREFIX));
}

if (\LightweightCMS\Core\isHome($loc)) {
    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($loc);
    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = \LightweightCMS\Core\getSections($loc);
    # Posts not included in any section.
    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getPosts($loc);
    # First page in a series of pages.
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getPostsPerPage($loc, 0);
    }

    loadHome();
}
# Render a page of home page.
else if (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInHome($loc)) {
    $homeURI = "/";
    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($homeURI);
    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = \LightweightCMS\Core\getSections($homeURI);
    # Posts not included in any section.
    if (!is_null(SITE_STYLE) && "blog" === SITE_STYLE) {
        $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getAllPosts(SITE_PREFIX . "/");
    }
    else {
        $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getPosts($homeURI);
    }

    preg_match("/^\/(\d+)\/$/", $loc, $matches);
    $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getPostsPerPage($homeURI, $matches[1]);

    # Show HTTP 404 page if no post on this page.
    if (!is_null(SITE_STYLE) && "blog" === SITE_STYLE) {
        $c = count($GLOBALS[LIGHTWEIGHT_CMS_POSTS]);
        $p = ceil($c / POST_PER_PAGE);
        if ($matches[1] >= $p) {
            $post = \LightweightCMS\Core\errorPage(
                "Page Not Found",
                "The page doesn't exist on our server.",
                404
            );

            # Create a breadcrumb dynamically.
            $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

            $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
            $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

            loadPost();
        }
        else {
            loadHome();
        }
    }
    else {
        if (count($GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]) <= 0) {
            $post = \LightweightCMS\Core\errorPage(
                "Page Not Found",
                "The page doesn't exist on our server.",
                404
            );

            # Create a breadcrumb dynamically.
            $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

            $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
            $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

            loadPost();
        }
        else {
            loadHome();
        }
    }
}
# Tags is a special section.
else if (\LightweightCMS\Core\isTags($loc)) {
    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\errorPageBreadcrumb("Tags");

    # Create a special section on-the-fly.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = array();
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION][LIGHTWEIGHT_CMS_SECTION_TITLE] = "Tags";

    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = array();  # Tags owns no subsection.

    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getTags();
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getTagsPerPage(0);
    }

    loadSection();
}
# Render a page of a tags section.
else if (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInTags($loc)) {
    preg_match("/^\/tags\/(\d+)\/$/", $loc, $matches);
    $page = $matches[1];

    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\errorPageBreadcrumb("Tags");

    # Create a special section on-the-fly.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = array();
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION][LIGHTWEIGHT_CMS_SECTION_TITLE] = "Tags";

    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = array();  # Tags owns no subsection.

    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getTags();
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getTagsPerPage($page);
    }

    # Show HTTP 404 page if no post on this page.
    if (count($GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]) <= 0) {
        $post = \LightweightCMS\Core\errorPage(
            "Page Not Found",
            "The page doesn't exist on our server.",
            404
        );

        # Create a breadcrumb dynamically.
        $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

        $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

        loadPost();
    }
    else {
        loadSection();
    }
}
else if (\LightweightCMS\Core\IsPageInTagPage($loc)) {
    preg_match("/^\/tags\/([^\/]+?)\/(\d+)\/$/", $loc, $matches);
    $tag = urldecode($matches[1]);
    $page = $matches[2];

    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\tagPageBreadcrumb($tag);

    # Create a special section on-the-fly.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = array();
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION][LIGHTWEIGHT_CMS_SECTION_TITLE] = "[Tag] " . $tag;

    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = array();

    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\tagPosts(
        SITE_PREFIX . "/tags/" . urlencode($tag) . "/"
    );
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\tagPostsPerTagPage(
            SITE_PREFIX . "/tags/" . urlencode($tag) . "/",
            $page
        );
    }

    # Show HTTP 404 page if no post on this page.
    if (count($GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]) <= 0) {
        $post = \LightweightCMS\Core\errorPage(
            "Page Not Found",
            "The page doesn't exist on our server.",
            404
        );

        # Create a breadcrumb dynamically.
        $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

        $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

        loadPost();
    }
    else {
        loadSection();
    }
}
# Render a tag page, which is a section as well.
else if (\LightweightCMS\Core\isTagPage($loc)) {
    preg_match("/^\/tags\/(.+)\/$/", $loc, $matches);
    $tag = urldecode($matches[1]);

    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\tagPageBreadcrumb($tag);

    # Create a special section on-the-fly.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = array();
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION][LIGHTWEIGHT_CMS_SECTION_TITLE] = "[Tag] " . $tag;

    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = array();

    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\tagPosts($loc);
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\tagPostsPerTagPage($loc, 0);
    }

    loadSection();
}
# Render a section.
else if (\LightweightCMS\Core\isSection($loc)) {
    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($loc);
    # Current section.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = \LightweightCMS\Core\readSection($loc);
    # Subsections of current section.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = \LightweightCMS\Core\getSections($loc);
    # Posts of current section.
    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getPosts($loc);
    # First page in a series of pages.
    if (POST_PER_PAGE > 0) {
        $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getPostsPerPage($loc, 0);
    }

    loadSection();
}
# Render a page of a section.
else if (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInSection($loc)) {
    preg_match("/^\/(.+)\/(\d+)\/$/", $loc, $matches);
    $sectionURI = "/" . $matches[1] . "/";
    $page = $matches[2];

    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($sectionURI);
    # Current section.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTION] = \LightweightCMS\Core\readSection($sectionURI);
    # Subsections of current section.
    $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS] = \LightweightCMS\Core\getSections($sectionURI);
    # Posts of current section.
    $GLOBALS[LIGHTWEIGHT_CMS_POSTS] = \LightweightCMS\Core\getPosts($sectionURI);
    # A page in a series of pages.
    $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE] = \LightweightCMS\Core\getPostsPerPage($sectionURI, $page);

    # Show HTTP 404 page if no post on this page.
    if (count($GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]) <= 0) {
        $post = \LightweightCMS\Core\errorPage(
            "Page Not Found",
            "The page doesn't exist on our server.",
            404
        );

        # Create a breadcrumb dynamically.
        $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

        $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

        loadPost();
    }
    else {
        loadSection();
    }
}
# Render a PHP page, which is a special case of a post.
else if (\LightweightCMS\Core\isPage($loc)) {
    $GLOBALS[LIGHTWEIGHT_CMS_POST] = \LightweightCMS\Core\readPost($loc);

    if (200 === $GLOBALS[LIGHTWEIGHT_CMS_POST][LIGHTWEIGHT_CMS_POST_STATUS]) {
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($loc);
    }
    # Something is wrong while rendering a post.
    else {
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\errorPageBreadcrumb($GLOBALS[LIGHTWEIGHT_CMS_POST][LIGHTWEIGHT_CMS_POST_TITLE]);
    }

    loadPage();
}
# Render a post.
else if (\LightweightCMS\Core\isPost($loc)) {
    $GLOBALS[LIGHTWEIGHT_CMS_POST] = \LightweightCMS\Core\readPost($loc);

    if (200 === $GLOBALS[LIGHTWEIGHT_CMS_POST][LIGHTWEIGHT_CMS_POST_STATUS]) {
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\getBreadcrumb($loc);
    }
    # Something is wrong while rendering a post.
    else {
        $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = \LightweightCMS\Core\errorPageBreadcrumb($GLOBALS[LIGHTWEIGHT_CMS_POST][LIGHTWEIGHT_CMS_POST_TITLE]);
    }

    loadPost();
}
# Draft pages or anything else.
else {
    $post = \LightweightCMS\Core\errorPage(
        "Page Not Found",
        "The page doesn't exist on our server.",
        404
    );

    # Create a breadcrumb dynamically.
    $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Page Not Found");

    $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
    $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

    loadPost();
}
