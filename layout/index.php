<?php
require_once __DIR__ . "/../setting.php";

$sections = $GLOBALS["sections"];
$status = 200;
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo SITE_NAME; ?></title>

        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1>
                <?php echo SITE_NAME; ?>
            </h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <h2>Sections</h2>
            <ul>
                <?php
                    foreach ($sections as $section)
                        echo "<li><a href=\"/" . $section["path"] . "/\">"
                            . $section["title"] . "</a></li>";
                ?>
            </ul>

            <h2>Pages</h2>
            <p>Pending.</p>
        </div>
        
        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($status); ?>
