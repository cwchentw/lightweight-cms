<?php
require_once __DIR__ . '/../setting.php';
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/utils.php";

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
    
# Fetch local content.
$arr = parsePage("/c-programming/hello-world/");
$content = fetchContent($arr);

# Display raw content.
# TODO: Change it later.
$title = "My blog post";
$content = "Your request path is " . $_GET["page"] . "\n"
    . "Your request content is:" . "\n". "<pre>" . $content . "</pre>";
$status = 200;

render:
    # pass.
?>

<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $title ?></title>

        <?php
            # TODO: Refactor it later.
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
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
        
        <?php
            # TODO: Refactor it later.
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php"
        ?>
    </body>
</html>

<?php http_response_code($status); ?>
