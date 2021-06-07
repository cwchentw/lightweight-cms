<?php
# An asset loader.
#
$rootDirectory = __DIR__ . "/../..";
require_once $rootDirectory . "/setting.php";
require_once $rootDirectory . "/" . LIBRARY_DIRECTORY . "/autoload.php";
require_once $rootDirectory . "/" . PLUGIN_DIRECTORY . "/autoload.php";
require_once $rootDirectory . "/" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";

try {
    $publicDirectory = __DIR__ . "/../../public";
    loadAssets($publicDirectory);
}
catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
