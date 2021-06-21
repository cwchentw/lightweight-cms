<?php
# The main loader for plugin(s).


$rootDirectory = __DIR__ . "/..";
# Load global setting.
require_once $rootDirectory . "/setting.php";

# Scan all files in the directory.
$libraries = scandir(__DIR__);

# We only scan top layer of this directory.
foreach ($libraries as $library) {
    # Skip private directories and files.
    if ("." == substr($library, 0, 1)) {
        continue;
    }
    else if ("_" == substr($library, 0, 1)) {
        continue;
    }

    # Pass plugin in the black list.
    if (in_array($library, PLUGIN_BLACKLIST)) {
        continue;
    }

    $path = __DIR__ . "/" . $library;

    # Skip the script itself.
    if (__FILE__ == $path) {
        continue;
    }

    if (is_dir($path)) {
        # autoload.php at the root path of a plugin is mandatory.
        $loader = $path . "/autoload.php";

        # Load the plugin.
        require_once $loader;
    }
    # Ignore everything else.
    else {
        # Pass.
    }
}
