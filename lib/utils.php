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

function getPath($page, $ext) {
    $arr = parsePage($page);
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

function fetchPage($page) {
    $result = array();

    # Initialize the fields.
    $result["title"] = "";
    $result["content"] = "";

    $html_path = getPath($page, HTML_FILE_EXTENSION);
    $markdown_path = getPath($page, MARKDOWN_FILE_EXTENSION);

    # Here we simply set higher priority for HTML pages.
    # We may change it later.
    if (file_exists($html_path)) {
        $raw_content = file_get_contents($html_path);

        # `$raw_content` is not a full HTML document.
        # Therefore, we don't use a HTML parser.
        preg_match("/<h1[^>]*>(.+)<\/h1>/", $raw_content, $matches);
        if (isset($matches)) {
            $result["title"] = $matches[1];
            $result["content"] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $raw_content);
        }
        else
            $result["content"] = $raw_content;
    }
    else if (file_exists($markdown_path)) {
        $raw_content = file_get_contents($markdown_path);

        preg_match("/^# (.+)/", $raw_content, $matches);
        if (isset($matches)) {
            $result["title"] = $matches[1];
            $result["content"] = preg_replace("/^# (.+)/", "", $raw_content);
        }
        else
            $result["content"] = $raw_content;
    }

    return $result;
}
