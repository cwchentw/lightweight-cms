<?php
# The main PHP script for a mdcms theme.


function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}

function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}

function loadPost()
{
    require __DIR__ . "/theme/" . "post.php";
}

function loadAssets($dest)
{
    $oldDirectory = getcwd();

    if (!chdir(__DIR__)) {
        chdir($oldDirectory);
        throw new Exception("Unable to change working directory to theme directory");
    }

    # We don't update NPM packages because they are merely for build automation.
    if (!(file_exists("node_modules") && is_dir("node_modules"))) {
        if (!system("npm install")) {
            chdir($oldDirectory);
            throw new Exception("Unable to install NPM packages");
        }
    }

    # Compile assets.
    if (!system("npm run prod")) {
        chdir($oldDirectory);
        throw new Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = __DIR__ . "/public";
        xCopy($publicDirectory, $dest);
    }
    catch (Exception $e) {
        chdir($oldDirectory);
        throw $e;
    }

    chdir($oldDirectory);
}
