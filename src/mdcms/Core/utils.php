<?php
namespace mdcms\Core;
# Utility functions for mdcms.


# Copy directories and files recursively.
#
# Call it within a `try ... catch ...` block because the task may fail.
function xCopy($src, $dst)
{
    # Create destination directory if it doesn't exist.
    if (!is_dir($dst)) {
        # Currently, we hard code the common 0755 mode for destination directory.
        # We may read system mode instead if possible and feasible.
        if (!mkdir($dst, 0755, true)) {
            # We may find a better exception for this event.
            # TODO: Refactor it later.
            throw new \Exception("Unable to create directory: " . $dst . "\n");
        }
    }

    # Open the handle of destination directory.
    $dir = opendir($src);
    if (!$dir) {
        throw new \Exception("Unable to open directory: " . $src . "\n");
    }

    while(false !== ($file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            # Copy a subdirectionary by a recursive call.
            if ( is_dir($src . "/" . $file) ) {
                try {
                    xCopy($src . "/" . $file, $dst . "/" . $file);
                }
                catch (Exception $e) {
                    # Release the handle of destination directory.
                    closedir($dir);

                    throw $e;
                }
            }
            # Copy a file.
            else {
                if (!copy($src . "/" . $file, $dst . "/" . $file)) {
                    # Release the handle of destination directory.
                    closedir($dir);
  
                    # We may find a better exception for this event.
                    # TODO: Refactor it later.
                    throw new \Exception("Unable to create file: " . $dst . "/" . $file . "\n");
                }
            }
        }
    }
 
    # Release the handle of destination directory.
    closedir($dir);
}

# Disallow search engines from following links.
#
# Internally, the function calls Perl instead of utilizing
#  regex of PHP because the latter is unable to replace patterns
#  globally with callbacks.
function noFollowLinks($content)
{
    $rootDirectory = __DIR__ . "/../../..";
    # Load global setting.
    require_once $rootDirectory . "/setting.php";

    $baseURL = SITE_BASE_URL;
    $perl_program = <<<PERL
# Receive input from PHP program.
my \$input = <<'END';
$content
END

# Replace external links globally.
\$input =~ s{<a href=\"(.+?)\">(.+?)</a>}{
    # Skip local URIs.
    index(\$1, "http") < 0 ? "<a href=\"\$1\">\$2</a>"
    # Skip URIs of same domain.
    : index(\$1, "$baseURL") == 0 ? "<a href=\"\$1\">\$2</a>"
    # Prevent search engines from following links.
    : "<a href=\"\$1\" target=\"_blank\" rel=\"noopener nofollow\">\$2</a>"}ge;

# Print modified input to STDOUT.
print \$input;
PERL;

    $descriptorspec = array(
        0 => array("pipe", "r"),  # stdin is a pipe that the child will read from
        1 => array("pipe", "w"),  # stdout is a pipe that the child will write to
        2 => array("pipe", "w")   # stderr is a pipe that the child will write to
    );

    # Create a process to call Perl.
    $process = proc_open("perl", $descriptorspec, $pipes);

    if (is_resource($process)) {
        # Write our program to STDIN.
        fwrite($pipes[0], $perl_program);
        fclose($pipes[0]);

        # Receive output from STDOUT.
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        # Receive error message from STDERR.
        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        # Only for debugging.
        #echo $error . "\n";

        #$result[MDCMS_POST_CONTENT] = $output;
        #echo $output;

        $return_value =  proc_close($process);

        # Only for debugging.
        #echo "return value: {$return_value}" . "\n";

        if (0 == $return_value) {
            return $output;
        }
        else {
            return $content;
        }
    }

    return $content;
}
