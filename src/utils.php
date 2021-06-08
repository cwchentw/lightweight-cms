<?php
# Utility functions for mdcms.

# Get global setting.
require_once __DIR__ . "/../setting.php";


# Check whether the page is the home page of a site.
function isHome($page)
{
    return "/" == $page;
}

# Check whether the page is a section.
#
# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($page)
{
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
}

# Copy directories and files recursively.
#
# Call it within a `try ... catch ...` block because the task may fail.
function xCopy($src, $dst)
{
    # Create destination directory if it doesn't exist.
    if (!is_dir($dst)) {
        # Currently, we hard code the common 0755 mode for destination directory.
        # We may read system mode instead if possible and feasible.
        if (!mkdir($dst, 0755, true)) {
            # We may find a better exception for this event.
            # TODO: Refactor it later.
            throw new Exception("Unable to create directory: " . $dst . "\n");
        }
    }

    # Open the handle of destination directory.
    $dir = opendir($src);
    if (!$dir) {
        throw new Exception("Unable to open directory: " . $src . "\n");
    }

    while(false !== ($file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            # Copy a subdirectionary by a recursive call.
            if ( is_dir($src . "/" . $file) ) {
                try {
                    xCopy($src . "/" . $file, $dst . "/" . $file);
                }
                catch (Exception $e) {
                    # Release the handle of destination directory.
                    closedir($dir);

                    throw $e;
                }
            }
            # Copy a file.
            else {
                if (!copy($src . "/" . $file, $dst . "/" . $file)) {
                    # Release the handle of destination directory.
                    closedir($dir);
  
                    # We may find a better exception for this event.
                    # TODO: Refactor it later.
                    throw new Exception("Unable to create file: " . $dst . "/" . $file . "\n");
                }
            }
        }
    }
 
    # Release the handle of destination directory.
    closedir($dir);
}
