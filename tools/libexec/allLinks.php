<?php
# Get all links.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";
# Load the built-in library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load the plubin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";

$links = \LightweightCMS\Core\getAllLinks(SITE_PREFIX . "/");

$dataDirectory = $rootDirectory . $sep . DATA_DIRECTORY;
$linkFile = $dataDirectory . $sep . "allLinks.json";

!is_dir($dataDirectory)
    and mkdir($dataDirectory, 0755);

touch($linkFile)
    or die("Unable to create the link file");

file_put_contents($linkFile, json_encode($links, TRUE))
    or die("Unable to write data to the link file");