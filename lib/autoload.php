<?php
# Currently, it is an autoload.php of a poor man.
# Change it if needed.

$dir = __DIR__;

$libraries = scandir($dir);

foreach ($libraries as $library) {
    # Skip private directories.
    if ("." == substr($library, 0, 1))
        continue;

    # Skip itself.
    if ("autoload.php" == $library)
        continue;

    require_once __DIR__ . "/" . $library;
}