<?php
function hasSocialMedia()
{
    $rootDirectory = __DIR__ . "/../../..";
    # Get global setting.
    require_once $rootDirectory . "/setting.php";

    return !("" == FACEBOOK
        && "" == FACEBOOK_GROUP
        && "" == TWITTER
        && "" == GITHUB);
}
?>

<nav class="site-navbar">
    <div class="container">
        <a href="<?php echo homePage(); ?>">
            <?php echo siteShortName(); ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo SITE_PREFIX . localePrefix() . "/reference/"; ?>"><?php echo getLocalizedText("reference"); ?></a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . localePrefix() . "/howto/"; ?>"><?php echo getLocalizedText("howto"); ?></a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . localePrefix() . "/tip/"; ?>"><?php echo getLocalizedText("tip"); ?></a>
            </li>
        </ul>
    </div>
</nav>
