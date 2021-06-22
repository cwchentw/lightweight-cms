<?php
# The layout of posts of a site.
#
# This is one mandatory layout for a mdcms theme.

# Require a private utility script.
require_once __DIR__ . "/../src/utils.php";


# Take global data.
$post = $GLOBALS[MDCMS_POST];
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE; ?>">
    <head>
        <title><?php echo $post[MDCMS_POST_TITLE] . " | " . SITE_NAME; ?></title>
        <meta name="author" content="<?php echo SITE_AUTHOR; ?>">

        <?php includePartials("openGraph.php"); ?>
        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="jumbotron">
            <div class="container">
                <header>
                    <h1>
                        <img src="/img/<?php echo SITE_LOGO; ?>-64x64.png" alt="<?php echo SITE_AUTHOR; ?>" style="margin-right: 10px;" />

                        <span>
                            <?php echo $post[MDCMS_POST_TITLE]; ?>
                        </span>
                    </h1>
                </header>

                <?php includePartials("breadcrumb.php"); ?>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- TODO: Adjust the layout. -->
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php if (array_key_exists(MDCMS_POST_AUTHOR, $post) && "" != $post[MDCMS_POST_AUTHOR]): ?>
                    <div class="alert alert-primary" role="alert">
                        Author of this post is <?php echo $post[MDCMS_POST_AUTHOR]; ?>.
                    </div>
                    <?php endif; ?>

                    <?php if (array_key_exists(MDCMS_POST_MTIME, $post)): ?>
                    <div class="alert alert-secondary" role="alert">
                        Last modified date is <?php echo date("Y-m-d", $post[MDCMS_POST_MTIME]); ?>.
                    </div>
                    <?php endif; ?>

                    <!-- 300 wpm is the average reading speed of adults. -->
                    <div class="alert alert-info" role="alert">
                        There are <?php echo $post[MDCMS_POST_WORD_COUNT]; ?> word(s) in the post.
                        It will take <?php echo ceil($post[MDCMS_POST_WORD_COUNT] / 300); ?> minute(s) to read.
                    </div>

                    <?php includePartials("shareButtons.php"); ?>

                    <main>
                        <?php echo $post[MDCMS_POST_CONTENT]; ?>
                    </main>                    
                </div>

                <!-- TODO: Adjust the layout. -->
                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php
                        if (!is_null(ENABLE_TOC) && ENABLE_TOC) {
                            includePartials("toc.php");
                        }
                        else {
                            includePartials("sideInfo.php");
                        }
                        ?>
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

<?php http_response_code($post[MDCMS_POST_STATUS]); ?>
