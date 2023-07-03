<?php
# The layout of posts of a site.
#
# This is one mandatory layout for a Lightweight CMS theme.

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
        $noSubtitle = TRUE;
    }
    else {
        $noSubtitle = FALSE;
    }

    $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
}

$uri = $_SERVER["REQUEST_URI"];
if ("/" !== substr($uri, -1))
    $uri .= "/";

if (array_key_exists(LIGHTWEIGHT_CMS_POST_AUTHOR, $post)) {
    if (isZhTW()) {
        $writtenBy = "由 " . $post[LIGHTWEIGHT_CMS_POST_AUTHOR] . " 撰寫";
    }
    else if (isEnUS()) {
        $writtenBy = "Written by " . $post[LIGHTWEIGHT_CMS_POST_AUTHOR];
    }
    else /* Fallback to default language. */ {
        $writtenBy = "Written by " . $post[LIGHTWEIGHT_CMS_POST_AUTHOR];
    }
}

if (isZhTW()) {
    $period = "。";
}
else if (isEnUS()) {
    $period = ". ";
}
else /* Fallback to default language. */ {
    $period = ". ";
}

if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $post)) {
    if (isZhTW()) {
        $lastModifiedOn = "最後修改於西元 " . date("Y", $post[LIGHTWEIGHT_CMS_POST_MTIME]) . " 年 "
                                           . date("m", $post[LIGHTWEIGHT_CMS_POST_MTIME]) . " 月 "
                                           . date("d", $post[LIGHTWEIGHT_CMS_POST_MTIME]) . " 日";
    }
    else if (isEnUS()) {
        $lastModifiedOn = "Last modified on " . date("Y-m-d", $post[LIGHTWEIGHT_CMS_POST_MTIME]);
    }
    else /* Fallback to default language. */ {
        $lastModifiedOn = "Last modified on " . date("Y-m-d", $post[LIGHTWEIGHT_CMS_POST_MTIME]);
    }
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
                  && array_key_exists("description", $post[LIGHTWEIGHT_CMS_POST_META])): ?>
        <meta name="description" content="<?php echo $post[LIGHTWEIGHT_CMS_POST_META]["description"]; ?>">
        <?php else: ?>
        <meta name="description" content="<?php echo \LightweightCMS\Plugin\excerpt($post[LIGHTWEIGHT_CMS_POST_CONTENT]); ?>">
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
<?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_AUTHOR, $post) && "" != $post[LIGHTWEIGHT_CMS_POST_AUTHOR]): ?><!-- Trick to prevent an extra space. -->
<span class="author"><?php echo $writtenBy; ?><?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $post)): ?><?php echo $period; ?><?php endif; ?></span><?php endif; ?><?php if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $post)): ?><span class="last-modified-time"><?php echo $lastModifiedOn; ?></span><?php endif; ?>
                    </div>

                    <?php includePartials("breadcrumb.php"); ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php if (!isZhTW()): ?>
                    <!-- 300 wpm is the average reading speed of adults. -->
                    <div class="alert alert-info" role="alert">
                        There are <?php echo $wordCount; ?> word(s) in the post.
                        It will take <?php echo $readTime; ?> minute(s) to read.
                    </div>
                    <?php endif; ?>

                    <?php includePartials("tags.php"); ?>
                    <?php includePartials("shareButtons.php"); ?>

                    <main>
                        <?php
                        try {
                            eval($post[LIGHTWEIGHT_CMS_POST_CONTENT]);

                            # HTTP 200 OK.
                            http_response_code(200);
                        }
                        catch (Exception $e) {
                            $post = \LightweightCMS\Core\errorPage(
                                "Internal Server Error",
                                "Unable to run the page",
                                500
                            );

                            # Create a breadcrumb dynamically.
                            $breadcrumb = \LightweightCMS\Core\errorPageBreadcrumb("Internal Server Error");

                            $GLOBALS[LIGHTWEIGHT_CMS_POST] = $post;
                            $GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB] = $breadcrumb;

                            loadPost();
                        }
                        ?>
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
