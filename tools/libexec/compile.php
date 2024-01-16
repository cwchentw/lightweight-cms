<?php
# Static site generator for Lightweight CMS.

error_reporting(E_ERROR);

$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load global settings.
require_once $rootDirectory . $sep . "setting.php";
# Load builtin library.
require_once $rootDirectory . $sep . LIBRARY_DIRECTORY . $sep . "autoload.php";
# Load plugin(s) if any.
require_once $rootDirectory . $sep . PLUGIN_DIRECTORY . $sep . "autoload.php";
# Load a theme.
require_once $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . $sep . "autoload.php";


$checkFile = $rootDirectory . $sep . DATA_DIRECTORY . $sep . "checked.json";
if (is_file($checkFile)) {
    $isChecked = TRUE;
    if (!($checkStringData = file_get_contents($checkFile))) {
        $isChecked = FALSE;
    }

    if ($isChecked) {
        $checkData = json_decode($checkStringData, TRUE);
    }
}
else {
    $isChecked = FALSE;
}

$publicDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY;
if (!is_dir($publicDirectory)) {
    $isChecked = FALSE;
}

$contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;

# Generate the static page of the home page.
#
# Even the home page itself doesn't change,
#  there may be some new posts. Hence, we always
#  compile the home page.
$pageContent = compilePage(SITE_PREFIX . "/");
compile($pageContent, "/");

$dirs = array();
array_push($dirs, $contentDirectory);

while (count($dirs) > 0) {
    $dir = array_shift($dirs);

    $files = scandir($dir);

    $pageCount = 0;
    foreach ($files as $file) {
        # Skip special directories.
        if ("." == substr($file, 0, 1)) {
            continue;
        }
        # Skip private directories and files.
        else if ("_" == substr($file, 0, 1)) {
            continue;
        }

        $path = $dir . $sep . $file;
        if (is_dir($path)) {
            array_push($dirs, $path);

            $uri = str_replace($sep, "/", substr($path, strlen($contentDirectory)));

            /* Add a trailing slash if no any. */
            if ("/" != substr($uri, strlen($uri)-1, 1)) {
                $uri .= "/";
            }

            # Compile a section.
            #
            # Even the section page itself doesn't change,
            #  there may be some new posts. Hence, we always
            #  compile a section.
            $pageContent = compilePage(SITE_PREFIX . $uri);
            compile($pageContent, $uri);
        }
        else if (isWebPage($path)) {
            $pageCount += 1;

            $fileParts = pathinfo($path);
            $relPath = str_replace($sep, "/", substr($path, strlen($contentDirectory)));
            $uri = substr($relPath, 0, -(strlen($fileParts["extension"])+1));

            /* Add a trailing slash if no any. */
            if ("/" != substr($uri, strlen($uri)-1, 1)) {
                $uri .= "/";
            }

            if ($isChecked) {
                if ($checkData[SITE_PREFIX . $uri] != hash_file("sha256", $path)) {
                    goto COMPILE_POST;
                }
            }
            else {
            COMPILE_POST:
                $pageContent = compilePage(SITE_PREFIX . $uri);
                compile($pageContent, $uri);
            }
        }
    }

    if (POST_PER_PAGE > 0 && $pageCount > POST_PER_PAGE) {
        # Skip the pages for a home page in blogs.
        if (!is_null(SITE_STYLE) && "blog" === SITE_STYLE && $contentDirectory === $dir) {
            continue;
        }

        $baseURI = str_replace($sep, "/", substr($dir, strlen($contentDirectory)));

        $c = 1;
        while ($pageCount > POST_PER_PAGE) {
            $uri = $baseURI . "/" . $c . "/";

            $pageContent = compilePage(SITE_PREFIX . $uri);
            compile($pageContent, $uri);

            $c += 1;
            $pageCount -= POST_PER_PAGE;
        }
    }
}

# Compile the pages for a home page in blogs.
if (!is_null(SITE_STYLE) && "blog" === SITE_STYLE) {
    $allPosts = \LightweightCMS\Core\getAllPosts(SITE_PREFIX . "/");

    $c = 1;
    $postCount = count($allPosts);
    while ($postCount > POST_PER_PAGE) {
        $uri = SITE_PREFIX . "/" . $c . "/";

        $pageContent = compilePage($uri);
        compile($pageContent, $uri);

        $c += 1;
        $postCount -= POST_PER_PAGE;
    }
}

$dataDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY . $sep . "data";
$json = file_get_contents($dataDirectory . $sep . "tags.json");

$tags = json_decode($json, JSON_UNESCAPED_UNICODE);

$tagsURI = SITE_PREFIX . "/tags/";
$tagsContent = compilePage($tagsURI);
compile($tagsContent, "/tags/");

$tagCount = 0;
foreach ($tags as $tag => $paths) {
    $tagPageContent = compilePage(
        SITE_PREFIX . "/tags/" . urlencode($tag) . "/"
    );
    compile($tagPageContent, "/tags/${tag}/");

    $tagPageCount = 0;
    foreach ($paths as $path) {
        $tagPageCount += 1;
    }

    if (POST_PER_PAGE > 0 && $tagPageCount > POST_PER_PAGE) {
        $c = 1;
        while ($tagPageCount > POST_PER_PAGE) {
            $tagPageContent = compilePage(
                SITE_PREFIX . "/tags/" . urlencode($tag) . "/" . $c . "/"
            );
            compile($tagPageContent, "/tags/${tag}/${c}/");

            $c += 1;
            $tagPageCount -= POST_PER_PAGE;
        }
    }

    $tagCount += 1;
}

if (POST_PER_PAGE > 0 && $tagCount > POST_PER_PAGE) {
    $c = 1;
    while ($tagCount > POST_PER_PAGE) {
        $u = "/tags/" . $c . "/";
        $tagsContent = compilePage(SITE_PREFIX . $u);
        compile($tagsContent, $u);

        $c += 1;
        $tagCount -= POST_PER_PAGE;
    }
}

function isWebPage ($path)
{
    $fileParts = pathinfo($path);
    $extension = "." . $fileParts["extension"];

    return $extension === HTML_FILE_EXTENSION
        || $extension === MARKDOWN_FILE_EXTENSION
        || $extension === ASCIIDOC_FILE_EXTENSION
        || $extension === RESTRUCTUREDTEXT_FILE_EXTENSION
        || $extension === ".php";
}

function compile ($content, $uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

    $publicDirectory = $rootDirectory . $sep . PUBLIC_DIRECTORY;

    if ("" != $content) {
        if (!file_exists($publicDirectory . str_replace("/", $sep, $uri))) {
            if (!mkdir($publicDirectory . str_replace("/", $sep, $uri))) {
                fwrite(STDERR, "Unable to create a directory for " . $uri . PHP_EOL);
                exit(1);
            }
        }

        if (!file_put_contents(
            $publicDirectory . str_replace("/", $sep, $uri) . "index.html",
            $content
        )) {
            fwrite(STDERR, "Unable to generate web page for " . $uri . PHP_EOL);
            exit(1);
        }
    }
    else {
        fwrite(STDERR, "Unable to generate web page for " . $uri . PHP_EOL);
        exit(1);
    }
}

function compilePage ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

    $descriptorspec = array(
        0 => array("pipe", "r"),  # stdin is a pipe that the child will read from
        1 => array("pipe", "w"),  # stdout is a pipe that the child will write to
        2 => array("pipe", "w")   # stderr is a pipe that the child will write to
    );

    # Create a process to call Perl.
    $staticPageGenerator = $rootDirectory . $sep . "tools" . $sep . "libexec" . $sep . "compilePage.php";
    $command = "php " . $staticPageGenerator . " " . $uri;
    $process = proc_open($command, $descriptorspec, $pipes);

    if (is_resource($process)) {
        # Receive output from STDOUT.
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        # Receive error message from STDERR.
        stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        # Only for debugging.
        #echo $error . "\n";

        #$result[LIGHTWEIGHT_CMS_POST_CONTENT] = $output;
        #echo $output;

        $returnValue =  proc_close($process);

        # Only for debugging.
        #echo "return value: {$returnValue}" . "\n";

        if (0 == $returnValue) {
            return $output;
        }
        else {
            return "";
        }
    }

    return "";
}
