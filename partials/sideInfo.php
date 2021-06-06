<div id="table-of-contents">
    <div style="font-size: 0.92em;"><?php echo SITE_NAME; ?></div>
    <p style="font-size: 0.8em;"><?php echo SITE_DESCRIPTION; ?></p>
    <ul>
        <li><a href="<?php echo $_SERVER["REQUEST_URI"]; ?>#main-content">Back to Top</a></li>
        <?php if ("/" != $_SERVER["REQUEST_URI"]): ?>
        <li><a href="/">Back to Home</a></li>
        <?php endif; ?>
    </ul>
</div>