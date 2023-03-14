<?php
namespace LightweightCMS\Core;
# Site related functions.


function getAllLinks($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Get the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load some local scripts.
    require_once __DIR__ . $sep . "const.php";
    require_once __DIR__ . $sep . "customPage.php";
    require_once __DIR__ . $sep . "post.php";
    # Load some private scripts.
    require_once __DIR__ . $sep . "_site.php";
    require_once __DIR__ . $sep . "_utils.php";

    $result = array();

    $pages = array();

    # Add all valid directories and files into the queue.
    if (isHome($uri)) {
        # The home page itself is a special page.
        {
            $link = array();

            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;
            $link[LIGHTWEIGHT_CMS_LINK_TITLE] = SITE_NAME . " - " . SITE_DESCRIPTION;

            # FIXME: Unable to get mtime.
            $indexPath = $rootDirectory . "/" . CONTENT_DIRECTORY;
            $link[LIGHTWEIGHT_CMS_LINK_MTIME] = stat($indexPath)["mtime"];

            array_push($result, $link);
        }

        $contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;
        $files = scandir($contentDirectory);

        foreach ($files as $file) {
            # Skip private files.
            if ("." == substr($file, 0, 1)) {
                continue;
            }
            else if ("_" == substr($file, 0, 1)) {
                continue;
            }

            $path = $contentDirectory . $sep . $file;
            if (is_dir($path)) {
                $page = getPageFromPath($path);
                array_push($pages, $page);
            }
            else if (isHTMLFile($path)) {
                $uri = getPageFromPath($path);
                $link = readPost($uri);
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                # Skip functional posts.
                # TODO: We may change it later.
                if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                {
                    array_push($result, $link);
                }
            }
            else if (isMarkdownFile($path)) {
                $uri = getPageFromPath($path);
                $link = readPost($uri);
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                # Skip functional posts.
                # TODO: We may change it later.
                if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                {
                    array_push($result, $link);
                }
            }
            else if (strpos($path, ASCIIDOC_FILE_EXTENSION)) {
                $uri = getPageFromPath($path);
                $link = readPost($uri);
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                # Skip functional posts.
                # TODO: We may change it later.
                if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                {
                    array_push($result, $link);
                }
            }
            else if (strpos($path, RESTRUCTUREDTEXT_FILE_EXTENSION)) {
                $uri = getPageFromPath($path);
                $link = readPost($uri);
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                # Skip functional posts.
                # TODO: We may change it later.
                if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                {
                    array_push($result, $link);
                }
            }
            else if (isPHPFile($path)) {
                $uri = getPageFromPath($path);
                $link = readCustomPage($uri);
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                # Skip functional posts.
                # TODO: We may change it later.
                if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                    && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                        && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
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
        $asciiDocPath = $path . ASCIIDOC_FILE_EXTENSION;
        $rstDocPath = $path . RESTRUCTUREDTEXT_FILE_EXTENSION;
        $phpPath = $path . ".php";

        /* `$path` is a HTML file. */
        if (file_exists($htmlPath)) {
            $uri = getPageFromPath($path);
            $link = readPost($uri);
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
        /* `$path` is a Markdown file. */
        else if (file_exists($markdownPath)) {
            $uri = getPageFromPath($path);
            $link = readPost($uri);
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
        else if (file_exists($asciiDocPath)) {
            $uri = getPageFromPath($path);
            $link = readPost($uri);
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
        else if (file_exists($rstDocPath)) {
            $uri = getPageFromPath($path);
            $link = readPost($uri);
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
        else if (file_exists($phpPath)) {
            $uri = getPageFromPath($phpPath);
            $link = readPost($uri);
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

            # Skip functional posts.
            # TODO: We may change it later.
            if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
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
                $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;
                $link[LIGHTWEIGHT_CMS_LINK_MTIME] = stat($dirpath)["mtime"];
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
                    $link = readPost($uri);
                    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                    {
                        array_push($result, $link);
                    }
                }
                # Load a Markdown file.
                else if (isMarkdownFile($subpath)) {
                    $uri = getPageFromPath($subpath);
                    $link = readPost($uri);
                    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                    {
                        array_push($result, $link);
                    }
                }
                else if (strpos($subpath, ASCIIDOC_FILE_EXTENSION)) {
                    $uri = getPageFromPath($subpath);
                    $link = readPost($uri);
                    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                    {
                        array_push($result, $link);
                    }
                }
                else if (strpos($subpath, RESTRUCTUREDTEXT_FILE_EXTENSION)) {
                    $uri = getPageFromPath($subpath);
                    $link = readPost($uri);
                    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
                    {
                        array_push($result, $link);
                    }
                }
                else if (isPHPFile($subpath)) {
                    $uri = getPageFromPath($subpath);
                    $link = readPost($uri);
                    $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri;

                    # Skip functional posts.
                    # TODO: We may change it later.
                    if (isValidField($link, LIGHTWEIGHT_CMS_POST_META)
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                        && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                            && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
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
