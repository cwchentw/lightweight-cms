<?php
# The theme assets loader of mdcms.


# Get the absolute path of a local mdcms.
$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . "{$sep}..{$sep}..";

# Load global setting.
require_once $rootDirectory . $sep . "setting.php";

# Load required libraries.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


try {
    $publicDirectory = $rootDirectory . $sep . "public";

    # `loadAssets($dest)` is a function
    #  implemented by a mdcms theme.
    loadAssets($publicDirectory);
}
catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
