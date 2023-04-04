<?php
namespace LightweightCMS\Core;
# URIs related functions.


# Check whether the web page is the home page of a site.
function isHome ($uri)
{
    return "/" === $uri;
}

function isPageInHome ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    return preg_match("/^\/(\d+)\/$/", $uri);
}

function isTags ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    return "/tags/" === $uri;
}

function isPageInTags ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    return preg_match("/^\/tags\/\d+\/$/", $uri);
}

# Check whether the page is a section.
#
# The function doesn't distinguish between top sections
#  and nested ones.
function isSection ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";

    $path = $rootDirectory . $sep . CONTENT_DIRECTORY . $sep . str_replace("/", $sep, $uri);

    return is_dir($path);
}

function isPageInSection ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    if (preg_match("/^\/(.+)\/(\d+)\/$/", $uri, $matches)) {
        return isSection("/" . $matches[1] . "/");
    }

    return false;
}

function isTagPage ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    return preg_match("/^\/tags\/(.+)\/$/", $uri);
}

function isPageInTagPage ($uri)
{
    /* Add a trailing slash if no any. */
    if ("/" != substr($uri, strlen($uri)-1, 1)) {
        $uri .= "/";
    }

    return preg_match("/^\/tags\/([^\/]+?)\/(\d+)\/$/", $uri);
}

function isPage ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    require_once __DIR__ . $sep . "_uri.php";

    $path = getPath($uri, ".php");

    return file_exists($path);
}

function isPost ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load a private script.
    require_once __DIR__ . $sep . "_uri.php";

    $htmlPath = getPath($uri, HTML_FILE_EXTENSION);
    $markdownPath = getPath($uri, MARKDOWN_FILE_EXTENSION);
    $asciiDocPath = getPath($uri, ASCIIDOC_FILE_EXTENSION);
    $reStructuredTextPath = getPath($uri, RESTRUCTUREDTEXT_FILE_EXTENSION);
    $phpPath = getPath($uri, ".php");

    if (file_exists($htmlPath)) {
        $path = $htmlPath;
    }
    else if (file_exists($markdownPath)) {
        $path = $markdownPath;
    }
    else if (file_exists($asciiDocPath)) {
        $path = $asciiDocPath;
    }
    else if (file_exists($reStructuredTextPath)) {
        $path = $reStructuredTextPath;
    }
    else if (file_exists($phpPath)) {
        $path = $phpPath;
    }
    else {
        $path = null;
    }

    if (!is_null($path)) {
        # Load third-party libraries.
        require_once $rootDirectory . $sep . "vendor" . $sep . "autoload.php";
        # Load private scripts.
        require_once __DIR__ . $sep . "_utils.php";

        $rawContent = file_get_contents($path);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse some raw content.
        if (file_exists($markdownPath)) {
            $document = $parser->parse($rawContent);
        }
        else {
            $document = $parser->parse($rawContent, false);
        }

        # Extract the metadata from a post.
        $metadata = $document->getYAML();

        if (isValidField($metadata, METADATA_DRAFT)) {
            if ($metadata[METADATA_DRAFT]) {
                return false;
            }

            return true;
        }

        return true;
    }

    return false;
}
