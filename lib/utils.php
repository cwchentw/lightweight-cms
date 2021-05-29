<?php
require_once __DIR__ . "/../vendor/autoload.php";
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

function isHomePage($page) {
    return "/" == $page;
}

function getPath($page, $ext) {
    $arr = parsePage($page);
    $result = "";

    $len = count($arr);
    if (0 == $len) {
        # Pass.
    }
    else if (1 == $len) {
        $result = __DIR__ . "/../"
            . CONTENT_DIRECTORY . "/"
            . $arr[0] . $ext;
    }
    else {
        $file = array_pop($arr);
        $directory = join("/", $arr);

        $result = __DIR__ . "/../"
            . CONTENT_DIRECTORY . "/"
            . $directory . "/"
            . $file . $ext;
    }

    return $result;
}

function readPage($page) {
    $result = array();

    # Initialize the fields.
    $result["title"] = "";
    $result["content"] = "";
    $result["status"] = 404;

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

        $result["status"] = 200;
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

        $parser = new Parsedown();
        $result["content"] = $parser->text($result["content"]);

        $result["status"] = 200;
    }

    return $result;
}

# TODO: Test the code.
function getSections() {
    $result = array();

    $content_directory = __DIR__ . "/../" . CONTENT_DIRECTORY;
    $files = scandir($content_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories.
        if ("." == substr($file, 0, 1))
            continue;

        $path = $content_directory . "/" . $file;
        if (is_dir($path)) {
            $d = array();

            $d["path"] = $file;

            $t = preg_replace("/-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d["title"] = $t;

            array_push($result, $d);
        }
    }

    # Scan custom directories added in the application directory by users of mdcms.
    $application_directory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($application_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories.
        if ("." == substr($file, 0, 1))
            continue;

        $path = $content_directory . "/" . $file;
        if (is_dir($path)) {
            $d = array();

            $d["path"] = $file;

            $t = preg_replace("/-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d["title"] = $t;

            array_push($result, $d);
        }
    }

    return $result;
}

# TODO: Test the code.
function getPages() {
    $result = array();

    $content_directory = __DIR__ . "/../" . CONTENT_DIRECTORY;
    $files = scandir($content_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Omit private files.
        if ("." == substr($file, 0, 1))
            continue;
        else if ("_" == substr($file, 0, 1))
            continue;

        $path = $content_directory . "/" . $file;
        if (is_file($path)) {
            $f = array();

            # Remove file extensions.
            $f["path"] = pathinfo($file, PATHINFO_FILENAME);

            # Get the title of the page.
            $t = pathinfo($file, PATHINFO_FILENAME);
            $t = preg_replace("/-+/", " ", $t);
            $t = ucwords($t);  # Capitalize a title.
            $f["title"] = $t;

            array_push($result, $f);
        }
    }

    $application_directory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($application_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Omit private files.
        if ("." == substr($file, 0, 1))
            continue;

        # Omit the index script.
        if ("index.php" == $file)
            continue;

        $path = $content_directory . "/" . $file;
        if (is_file($path)) {
            $f = array();

            $f["path"] = $file;

            # Get the title of the page.
            $t = pathinfo($file, PATHINFO_FILENAME);
            $t = preg_replace("/-+/", " ", $t);
            $t = ucwords($t);  # Capitalize a title.
            $f["title"] = $t;

            array_push($result, $f);
        }
    }

    return $result;
}
