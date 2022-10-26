<?php
# The theme assets loader of Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load global settings.
require_once $rootDirectory . $sep . "setting.php";

# Load required libraries.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


try {
    $publicDirectory = $rootDirectory . $sep . "public";

    # `loadAssets($dest)` is a function
    #  implemented by a Lightweight CMS theme.
    loadAssets($publicDirectory);
}
catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
