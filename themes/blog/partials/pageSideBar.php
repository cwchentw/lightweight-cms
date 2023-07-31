<?php
# Take global data.
$sections = \LightweightCMS\Core\getSections(SITE_PREFIX . "/");
# Pages are the web pages under a home page.
$pages = \LightweightCMS\Core\getPosts(SITE_PREFIX . "/");


# Add section(s) if any exists.
if (isset($sections) && count($sections) > 0) {
    echo "<div class='category-block'>";

    foreach ($sections as $section) {
        echo "<a class='btn btn-outline-dark btn-sm category-link' "
            . "href=\"" . $section[LIGHTWEIGHT_CMS_LINK_PATH] ."\">"
            . $section[LIGHTWEIGHT_CMS_SECTION_TITLE]
            . "</a>";
    }

    echo "</div>";  # End of the region of the sections.
}

if (isset($pages) && count($pages) > 0) {
    echo "<div class='list-group list-group-item-action active' aria-current='true'>";

    foreach ($pages as $page) {
        echo "<a class='list-group-item'"
            . "href=\"" . $page[LIGHTWEIGHT_CMS_LINK_PATH] ."\">"
            . $page[LIGHTWEIGHT_CMS_POST_TITLE]
            . "</a>";
        }
    echo "</div>";
}