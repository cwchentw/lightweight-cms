<?php
namespace mdcms\Core;
# Site related functions.


function getAllLinks($uri)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/customPage.php";
    # Load a private script.
    require_once __DIR__ . "/_site.php";

    $result = array();

    $pages = array();

    # Add all valid directories and files into the queue.
    if (isHome($uri)) {
        $rootDirectory = __DIR__ . "/../../..";

        # The home page itself is a special page.
        {
            $link = array();

            $link[MDCMS_LINK_PATH] = $uri;
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
                $uri = getPageFromPath($path);
                $link = readHTMLLink($uri);
                $link[MDCMS_LINK_PATH] = $uri;
                $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

                # Skip functional posts.
                # TODO: We may change it later.
                if (!(array_key_exists(MDCMS_POST_META, $link)
                    && array_key_exists("noindex", $link[MDCMS_POST_META])
                    && $link[MDCMS_POST_META]))
                {
                    array_push($result, $link);
                }
            }
            else if (isMarkdownFile($path)) {
                $uri = getPageFromPath($path);
                $link = readMarkdownLink($uri);
                $link[MDCMS_LINK_PATH] = $uri;
                $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

                # Skip functional posts.
                # TODO: We may change it later.
                if (!(array_key_exists(MDCMS_POST_META, $link)
                    && array_key_exists("noindex", $link[MDCMS_POST_META])
                    && $link[MDCMS_POST_META]))
                {
                    array_push($result, $link);
                }
            }
            else if (isPHPFile($path)) {
                $uri = getPageFromPath($path);
                $link = readCustomPage($uri);
                $link[MDCMS_LINK_PATH] = $uri;
                $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

                # Skip functional posts.
                # TODO: We may change it later.
                if (!(array_key_exists(MDCMS_POST_META, $link)
                    && array_key_exists("noindex", $link[MDCMS_POST_META])
                    && $link[MDCMS_POST_META]))
                {
                    array_push($result, $link);
                }
            }
        }
    }
    # Add itself into the queue.
    else {
        array_push($pages, $uri);
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
        $phpPath = $path . ".php";

        /* `$path` is a HTML file. */
        if (file_exists($htmlPath)) {
            $uri = getPageFromPath($path);
            $link = readHTMLLink($uri);
            $link[MDCMS_LINK_PATH] = $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (!(array_key_exists(MDCMS_POST_META, $link)
                && array_key_exists("noindex", $link[MDCMS_POST_META])
                && $link[MDCMS_POST_META]))
            {
                array_push($result, $link);
            }
        }
        /* `$path` is a Markdown file. */
        else if (file_exists($markdownPath)) {
            $uri = getPageFromPath($path);
            $link = readMarkdownLink($uri);
            $link[MDCMS_LINK_PATH] = $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (!(array_key_exists(MDCMS_POST_META, $link)
                && array_key_exists("noindex", $link[MDCMS_POST_META])
                && $link[MDCMS_POST_META]))
            {
                array_push($result, $link);
            }
        }
        else if (file_exists($phpPath)) {
            $uri = getPageFromPath($phpPath);
            $link = readCustomPage($uri);
            $link[MDCMS_LINK_PATH] = $uri;
            $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

            # Skip functional posts.
            # TODO: We may change it later.
            if (!(array_key_exists(MDCMS_POST_META, $link)
                && array_key_exists("noindex", $link[MDCMS_POST_META])
                && $link[MDCMS_POST_META]))
            {
                array_push($result, $link);
            }
        }
        /* `$path` is a directory. */
        else if (is_dir($dirpath)) {
            /* Convert from path to page. */
            if (!BLOCK_BOT_ON_SECTION) {
                $uri = getPageFromPath($dirpath);
                $link = readDirectoryLink($uri);
                $link[MDCMS_LINK_PATH] = $uri;
                $link[MDCMS_LINK_MTIME] = stat($dirpath)["mtime"];
                array_push($result, $link);
            }

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
                    $uri = getPageFromPath($subpath);
                    $link = readHTMLLink($uri);
                    $link[MDCMS_LINK_PATH] = $uri;
                    $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (!(array_key_exists(MDCMS_POST_META, $link)
                        && array_key_exists("noindex", $link[MDCMS_POST_META])
                        && $link[MDCMS_POST_META]))
                    {
                        array_push($result, $link);
                    }
                }
                # Load a Markdown file.
                else if (isMarkdownFile($subpath)) {
                    $uri = getPageFromPath($subpath);
                    $link = readMarkdownLink($uri);
                    $link[MDCMS_LINK_PATH] = $uri;
                    $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (!(array_key_exists(MDCMS_POST_META, $link)
                        && array_key_exists("noindex", $link[MDCMS_POST_META])
                        && $link[MDCMS_POST_META]))
                    {
                        array_push($result, $link);
                    }
                }
                else if (isPHPFile($subpath)) {
                    $uri = getPageFromPath($subpath);
                    $link = readCustomPage($uri);
                    $link[MDCMS_LINK_PATH] = $uri;
                    $link[MDCMS_LINK_MTIME] = $link[MDCMS_POST_MTIME];
    
                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (!(array_key_exists(MDCMS_POST_META, $link)
                        && array_key_exists("noindex", $link[MDCMS_POST_META])
                        && $link[MDCMS_POST_META]))
                    {
                        array_push($result, $link);
                    }
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
