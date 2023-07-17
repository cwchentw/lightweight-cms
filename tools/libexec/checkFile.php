<?php
# Check whether posts are modified.

error_reporting(E_ERROR);

$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load global settings.
require_once $rootDirectory . $sep . "setting.php";
# Load builtin library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";


$dataDirectory = $rootDirectory . $sep . DATA_DIRECTORY;
$checkFile = $dataDirectory . $sep . "checked.json";

if (!is_dir($dataDirectory)) {
    mkdir($dataDirectory) or die("Unable to create data directory");
}

if (!is_file($checkFile)) {
    # Create an empty text file.
    touch($checkFile) or die("Unable to create check data file");
}

$contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;

$dirs = array();
array_push($dirs, $contentDirectory);

$checkData = array();

while (count($dirs) > 0) {
    $dir = array_pop($dirs);

    # Scan all files in the directory.
    $files = scandir($dir);

    foreach ($files as $file) {
        # Skip special directories.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        $path = $dir . $sep . $file;
        if (is_dir($path)) {
            array_push($dirs, $path);
        }
        # Check the checksum of the home page.
        if (($contentDirectory . $sep . SECTION_INDEX) == $path) {
            $checkData[SITE_PREFIX . "/"] = hash_file("sha256", $path);
        }
        # Check the checksum of a section page.
        else if (($dir . $sep . SECTION_INDEX) == $path) {
            $currentPath = str_replace('\\', "/", substr($dir, strlen($contentDirectory)));
            $checkData[SITE_PREFIX . $currentPath .  "/"] = hash_file("sha256", $path);
        }
        # Check the checksum of regular pages.
        else {
            $uri = getPageFromPath($path);
            $checkData[SITE_PREFIX . $uri] = hash_file("sha256", $path);
        }
    }
}

$checkText = json_encode($checkData);
file_put_contents($checkFile, $checkText) or die ("Unable to write checksum data");

function getPageFromPath ($path)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

    $contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;
    #echo $contentDirectory, PHP_EOL;
    $page = substr($path, strlen($contentDirectory));

    $fileParts = pathinfo($page);
    if (isset($fileParts["extension"])) {
        $page = substr($page, 0, -(strlen($fileParts["extension"])+1));
    }

    /* Add a trailing slash if no any. */
    if ("/" != substr($page, strlen($page)-1, 1)) {
        $page .= "/";
    }

    return str_replace("\\", "/", $page);
}