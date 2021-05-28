<?php
require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/utils.php";

# Remove it later.
goto temp;

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

# Remove it later.
temp:

# Change it later.
$arr = parsePage("/c-programming/hello-world/");
$mdpath = getPath($arr, MARKDOWN_FILE_EXTENSION);
$raw_content = fetchContent($arr);

# TODO: Read a title from a post.
$title = "My blog post";
if (file_exists($mdpath)) {
    $parser = new Parsedown();
    $content = $parser->text($raw_content);
}
else {
    $content = $raw_content;
}

$status = 200;

render:
    # pass.
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $title ?></title>

        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1>
                <?php echo $title; ?>
            </h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php echo $content; ?>
        </div>
        
        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($status); ?>
