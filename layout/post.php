<?php
# The layout of posts.
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";


# Take global data.
$post = $GLOBALS[MDCMS_POST];
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $post[MDCMS_POST_TITLE] ?></title>
        <meta name="author" content="<?php echo SITE_AUTHOR ?>">

        <?php includePartials("header.php"); ?>

        <!-- highlight.js CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/railscasts.min.css"
            integrity="sha512-0UdQ2subH1uPQAASCGB83KophEAoaJd6ii3D1jKEZ8YMnP7W3dGh3Pn3Pf8P5zKvX+T8Ltp+kY0ABON0mUqP3w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            <?php echo $post[MDCMS_POST_CONTENT]; ?>
        </div>

        <?php includePartials("footer.php"); ?>

        <!-- highlight.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"
            integrity="sha512-s+tOYYcC3Jybgr9mVsdAxsRYlGNq4mlAurOrfNuGMQ/SCofNPu92tjE7YRZCsdEtWL1yGkqk15fU/ark206YTg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>hljs.highlightAll();</script>
    </body>
</html>

<?php http_response_code($post[MDCMS_POST_STATUS]); ?>
