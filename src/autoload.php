<?php
# A home-made autoload.php script.


# Get current working directory of the script.
$cwd = __DIR__;

# Create a queue for unvisited directories.
$dirs = array();

# Push current working dirctory into the queue.
array_push($dirs, $cwd);

while (count($dirs) > 0) {
    # Pop out a directory.
    $dir = array_shift($dirs);

    # Scan all files in the directory.
    $libraries = scandir($dir);

    # Iterate over the layer of directories and files.
    foreach ($libraries as $library) {
        # Skip private directories and files.
        if ("." == substr($library, 0, 1)) {
            continue;
        }
        else if ("_" == substr($library, 0, 1)) {
            continue;
        }

        $path = $dir . "/" . $library;

        # Skip the script itself.
        if (__FILE__ == $path) {
            continue;
        }

        # Push a subdirectory into the queue.
        if (is_dir($path)) {
            array_push($dirs, $path);
        }
        # Load a PHP script.
        else if ("php" == pathinfo($path)["extension"]) {
            require_once $path;
        }
    }
}
