<?php
namespace LightweightCMS\Plugin;
# Calculate word count and read time for western European text.

function wordCount($content)
{
    $result = 0;

    # Count words in paragraphs.
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

        # Currently, we only count words for articles in Western languages.
        $words = explode(" ", $text);
        $result += count($words);
    }

    # Count words in list items.
    if (preg_match_all("/<li[^>]*>(.+)<\/li>/", $content, $matches)) {
        $text = "";

        for ($i = 0; $i < count($matches[1]); ++$i) {
            # Reduce multiple spaces into single space.
            $paragraph = preg_replace("/[ ]+/", " ", $matches[1][$i]);
            $text .= $paragraph;

            if ($i < count($matches[1]) - 1) {
                $text .= " ";
            }
        }

        # Currently, we only count words for articles in Western languages.
        $words = explode(" ", $text);
        $result += count($words);
    }

    return $result;
}

function readTime($wordCount)
{
    # Average reading speed for adults.
    $wpm = 200;

    return ceil($wordCount / $wpm);
}
