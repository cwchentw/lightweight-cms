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

        <div id="top" class="jumbotron">
            <div class="container">
                <header>
                    <h1 class="title">
                        <img src="/img/<?php echo SITE_LOGO; ?>-128x128.png" alt="<?php echo SITE_NAME; ?>" style="margin-right: 10px;" />

                        <span>
                            <?php echo SITE_NAME; ?>
                        </span>
                    </h1>

                    <div class="text-center subtitle"><?php echo SITE_DESCRIPTION; ?></div>
                </header>
            </div>
        </div>

        <div id="top" class="container">
            <!-- TODO: Adjust the layout. -->
            <div id="main-content">
                <?php
                # Show a fallback message if no any section and post.
                if ((!isset($sections) && !isset($posts))
                    || ((isset($sections) && 0 == count($sections))
                        && (isset($posts) && 0 == count($posts))))
                {
                    echo "<p>No content available yet.</p>";
                }
                ?>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
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
                    </div>

                    <div class="col-md-6 col-sm-12">
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
