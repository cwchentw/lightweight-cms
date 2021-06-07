<?php
# A home-made autoload.php script.


# The path of the loader itself.
$pluginLoader = __DIR__ . "/" . __FILE__;

# Scan all files in the directory.
$libraries = scandir(__DIR__);

# We only scan the first layer of directories.
foreach ($libraries as $library) {
    # Skip private directories and files.
    if ("." == substr($library, 0, 1)) {
        continue;
    }
    else if ("_" == substr($library, 0, 1)) {
        continue;
    }

    $path = __DIR__ . "/" . $library;

    # Skip the script itself.
    if ($pluginLoader == $path) {
        continue;
    }

    if (is_dir($path)) {
        $loader = $path . "/autoloader.php";
        require_once $loader;
    }
    # Ignore everything else.
    else {
        # Pass.
    }
}
