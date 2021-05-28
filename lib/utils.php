<?php

# TODO: Test the function.
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

# TODO: Test the code.
function fetchContent($arr) {
    $result = "";

    if (0 == count($arr)) {
        # Pass.   
    }
    else if (1 == count($arr)) {
        $html_path = __DIR__ . "/../" 
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . ".html";
        $markdown_path = __DIR__ . "/../" 
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . ".md";

        # Here we just set higher priority for HTML pages.
        # We may change it later.
        if (file_exists($html_path)) {
            $result = file_get_contents($html_path);
        }
        else if (file_exists($markdown_path)) {
            $result = file_get_contents($markdown_path);
        }
    }
    else {
        # TODO: Implement it later.
    }

    return $result;
}
