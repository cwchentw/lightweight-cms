<?php
# Breadcrumb(s) of a page.
#
# This layout is applicable to all pages in mdcms sites
#  - home page, sections and posts.


# Take global data.
$breadcrumb = $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB];
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <?php
        $len = count($breadcrumb);
        for ($i = 0; $i < $len; ++$i) {
            if ($i < $len - 1) {
                if (!is_null($breadcrumb[$i][LIGHTWEIGHT_CMS_SECTION_META])
                    && count($breadcrumb[$i][LIGHTWEIGHT_CMS_SECTION_META]) > 0
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
                if (!is_null($breadcrumb[$i][LIGHTWEIGHT_CMS_POST_META])
                    && count($breadcrumb[$i][LIGHTWEIGHT_CMS_POST_META]) > 0
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
