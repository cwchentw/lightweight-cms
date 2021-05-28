<?php

require_once __DIR__ . "/../setting.php";

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
# TODO: Merge `fetchTitle` and `fetchContent` to reduce file loading.
function fetchTitle($arr) {
    $title = "";

    $html_path = getPath($arr, HTML_FILE_EXTENSION);
    $markdown_path = getPath($arr, MARKDOWN_FILE_EXTENSION);

    # Here we just set higher priority for HTML pages.
    # We may change it later.
    if (file_exists($html_path)) {
        $dom = new DOMDocument();
        $dom->loadHTMLFile($html_path);
        $titles = $dom->getElementsByTagName("h1");
        if (isset($titles))
            $title = $titles[0];
    }
    else if (file_exists($markdown_path)) {
        $raw_content = file_get_contents($markdown_path);
        preg_match("^# (.+)", $raw_content, $matches);
        if (isset($matches))
            $title = $matches[0];
    }

    return $title;
}

function fetchContent($arr) {
    $result = "";

    $html_path = getPath($arr, HTML_FILE_EXTENSION);
    $markdown_path = getPath($arr, MARKDOWN_FILE_EXTENSION);

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
