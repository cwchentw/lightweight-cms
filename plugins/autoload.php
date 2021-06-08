<?php
# The main loader for plugin(s).


# The path of the main loader itself.
$pluginLoader = __DIR__ . "/" . __FILE__;

# Scan all files in the directory.
$libraries = scandir(__DIR__);

# We only scan the first layer of this directory.
foreach ($libraries as $library) {
    # Skip private directories and files.
    if ("." == substr($library, 0, 1)) {
        continue;
    }
    else if ("_" == substr($library, 0, 1)) {
        continue;
    }

    # TODO: Filter out blacklisted plugin(s).

    $path = __DIR__ . "/" . $library;

    # Skip the script itself.
    if ($pluginLoader == $path) {
        continue;
    }

    if (is_dir($path)) {
        # autoload.php at the root path of a plugin is mandatory.
        $loader = $path . "/autoloader.php";

        # Load the plugin.
        require_once $loader;
    }
    # Ignore everything else.
    else {
        # Pass.
    }
}
