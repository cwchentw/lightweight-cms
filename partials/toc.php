<?php
# The layout of ToC (Table of Contents)
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";

# Take global data.
$post = $GLOBALS[MDCMS_POST];

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
?>
<div id="table-of-contents">
    <div class="text-center">Table of Contents</div>
    <ul>
        <?php
        foreach ($subtitles as $subtitle) {
            echo "<li>";

            echo "<a href=\"" . $_SERVER["REQUEST_URI"] . "#" . $subtitle["id"] . "\">";
            echo $subtitle["title"];        
            echo "</a>";

            echo "</li>";
        }
        ?>
        <!-- FIXME: Check the rendered URL. -->
        <li><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>#top">Back to Top</a></li>
        <li><a href="/">Back to Home</a></li>
    </ul>
</div>