<?php
# The layout of sections of a site.
#
# This is one mandatory layout for a mdcms theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$section = $GLOBALS[MDCMS_SECTION];
$sections = $GLOBALS[MDCMS_SECTIONS];
$pages = $GLOBALS[MDCMS_POSTS];
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <title><?php echo $section[MDCMS_SECTION_TITLE] . " | " . SITE_NAME; ?></title>
        <meta name="author" content="<?php echo SITE_AUTHOR; ?>">

        <?php if (BLOCK_BOT_ON_SECTION): ?>
        <!-- Most section pages merely work as intermediate documents
              to posts. They seldom benefit SEO. You may safely block
              sections from crawlings of search engine bots.  -->
        <meta name="robots" content="noindex, follow">
        <?php endif; ?>

        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="container">
            <div class="text-center">
                <h1><?php echo $section[MDCMS_SECTION_TITLE]; ?></h1>
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
                    # Add page(s) if any exists.
                    if (isset($pages) && count($pages) > 0) {
                        echo "<h2>Articles</h2>";

                        foreach ($pages as $page) {
                            echo "<article style=\"margin-bottom: 30pt;\">";
                                echo "<h3>" . $page[MDCMS_POST_TITLE] . "</h3>";

                                echo "<p>" . $page[MDCMS_POST_EXCERPT] . " ";
                                    echo "<a class=\"btn btn-primary btn-sm\" "
                                        . "href=\"" . $page[MDCMS_LINK_PATH] . "\">"
                                        . "Read More"
                                        . "</a>";
                                echo "</p>";
                            echo "</article>";
                        }
                    }
                    ?>

                    <?php
                    # Add section(s) if any exists.
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

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
