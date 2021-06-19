<?php
namespace mdcms\Core;

# Site related functions.

# Get the root path of mdcms.
$rootDirectory = __DIR__ . "/../../..";

# Load third-party libraries.
require_once $rootDirectory . "/vendor/autoload.php";
# Get global setting.
require_once $rootDirectory . "/setting.php";
# Load local libraries.
require_once __DIR__ . "/const.php";
require_once __DIR__ . "/section.php";
require_once __DIR__ . "/page.php";
# Load a private library.
require_once __DIR__ . "/_site.php";


function hasSocialMedia()
{
    return !("" == FACEBOOK
        && "" == FACEBOOK_GROUP
        && "" == TWITTER
        && "" == GITHUB); 
}

# Nested sections are supported. Nonetheless, it is not recommended
#  because of SEO. Instead, two layers of web pages are purposed,
#  like "/section-title/post-title/".
function getSections($page)
{
    $result = array();

    $rootDirectory = __DIR__ . "/../../..";
    $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY . $page;
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
            if ("/" == $page) {
                $section = readSection("/" . $file);
                $section[MDCMS_LINK_PATH] = "/" . $file . "/";
            }
            # Get subsection(s) of a section.
            else {
                $section = readSection($page . $file);
                $section[MDCMS_LINK_PATH] = $page . $file . "/";
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

function getPosts($page)
{
    $result = array();

    $rootDirectory = __DIR__ . "/../../..";
    $directory = $rootDirectory . "/" . CONTENT_DIRECTORY . $page;
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
                = $page . pathinfo($file, PATHINFO_FILENAME) . "/";

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

function getBreadcrumb($page)
{
    $result = array();

    # Add the link to home.
    $d = array();

    $d[MDCMS_LINK_PATH] = "/";
    $d[MDCMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($result, $d);

    if ("/" == $page) {
        return $result;
    }

    $arr = parsePage($page);
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

function getAllLinks($page)
{
    $result = array();

    $pages = array();

    # Add all valid directories and files into the queue.
    if (isHome($page)) {
        $rootDirectory = __DIR__ . "/../../..";

        # The home page itself is a special page.
        {
            $link = array();

            $link[MDCMS_LINK_PATH] = $page;
            $link[MDCMS_LINK_TITLE] = SITE_NAME . " - " . SITE_DESCRIPTION;

            # FIXME: Unable to get mtime.
            $indexPath = $rootDirectory . "/" . CONTENT_DIRECTORY;
            $link[MDCMS_LINK_MTIME] = stat($indexPath)["mtime"];

            array_push($result, $link);
        }

        $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY;
        $files = scandir($contentDirectory);

        foreach ($files as $file) {
            # Skip private files.
            if ("." == substr($file, 0, 1)) {
                continue;
            }
            else if ("_" == substr($file, 0, 1)) {
                continue;
            }

            $path = $contentDirectory . "/" . $file;
            if (is_dir($path)) {
                $page = getPageFromPath($path);
                array_push($pages, $page);
            }
            else if (isHTMLFile($path)) {
                $page = getPageFromPath($path);
                array_push($result, readHTMLLink($page));
            }
            else if (isMarkdownFile($path)) {
                $page = getPageFromPath($path);
                array_push($result, readMarkdownLink($page));
            }
        }
    }
    # Add itself into the queue.
    else {
        array_push($pages, $page);
    }

    while (count($pages) > 0) {
        $currentPage = array_shift($pages);

        /* We cannot tell what `$page` is by its path. */
        $rootDirectory = __DIR__ . "/../../..";
        $path = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $currentPage;
        $dirpath = $path;
        if ("/" != substr($dirpath, strlen($dirpath)-1, 1)) {
            $dirpath .= "/";
        }
        $htmlPath = $path . HTML_FILE_EXTENSION;
        $markdownPath = $path . MARKDOWN_FILE_EXTENSION;

        /* `$path` is a HTML file. */
        if (file_exists($htmlPath)) {
            array_push($result, readHTMLLink($page));
        }
        /* `$path` is a Markdown file. */
        else if (file_exists($markdownPath)) {
            array_push($result, readMarkdownLink($page));
        }
        /* `$path` is a directory. */
        else if (is_dir($dirpath)) {
            /* Convert from path to page. */
            $page = getPageFromPath($dirpath);
            $link = readDirectoryLink($page);
            array_push($result, $link);

            $subfiles = scandir($dirpath, SCANDIR_SORT_ASCENDING);

            foreach ($subfiles as $subfile) {
                # Skip private files.
                if ("." == substr($subfile, 0, 1)) {
                    continue;
                }
                else if ("_" == substr($subfile, 0, 1)) {
                    continue;
                }

                $subpath = $dirpath . $subfile;

                # Load a directory.
                if (is_dir($subpath)) {
                    array_push($pages, getPageFromPath($subpath));
                }
                # Load a HTML file.
                else if (isHTMLFile($subpath)) {
                    $subpage = getPageFromPath($subpath);
                    array_push($result, readHTMLLink($subpage));
                }
                # Load a Markdown file.
                else if (isMarkdownFile($subpath)) {
                    $subpage = getPageFromPath($subpath);
                    array_push($result, readMarkdownLink($subpage));
                }
                # Ignore everything else.
                else {
                    # Pass.
                }
            }
        }
    }

    return $result;
}
