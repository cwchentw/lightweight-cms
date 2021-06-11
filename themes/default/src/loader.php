<?php
# Don't add any namespace in a mdcms theme. Instead,
#  let mdcms load global functions.

# Get the root path of default theme of mdcms.
global $rootDirectory;
$rootDirectory = __DIR__ . "/..";


function loadHome()
{
    global $rootDirectory;
    require $rootDirectory . "/theme/home.php";
}

function loadSection()
{
    global $rootDirectory;
    require $rootDirectory . "/theme/section.php";
}

function loadPost()
{
    global $rootDirectory;
    require $rootDirectory . "/theme/post.php";
}

function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();

    global $rootDirectory;

    # Move to theme directory.
    if (!chdir($rootDirectory)) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw new \Exception("Unable to change working directory to theme directory");
    }

    # We don't update NPM packages because they are merely for build automation.
    if (!(file_exists("node_modules") && is_dir("node_modules"))) {
        if (!system("npm install")) {
            # Move back to old working directory.
            chdir($oldDirectory);

            throw new \Exception("Unable to install NPM packages");
        }
    }

    # Compile assets.
    #
    # Not every theme invoke the same command to compile assets.
    #  Modify it according to your own situation.
    if (!system("npm run prod")) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw new \Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = $rootDirectory . "/public";

        # xCopy is a utility function in mdcms.
        #  It will copy directories and files recursively.
        \mdcms\Core\xCopy($publicDirectory, $dest);
    }
    catch (Exception $e) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw $e;
    }

    # Move back to old working directory.
    chdir($oldDirectory);
}
