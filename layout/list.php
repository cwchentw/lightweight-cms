<?php
# The layout of sections.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# Take global data.
$section = $GLOBALS[MDCMS_SECTION];
$sections = $GLOBALS[MDCMS_SECTIONS];
$pages = $GLOBALS[MDCMS_PAGES];
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $section[MDCMS_SECTION_TITLE] ?></title>
        <meta name="author" content="<?php echo SITE_AUTHOR ?>">

        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div class="text-center">
            <h1><?php echo $section[MDCMS_SECTION_TITLE]; ?></h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php includePartials("breadcrumb.php"); ?>

            <?php
            if (isset($section[MDCMS_SECTION_CONTENT])
                && "" != $section[MDCMS_SECTION_CONTENT])
                echo $section[MDCMS_SECTION_CONTENT];
            ?>

            <?php
            # Add section(s) if any exist.
            # TODO: Check it later.
            if (isset($sections) && count($sections) > 0) {
                echo "<h2>Sections</h2>";

                echo "<div class=\"list-group\">";

                foreach ($sections as $section)
                    echo "<a class=\"list-group-item\" "
                        . "href=\"" . $section[MDCMS_LINK_PATH] ."\">"
                        . $section[MDCMS_LINK_TITLE]
                        . "</a>";

                echo "</div>";
            }
            ?>

            <?php
            # Add page(s) if any exist.
            if (isset($pages) && count($pages) > 0) {
                echo "<h2>Articles</h2>";

                echo "<div class=\"list-group\">";

                foreach ($pages as $page)
                    echo "<a class=\"list-group-item\" "
                        . "href=\"" . $page[MDCMS_LINK_PATH] . "\">"
                        . $page[MDCMS_LINK_TITLE]
                        . "</a>";

                echo "</div>";
            }
            ?>
        </div>

        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
