<div id="table-of-contents">
    <div style="font-size: 0.92em;"><?php echo SITE_NAME; ?></div>
    <p style="font-size: 0.8em;"><?php echo SITE_DESCRIPTION; ?></p>
    <a class="dropdown-item"
        href="https://github.com/cwchentw/mdcms"
        target="_blank" rel="noopener nofollow">
        <img src="/img/share-buttons/github-32x32.png" alt="The GitHub of mdcms"/>
    </a>

    <ul>
        <li><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>#main-content">Back to Top</a></li>
        <?php if ("/" != $_SERVER["REQUEST_URI"]): ?>
        <li><a href="/">Back to Home</a></li>
        <?php endif; ?>
    </ul>
</div>