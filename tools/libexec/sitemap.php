<?php
# The sitemap.xml generator for Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";
# Load the built-in library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";


$dataDirectory = $rootDirectory . $sep . DATA_DIRECTORY;
$linkFile = $dataDirectory . $sep . "allLinks.json";

if (is_file($linkFile)) {
    $links = json_decode(file_get_contents($linkFile), TRUE);
}
else {
    $links = \LightweightCMS\Core\getAllLinks(SITE_PREFIX . "/");
}

$xml = new DOMDocument("1.0", "UTF-8");

# Pretty printing is not required because sitemap.xml is read by search engine bots.
#$xml->formatOutput = true;

$urlset = $xml->createElement("urlset");
$urlset->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

foreach ($links as $link) {
    $node = $xml->createElement("url");

    $url = SITE_BASE_URL . $link[LIGHTWEIGHT_CMS_LINK_PATH];
    $loc = $xml->createElement("loc", $url);
    $node->appendChild($loc);

    $mtime = $xml->createElement("lastmod", date("Y-m-d", $link[LIGHTWEIGHT_CMS_LINK_MTIME]));
    $node->appendChild($mtime);

    # Currently, we simply hard code the frequency of document change.
    # Search engines don't always follow this attribute.
    $changefreq = $xml->createElement("changefreq", "monthly");
    $node->appendChild($changefreq);

    $urlset->appendChild($node);
}

$xml->appendChild($urlset);

# Render sitemap.xml
echo $xml->saveXML();
