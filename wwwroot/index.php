<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/utils.php";

# Check whether the ?page query is set.
if (!isset($_GET["page"])) {
    $title = "Bad Request Error";
    $content = "Invalid URL";
    $status = 400;
    goto render;
}

# Get page location in the ?page query param.
$loc = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $title = "Bad Request Error";
    $content = "Invalid URL";
    $status = 400;
    goto render;
}

$arr = parsePage($loc);
$mdpath = getPath($arr, MARKDOWN_FILE_EXTENSION);
$result = fetchContent($arr);

# Get the post title.
if ("" != $result["title"])
    $title = $result["title"];
else
    $title = "My Blog Post";

# Get the post content with its title removed.
if (file_exists($mdpath)) {
    $parser = new Parsedown();
    $content = $parser->text($result["content"]);
}
else {
    $content = $result["content"];
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
