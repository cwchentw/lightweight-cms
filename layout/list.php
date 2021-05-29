<?php
require_once __DIR__ . "/../setting.php";

# Receive global data here.
$section = $GLOBALS["section"];
$status = 200;
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $section["title"] ?></title>

        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1>
                <?php echo $section["title"]; ?>
            </h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php
                if (isset($section["content"]) && "" != $section["content"])
                    echo $section["content"];
            ?>

            <p>Pending a list.</p>
        </div>
        
        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($status); ?>
