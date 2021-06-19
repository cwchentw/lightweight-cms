<?php
# ToC (Table of Contents) for default theme.
#
# It is only applicatble to posts in mdcms sites.


# Take global data.
$post = $GLOBALS[MDCMS_POST];

# Extract titles and ids from <h2> titles.
$subtitles = array();
preg_match_all("/<h2 id=\"([^\"]+)\">([^<]+)<\/h2>/", $post[MDCMS_POST_CONTENT], $matches);
if (isset($matches)) {
    for ($i = 0; $i < count($matches[1]); ++$i) {
        $subtitle = array();

        $subtitle["id"] = $matches[1][$i];
        $subtitle["title"] = $matches[2][$i];

        array_push($subtitles, $subtitle);
    }
}

$URI = "";
# The script is called from the Web.
if (isset($_SERVER["REQUEST_URI"])) {
    $URI = $_SERVER["REQUEST_URI"];
}
# The script is called from CLI.
else if (isset($GLOBALS["file"])){
    $URI = "/" . basename($GLOBALS["file"], ".php") . HTML_FILE_EXTENSION;
}
# Fallback to the root path.
else {
    $URI = "/";
}
?>

<div id="toc">
    <div class="text-center">Table of Contents</div>
    <ul>
        <?php
        foreach ($subtitles as $subtitle) {
            echo "<li>";

            echo "<a href=\"" . $URI  . "#" . $subtitle["id"] . "\" class=\"toc-item\">";
            echo $subtitle["title"];        
            echo "</a>";

            echo "</li>";
        }
        ?>

        <!-- FIXME: Check the rendered URL. -->
        <li><a href="<?php echo $URI; ?>#top" class="toc-link">Back to Top</a></li>

        <li><a href="/" class="toc-link">Back to Home</a></li>
    </ul>
</div>
