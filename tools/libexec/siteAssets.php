<?php
# The site assets loader for Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";
# Load the built-in library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";

if (!LOAD_SITE_ASSETS) {
    exit(0);
}

# Get the directory of the personal assets.
$assetDirectory = $rootDirectory . $sep . ASSET_DIRECTORY;
$publicDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY;

$hasAsset = false;

$dirs = array();
array_push($dirs, $assetDirectory);

# Scan directory of personal assets to check
#  whether any asset exists.
while (!$hasAsset && count($dirs) > 0) {
    $dir = array_pop($dirs);

    $files = scandir($dir);
    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        $path = $dir . "/" . $file;
        if (is_dir($path)) {
            array_push($dirs, $path);
        }
        else if (file_exists($path)) {
            $hasAsset = true;
            break;
        }
    }
}

# Exit if no asset.
if (!$hasAsset) {
    exit(0);
}

# Save the path of old working directory.
$oldDirectory = getcwd();

# Move to the root path of Lightweight CMS.
if (!chdir($rootDirectory)) {
    # Move back to old working directory.
    chdir($oldDirectory);

    fwrite(STDERR, "Unable to change working directory to the root path of Lightweight CMS", PHP_EOL);
    exit(1);
}

# We don't update NPM packages because they are merely for build automation.
if (!(file_exists("node_modules") && is_dir("node_modules"))) {
    if (!system("npm install")) {
        # Move back to old working directory.
        chdir($oldDirectory);

        fwrite(STDERR, "Unable to install NPM packages", PHP_EOL);
        exit(1);
    }
}

# Compile assets.
#
# Not every theme invoke the same command to compile assets.
#  Modify it according to your own situation.
if (!system("npm run prod")) {
    # Move back to old working directory.
    chdir($oldDirectory);

    fwrite(STDERR, "Unable to compile assets", PHP_EOL);
    exit(1);
}

# Copy assets recursively.
try {
    # xCopy is a utility function in Lightweight CMS.
    #  It will copy directories and files recursively.
    \LightweightCMS\Core\xCopy($assetDirectory, $publicDirectory);
}
catch (Exception $e) {
    # Move back to old working directory.
    chdir($oldDirectory);

    fwrite(STDERR, "Unable to copy assets", PHP_EOL);
    exit(1);
}

# Move back to old working directory.
chdir($oldDirectory);
