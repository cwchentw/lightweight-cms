<?php
# The layout of the home page of a site.
#
# This is one mandatory layout for a mdcms theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$sections = $GLOBALS[MDCMS_SECTIONS];
$posts = $GLOBALS[MDCMS_POSTS];
# The HTTP status of the home page is always HTTP 200 OK.
$status = 200;
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <title><?php echo SITE_NAME; ?></title>
        <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
        <meta name="author" content="<?php echo SITE_AUTHOR; ?>">

        <?php includePartials("openGraph.php"); ?>
        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="container">

            <div class="center">
                <header>
                    <h1>
                        <img src="/img/<?php echo SITE_LOGO; ?>-64x64.png" alt="<?php echo SITE_AUTHOR; ?>" style="margin-right: 10px;" />

                        <span>
                            <?php echo SITE_NAME; ?>
                        </span>
                    </h1>
                </header>
            </div>

            <div class="row">
                <!-- TODO: Adjust the layout. -->
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php
                    if (isset($section[MDCMS_SECTION_CONTENT])
                        && "" != $section[MDCMS_SECTION_CONTENT])
                    {
                        echo $section[MDCMS_SECTION_CONTENT];
                    }
                    ?>

                    <?php
                    # Show a fallback message if no any section and post.
                    if ((!isset($sections) && !isset($posts))
                        || ((isset($sections) && 0 == count($sections))
                            && (isset($posts) && 0 == count($posts))))
                    {
                        echo "<p>No content available yet.</p>";
                    }
                    ?>

                    <?php
                    # Add post(s) if any exists.
                    if (isset($posts) && count($posts) > 0) {
                        echo "<h2>Articles</h2>";

                        foreach ($posts as $post) {
                            echo "<h3>" . $post[MDCMS_POST_TITLE] . "</h3>";

                            echo "<p>" . $post[MDCMS_POST_EXCERPT] . " ";

                            echo "<a class=\"btn btn-primary btn-sm\" "
                                . "href=\"" . $post[MDCMS_LINK_PATH] . "\">"
                                . "Read More"
                                . "</a>";

                            echo "</p>";
                        }
                    }
                    ?>

                    <?php
                    # Add section(s) if any exists.
                    if (isset($sections) && count($sections) > 0) {
                        echo "<h2>Sections</h2>";

                        foreach ($sections as $section) {
                            echo "<h3>" . $section[MDCMS_SECTION_TITLE] . "</h3>";

                            echo "<p>";

                            if ("" != $section[MDCMS_SECTION_EXCERPT]) {
                                echo $section[MDCMS_SECTION_EXCERPT];
                            }

                            echo "<a class=\"btn btn-primary btn-sm\" "
                                . "href=\"" . $section[MDCMS_LINK_PATH] ."\">"
                                . "Read More"
                                . "</a>";

                            echo "</p>";
                        }
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

<?php http_response_code($status); ?>
