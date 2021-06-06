<?php
# The layout of posts.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# Take global data.
$post = $GLOBALS[MDCMS_POST];

if (ENABLE_TOC) {
    # Add id for each subtitle.
    $post[MDCMS_POST_CONTENT]
        = preg_replace_callback(
            "/<h2>(.+)<\/h2>/",
            function ($matches) {
                $id = preg_replace("/[ ]+/", "-", $matches[1]);
                $id = strtolower($id);
                return "<h2 id=\"" . $id . "\">" . $matches[1] . "</h2>";
            },
            $post[MDCMS_POST_CONTENT]);
    $GLOBALS[MDCMS_POST] = $post;
}
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

        <div id="main-content" class="container">
            <div class="text-center">
                <h1><?php echo $post[MDCMS_POST_TITLE]; ?></h1>
            </div>

            <div class="row">
                <!-- TODO: Adjust it later. -->
                <div class="col-lg-9 col-xs-12">
                    <article>
                        <?php includePartials("breadcrumb.php"); ?>

                        <div class="alert alert-info" role="alert">
                            There are <?php echo $post[MDCMS_POST_WORD_COUNT]; ?> word(s) in the post.
                            It will take <?php echo ceil($post[MDCMS_POST_WORD_COUNT] / 200); ?> minute(s) to read.
                        </div>

                        <?php echo $post[MDCMS_POST_CONTENT]; ?>
                    </article>
                </div>

                <!-- TODO: Adjust it later. -->
                <div id="fixed-sidebar" class="col-lg-3 col-xs-12">
                    <aside>
                        <?php
                        if (ENABLE_TOC) {
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
