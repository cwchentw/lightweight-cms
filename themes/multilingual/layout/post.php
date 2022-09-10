<?php
# The layout of posts of a site.
#
# This is one mandatory layout for a mdcms theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$post = $GLOBALS[LIGHTWEIGHT_CMS_POST];

$wordCount = \LightweightCMS\Plugin\wordCount($post[LIGHTWEIGHT_CMS_POST_CONTENT]);
$readTime = \LightweightCMS\Plugin\readTime($wordCount);

# Add id for each subtitle if none.
if (ENABLE_TOC) {
    $originalPost = $post[LIGHTWEIGHT_CMS_POST_CONTENT];

    $post[LIGHTWEIGHT_CMS_POST_CONTENT]
        = preg_replace_callback(
            "/<h2(?: id=\"[^\"]+\")?>(.+?)<\/h2>/",
            function ($matches) {
                $id = preg_replace("/<(.+?)>/", "", $matches[1]);
                $id = preg_replace("/[ ]+/", "-", $id);
                $id = strtolower($id);
                return "<h2 id=\"" . $id . "\">" . $matches[1] . "</h2>";
            },
            $post[LIGHTWEIGHT_CMS_POST_CONTENT]
        );

    if (strlen($originalPost) === strlen($post[LIGHTWEIGHT_CMS_POST_CONTENT])) {
        $noSubtitle = True;
    }
    
    $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
}
?>

<!DOCTYPE html>
<html lang="<?php echo siteLanguage(); ?>">
    <head>
        <?php
        if (!is_null(GOOGLE_ANALYTICS_ID) && "" != GOOGLE_ANALYTICS_ID) {
            echo "<!-- Google Analytics -->";
            echo \LightweightCMS\Plugin\googleAnalytics(GOOGLE_ANALYTICS_ID);
        }
        ?>

        <title><?php echo $post[LIGHTWEIGHT_CMS_POST_TITLE] . " | " . SITE_NAME; ?></title>
        <?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_AUTHOR, $post) && "" != $post[LIGHTWEIGHT_CMS_POST_AUTHOR]): ?>
        <meta name="author" content="<?php echo $post[LIGHTWEIGHT_CMS_POST_AUTHOR]; ?>">
        <?php endif; ?>

        <?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $post)
                  && array_key_exists(METADATA_NOINDEX, $post[LIGHTWEIGHT_CMS_POST_META])
                  && $post[LIGHTWEIGHT_CMS_POST_META][METADATA_NOINDEX]): ?>
            <!-- Some functional post doesn't benefit SEO.  -->
            <meta name="robots" content="noindex, follow">
        <?php endif; ?>

        <?php includePartials("openGraph.php"); ?>
        <?php includePartials("header.php"); ?>
        <?php includePartials("hreflang.php"); ?>
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
                                <?php echo $post[LIGHTWEIGHT_CMS_POST_TITLE]; ?>
                            </span>
                        </h1>
                    </header>

                    <div class="post-info">
                        <?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_AUTHOR, $post) && "" != $post[LIGHTWEIGHT_CMS_POST_AUTHOR]): ?>
                        <span class="author">Written by <?php echo $post[LIGHTWEIGHT_CMS_POST_AUTHOR]; ?><?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $post)): ?>.<?php endif; ?></span>
                        <?php endif; ?>

                        <?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $post)): ?>
                        <span class="last-modified-time">Last modified on <?php echo date("Y-m-d", $post[LIGHTWEIGHT_CMS_POST_MTIME]); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php includePartials("breadcrumb.php"); ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <!-- 300 wpm is the average reading speed of adults. -->
                    <div class="alert alert-info" role="alert">
                        There are <?php echo $wordCount; ?> word(s) in the post.
                        It will take <?php echo $readTime; ?> minute(s) to read.
                    </div>

                    <?php includePartials("shareButtons.php"); ?>

                    <main>
                        <?php echo $post[LIGHTWEIGHT_CMS_POST_CONTENT]; ?>
                    </main>
                </div>

                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php
                        if ($noSubtitle) {
                            includePartials("sideInfo.php");
                        }
                        else if (!is_null(ENABLE_TOC) && ENABLE_TOC) {
                            includePartials("toc.php");
                        }
                        else {
                            includePartials("sideInfo.php");
                        }
                        ?>
                    </aside>
                </div>
            </div>
        </div>

        <?php includePartials("footer.php"); ?>
        <?php includePartials("library.php"); ?>
    </body>
</html>

<?php http_response_code($post[LIGHTWEIGHT_CMS_POST_STATUS]); ?>
