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

function getPath($uri, $extension)
{
    $result = "";

    $arr = parseURI($uri);
    $len = count($arr);

    $sep = DIRECTORY_SEPARATOR;

    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";

    if (0 == $len) {
        # Pass.
    }
    else if (1 == $len) {
        $result = $rootDirectory . $sep
            . CONTENT_DIRECTORY . $sep
            . $arr[0] . $extension;
    }
    else {
        $file = array_pop($arr);
        $directory = join($sep, $arr);

        $result = $rootDirectory . $sep
            . CONTENT_DIRECTORY . $sep
            . $directory . $sep
            . $file . $extension;
    }

    return $result;
}
