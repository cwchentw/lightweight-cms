<?php
# Currently, it is an autoload.php of a poor man.
#  Change it if needed.


# Get current working directory of the script.
$cwd = __DIR__;

# Scan all files in the directory.
$libraries = scandir($cwd);

# Currently, we merely iterate over the first layer of
#  the directory. Recursive scanning is not supported yet.
foreach ($libraries as $library) {
    # Skip private directories and files.
    if ("." == substr($library, 0, 1))
        continue;

    # Skip the script itself.
    if ("autoload.php" == $library)
        continue;

    require_once __DIR__ . "/" . $library;
}