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
        <a href="<?php echo SITE_PREFIX . "/"; ?>">
            <?php echo SITE_SHORT_NAME; ?>
        </a>
        <ul>
            <li>
                <a href="<?php echo SITE_PREFIX . "/reference/" ?>">Reference</a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . "/howto/" ?>">HOWTOs</a>
            </li>
            <li>
                <a href="<?php echo SITE_PREFIX . "/tip/" ?>">Tips</a>
            </li>
        </ul>
    </div>
</nav>
