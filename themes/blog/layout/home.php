<?php
# The layout of the home page of a site.
#
# This is one mandatory layout for a Lightweight CMS theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$sections = $GLOBALS[LIGHTWEIGHT_CMS_SECTIONS];
# Pages are the web pages under a home page.
$pages = \LightweightCMS\Core\getPosts(SITE_PREFIX . "/");
# Posts are all the web pages except those under a home page.
$posts = $GLOBALS[LIGHTWEIGHT_CMS_POSTS];
usort($posts, $GLOBALS[SORT_POST_CALLBACK]);
preg_match("/^\/(\d+)\/$/", $_SERVER["REQUEST_URI"], $matches);
if (!is_null($matches)) {
    $currentPageCount = $matches[1];
}
else {
    $currentPageCount = 0;
}
usort($posts, $GLOBALS[SORT_POST_CALLBACK]);
if (POST_PER_PAGE > 0) {
    $currentPosts = array();

    $c = 0;
    while (count($posts) > 0) {
        if ($c < $currentPageCount * POST_PER_PAGE) {
            # Discard a post.
            array_pop($posts);
            ++$c;
            continue;
        }
        else if ($c >= ($currentPageCount + 1) * POST_PER_PAGE) {
            break;
        }

        $p = array_pop($posts);
        array_push($currentPosts, $p);
        ++$c;
    }
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
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-9">
                    <?php
                    # Add post(s) if any exists.

                    # Posts in a page of a series of pages.
                    if (POST_PER_PAGE > 0) {
                        if (isset($currentPosts) && count($currentPosts) > 0) {
                            foreach ($currentPosts as $post) {
                                echo "<article>";
                                echo "<span class='article-title'>" . $post[LIGHTWEIGHT_CMS_POST_TITLE] . "</span>";

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
                            foreach ($posts as $post) {
                                echo "<article>";
                                echo "<span class='article-title'>" . $post[LIGHTWEIGHT_CMS_POST_TITLE] . "</span>";

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
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <?php includePartials("pageSideBar.php"); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php includePartials("footer.php"); ?>
        <?php includePartials("library.php"); ?>
    </body>
</html>

<?php http_response_code($status); ?>
