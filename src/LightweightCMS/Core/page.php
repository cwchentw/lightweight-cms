<?php
namespace LightweightCMS\Core;
# Functions for all pages.


function getHomeContent()
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    require_once $rootDirectory . "/vendor/autoload.php";

    $contentDirectory = $rootDirectory . "/" . CONTENT_DIRECTORY;
    $indexPage = $contentDirectory . "/" . SECTION_INDEX;

    $result = "";

    if (file_exists($indexPage)) {
        $rawContent = file_get_contents($indexPage);

        $parser = new \Mni\FrontYAML\Parser();

        $document = $parser->parse($rawContent);

        # Discard metadata from index page.
        #$metadata = $document->getYAML();

        # Strip metadata from index page.
        $stripedContent = $document->getContent();

        $result .= $stripedContent;
    }

    return $result;
}

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
                $section[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/" . $file . "/";
            }
            # Get subsection(s) of a section.
            else {
                $section = readSection($uri . $file);
                $section[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri . $file . "/";
            }

            # Skip functional sections.
            # TODO: We may change it later.
            if (!(isValidField($section[LIGHTWEIGHT_CMS_SECTION_META], METADATA_NOINDEX)
                    && $section[LIGHTWEIGHT_CMS_SECTION_META][METADATA_NOINDEX]))
            {
                array_push($result, $section);
            }
        }
    }

    usort($result, $GLOBALS[SORT_SECTION_CALLBACK]);

    return $result;
}

function getPosts($uri)
{
    $rootDirectory = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";
    # Load local scripts.
    require_once __DIR__ . "/const.php";
    require_once __DIR__ . "/post.php";
    require_once __DIR__ . "/customPage.php";

    $result = array();

    $modifiedURI = preg_replace("/\//", DIRECTORY_SEPARATOR, $uri);
    $directory = $rootDirectory . DIRECTORY_SEPARATOR . CONTENT_DIRECTORY . $modifiedURI;
    $files = scandir($directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }
        else if ("_" == substr($file, 0, 1)) {
            continue;
        }

        $path = $directory . $file;
        if (is_file($path)) {
            $link = array();

            # Remove file extensions.
            $origPath = $uri . pathinfo($file, PATHINFO_FILENAME) . "/";
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $origPath;

            # Get information of a post.
            # TODO: If the commands cost too many system resources, change it.
            if ("php" == pathinfo($path)["extension"]) {
                $post = readCustomPage($origPath);
            }
            else {
                $post = readPost($origPath);
            }

            foreach ($post as $key => $value) {
                $link[$key] = $value;
            }

            # Skip functional posts.
            # TODO: We may change it later.
            if (!(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $post[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
    }

    usort($result, $GLOBALS[SORT_POST_CALLBACK]);

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
    require_once __DIR__ . "/customPage.php";
    # Load private scripts.
    require_once __DIR__ . "/_site.php";
    require_once __DIR__ . "/_uri.php";

    $result = array();

    # Add the link to home.
    $d = array();

    $d[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
    $d[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($result, $d);

    if ("/" == $uri) {
        return $result;
    }

    $arr = parseURI($uri);
    $len = count($arr);
    for ($i = 0; $i < $len; ++$i) {
        $prev = $result[$i][LIGHTWEIGHT_CMS_LINK_PATH];

        if ("" != SITE_PREFIX) {
            $prevPath = substr($prev, strlen(SITE_PREFIX));
        }
        else {
            $prevPath = $prev;
        }

        $rootDirectory = __DIR__ . "/../../..";
        $path = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath . $arr[$i];
        $htmlPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . HTML_FILE_EXTENSION;
        $markdownPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . MARKDOWN_FILE_EXTENSION;
        $asciiDocPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . ASCIIDOC_FILE_EXTENSION;
        $reStructuredTextPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . RESTRUCTUREDTEXT_FILE_EXTENSION;
        $phpPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . ".php";

        $d = array();
        $d[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

        if (is_dir($path)) {
            $section = readSection($prevPath . $arr[$i]);
            $section[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";
            array_push($result, $section);
        }
        else if (file_exists($htmlPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($markdownPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($asciiDocPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($reStructuredTextPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($phpPath)) {
            $post = readCustomPage($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
    }

    return $result;
}
