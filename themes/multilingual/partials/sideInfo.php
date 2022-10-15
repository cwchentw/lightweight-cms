<div id="side-info" class="sidebar">
    <div style="font-size: 0.92em;"><?php echo siteName(); ?></div>
    <p style="font-size: 0.8em;"><?php echo siteDescription(); ?></p>
    <?php if (!is_null(FACEBOOK) && "" != FACEBOOK): ?>
    <a class="img-link"
        href="https://facebook.com/<?php echo FACEBOOK; ?>"
        target="_blank" rel="noopener nofollow">
        <img src="/img/share-buttons/facebook-32x32.png" alt="Facebook of <?php echo siteName(); ?>"/>
    </a>
    <?php endif; ?>

    <?php if (!is_null(FACEBOOK_GROUP) && "" != FACEBOOK_GROUP): ?>
    <a class="img-link"
        href="https://facebook.com/groups/<?php echo FACEBOOK_GROUP; ?>"
        target="_blank" rel="noopener nofollow">
        <img src="/img/share-buttons/facebook-32x32.png" alt="Facebook Group of <?php echo siteName(); ?>"/>
    </a>
    <?php endif; ?>

    <?php if (!is_null(TWITTER) && "" != TWITTER): ?>
    <a class="img-link"
        href="https://twitter.com/<?php echo TWITTER; ?>"
        target="_blank" rel="noopener nofollow">
        <img src="/img/share-buttons/twitter-32x32.png" alt="Twitter of <?php echo siteName()?>"/>
    </a>
    <?php endif; ?>

    <?php if (!is_null(GITHUB) && "" != GITHUB): ?>
    <a class="img-link"
        href="https://github.com/<?php echo GITHUB; ?>"
        target="_blank" rel="noopener nofollow">
        <img src="/img/share-buttons/github-32x32.png" alt="GitHub of <?php echo SITE_NAME; ?>"/>
    </a>
    <?php endif; ?>

    <a class="img-link"
        href="<?php echo SITE_BASE_URL . SITE_PREFIX . "/rss.xml"; ?>">
        <img src="/img/share-buttons/rss-32x32.png" alt="RSS Feed of <?php echo SITE_NAME; ?>"/>
    </a>

    <ul>
        <li><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>#top" class="toc-link"><?php echo getLocalizedText("backToTop"); ?></a></li>
        <?php if (homePage() != $_SERVER["REQUEST_URI"]): ?>
        <li><a href="<?php echo homePage(); ?>" class="toc-link"><?php echo getLocalizedText("backToHome"); ?></a></li>
        <?php endif; ?>
    </ul>
</div>
