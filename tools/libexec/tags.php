<?php
# The RSS feed generator of Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Get global settings.
require_once $rootDirectory . $sep . "setting.php";

# Load required library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";

# Load required plubins.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";


$posts = \LightweightCMS\Core\getAllLinks("/");
usort($posts, function ($a, $b) {
    $ma = $a[LIGHTWEIGHT_CMS_POST_MTIME];
    $mb = $b[LIGHTWEIGHT_CMS_POST_MTIME];

    if ($ma < $mb) {
        return 1;
    }
    else if ($ma == $mb) {
        return 0;
    }
    else {
        return -1;
    }
});

$json = array();

foreach ($posts as $post) {
    # Skip the home page.
    $url = SITE_BASE_URL . $post[LIGHTWEIGHT_CMS_LINK_PATH];
    $siteURL = SITE_BASE_URL . SITE_PREFIX . "/";
    if ($url == $siteURL)
        continue;

    if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $post)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_TAGS, $post[LIGHTWEIGHT_CMS_POST_META]))
    {
        $tags = $post[LIGHTWEIGHT_CMS_POST_META][LIGHTWEIGHT_CMS_POST_TAGS];
    }
    else {
        $tags = array();  # A dummy array.
    }

    foreach ($tags as $tag) {
        if (!array_key_exists($tag, $json))
            $json[$tag] = array();

        array_push($json[$tag], $post[LIGHTWEIGHT_CMS_LINK_PATH]);
    }
}

# Create a data directory if it doesn't exist.
$dataDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY . $sep . "data";
if (!file_exists($dataDirectory)) {
    mkdir($dataDirectory);
}

# Create a JSON file as the tag data.
file_put_contents(
    $dataDirectory . $sep . "tags.json",
    0 === count($json) ? json_encode($json, JSON_FORCE_OBJECT) : json_encode($json, JSON_UNESCAPED_UNICODE)
);
