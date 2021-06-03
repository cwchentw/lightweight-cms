<?php
# The layout of posts.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


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

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <div class="text-center">
                <h1><?php echo $post[MDCMS_POST_TITLE]; ?></h1>
            </div>

            <?php includePartials("breadcrumb.php"); ?>

            <div class="alert alert-info" role="alert">
                There are <?php echo $post[MDCMS_POST_WORD_COUNT]; ?> words in the post.
                It will take <?php echo ceil($post[MDCMS_POST_WORD_COUNT] / 200); ?> minutes to read.
            </div>

            <?php echo $post[MDCMS_POST_CONTENT]; ?>
        </div>

        <?php includePartials("footer.php"); ?>
    </body>
</html>

<?php http_response_code($post[MDCMS_POST_STATUS]); ?>
