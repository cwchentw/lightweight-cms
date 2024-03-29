<?php
# The RSS feed generator of Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";
# Load the built-in library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load the plubin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";


$dataDirectory = $rootDirectory . $sep . DATA_DIRECTORY;
$linkFile = $dataDirectory . $sep . "allLinks.json";

if (is_file($linkFile)) {
    $links = json_decode(file_get_contents($linkFile), TRUE);
}
else {
    $links = \LightweightCMS\Core\getAllLinks(SITE_PREFIX . "/");
}

$xml = new DOMDocument("1.0", "UTF-8");

# Pretty printing is not required because rss.xml is read by RSS readers.
#$xml->formatOutput = true;

$rss = $xml->createElement("rss");
$rss->setAttribute("version", "2.0");

$channel = $xml->createElement("channel");

$rss->appendChild($channel);

$siteTitle = $xml->createElement("title", SITE_NAME);
$channel->appendChild($siteTitle);

$siteDescription = $xml->createElement("description", SITE_DESCRIPTION);
$channel->appendChild($siteDescription);

$siteURL = $xml->createElement("link", SITE_BASE_URL . SITE_PREFIX . "/");
$channel->appendChild($siteURL);

usort($links, function ($a, $b) {
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

foreach ($links as $link) {
    $node = $xml->createElement("item");

    # Skip the home page.
    $url = SITE_BASE_URL . $link[LIGHTWEIGHT_CMS_LINK_PATH];
    $siteURL = SITE_BASE_URL . SITE_PREFIX . "/";
    if ($url == $siteURL)
        continue;

    $title = $link[LIGHTWEIGHT_CMS_POST_TITLE];
    $titleNode = $xml->createElement("title", $title);
    $node->appendChild($titleNode);

    if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $link)
        && array_key_exists("description", $link[LIGHTWEIGHT_CMS_POST_META]))
    {
        $description = $link[LIGHTWEIGHT_CMS_POST_META]["description"];
    }
    else {
        $description = \LightweightCMS\Plugin\excerpt($link[LIGHTWEIGHT_CMS_POST_CONTENT]);
    }
    $descriptionNode = $xml->createElement("description", $description);
    $node->appendChild($descriptionNode);

    $author = $link[LIGHTWEIGHT_CMS_POST_AUTHOR];
    $authorNode = $xml->createElement("author", $author);
    $node->appendChild($authorNode);

    $loc = $xml->createElement("link", $url);
    $node->appendChild($loc);

    $mtime = date("Y-m-d", $link[LIGHTWEIGHT_CMS_LINK_MTIME]);
    $date = $xml->createElement("pubDate", $mtime);
    $node->appendChild($date);

    $channel->appendChild($node);
}

$xml->appendChild($rss);

# Render rss.xml
echo $xml->saveXML();
