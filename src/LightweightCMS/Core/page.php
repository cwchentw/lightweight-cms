<?php
namespace LightweightCMS\Core;
# Functions for all pages.


function getHomeContent ()
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load the third-party libraries.
    require_once $rootDirectory . $sep . "vendor" . $sep . "autoload.php";

    $contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY;
    $indexPage = $contentDirectory . $sep . SECTION_INDEX;

    # Default to an empty string.
    $result = "";

    if (file_exists($indexPage)) {
        $rawContent = file_get_contents($indexPage);

        $parser = new \Mni\FrontYAML\Parser();

        $ext = "." . pathinfo($indexPage, PATHINFO_EXTENSION);

        if (MARKDOWN_FILE_EXTENSION === $ext) {
            $document = $parser->parse($rawContent);
        }
        else {
            $document = $parser->parse($rawContent, false);
        }

        # Discard metadata from index page.
        #$metadata = $document->getYAML();

        # Strip metadata from index page.
        if (MARKDOWN_FILE_EXTENSION === $ext) {
            $stripedContent = $document->getContent();
            $result .= $stripedContent;
        }
        else if (ASCIIDOC_FILE_EXTENSION === $ext) {
            # Convert a AsciiDoc document to a HTML fragment.
            $asciiDoctorTemplatePath =
                $rootDirectory . $sep . "tools" . $sep . "lib" . $sep . "asciidoctor-backends";
            $process = proc_open(
                "asciidoctor -T {$asciiDoctorTemplatePath} -E erb -e -o - -",
                $descriptorspec,
                $pipes
            );

            if (is_resource($process)) {
                # Write the input to STDIN.
                fwrite($pipes[0], $stripedContent);
                fclose($pipes[0]);

                # Receive the output from STDOUT.
                $content = stream_get_contents($pipes[1]);
                fclose($pipes[1]);

                $returnValue = proc_close($process);

                if (0 === $returnValue) {
                    $result .= $content;
                }
                else {
                    $result = "Internal Server Error";
                }
            }
            else {
                $result = "Internal Server Error";
            }
        }
        else if (RESTRUCTUREDTEXT_FILE_EXTENSION === $ext) {
            # Convert a reStructuredText document to a HTML fragment.
            $rst2html = $rootDirectory . $sep . "tools" . $sep . "libexec" . $sep . "rst2html-fragment.py";
            if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                # Run the utility script on Windows.
                # TODO: Test the utility script on Windows.
                $process = proc_open("python ${rst2html}", $descriptorspec, $pipes);
            }
            else {
                # Run the utility script on Unix.
                $process = proc_open("${rst2html}", $descriptorspec, $pipes);
            }

            if (is_resource($process)) {
                # Write the input to STDIN.
                fwrite($pipes[0], $stripedContent);
                fclose($pipes[0]);

                # Receive the output from STDOUT.
                $content = stream_get_contents($pipes[1]);
                fclose($pipes[1]);

                $returnValue = proc_close($process);

                if (0 === $returnValue) {
                    $result .= $content;
                }
                else {
                    $result = "Internal Server Error";
                }
            }
            else {
                $result = "Internal Server Error";
            }
        }
    }

    return $result;
}

# Nested sections are supported. Nonetheless, it is not recommended
#  because of SEO. Instead, two layers of web pages are purposed,
#  like "/section-title/post-title/".
function getSections ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load some local scripts.
    require_once __DIR__ . $sep . "const.php";
    require_once __DIR__ . $sep . "section.php";

    $result = array();

    $contentDirectory = $rootDirectory . $sep . CONTENT_DIRECTORY . $uri;
    $files = scandir($contentDirectory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private directories and files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }

        $path = $contentDirectory . $sep . $file;
        if (is_dir($path)) {
            $section = null;
            # Get top section(s).
            if ("/" == $uri) {
                $section = readSection("/" . $file);
                $section[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/" . $file . "/";
            }
            # Get subsection(s) of a section.
            else {
                $section = readSection($uri . $file);
                $section[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $uri . $file . "/";
            }

            # Skip functional sections.
            # TODO: We may change it later.
            if (!(isValidField($section[LIGHTWEIGHT_CMS_SECTION_META], METADATA_NOINDEX)
                    && $section[LIGHTWEIGHT_CMS_SECTION_META][METADATA_NOINDEX]))
            {
                array_push($result, $section);
            }
        }
    }

    usort($result, $GLOBALS[SORT_SECTION_CALLBACK]);

    return $result;
}

function getPosts ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Get the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load some local scripts.
    require_once __DIR__ . $sep . "const.php";
    require_once __DIR__ . $sep . "post.php";

    $result = array();

    $modifiedURI = preg_replace("/\//", $sep, $uri);
    $directory = $rootDirectory . $sep . CONTENT_DIRECTORY . $modifiedURI;
    $files = scandir($directory, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        # Skip private files.
        if ("." == substr($file, 0, 1)) {
            continue;
        }
        else if ("_" == substr($file, 0, 1)) {
            continue;
        }

        $path = $directory . $file;
        if (is_file($path)) {
            $link = array();

            # Remove the file extension.
            $origPath = $uri . pathinfo($file, PATHINFO_FILENAME) . "/";
            $link[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . $origPath;

            # Get information of a post.
            $post = readPost($origPath);

            foreach ($post as $key => $value) {
                $link[$key] = $value;
            }

            # Skip functional posts.
            # TODO: We may change it later.
            if (!(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_NOINDEX)
                    && $post[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX])
                && !(isValidField($link[LIGHTWEIGHT_CMS_POST_META], METADATA_DRAFT)
                    && $link[LIGHTWEIGHT_CMS_POST_META][METADATA_DRAFT]))
            {
                array_push($result, $link);
            }
        }
    }

    usort($result, $GLOBALS[SORT_POST_CALLBACK]);

    return $result;
}

function getPostsPerPage ($uri, $page)
{
    $result = getPosts($uri);

    # Discard some post(s) if pagination is on.
    if (POST_PER_PAGE > 0) {
        # Discard previous post(s).
        $prevCount = 0;
        while (count($result) > 0 && $prevCount < $page * POST_PER_PAGE) {
            array_shift($result);
            $prevCount += 1;
        }

        # Discard next post(s).
        while (count($result) > POST_PER_PAGE) {
            array_pop($result);
        }
    }

    return $result;
}

function getBreadcrumb ($uri)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";
    # Get the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load some local scripts.
    require_once __DIR__ . $sep . "const.php";
    require_once __DIR__ . $sep . "uri.php";
    require_once __DIR__ . $sep . "post.php";
    # Load some private scripts.
    require_once __DIR__ . $sep . "_site.php";
    require_once __DIR__ . $sep . "_uri.php";

    $result = array();

    # Add the link to home.
    $d = array();

    $d[LIGHTWEIGHT_CMS_LINK_PATH] = SITE_PREFIX . "/";
    $d[LIGHTWEIGHT_CMS_LINK_TITLE] = BREADCRUMB_HOME;

    array_push($result, $d);

    if ("/" == $uri) {
        return $result;
    }

    $arr = parseURI($uri);
    $len = count($arr);
    for ($i = 0; $i < $len; ++$i) {
        $prev = $result[$i][LIGHTWEIGHT_CMS_LINK_PATH];

        if ("" != SITE_PREFIX) {
            $prevPath = substr($prev, strlen(SITE_PREFIX));
        }
        else {
            $prevPath = $prev;
        }

        $path = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath . $arr[$i];
        $htmlPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . HTML_FILE_EXTENSION;
        $markdownPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . MARKDOWN_FILE_EXTENSION;
        $asciiDocPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . ASCIIDOC_FILE_EXTENSION;
        $reStructuredTextPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . RESTRUCTUREDTEXT_FILE_EXTENSION;
        $phpPath = $rootDirectory
            . "/" . CONTENT_DIRECTORY
            . $prevPath
            . $arr[$i] . ".php";

        $d = array();
        $d[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

        if (is_dir($path)) {
            $section = readSection($prevPath . $arr[$i]);
            $section[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";
            array_push($result, $section);
        }
        else if (file_exists($htmlPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($markdownPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($asciiDocPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($reStructuredTextPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
        else if (file_exists($phpPath)) {
            $post = readPost($prevPath . $arr[$i]);
            $post[LIGHTWEIGHT_CMS_LINK_PATH] = $prev . $arr[$i] . "/";

            array_push($result, $post);
        }
    }

    return $result;
}
