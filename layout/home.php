<?php
# The layout of the home page of a site.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# Take global data.
$sections = $GLOBALS[MDCMS_SECTIONS];
$pages = $GLOBALS[MDCMS_POSTS];
$status = 200;  # HTTP 200 OK.
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <title><?php echo SITE_NAME; ?></title>
        <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
        <meta name="author" content="<?php echo SITE_AUTHOR; ?>">

        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="container">
            <div class="text-center">
                <h1><?php echo SITE_NAME; ?></h1>
            </div>

            <div class="row">
                <!-- TODO: Adjust it later. -->
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php includePartials("breadcrumb.php"); ?>

                    <?php
                    if (isset($section[MDCMS_SECTION_CONTENT])
                        && "" != $section[MDCMS_SECTION_CONTENT])
                    {
                        echo $section[MDCMS_SECTION_CONTENT];
                    }
                    ?>

                    <?php
                    # Add section(s) if any exists.
                    # TODO: Check it later.
                    if (isset($sections) && count($sections) > 0) {
                        echo "<h2>Sections</h2>";

                        echo "<div class=\"list-group\" style=\"margin-bottom: 30pt;\">";

                        foreach ($sections as $section) {
                            echo "<a class=\"list-group-item\" "
                                . "href=\"" . $section[MDCMS_LINK_PATH] ."\">"
                                . $section[MDCMS_LINK_TITLE]
                                . "</a>";
                        }

                        echo "</div>";
                    }
                    ?>

                    <?php
                    # Add page(s) if any exists.
                    if (isset($pages) && count($pages) > 0) {
                        echo "<h2>Articles</h2>";

                        foreach ($pages as $page) {
                            echo "<h3>" . $page[MDCMS_POST_TITLE] . "</h3>";

                            echo "<p>" . $page[MDCMS_POST_EXCERPT] . " ";

                            echo "<a class=\"btn btn-primary btn-sm\" "
                                . "href=\"" . $page[MDCMS_LINK_PATH] . "\">"
                                . "Read More"
                                . "</a>";

                            echo "</p>";
                        }
                    }
                    ?>
                </div>

                <!-- TODO: Adjust it later. -->
                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php includePartials("sideInfo.php"); ?>
                    </aside>
                </div>
            </div>
        </div>
        
        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($status); ?>
