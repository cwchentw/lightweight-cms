<?php
# The layout of a home page.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# Take global data.
$sections = $GLOBALS[MDCMS_SECTIONS];
$pages = $GLOBALS[MDCMS_PAGES];
$status = 200;  # HTTP 200 OK.
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
            # TODO: Check it later.
            if (isset($sections) && count($sections) > 0) {
                echo "<h2>Sections</h2>";

                echo "<div class=\"list-group\">";

                foreach ($sections as $section)
                    echo "<a class=\"list-group-item\" href=\"" . $section[MDCMS_LINK_PATH] ."\">"
                        . $section[MDCMS_LINK_TITLE] . "</a>";

                echo "</div>";
            }
            ?>

            <?php
            # Add page(s) if any exist.
            # TODO: Check it later.
            if (isset($pages) && count($pages) > 0) {
                echo "<h2>Pages</h2>";

                echo "<div class=\"list-group\">";

                foreach ($pages as $page)
                    echo "<a class=\"list-group-item\" href=\"" . $page[MDCMS_LINK_PATH] . "\">"
                        . $page[MDCMS_LINK_TITLE] . "</a>";

                echo "</div>";
            }
            ?>
        </div>
        
        <?php
        include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($status); ?>
