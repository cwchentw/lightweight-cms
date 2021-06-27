<?php
namespace mdcms\Plugin;
# Calculate word count and read time for western European text.

function wordCount($content)
{
    $result = 0;
    if (preg_match_all("/<p[^>]*>(.+)<\/p>/", $content, $matches)) {
        $text = "";

        for ($i = 0; $i < count($matches[1]); ++$i) {
            # Reduce multiple spaces into single space.
            $paragraph = preg_replace("/[ ]+/", " ", $matches[1][$i]);
            $text .= $paragraph;

            if ($i < count($matches[1]) - 1) {
                $text .= " ";
            }
        }

        $words = explode(" ", $text);
        # Currently, we only count words for English articles.
        # TODO: Count words for posts in other languages.
        $result = count($words);
    }

    return $result;
}

function readTime($wordCount)
{
    # Average reading speed for adults.
    $wpm = 300;

    return ceil($wordCount / $wpm);
}
