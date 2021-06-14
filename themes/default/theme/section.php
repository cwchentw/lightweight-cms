<?php
# The layout of sections of a site.
#
# Top sections and subsections are indistinguishable in this theme.
# This is one mandatory layout for a mdcms theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$section = $GLOBALS[MDCMS_SECTION];
$sections = $GLOBALS[MDCMS_SECTIONS];
$posts = $GLOBALS[MDCMS_POSTS];
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

        <div id="top" class="jumbotron">
            <div class="container">
                <header>
                    <h1>
                        <img src="/img/logo-64x64.png" alt="<?php echo SITE_AUTHOR; ?>" style="margin-right: 10px;" />

                        <span>
                            <?php echo $section[MDCMS_SECTION_TITLE]; ?>
                        </span>
                    </h1>
                </header>

                <?php includePartials("breadcrumb.php"); ?>
            </div>
        </div>

        <div id="top" class="container">
            <div class="row">
                <!-- TODO: Adjust the layout. -->
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php
                    # Show an optional section content if it exists.
                    if (isset($section[MDCMS_SECTION_CONTENT])
                        && "" != $section[MDCMS_SECTION_CONTENT])
                    {
                        echo $section[MDCMS_SECTION_CONTENT];
                    }
                    ?>

                    <?php
                    # Show a fallback message if no any subsection and post.
                    if ((!isset($sections) && !isset($posts))
                        || ((isset($sections) && 0 == count($sections))
                            && (isset($posts) && 0 == count($posts))))
                    {
                        echo "<p>No content available yet.</p>";
                    }
                    ?>

                    <?php
                    # Add page(s) if any exists.
                    if (isset($posts) && count($posts) > 0) {
                        echo "<h2>Articles</h2>";

                        foreach ($posts as $post) {
                            echo "<article style=\"margin-bottom: 30pt;\">";
                                echo "<h3>" . $post[MDCMS_POST_TITLE] . "</h3>";

                                echo "<p>" . $post[MDCMS_POST_EXCERPT] . " ";
                                    echo "<a class=\"btn btn-primary btn-sm\" "
                                        . "href=\"" . $post[MDCMS_LINK_PATH] . "\">"
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

                <!-- TODO: Adjust the layout. -->
                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php includePartials("sideInfo.php"); ?>
                    </aside>
                </div>
            </div>

            <?php includePartials("copyright.php"); ?>
        </div>

        <!-- Currently, there is no footer in this theme.
              Our footer is merely for script loading.
              We may change it later. -->
        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
