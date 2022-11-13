<?php
# Breadcrumb(s) of a page.
#
# This layout is applicable to all pages in Lightweight CMS sites
#  - home page, sections and posts.


# Take global data.
$breadcrumb = $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB];
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <?php
        $uri = $_SERVER["REQUEST_URI"];
        $len = count($breadcrumb);
        for ($i = 0; $i < $len; ++$i) {
            # Skip top breadcrumb on the subsites.
            if (0 === $i
                && (0 === strpos($uri, SITE_PREFIX . "/zh-tw")
                    || 0 === strpos($uri, SITE_PREFIX . "/en-us")))
            {
                continue;
            }

            if ($i < $len - 1) {
                if (array_key_exists(LIGHTWEIGHT_CMS_SECTION_META, $breadcrumb[$i])
                    && array_key_exists("linkTitle", $breadcrumb[$i][LIGHTWEIGHT_CMS_SECTION_META]))
                {
                    echo "<li class=\"breadcrumb-item\">";
                    echo "<a href=\"" . $breadcrumb[$i][LIGHTWEIGHT_CMS_LINK_PATH] . "\">"
                        . $breadcrumb[$i][LIGHTWEIGHT_CMS_SECTION_META]["linkTitle"] . "</a>";
                    echo "</li>";
                }
                else {
                    echo "<li class=\"breadcrumb-item\">";
                    echo "<a href=\"" . $breadcrumb[$i][LIGHTWEIGHT_CMS_LINK_PATH] . "\">"
                        . $breadcrumb[$i][LIGHTWEIGHT_CMS_LINK_TITLE] . "</a>";
                    echo "</li>";
                }
            }
            else {
                if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $breadcrumb[$i])
                    && array_key_exists("linkTitle", $breadcrumb[$i][LIGHTWEIGHT_CMS_POST_META]))
                {
                    echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">"
                        . $breadcrumb[$i][LIGHTWEIGHT_CMS_POST_META]["linkTitle"]
                        . "</li>";
                }
                else {
                    echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">"
                        . $breadcrumb[$i][LIGHTWEIGHT_CMS_LINK_TITLE]
                        . "</li>";
                }
            }
        }
        ?>

    </ol>
</nav>
