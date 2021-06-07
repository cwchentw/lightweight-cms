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

        <?php includePartials("header.php"); ?>
    </head>
    <body>
        <?php includePartials("navbar.php"); ?>

        <div id="top" class="container">
            <div class="text-center">
                <header>
                    <h1><?php echo $post[MDCMS_POST_TITLE]; ?></h1>
                </header>
            </div>

            <div class="row">
                <!-- TODO: Adjust it later. -->
                <div id="main-content" class="col-lg-9 col-xs-12">
                    <?php includePartials("breadcrumb.php"); ?>

                    <div class="alert alert-info" role="alert">
                        There are <?php echo $post[MDCMS_POST_WORD_COUNT]; ?> word(s) in the post.
                        It will take <?php echo ceil($post[MDCMS_POST_WORD_COUNT] / 200); ?> minute(s) to read.
                    </div>

                    <main>
                        <?php echo $post[MDCMS_POST_CONTENT]; ?>
                    </main>
                </div>

                <!-- TODO: Adjust it later. -->
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
        </div>

        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($post[MDCMS_POST_STATUS]); ?>
