<?php
namespace mdcms\Core;
# Functions for all pages.


# Nested sections are supported. Nonetheless, it is not recommended
#  because of SEO. Instead, two layers of web pages are purposed,
#  like "/section-title/post-title/".
function getSections($uri)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/section.php";

    $result = array();

    $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY . $uri;
    $files = scandir($contentDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        $path = $contentDirectory . "/" . $file;
        if (is_dir($path)) {
            $section = null;
            # Get top section(s).
            if ("/" == $uri) {
                $section = readSection("/" . $file);
                $section[MDCMS_LINK_PATH] = "/" . $file . "/";
            }
            # Get subsection(s) of a section.
            else {
                $section = readSection($uri . $file);
                $section[MDCMS_LINK_PATH] = $uri . $file . "/";
            }

            array_push($result, $section);
        }
    }

    usort($result, $GLOBALS[SORT_SECTION_CALLBACK]);

    # Skip to scan the application directory.
    if (!SCAN_APPLICATION_DIRECTORY) {
        return $result;
    }

    # Scan custom directories added in the application directory
    #  by users of mdcms as well.
    $applicationDirectory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($applicationDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        $path = $contentDirectory . "/" . $file;
        if (is_dir($path)) {
            $d = array();

            $d[MDCMS_LINK_PATH] = $file;

            $t = preg_replace("/\/|-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d[MDCMS_LINK_TITLE] = $t;

            array_push($result, $d);
        }
    }

    return $result;
}

function getPosts($uri)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/post.php";

    $result = array();
    
    $directory = $rootDirectory . "/" . CONTENT_DIRECTORY . $uri;
    $files = scandir($directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }
        else if ("_" == substr($file, 0, 1)) {
            continue;
        }

        $path = $directory . "/" . $file;
        if (is_file($path)) {
            $link = array();

            # Remove file extensions.
            $link[MDCMS_LINK_PATH]
                = $uri . pathinfo($file, PATHINFO_FILENAME) . "/";

            # Get the title of the page.
            # If the commands cost too many system resources, change it.
            $post = readPost($link[MDCMS_LINK_PATH]);

            foreach ($post as $key => $value) {
                $link[$key] = $value;
            }

            array_push($result, $link);
        }
    }

    usort($result, $GLOBALS[SORT_POST_CALLBACK]);

    # Skip to scan the application directory.
    if (!SCAN_APPLICATION_DIRECTORY) {
        return $result;
    }

    # Scan custom pages added in the application directory
    #  by users of mdcms as well.
    $applicationDirectory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($applicationDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        # Skip the index script.
        if ("index.php" == $file) {
            continue;
        }

        $path = $applicationDirectory . "/" . $file;
        if (is_file($path)) {
            $f = array();

            # It is not a pretty URL. Keep its file extension *as is*.
            $f[MDCMS_LINK_PATH] = $file;

            # Get the title of the page.
            $t = pathinfo($file, PATHINFO_FILENAME);
            $t = preg_replace("/-+/", " ", $t);
            $t = ucwords($t);  # Capitalize a title.
            $f[MDCMS_LINK_TITLE] = $t;

            array_push($result, $f);
        }
    }

    return $result;
}

function getPostsPerPage($uri, $page)
{
    $result = getPosts($uri);

    # Discard some post(s) if pagination is on.
    if (POST_PER_PAGE > 0) {
        # Discard previous post(s).
        $prevCount = 0;
        while (count($result) > 0 && $prevCount < $page * POST_PER_PAGE) {
            array_shift($result);
            $prevCount += 1;
        }

        # Discard next post(s).
        while (count($result) > POST_PER_PAGE) {
            array_pop($result);
        }
    }

    return $result;
}

function getBreadcrumb($uri)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load a local script.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/uri.php";
    require_once __DIR__ . "/post.php";
    # Load private scripts.
    require_once __DIR__ . "/_site.php";
    require_once __DIR__ . "/_uri.php";

    $result = array();

    # Add the link to home.
    $d = array();

    $d[MDCMS_LINK_PATH] = "/";
    $d[MDCMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($result, $d);

    if ("/" == $uri) {
        return $result;
    }

    $arr = parseURI($uri);
    $len = count($arr);
    for ($i = 0; $i < $len; ++$i) {
        $prev = $result[$i][MDCMS_LINK_PATH];

        $rootDirectory = __DIR__ . "/../../..";
        $path = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prev . $arr[$i];
        $htmlPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prev
            . $arr[$i] . HTML_FILE_EXTENSION;
        $markdownPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prev
            . $arr[$i] . MARKDOWN_FILE_EXTENSION;

        $d = array();
        $d[MDCMS_LINK_PATH] = $prev . $arr[$i] . "/";

        if (is_dir($path)) {
            $section = readSection($prev . $arr[$i]);
            $section[MDCMS_LINK_PATH] = $prev . $arr[$i] . "/";
            array_push($result, $section);
        }
        else if (file_exists($htmlPath)) {
            $post = readPost($prev . $arr[$i]);
            $post[MDCMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($markdownPath)) {
            $post = readPost($prev . $arr[$i]);
            $post[MDCMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
    }

    return $result;
}
