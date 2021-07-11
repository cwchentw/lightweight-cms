<?php
namespace mdcms\Core;
# Utility functions for mdcms.


# Check whether `$source` string starts with `$target` string.
#
# PHP 8 provides `str_starts_with` function. Because
#  we assume PHP 7, we write our own utility function.
function startsWith($source, $target)
{
    return $target == substr($source, 0, strlen($target));
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
            throw new \Exception("Unable to create directory: " . $dst . "\n");
        }
    }

    # Open the handle of destination directory.
    $dir = opendir($src);
    if (!$dir) {
        throw new \Exception("Unable to open directory: " . $src . "\n");
    }

    $sep = DIRECTORY_SEPARATOR;

    while(false !== ($file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            # Copy a subdirectionary by a recursive call.
            if ( is_dir($src . $sep . $file) ) {
                try {
                    xCopy($src . $sep . $file, $dst . $sep . $file);
                }
                catch (Exception $e) {
                    # Release the handle of destination directory.
                    closedir($dir);

                    throw $e;
                }
            }
            # Copy a file.
            else {
                if (!copy($src . $sep . $file, $dst . $sep . $file)) {
                    # Release the handle of destination directory.
                    closedir($dir);

                    # We may find a better exception for this event.
                    # TODO: Refactor it later.
                    throw new \Exception("Unable to create file: " . $dst . $sep . $file . "\n");
                }
            }
        }
    }

    # Release the handle of destination directory.
    closedir($dir);
}
