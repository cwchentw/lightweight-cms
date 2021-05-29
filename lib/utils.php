<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/const.php";

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

function isSection($page) {
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
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
    $result[MDCMS_POST_TITLE] = "";
    $result[MDCMS_POST_CONTENT] = "";
    $result[MDCMS_POST_STATUS] = 404;

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
            $result[MDCMS_POST_TITLE] = $matches[1];
            $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $raw_content);
        }
        else
            $result[MDCMS_POST_CONTENT] = $raw_content;

        $result[MDCMS_POST_STATUS] = 200;
    }
    else if (file_exists($markdown_path)) {
        $raw_content = file_get_contents($markdown_path);

        preg_match("/^# (.+)/", $raw_content, $matches);
        if (isset($matches)) {
            $result[MDCMS_POST_TITLE] = $matches[1];
            $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $raw_content);
        }
        else
            $result[MDCMS_POST_CONTENT] = $raw_content;

        $parser = new Parsedown();
        $result[MDCMS_POST_CONTENT] = $parser->text($result["content"]);

        $result[MDCMS_POST_STATUS] = 200;
    }

    return $result;
}

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

            $d[MDCMS_LINK_PATH] = $file;

            $t = preg_replace("/-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d[MDCMS_LINK_TITLE] = $t;

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

            $d[MDCMS_LINK_PATH] = $file;

            $t = preg_replace("/-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d[MDCMS_LINK_TITLE] = $t;

            array_push($result, $d);
        }
    }

    return $result;
}

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
            $f[MDCMS_LINK_PATH] = pathinfo($file, PATHINFO_FILENAME);

            # Get the title of the page.
            $t = pathinfo($file, PATHINFO_FILENAME);
            $t = preg_replace("/-+/", " ", $t);
            $t = ucwords($t);  # Capitalize a title.
            $f[MDCMS_LINK_TITLE] = $t;

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

            # It is not a pretty URL. Keep its file extension *as is*.
            $f[MDCMS_LINK_PATH] = $file;

            # Get the title of the page.
            $t = pathinfo($file, PATHINFO_FILENAME);
            $t = preg_replace("/-+/", " ", $t);
            $t = ucwords($t);  # Capitalize a title.
            $f[MDCMS_LINK_TITLE] = $t;

            array_push($result, $f);
        }
    }

    return $result;
}

function getSection($page) {
    $result = array();

    # Initialize some data.
    $result[MDCMS_SECTION_TITLE] = "";
    $result[MDCMS_SECTION_CONTENT] = "";
    $result[MDCMS_SECTION_STATUS] = 200;  # HTTP Status.

    $index_path = __DIR__ . "/../" . CONTENT_DIRECTORY
        . "/" . $page . SECTION_INDEX;

    if (file_exists($index_path)) {
        $c = file_get_contents($index_path);

        preg_match("/^# (.+)/", $c, $matches);
        if (isset($matches))
            $result[MDCMS_SECTION_TITLE] = $matches[1];

        $c = preg_replace("/^# (.+)/", "", $c);

        $parser = new Parsedown();
        $result[MDCMS_SECTION_CONTENT] = $parser->text($c);
    }
    else {
        $t = preg_replace("/\/|-+/", " ", $page);
        $t = ucwords($t);  # Capitalize a title.
        $result[MDCMS_SECTION_TITLE] = $t;
    }

    return $result;
}