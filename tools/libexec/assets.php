<?php
# The theme assets loader of mdcms.


# Get the absolute path of a local mdcms.
# TODO: Refactor the code with a directory separator.
$rootDirectory = __DIR__ . "/../..";

# Load global setting.
require_once $rootDirectory . "/setting.php";

# Load required libraries.
require_once $rootDirectory . "/" . LIBRARY_DIRECTORY . "/autoload.php";
require_once $rootDirectory . "/" . PLUGIN_DIRECTORY . "/autoload.php";
require_once $rootDirectory . "/" . THEME_DIRECTORY . "/" . SITE_THEME . "/autoload.php";


try {
    $publicDirectory = $rootDirectory . "/public";

    # `loadAssets($dest)` is a function
    #  implemented by a mdcms theme.
    loadAssets($publicDirectory);
}
catch (Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
