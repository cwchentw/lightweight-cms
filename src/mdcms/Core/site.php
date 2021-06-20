<?php
namespace mdcms\Core;
# Site related functions.


function hasSocialMedia()
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";

    return !("" == FACEBOOK
        && "" == FACEBOOK_GROUP
        && "" == TWITTER
        && "" == GITHUB); 
}

function getAllLinks($page)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load a local script.
    require_once __DIR__ . "/const.php";
    # Load a private script.
    require_once __DIR__ . "/_site.php";

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
