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
if (POST_PER_PAGE > 0) {
    $postsPerPage = $GLOBALS[MDCMS_POST_PER_PAGE];
}
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <?php
        if ("" != GOOGLE_ANALYTICS_ID) {
            echo "<!-- Google Analytics -->";
            echo \LightweightCMS\Plugin\googleAnalytics(GOOGLE_ANALYTICS_ID);
        }
        ?>

        <title><?php echo $section[MDCMS_SECTION_TITLE] . " | " . SITE_NAME; ?></title>
        <meta name="author" content="<?php echo $section[MDCMS_SECTION_AUTHOR]; ?>">

        <?php if (BLOCK_BOT_ON_SECTION): ?>
        <!-- Most section pages merely work as intermediate documents
              to posts. They seldom benefit SEO. You may safely block
              sections from crawlings of search engine bots.  -->
        <meta name="robots" content="noindex, follow">
        <?php endif; ?>

        <?php includePartials("openGraph.php"); ?>
        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="jumbotron">
            <div class="container">
                <div>
                    <header>
                        <h1>
                            <img class="d-none d-md-block" src="/img/<?php echo SITE_LOGO; ?>-64x64.png" alt="<?php echo SITE_AUTHOR; ?>" style="margin-right: 10px;" />

                            <span>
                                <?php echo $section[MDCMS_SECTION_TITLE]; ?>
                            </span>
                        </h1>
                    </header>

                    <div class="post-info">
                        <?php if (array_key_exists(MDCMS_SECTION_AUTHOR, $section) && "" != $section[MDCMS_SECTION_AUTHOR]): ?>
                        <span class="author">Written by <?php echo $section[MDCMS_SECTION_AUTHOR]; ?>.</span>
                        <?php endif; ?>

                        <?php if (array_key_exists(MDCMS_SECTION_MTIME, $section)): ?>
                        <span class="last-modified-time">Last modified on <?php echo date("Y-m-d", $section[MDCMS_SECTION_MTIME]); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php includePartials("breadcrumb.php"); ?>
                </div>
            </div>
        </div>

        <div id="top" class="container">
            <div class="row">
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

                    # Posts in a page of a series of pages.
                    if (POST_PER_PAGE > 0) {
                        if (isset($postsPerPage) && count($postsPerPage) > 0) {
                            echo "<h2>Articles</h2>";

                            foreach ($postsPerPage as $post) {
                                echo "<article>";
                                echo "<h3>" . $post[MDCMS_POST_TITLE] . "</h3>";

                                if (!is_null($post[MDCMS_POST_META])
                                    && array_key_exists("description", $post[MDCMS_POST_META]))
                                {
                                    echo "<p>" . $post[MDCMS_POST_META]["description"] . " ";
                                }
                                else {
                                    echo "<p>" . \LightweightCMS\Plugin\excerpt($post[MDCMS_POST_CONTENT]) . " ";
                                }

                                echo "<a class=\"btn btn-primary btn-sm\" "
                                    . "href=\"" . $post[MDCMS_LINK_PATH] . "\">"
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
                            echo "<h2>Articles</h2>";

                            foreach ($posts as $post) {
                                echo "<article>";
                                echo "<h3>" . $post[MDCMS_POST_TITLE] . "</h3>";

                                if (!is_null($post[MDCMS_POST_META])
                                    && array_key_exists("description", $post[MDCMS_POST_META]))
                                {
                                    echo "<p>" . $post[MDCMS_POST_META]["description"] . " ";
                                }
                                else {
                                    echo "<p>" . \LightweightCMS\Plugin\excerpt($post[MDCMS_POST_CONTENT]) . " ";
                                }

                                echo "<a class=\"btn btn-primary btn-sm\" "
                                    . "href=\"" . $post[MDCMS_LINK_PATH] . "\">"
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
                        echo "<h2>Sections</h2>";

                        foreach ($sections as $section) {
                            echo "<h3>" . $section[MDCMS_SECTION_TITLE] . "</h3>";

                            echo "<p>";

                            $sectionExcerpt = \LightweightCMS\Plugin\excerpt($section[MDCMS_SECTION_CONTENT]);
                            if ("" != $sectionExcerpt) {
                                echo $sectionExcerpt;
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

                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php includePartials("sideInfo.php"); ?>
                    </aside>
                </div>
            </div>
        </div>

        <?php includePartials("footer.php"); ?>
        <?php includePartials("library.php"); ?>
    </body>
</html>

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
