<?php
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
<html>
    <head>
        <title><?php echo $title ?></title>
    </head>
    <body>
        <h1><?php echo $title; ?></h1>

        <div>
            <?php echo $content; ?>
        </div>
    </body>
</html>

<?php http_response_code($status); ?>
