<?php
namespace mdcms\Core;
# Private utility functions for mdcms.


function isValidField($array, $key)
{
    return !is_null($array)
        && array_key_exists($key, $array)
        && "" != $array[$key];
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
    $perlProgram = <<<PERL
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
        fwrite($pipes[0], $perlProgram);
        fclose($pipes[0]);

        # Receive output from STDOUT.
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        # Receive error message from STDERR.
        stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        # Only for debugging.
        #echo $error . "\n";

        #$result[MDCMS_POST_CONTENT] = $output;
        #echo $output;

        $returnValue =  proc_close($process);

        # Only for debugging.
        #echo "return value: {$returnValue}" . "\n";

        if (0 == $returnValue) {
            return $output;
        }
        else {
            return $content;
        }
    }

    return $content;
}
