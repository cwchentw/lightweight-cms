<?php
namespace LightweightCMS\Core;
# Post related function(s).


# The implementation is too long. We may refactor it later.
function readPost ($page)
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . ".." . $sep . ".." . $sep . "..";

    # Load the third-party libraries.
    require_once $rootDirectory . $sep . "vendor" . $sep . "autoload.php";
    # Load the site settings.
    require_once $rootDirectory . $sep . "setting.php";
    # Load some local scripts.
    require_once __DIR__ . $sep . "const.php";
    require_once __DIR__ . $sep . "errorPage.php";
    require_once __DIR__ . $sep . "uri.php";
    require_once __DIR__ . $sep . "utils.php";
    # Load some private scripts.
    require_once __DIR__ . $sep . "_uri.php";
    require_once __DIR__ . $sep . "_utils.php";

    $result = array();

    # Initialize the fields of a post.
    $result[LIGHTWEIGHT_CMS_POST_TITLE] = "";
    $result[LIGHTWEIGHT_CMS_POST_CONTENT] = "";
    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = "";
    $result[LIGHTWEIGHT_CMS_POST_STATUS] = 404;

    $htmlPath = getPath($page, HTML_FILE_EXTENSION);
    $markdownPath = getPath($page, MARKDOWN_FILE_EXTENSION);
    $asciiDocPath = getPath($page, ASCIIDOC_FILE_EXTENSION);
    $reStructuredTextPath = getPath($page, RESTRUCTUREDTEXT_FILE_EXTENSION);
    $phpPath = getPath($page, ".php");

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

    $rawContent = file_get_contents($path);

    /* NOTE: To our best knowledge, there is no front matter YAML parser
        for PHP 8.2 currently. Hence, we keep the version of PHP in 8.1. */
    $parser = new \Mni\FrontYAML\Parser();

    # Parse raw content.
    if (file_exists($markdownPath)) {
        $document = $parser->parse($rawContent);
    }
    else {
        $document = $parser->parse($rawContent, false);
    }

    # Extract metadata from a post.
    $metadata = $document->getYAML();

    # Strip metadata from a post.
    $stripedContent = $document->getContent();

    # Expose metadata of a post. No matter it is empty or not.
    if (is_array($metadata)) {
        $result[LIGHTWEIGHT_CMS_POST_META] = $metadata;
    }
    else {
        $result[LIGHTWEIGHT_CMS_POST_META] = array();
    }

    # Here we simply set higher priority for HTML pages.
    #  We may change it later.
    if (file_exists($htmlPath)) {
        if (isValidField($metadata, METADATA_TITLE)) {
            $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];

            # We have received a title from the metadata of a post.
            #  Therefore, we remove <h1>-level titles from the content.
            $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $stripedContent);
        }
        else {
            # `$stripedContent` is not a full HTML document.
            # Therefore, we don't use a HTML parser but some regex pattern.
            if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $stripedContent, $matches)) {
                $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];

                # Remove <h1>-level titles from the content.
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $stripedContent);
            }
            else {
                $pages = parseURI($page);
                $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                $title = ucwords($title);  # Capitalize a title.
                $result[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $stripedContent;
            }
        }

        # Set the author of a post.
        if (isValidField($metadata, METADATA_AUTHOR)) {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
        }

        # Set the mtime of a post.
        if (isValidField($metadata, METADATA_MTIME)) {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($htmlPath);
        }

        # Set weight of a post if any.
        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        $result[LIGHTWEIGHT_CMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }
    else if (file_exists($markdownPath)) {
        if (isValidField($metadata, METADATA_TITLE)) {
            $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];

            # Remove a <h1>-level title from the content.
            # Here we assume there is only one <h1> title per document.
            $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
        }
        else {
            if (preg_match("/^# (.+)/", $stripedContent, $matches)) {
                $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];

                # Remove a <h1>-level title from the content.
                # Here we assume there is only one <h1> title per document.
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
            }
            else {
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $stripedContent;
            }
        }

        # Set author of a post.
        if (isValidField($metadata, METADATA_AUTHOR)) {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
        }

        # Set mtime of a post.
        if (isValidField($metadata, METADATA_MTIME)) {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($markdownPath);
        }

        # Set weight of a post if any.
        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        /* Convert the Markdown document into a HTML document.

           NOTE: erusev/Parsedown doesn't support PHP 8.2 yet.
            Hence, we keep the version of PHP in 8.1.  */
        $parser = new \Parsedown();
        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $parser->text($result["content"]);

        $result[LIGHTWEIGHT_CMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }
    else if (file_exists($asciiDocPath)) {
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w")
        );

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
                # Set the author of a post.
                if (isValidField($metadata, METADATA_AUTHOR)) {
                    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
                }
                else {
                    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
                }

                # Set the mtime of a post.
                if (isValidField($metadata, METADATA_MTIME)) {
                    $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
                }
                else {
                    $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($htmlPath);
                }

                # Set weight of a post if any.
                if (isValidField($metadata, METADATA_WEIGHT)) {
                    $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
                }

                if (isValidField($metadata, METADATA_TITLE)) {
                    $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];

                    # We have received a title from the metadata of a post.
                    #  Therefore, we remove <h1>-level titles from the content.
                    $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                }
                else {
                    # `$content` is not a full HTML document.
                    # Therefore, we don't use a HTML parser but some regex pattern.
                    if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $content, $matches)) {
                        $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];

                        # Remove <h1>-level titles from the content.
                        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                    }
                    else {
                        $pages = parseURI($page);
                        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                        $title = ucwords($title);  # Capitalize a title.
                        $result[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
                        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $content;
                    }
                }

                $result[LIGHTWEIGHT_CMS_POST_STATUS] = 200;  # HTTP 200 OK.
            }
            else {
                $result = errorPage("Internal Server Error", "Unable to Convert AsciiDoc", 500);
            }
        }
        else {
            $result = errorPage("Internal Server Error", "Unable to Run AsciiDoc", 500);
        }
    }
    else if (file_exists($reStructuredTextPath)) {
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w")
        );

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
                # Set the author of a post.
                if (isValidField($metadata, METADATA_AUTHOR)) {
                    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
                }
                else {
                    $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
                }

                # Set the mtime of a post.
                if (isValidField($metadata, METADATA_MTIME)) {
                    $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
                }
                else {
                    $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($htmlPath);
                }

                # Set weight of a post if any.
                if (isValidField($metadata, METADATA_WEIGHT)) {
                    $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
                }

                if (isValidField($metadata, METADATA_TITLE)) {
                    $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];

                    # We have received a title from the metadata of a post.
                    #  Therefore, we remove <h1>-level titles from the content.
                    $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                }
                else {
                    # `$content` is not a full HTML document.
                    # Therefore, we don't use a HTML parser but some regex pattern.
                    if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $content, $matches)) {
                        $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];

                        # Remove <h1>-level titles from the content.
                        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                    }
                    else {
                        $pages = parseURI($page);
                        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                        $title = ucwords($title);  # Capitalize a title.
                        $result[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
                        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $content;
                    }
                }

                $result[LIGHTWEIGHT_CMS_POST_STATUS] = 200;  # HTTP 200 OK.
            }
            else {
                $result = errorPage("Internal Server Error", "Unable to Convert reStructuredText", 500);
            }
        }
        else {
            $result = errorPage("Internal Server Error", "Unable to Run reStructuredText", 500);
        }
    }
    else if (file_exists($phpPath)) {
        # Set the author of a post.
        if (isValidField($metadata, METADATA_AUTHOR)) {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_AUTHOR] = SITE_AUTHOR;
        }

        # Set the mtime of a post.
        if (isValidField($metadata, METADATA_MTIME)) {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
        }
        else {
            $result[LIGHTWEIGHT_CMS_POST_MTIME] = filemtime($phpPath);
        }

        # Set weight of a post if any.
        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[LIGHTWEIGHT_CMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        if (isValidField($metadata, METADATA_TITLE)) {
            $result[LIGHTWEIGHT_CMS_POST_TITLE] = $metadata[METADATA_TITLE];

            # We have received a title from the metadata of a post.
            #  Therefore, we remove <h1>-level titles from the content.
            $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
        }
        else {
            # `$content` is not a full HTML document.
            # Therefore, we don't use a HTML parser but some regex pattern.
            if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $content, $matches)) {
                $result[LIGHTWEIGHT_CMS_POST_TITLE] = $matches[1];

                # Remove <h1>-level titles from the content.
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
            }
            else {
                $pages = parseURI($page);
                $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                $title = ucwords($title);  # Capitalize a title.
                $result[LIGHTWEIGHT_CMS_POST_TITLE] = $title;
                $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $content;
            }
        }

        # We cannot tell whether the content of the PHP page is wrong or not.
        #  Hence, we postpone the evaluation till our page layout.
    }

    # Prevent search engine bots from following links.
    # FIXME: Not working for reStructuredText posts.
    if (NO_FOLLOW_EXTERNAL_LINK) {
        $output = noFollowLinks($result[LIGHTWEIGHT_CMS_POST_CONTENT]);
        $result[LIGHTWEIGHT_CMS_POST_CONTENT] = $output;
    }

    return $result;
}
