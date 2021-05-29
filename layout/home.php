<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";

# Take global data.
$sections = $GLOBALS[MDCMS_SECTIONS];
$pages = $GLOBALS[MDCMS_PAGES];
$status = 200;
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo SITE_NAME; ?></title>
        <meta name="description" content="<?php echo SITE_DESCRIPTION ?>">
        <meta name="author" content="<?php echo SITE_AUTHOR ?>">

        <?php
        include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1><?php echo SITE_NAME; ?></h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
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

<?php http_response_code($status); ?>
