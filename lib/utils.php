<?php

function parsePage($page) {
    $result = array();

    # Reject invalid pages.
    if ("/" != substr($page, 0, 1))
        return $result;

    $len = strlen($page);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($page, $i, 1)) {
            $j = $i + 1;

            while ($j < $len && "/" != substr($page, $j, 1))
                ++$j;

            $part = substr($page, $i+1, $j-$i-1);

            # Discard trailing empty strings.
            if ("" != $part)
                array_push($result, $part);

            $i = $j;
        }
        else {
            ++$i;
        }
    }

    return $result;
}

# TODO: Refactor it later.
define("CONTENT_DIRECTORY", "content");

function getPath($arr, $ext) {
    $path = "";

    $len = count($arr);
    if (0 == $len) {
        # Pass.
    }
    else if (1 == $len) {
        $path = __DIR__ . "/../" 
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . $ext;
    }
    else {
        $file = array_pop($arr);
        $directory = join("/", $arr);

        $path = __DIR__ . "/../" 
            . CONTENT_DIRECTORY . "/"
            . $directory . "/"
            . $file . $ext;
    }

    return $path;
}

# TODO: Test the code.
function fetchContent($arr) {
    $result = "";

    $html_path = getPath($arr, ".html");
    $markdown_path = getPath($arr, ".md");

    # Here we just set higher priority for HTML pages.
    # We may change it later.
    if (file_exists($html_path)) {
        $result = file_get_contents($html_path);
    }
    else if (file_exists($markdown_path)) {
        $result = file_get_contents($markdown_path);
    }

    return $result;
}
