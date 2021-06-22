<?php
namespace mdcms\Core;
# Private functions related to URIs.


function parseURI($uri)
{
    $result = array();

    # Reject invalid pages.
    if ("/" != substr($uri, 0, 1)) {
        return $result;
    }

    # Parse a `$uri` within a while loop.
    $len = strlen($uri);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($uri, $i, 1)) {
            $j = $i + 1;

            # Iterate until next "/" or the end of `$uri`.
            while ($j < $len && "/" != substr($uri, $j, 1)) {
                ++$j;
            }

            # Extract a part of `$uri`.
            $part = substr($uri, $i+1, $j-$i-1);

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

function getPath($uri, $ext)
{
    $result = "";

    $arr = parseURI($uri);
    $len = count($arr);

    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";

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