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

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/"><?php echo SITE_SHORT_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarSiteInfo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Site Info
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarSiteInfo">
                    <li><a class="dropdown-item" href="/about/">About the Site</a></li>
                    <li><a class="dropdown-item" href="#">Terms and Conditions</a></li>
                    <li><a class="dropdown-item" href="#">Privacy Policy</a></li>
                  </ul>
                </li>
                <?php if (hasSocialMedia()): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarMedia" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Social Media
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarMedia">
                    <?php if (!is_null(FACEBOOK) && "" != FACEBOOK): ?>
                    <!-- The link to Facebook (personal account or fan page). -->
                    <li><a class="dropdown-item"
                        href="https://facebook.com/<?php echo FACEBOOK; ?>"
                        target="_blank" rel="noopener nofollow">Facebook</a>
                    </li>
                    <?php endif; ?>

                    <?php if (!is_null(FACEBOOK_GROUP) && "" != FACEBOOK_GROUP): ?>
                    <!-- The link to Facebook group. -->
                    <li><a class="dropdown-item"
                        href="https://facebook.com/groups/<?php echo FACEBOOK_GROUP; ?>"
                        target="_blank" rel="noopener nofollow">Facebook Group</a>
                    </li>
                    <?php endif; ?>

                    <?php if (!is_null(TWITTER) && "" != TWITTER): ?>
                    <!-- The link to Twitter. -->
                    <li><a class="dropdown-item"
                        href="https://twitter.com/<?php echo TWITTER; ?>"
                        target="_blank" rel="noopener nofollow">Twitter</a>
                    </li>
                    <?php endif; ?>

                    <?php if (!is_null(GITHUB) && "" != GITHUB): ?>
                    <!-- The link to GitHub. -->
                    <li><a class="dropdown-item"
                        href="https://github.com/<?php echo GITHUB; ?>"
                        target="_blank" rel="noopener nofollow">GitHub</a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
