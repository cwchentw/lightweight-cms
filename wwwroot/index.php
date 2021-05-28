<?php
require_once __DIR__ . '/../setting.php';

# Check whether the ?page query is set.
if (!isset($_GET["page"])) {
    $title = "Bad Request Error";
    $content = "Invalid URL";
    $status = 400;
    goto render;
}

# Get page location in the ?page query param.
$loc = filter_input(INPUT_GET, $_GET["page"], FILTER_SANITIZE_STRING);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $title = "Bad Request Error";
    $content = "Invalid URL";
    $status = 400;
    goto render;
}

# A dummu blog post.
$title = "My blog post";
$content = "Your request page is " . $_GET["page"];
$status = 200;

render:
    # pass.
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $title ?></title>

        <?php include __DIR__ . "/../partials/header.php"; ?>
    </head>
    <body>
        <div class="text-center">
            <h1>
                <?php echo $title; ?>
            </h1>
        </div>

        <div class="container">
            <?php echo $content; ?>
        </div>
        
        <?php include __DIR__ . "/../partials/footer.php" ?>
    </body>
</html>

<?php http_response_code($status); ?>
