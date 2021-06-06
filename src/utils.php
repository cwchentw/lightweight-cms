<?php
# Utility functions for mdcms.
require_once __DIR__ . "/../setting.php";


function isHome($page)
{
    return "/" == $page;
}

# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($page)
{
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
}

# TODO: Check it later.
function xCopy($src, $dst)
{
    if (!mkdir($dst, 0755, true)) {
        # We may find a better exception for this event.
        # TODO: Refactor it later.
        throw new Exception("Unable to create directory: " . $dst . "\n");
    }

    $dir = opendir($src);
    if (!dir) {
        # We may find a better exception for this event.
        # TODO: Refactor it later.
        throw new Exception("Unable to open directory: " . $src . "\n");
    }

    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                try {
                    xCopy($src . '/' . $file, $dst . '/' . $file);
                }
                catch (Exception $e) {
                    echo $e->getMessage();
                }
                finally {
                    # Release system resources.
                    closedir($dir);
                }
            }
            else {
                if (!copy($src . '/' . $file, $dst . '/' . $file)) {
                    # Release system resources.
                    closedir($dir);
  
                    # We may find a better exception for this event.
                    # TODO: Refactor it later.
                    throw new Exception("Unable to create file: " . $dst . "/" . $file . "\n");
                }
            }
        }
    }
 
    closedir($dir);
}
