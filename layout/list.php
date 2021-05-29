<?php
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

        <?php
        include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1><?php echo $section[MDCMS_SECTION_TITLE]; ?></h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php
            if (isset($section[MDCMS_SECTION_CONTENT])
                && "" != $section[MDCMS_SECTION_CONTENT])
                echo $section[MDCMS_SECTION_CONTENT];
            ?>

            <?php
            # Add section(s) if any exist.
            if (isset($sections) && count($sections) > 0) {
                echo "<h2>Sections</h2>";

                echo "<ul>";

                foreach ($sections as $section)
                    echo "<li><a href=\"" . $section[MDCMS_LINK_PATH] ."\">"
                        . $section[MDCMS_LINK_TITLE] . "</a></li>";

                echo "</ul>";
            }
            ?>

            <?php
            # Add page(s) if any exist.
            if (isset($pages) && count($pages) > 0) {
                echo "<h2>Pages</h2>";

                echo "<ul>";

                foreach ($pages as $page)
                    echo "<li><a href=\"" . $page[MDCMS_LINK_PATH] . "\">"
                        . $page[MDCMS_LINK_TITLE] . "</a></li>";

                echo "</ul>";
            }
            ?>
        </div>
        
        <?php
        include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
