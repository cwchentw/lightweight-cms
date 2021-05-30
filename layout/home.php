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

        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div class="text-center">
            <h1><?php echo SITE_NAME; ?></h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php includePartials("breadcrumb.php"); ?>

            <h2>Synopsis</h2>

            <p><?php echo SITE_DESCRIPTION ?></p>

            <?php
            # Add section(s) if any exists.
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
        </div>
        
        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($status); ?>
