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

        # Skip the script itself.
        #
        # Currently, we simply ignore all autoload.php
        #  in our library. We may change it later.
        if ("autoload.php" == $library) {
            continue;
        }

        $path = $dir . "/" . $library;

        if (is_dir($path)) {
            # Push a subdirectory into the queue.
            array_push($dirs, $path);
        }
        else if ("php" == pathinfo($path)["extension"]) {
            require_once $path;
        }
    }
}
