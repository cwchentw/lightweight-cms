<?php
# The layout of the home page of a site.
#
# This is one mandatory layout for a Lightweight CMS theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$sections = $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS];
$posts = $GLOBALS[LIGHTWEIGHT_CMS_POSTS];
if (POST_PER_PAGE > 0) {
    $postsPerPage = $GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE];
}
# The HTTP status of the home page is always HTTP 200 OK.
$status = 200;
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <?php
        if (!is_null(GOOGLE_ANALYTICS_ID) && "" != GOOGLE_ANALYTICS_ID) {
            echo "<!-- Google Analytics -->";
            echo \LightweightCMS\Plugin\googleAnalytics(GOOGLE_ANALYTICS_ID);
        }
        ?>

        <title><?php echo strip_tags(SITE_NAME); ?></title>
        <meta name="description" content="<?php echo strip_tags(SITE_DESCRIPTION); ?>">
        <meta name="author" content="<?php echo strip_tags(SITE_AUTHOR); ?>">

        <?php includePartials("openGraph.php"); ?>
        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="jumbotron">
            <div class="container">
                <header>
                    <div>
                        <h1 class="title">
                            <img class="d-none d-md-block" src="/img/<?php echo SITE_LOGO; ?>-128x128.png" alt="<?php echo SITE_NAME; ?>" style="margin-right: 10px;" />

                            <span>
                                <?php echo SITE_NAME; ?>
                            </span>
                        </h1>

                        <div class="text-center subtitle"><?php echo SITE_DESCRIPTION; ?></div>
                    </div>
                </header>
            </div>
        </div>

        <div id="top" class="container">
            <div id="main-content">
                <?php
                # Show home content if it is not empty.
                $homeContent = \LightweightCMS\Core\getHomeContent();
                if ("" != $homeContent) {
                    echo $homeContent;
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

                # Posts in a page of a series of pages.
                if (POST_PER_PAGE > 0) {
                    if (isset($postsPerPage) && count($postsPerPage) > 0) {
                        echo "<h2 id=\"introduction\">Articles</h2>";

                        foreach ($postsPerPage as $post) {
                            echo "<article>";
                            echo "<h3>" . $post[LIGHTWEIGHT_CMS_POST_TITLE] . "</h3>";

                            if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $post)
                                && array_key_exists("description", $post[LIGHTWEIGHT_CMS_POST_META]))
                            {
                                echo "<p>" . $post[LIGHTWEIGHT_CMS_POST_META]["description"] . " ";
                            }
                            else {
                                echo "<p>" . \LightweightCMS\Plugin\excerpt($post[LIGHTWEIGHT_CMS_POST_CONTENT]) . " ";
                            }

                            echo "<a class=\"btn btn-primary btn-sm\" "
                                . "href=\"" . $post[LIGHTWEIGHT_CMS_LINK_PATH] . "\">"
                                . "Read More"
                                . "</a>";

                            echo "</p>";
                            echo "</article>";
                        }
                    }

                    includePartials("pagination.php");
                }
                # All posts.
                else {
                    if (isset($posts) && count($posts) > 0) {
                        echo "<h2 id=\"introduction\">Articles</h2>";

                        foreach ($posts as $post) {
                            echo "<article>";
                            echo "<h3>" . $post[LIGHTWEIGHT_CMS_POST_TITLE] . "</h3>";

                            if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $post)
                                && array_key_exists("description", $post[LIGHTWEIGHT_CMS_POST_META]))
                            {
                                echo "<p>" . $post[LIGHTWEIGHT_CMS_POST_META]["description"] . " ";
                            }
                            else {
                                echo "<p>" . \LightweightCMS\Plugin\excerpt($post[LIGHTWEIGHT_CMS_POST_CONTENT]) . " ";
                            }

                            echo "<a class=\"btn btn-primary btn-sm\" "
                                . "href=\"" . $post[LIGHTWEIGHT_CMS_LINK_PATH] . "\">"
                                . "Read More"
                                . "</a>";

                            echo "</p>";
                            echo "</article>";
                        }
                    }
                }
                ?>

                <?php
                # Add section(s) if any exists.
                if (isset($sections) && count($sections) > 0) {
                    echo "<div class=\"sections\">";  # Directive for the region of the sections.
                    foreach ($sections as $section) {
                        echo "<div class=\"section-block\">";  # Directive for a section.
                        echo "<h2>" . $section[LIGHTWEIGHT_CMS_SECTION_TITLE] . "</h2>";  # Section title.

                        echo "<p>";  # The descriptive text of a section.

                        $sectionExcerpt = \LightweightCMS\Plugin\excerpt($section[LIGHTWEIGHT_CMS_SECTION_CONTENT]);
                        if ("" != $sectionExcerpt) {
                            echo $sectionExcerpt;
                        }

                        echo "<a class=\"btn btn-primary btn-sm\" "
                            . "href=\"" . $section[LIGHTWEIGHT_CMS_LINK_PATH] ."\">"
                            . "Explore More"
                            . "</a>";

                        echo "</p>";  # End of the descriptive text of a section.
                        echo "</div>";  # End of a section.
                    }
                    echo "</div>";  # End of the region of the sections.
                }
                ?>
                </div>
            </div>
        </div>

        <?php includePartials("footer.php"); ?>
        <?php includePartials("library.php"); ?>
    </body>
</html>

<?php http_response_code($status); ?>
