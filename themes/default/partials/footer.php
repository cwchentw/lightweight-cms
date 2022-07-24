<?php
# Footer of a mdcms theme.
#
?>

<footer>
    <div class="container">
        <div class="links">
            <ul>
                <li>
                    <a href="<?php echo SITE_PREFIX . "/about/"; ?>">About</a>
                </li>
                <li>
                    <a href="<?php echo SITE_PREFIX . "/terms-and-conditions/"; ?>">Terms and Conditions</a>
                </li>
                <li>
                    <a href="<?php echo SITE_PREFIX . "/privacy-policy/"; ?>">Privacy Policy</a>
                </li>
            </ul>

            <ul>
                <?php if (!is_null(FACEBOOK) && "" != FACEBOOK): ?>
                <!-- The link to Facebook (personal account or fan page). -->
                <li><a href="https://facebook.com/<?php echo FACEBOOK; ?>"
                    target="_blank" rel="noopener nofollow">Facebook</a>
                </li>
                <?php endif; ?>

                <?php if (!is_null(FACEBOOK_GROUP) && "" != FACEBOOK_GROUP): ?>
                <!-- The link to Facebook group. -->
                <li><a href="https://facebook.com/groups/<?php echo FACEBOOK_GROUP; ?>"
                    target="_blank" rel="noopener nofollow">Facebook Group</a>
                </li>
                <?php endif; ?>

                <?php if (!is_null(TWITTER) && "" != TWITTER): ?>
                <!-- The link to Twitter. -->
                <li><a href="https://twitter.com/<?php echo TWITTER; ?>"
                    target="_blank" rel="noopener nofollow">Twitter</a>
                </li>
                <?php endif; ?>

                <?php if (!is_null(GITHUB) && "" != GITHUB): ?>
                <!-- The link to GitHub. -->
                <li><a href="https://github.com/<?php echo GITHUB; ?>"
                    target="_blank" rel="noopener nofollow">GitHub</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="text-center info-title">
            <?php if (!is_null(SITE_COPYRIGHT) && "" != SITE_COPYRIGHT): ?>
            <?php echo SITE_COPYRIGHT; ?>
            <?php else: ?>
            Powered by <a href="https://github.com/cwchentw/lightweight-cms" target="_blank" rel="noopener nofollow">Lightweight CMS</a>
            <?php endif; ?>
        </div>
    </div>
</footer>
