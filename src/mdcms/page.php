<?php
namespace mdcms;
# Pages related functions.

$rootDirectory = __DIR__ . "/../..";
require_once $rootDirectory . "/vendor/autoload.php";
require_once $rootDirectory . "/setting.php";
require_once __DIR__ . "/const.php";


function parsePage($page)
{
    $result = array();

    # Reject invalid pages.
    if ("/" != substr($page, 0, 1)) {
        return $result;
    }

    # Parse a `$page` while a while loop.
    $len = strlen($page);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($page, $i, 1)) {
            $j = $i + 1;

            # Iterate until next "/" or the end of `$page`.
            while ($j < $len && "/" != substr($page, $j, 1)) {
                ++$j;
            }

            # Extract a part of `$page`.
            $part = substr($page, $i+1, $j-$i-1);

            # Discard trailing empty strings.
            if ("" != $part) {
                array_push($result, $part);
            }

            # Reset the counter.
            $i = $j;
        }
        else {
            ++$i;
        }
    }

    return $result;
}

function getPath($page, $ext)
{
    $result = "";

    $arr = parsePage($page);
    $len = count($arr);
    $rootDirectory = __DIR__ . "/../..";
    if (0 == $len) {
        # Pass.
    }
    else if (1 == $len) {
        $result = $rootDirectory . "/"
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . $ext;
    }
    else {
        $file = array_pop($arr);
        $directory = join("/", $arr);

        $result = $rootDirectory . "/"
            . CONTENT_DIRECTORY . "/"
            . $directory . "/"
            . $file . $ext;
    }

    return $result;
}
