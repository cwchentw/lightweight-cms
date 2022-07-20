<?php
namespace mdcms\Core;
# Post related function(s).


# The implementation is too long. We may refactor it later.
function readPost($page)
{
    $sep = DIRECTORY_SEPARATOR;

    # Get the root path of mdcms.
    $rootDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";

    # Load third-party libraries.
    require_once $rootDirectory . "{$sep}vendor{$sep}autoload.php";
    # Load global setting.
    require_once $rootDirectory . "{$sep}setting.php";
    # Load local scripts.
    require_once __DIR__ . "{$sep}const.php";
    require_once __DIR__ . "{$sep}errorPage.php";
    require_once __DIR__ . "{$sep}uri.php";
    require_once __DIR__ . "{$sep}utils.php";
    # Load private scripts.
    require_once __DIR__ . "{$sep}_uri.php";
    require_once __DIR__ . "{$sep}_utils.php";

    $result = array();

    # Initialize the fields of a post.
    $result[MDCMS_POST_TITLE] = "";
    $result[MDCMS_POST_CONTENT] = "";
    $result[MDCMS_POST_AUTHOR] = "";
    $result[MDCMS_POST_STATUS] = 404;

    $htmlPath = getPath($page, HTML_FILE_EXTENSION);
    $markdownPath = getPath($page, MARKDOWN_FILE_EXTENSION);
    $asciiDocPath = getPath($page, ASCIIDOC_FILE_EXTENSION);

    # Here we simply set higher priority for HTML pages.
    #  We may change it later.
    if (file_exists($htmlPath)) {
        $rawContent = file_get_contents($htmlPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent, false);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        # Strip metadata from a post.
        $stripedContent = $document->getContent();

        # Expose metadata of a post. No matter it is empty or not.
        if (!is_null($metadata)) {
            $result[MDCMS_POST_META] = $metadata;
        }
        else {
            $result[MDCMS_POST_META] = array();
        }

        if (isValidField($metadata, METADATA_TITLE)) {
            $result[MDCMS_POST_TITLE] = $metadata[METADATA_TITLE];

            # We have received a title from the metadata of a post.
            #  Therefore, we remove <h1>-level titles from the content.
            $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $stripedContent);
        }
        else {
            # `$stripedContent` is not a full HTML document.
            # Therefore, we don't use a HTML parser but some regex pattern.
            if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $stripedContent, $matches)) {
                $result[MDCMS_POST_TITLE] = $matches[1];

                # Remove <h1>-level titles from the content.
                $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $stripedContent);
            }
            else {
                $pages = parseURI($page);
                $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                $title = ucwords($title);  # Capitalize a title.
                $result[MDCMS_POST_TITLE] = $title;
                $result[MDCMS_POST_CONTENT] = $stripedContent;
            }
        }

        # Set the author of a post.
        if (isValidField($metadata, METADATA_AUTHOR)) {
            $result[MDCMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
        }
        else {
            $result[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
        }

        # Set the mtime of a post.
        if (isValidField($metadata, METADATA_MTIME)) {
            $result[MDCMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
        }
        else {
            $result[MDCMS_POST_MTIME] = filemtime($htmlPath);
        }

        # Set weight of a post if any.
        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[MDCMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }
    else if (file_exists($markdownPath)) {
        $rawContent = file_get_contents($markdownPath);

        $parser = new \Mni\FrontYAML\Parser();

        $document = $parser->parse($rawContent);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        # Strip metadata from a post.
        $stripedContent = $document->getContent();

        # Expose metadata of a post. No matter it is empty or not.
        if (!is_null($metadata)) {
            $result[MDCMS_POST_META] = $metadata;
        }
        else {
            $result[MDCMS_POST_META] = array();
        }

        if (isValidField($metadata, METADATA_TITLE)) {
            $result[MDCMS_POST_TITLE] = $metadata[METADATA_TITLE];

            # Remove a <h1>-level title from the content.
            # Here we assume there is only one <h1> title per document.
            $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
        }
        else {
            if (preg_match("/^# (.+)/", $stripedContent, $matches)) {
                $result[MDCMS_POST_TITLE] = $matches[1];

                # Remove a <h1>-level title from the content.
                # Here we assume there is only one <h1> title per document.
                $result[MDCMS_POST_CONTENT] = preg_replace("/^# (.+)/", "", $stripedContent);
            }
            else {
                $result[MDCMS_POST_CONTENT] = $stripedContent;
            }
        }

        # Set author of a post.
        if (isValidField($metadata, METADATA_AUTHOR)) {
            $result[MDCMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
        }
        else {
            $result[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
        }

        # Set mtime of a post.
        if (isValidField($metadata, METADATA_MTIME)) {
            $result[MDCMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
        }
        else {
            $result[MDCMS_POST_MTIME] = filemtime($markdownPath);
        }

        # Set weight of a post if any.
        if (isValidField($metadata, METADATA_WEIGHT)) {
            $result[MDCMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
        }

        # Convert the Markdown document into a HTML document.
        $parser = new \Parsedown();
        $result[MDCMS_POST_CONTENT] = $parser->text($result["content"]);

        $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
    }
    else if (file_exists($asciiDocPath)) {
        $rawContent = file_get_contents($asciiDocPath);

        $parser = new \Mni\FrontYAML\Parser();

        # Parse raw content.
        $document = $parser->parse($rawContent, false);

        # Extract metadata from a post.
        $metadata = $document->getYAML();

        # Strip metadata from a post.
        $stripedContent = $document->getContent();

        # Expose metadata of a post. No matter it is empty or not.
        if (!is_null($metadata)) {
            $result[MDCMS_POST_META] = $metadata;
        }
        else {
            $result[MDCMS_POST_META] = array();
        }

        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w")
        );
        
        # Convert a AsciiDoc document to a HTML fragment.
        $process = proc_open("asciidoctor -e -o - -", $descriptorspec, $pipes);
        
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
                    $result[MDCMS_POST_AUTHOR] = $metadata[METADATA_AUTHOR];
                }
                else {
                    $result[MDCMS_POST_AUTHOR] = SITE_AUTHOR;
                }

                # Set the mtime of a post.
                if (isValidField($metadata, METADATA_MTIME)) {
                    $result[MDCMS_POST_MTIME] = strtotime($metadata[METADATA_MTIME]);
                }
                else {
                    $result[MDCMS_POST_MTIME] = filemtime($htmlPath);
                }

                # Set weight of a post if any.
                if (isValidField($metadata, METADATA_WEIGHT)) {
                    $result[MDCMS_POST_WEIGHT] = $metadata[METADATA_WEIGHT];
                }

                if (isValidField($metadata, METADATA_TITLE)) {
                    $result[MDCMS_POST_TITLE] = $metadata[METADATA_TITLE];
        
                    # We have received a title from the metadata of a post.
                    #  Therefore, we remove <h1>-level titles from the content.
                    $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                }
                else {
                    # `$content` is not a full HTML document.
                    # Therefore, we don't use a HTML parser but some regex pattern.
                    if (preg_match("/<h1[^>]*>(.+)<\/h1>/", $content, $matches)) {
                        $result[MDCMS_POST_TITLE] = $matches[1];
        
                        # Remove <h1>-level titles from the content.
                        $result[MDCMS_POST_CONTENT] = preg_replace("/<h1[^>]*>(.+)<\/h1>/", "", $content);
                    }
                    else {
                        $pages = parseURI($page);
                        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
                        $title = ucwords($title);  # Capitalize a title.
                        $result[MDCMS_POST_TITLE] = $title;
                        $result[MDCMS_POST_CONTENT] = $content;
                    }
                }

                $result[MDCMS_POST_STATUS] = 200;  # HTTP 200 OK.
            }
            else {
                $result = errorPage("Internal Server Error", "Unable to Convert AsciiDoc", 500);
            }
        }
        else {
            $result = errorPage("Internal Server Error", "Unable to Convert AsciiDoc", 500);
        }
    }

    # Prevent search engine bots from following links.
    if (NO_FOLLOW_EXTERNAL_LINK) {
        $output = noFollowLinks($result[MDCMS_POST_CONTENT]);
        $result[MDCMS_POST_CONTENT] = $output;
    }

    return $result;
}
