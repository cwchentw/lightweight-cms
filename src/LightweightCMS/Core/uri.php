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

    if (file_exists($htmlPath)) {
        # Load third-party libraries.
        require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
        # Load private scripts.
        require_once __DIR__ . "{$sep}_utils.php";

        $rawContent = file_get_contents($htmlPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent, false);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        if (isValidField($metadata, METADATA_DRAFT)) {
            if ($metadata[METADATA_DRAFT]) {
                return false;
            }

            return true;
        }

        return true;
    }
    else if (file_exists($markdownPath)) {
        # Load third-party libraries.
        require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
        # Load private scripts.
        require_once __DIR__ . "{$sep}_utils.php";

        $rawContent = file_get_contents($markdownPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        if (isValidField($metadata, METADATA_DRAFT)) {
            if ($metadata[METADATA_DRAFT]) {
                return false;
            }

            return true;
        }

        return true;
    }
    else if (file_exists($asciiDocPath)) {
        # Load third-party libraries.
        require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
        # Load private scripts.
        require_once __DIR__ . "{$sep}_utils.php";

        $rawContent = file_get_contents($asciiDocPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent, false);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        if (isValidField($metadata, METADATA_DRAFT)) {
            if ($metadata[METADATA_DRAFT]) {
                return false;
            }

            return true;
        }

        return true;
    }
    else if (file_exists($reStructuredTextPath)) {
        # Load third-party libraries.
        require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
        # Load private scripts.
        require_once __DIR__ . "{$sep}_utils.php";

        $rawContent = file_get_contents($reStructuredTextPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent, false);

        # Extract metadata from a post.
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
