<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/autoload.php";

# Receive global data here.
$section = $GLOBALS[MDCMS_SECTION];
?>


<!DOCTYPE html>
<html lang="<?php echo SITE_LANGUAGE ?>">
    <head>
        <title><?php echo $section[MDCMS_SECTION_TITLE] ?></title>

        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/header.php";
        ?>
    </head>
    <body>
        <div class="text-center">
            <h1><?php echo $section[MDCMS_SECTION_TITLE]; ?></h1>
        </div>

        <!-- If you want to create multi-column pages,
               modify your layout here. -->
        <div class="container">
            <?php
                if (isset($section[MDCMS_SECTION_CONTENT])
                    && "" != $section[MDCMS_SECTION_CONTENT])
                    echo $section[MDCMS_SECTION_CONTENT];
            ?>

            <p>Pending a list.</p>
        </div>
        
        <?php
            include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/footer.php";
        ?>
    </body>
</html>

<?php http_response_code($section[MDCMS_SECTION_STATUS]); ?>
