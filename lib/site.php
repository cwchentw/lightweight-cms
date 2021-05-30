<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/const.php";
require_once __DIR__ . "/page.php";


function isHomePage($page) {
    return "/" == $page;
}

# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($page) {
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
}

# Nested sections are supported. Nonetheless, it is not recommended
#  because of SEO. Instead, two layers of web pages are purposed,
#  like "/section-title/article-title/".
function getSections($page) {
    $result = array();

    $contentDirectory = __DIR__ . "/../" . CONTENT_DIRECTORY . $page;
    $files = scandir($contentDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1))
            continue;

        $path = $contentDirectory . $file;
        if (is_dir($path)) {
            $d = array();

            # Set the link path.
            $d[MDCMS_LINK_PATH] = $page . $file . "/";

            $indexPage = $path . "/" . SECTION_INDEX;

            # If a section index exists, extract data from it.
            if (file_exists($indexPage)) {
                $c = file_get_contents($indexPage);

                preg_match("/^# (.+)/", $c, $matches);
                if (isset($matches))
                    $d[MDCMS_LINK_TITLE] = $matches[1];
            }
            # Otherwise, extract data from the directory name.
            else {
                $t = preg_replace("/\/|-+/", " ", $file);
                $t = ucwords($t);  # Capitalize a title.
                $d[MDCMS_SECTION_TITLE] = $t;
            }

            array_push($result, $d);
        }
    }

    # Skip to scan the application directory.
    if (!SCAN_APPLICATION_DIRECTORY)
        return $result;

    # Scan custom directories added in the application directory
    #  by users of mdcms as well.
    $applicationDirectory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($applicationDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories.
        if ("." == substr($file, 0, 1))
            continue;

        $path = $contentDirectory . "/" . $file;
        if (is_dir($path)) {
            $d = array();

            $d[MDCMS_LINK_PATH] = $file;

            $t = preg_replace("/\/|-+/", " ", $file);
            $t = ucwords($t);  # Capitalize a title.
            $d[MDCMS_LINK_TITLE] = $t;

            array_push($result, $d);
        }
    }

    return $result;
}

function getPages($page) {
    $result = array();

    $contentDirectory = __DIR__ . "/../" . CONTENT_DIRECTORY . $page;
    $files = scandir($contentDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private files.
        if ("." == substr($file, 0, 1))
            continue;
        else if ("_" == substr($file, 0, 1))
            continue;

        $path = $contentDirectory . "/" . $file;
        if (is_file($path)) {
            $f = array();

            # Remove file extensions.
            $f[MDCMS_LINK_PATH] =
                $page . pathinfo($file, PATHINFO_FILENAME) . "/";

            # Get the title of the page.
            # If the commands cost too many system resources, change it.
            $p = readPage($f[MDCMS_LINK_PATH]);
            $f[MDCMS_LINK_TITLE] = $p[MDCMS_POST_TITLE];

            array_push($result, $f);
        }
    }

    # Skip to scan the application directory.
    if (!SCAN_APPLICATION_DIRECTORY)
        return $result;

    # Scan custom pages added in the application directory
    #  by users of mdcms as well.
    $applicationDirectory = __DIR__ . "/../" . APPLICATION_DIRECTORY;
    $files = scandir($applicationDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1))
            continue;

        # Skip the index script.
        if ("index.php" == $file)
            continue;

        $path = $contentDirectory . "/" . $file;
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

    # Initialize the data of a section.
    $result[MDCMS_SECTION_TITLE] = "";
    $result[MDCMS_SECTION_CONTENT] = "";
    $result[MDCMS_SECTION_STATUS] = 200;  # HTTP 200 OK.

    $indexPage = __DIR__ . "/../" . CONTENT_DIRECTORY
        . "/" . $page . SECTION_INDEX;

    # If a section index exists, extract data from it.
    if (file_exists($indexPage)) {
        $c = file_get_contents($indexPage);

        preg_match("/^# (.+)/", $c, $matches);
        if (isset($matches))
            $result[MDCMS_SECTION_TITLE] = $matches[1];

        $c = preg_replace("/^# (.+)/", "", $c);

        $parser = new Parsedown();
        $result[MDCMS_SECTION_CONTENT] = $parser->text($c);
    }
    # Otherwise, extract data from the directory name.
    else {
        $t = preg_replace("/\/|-+/", " ", $page);
        $t = ucwords($t);  # Capitalize a title.
        $result[MDCMS_SECTION_TITLE] = $t;
    }

    return $result;
}

function getBreadcrumb($page) {
    $result = array();

    # Add the link to home.
    $d = array();

    $d[MDCMS_LINK_PATH] = "/";
    $d[MDCMS_LINK_TITLE] = SITE_BREADCRUMB_HOME;

    array_push($result, $d);

    if ("/" == $page)
        return $result;

    $arr = parsePage($page);
    $len = count($arr);
    for ($i = 0; $i < $len; ++$i) {
        $prev = $result[$i][MDCMS_LINK_PATH];

        $path = __DIR__
            . "/../" . CONTENT_DIRECTORY
            . $prev . $arr[$i];
        $htmlPath = __DIR__
            . "/../" . CONTENT_DIRECTORY
            . $prev
            . $arr[$i] . HTML_FILE_EXTENSION;
        $markdownPath = __DIR__
            . "/../" . CONTENT_DIRECTORY
            . $prev
            . $arr[$i] . MARKDOWN_FILE_EXTENSION;

        $d = array();
        $d[MDCMS_LINK_PATH] = $prev . $arr[$i] . "/";

        if (is_dir($path)) {
            $indexPage = $path . "/" . SECTION_INDEX;

            # If a section index exists, extract data from it.
            if (file_exists($indexPage)) {
                $c = file_get_contents($indexPage);

                preg_match("/^# (.+)/", $c, $matches);
                if (isset($matches))
                    $d[MDCMS_LINK_TITLE] = $matches[1];
            }
            # Otherwise, extract data from the directory name.
            else {
                $t = preg_replace("/\/|-+/", " ", $arr[$i]);
                $t = ucwords($t);  # Capitalize a title.
                $d[MDCMS_SECTION_TITLE] = $t;
            }

            array_push($result, $d);
        }
        else if (file_exists($htmlPath)) {
            $rawContent = file_get_contents($htmlPath);

            # `$rawContent` is not a full HTML document.
            # Therefore, we don't use a HTML parser but some regex pattern.
            preg_match("/<h1[^>]*>(.+)<\/h1>/", $rawContent, $matches);

            # Extract a title from a document.
            if (isset($matches)) {
                $d[MDCMS_POST_TITLE] = $matches[1];
            }
            # If no title in the above document, extract a title from a path.
            else {
                $t = preg_replace("/-+/", " ", $arr[$i]);
                $t = ucwords($t);  # Capitalize a title.
                $d[MDCMS_LINK_TITLE] = $t;
            }

            array_push($result, $d);
        }
        else if (file_exists($markdownPath)) {
            $c = file_get_contents($markdownPath);

            preg_match("/^# (.+)/", $c, $matches);

            # Extract a title from a document.
            if (isset($matches)) {
                $d[MDCMS_LINK_TITLE] = $matches[1];   
            }
            # If no title in the above document, extract a title from a path.
            else {
                $t = preg_replace("/-+/", " ", $arr[$i]);
                $t = ucwords($t);  # Capitalize a title.
                $d[MDCMS_LINK_TITLE] = $t;
            }

            array_push($result, $d);
        }
    }

    return $result;
}
