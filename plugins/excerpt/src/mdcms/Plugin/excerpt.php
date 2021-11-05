<?php
namespace mdcms\Plugin;
# Generate an excerpt from western European text.


function excerpt($content)
{
    $sep = DIRECTORY_SEPARATOR;
    $projectDirectory = __DIR__ . "{$sep}..{$sep}..{$sep}..";
    $rootDirectory = $projectDirectory . "{$sep}..{$sep}..";
    require_once $rootDirectory . "{$sep}setting.php";

    $result = "";

    if (preg_match_all("/<p[^>]*>(.+)<\/p>/", $content, $matches)) {
        $text = "";

        for ($i = 0; $i < count($matches[1]); ++$i) {
            # Reduce multiple spaces into single space.
            $paragraph = preg_replace("/[ ]+/", " ", $matches[1][$i]);

            # Remove all HTML tags inside.
            $paragraph = strip_tags($paragraph);

            $text .= $paragraph;

            if ($i < count($matches[1]) - 1) {
                $text .= " ";
            }
        }

        $words = explode(" ", $text);

        $excerpt = "";
        for ($i = 0; $i < count($words); ++$i) {
            if (strlen($excerpt) <= EXCERPT_THRESHOLD) {
                $excerpt .= $words[$i];
            }
            else {
                break;
            }

            if ($i < count($words) - 1) {
                $excerpt .= " ";
            }
        }

        $result .= $excerpt;
    }

    return $result;
}
