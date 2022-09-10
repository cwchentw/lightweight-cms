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

$uri = $_SERVER["REQUEST_URI"];
if ("/" !== substr($uri, -1))
    $uri .= "/";

if (isZhTW()) {
    $referenceURI = "/zh-tw/reference/";
    $howtoURI = "/zh-tw/howto/";
    $tipURI = "/zh-tw/tip/";
}
else if (isEnUS()) {
    $referenceURI = "/en-us/reference/";
    $howtoURI = "/en-us/howto/";
    $tipURI = "/en-us/tip/";
}
else /* Fallback to default language. */ {
    $referenceURI = "/reference/";
    $howtoURI = "/howto/";
    $tipURI = "/tip/";
}
?>

<nav class="site-navbar">
    <div class="container">
        <a href="<?php echo homePage(); ?>">
            <?php echo siteShortName(); ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo SITE_PREFIX . $referenceURI; ?>"><?php echo getLocalizedText("reference"); ?></a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . $howtoURI; ?>"><?php echo getLocalizedText("howto"); ?></a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . $tipURI; ?>"><?php echo getLocalizedText("tip"); ?></a>
            </li>
        </ul>
    </div>
</nav>
