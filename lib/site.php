<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/const.php";

function isHomePage($page) {
    return "/" == $page;
}

function isSection($page) {
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
}

function getSections($page) {
    $result = array();

    $content_directory = __DIR__ . "/../" . CONTENT_DIRECTORY . $page;
    $files = scandir($content_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories.
        if ("." == substr($file, 0, 1))
            continue;

        $path = $content_directory . $file;
        if (is_dir($path)) {
            $d = array();

            $d[MDCMS_LINK_PATH] =
                substr($page, 0, -1)  # Remove a trailing slash.
                . $file;

            $index_path = $path . "/" . SECTION_INDEX;

            if (file_exists($index_path)) {
                $c = file_get_contents($index_path);

                preg_match("/^# (.+)/", $c, $matches);
                if (isset($matches))
                    $d[MDCMS_LINK_TITLE] = $matches[1];
            }
            else {
                $t = preg_replace("/\/|-+/", " ", $file);
                $t = ucwords($t);  # Capitalize a title.
                $d[MDCMS_SECTION_TITLE] = $t;
            }

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

function getPages($page) {
    $result = array();

    $content_directory = __DIR__ . "/../" . CONTENT_DIRECTORY . $page;
    $files = scandir($content_directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private files.
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