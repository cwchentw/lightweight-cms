<?php
namespace LightweightCMS\Core;
# Tag related function(s).


function getTags ()
{
    $sep = DIRECTORY_SEPARATOR;

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";

    $dataDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY . $sep . "data";
    $json = file_get_contents($dataDirectory . $sep . "tags.json");

    $result = array();

    $tags = json_decode($json, JSON_UNESCAPED_UNICODE);

    foreach ($tags as $tag => $paths) {
        $link = array();

        $link[LIGHTWEIGHT_CMS_POST_META] = array();
        $link[LIGHTWEIGHT_CMS_POST_TITLE] = $tag;
        $link[LIGHTWEIGHT_CMS_POST_META]["description"] = $tag . " related articles";
        $link[LIGHTWEIGHT_CMS_LINK_PATH] = "/tags/" . urlencode($tag) . "/";

        array_push($result, $link);
    }

    usort($result, $GLOBALS[SORT_POST_CALLBACK]);

    return $result;
}

function getTagsPerPage ($page)
{
    $result = getTags();

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

function tagPosts ($uri)
{
    $sep = DIRECTORY_SEPARATOR;

    require_once __DIR__ . $sep . "post.php";

    preg_match("/^\/tags\/(.+)\/$/", $uri, $matches);
    $tag = urldecode($matches[1]);

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    $dataDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY . $sep . "data";
    $json = file_get_contents($dataDirectory . $sep . "tags.json");

    $result = array();

    $tags = json_decode($json);

    foreach ($tags as $t => $p) {
        if ($t !== $tag)
            continue;

        foreach ($p as $path) {
            $post = readPost($path);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $path;

            array_push($result, $post);
        }
    }

    usort($result, $GLOBALS[SORT_POST_CALLBACK]);

    return $result;
}

function tagPostsPerTagPage ($uri, $page)
{
    $result = tagPosts($uri);

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

function tagPageBreadcrumb ($tag)
{
    # Create a breadcrumb dynamically.
    $breadcrumb = array();

    {
        $home = array();

        $home[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
        $home[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

        array_push($breadcrumb, $home);
    }

    {
        $tags = array();

        $tags[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/tags/";
        $tags[LIGHTWEIGHT_CMS_LINK_TITLE] = "Tags";

        array_push($breadcrumb, $tags);
    }

    {
        $tagPage = array();

        $tagPage[LIGHTWEIGHT_CMS_LINK_TITLE] = $tag;

        array_push($breadcrumb, $tagPage);
    }

return $breadcrumb;
}
