<?php
# The header of a Lightweight CMS theme.
#
# The PHP script includes stuffs within `<head>` tags.
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (!is_null(THEME_COLOR) && "" != THEME_COLOR): ?>
<meta name="theme-color" content="<?php echo THEME_COLOR; ?>"/>
<?php endif; ?>

<!-- icon in the highest resolution we need it for -->
<link rel="icon" sizes="192x192" href="<?php echo SITE_PREFIX; ?>/img/<?php echo SITE_LOGO; ?>-192x192.png">

<!-- Reuse same icon for Safari -->
<link rel="apple-touch-icon" href="<?php echo SITE_PREFIX; ?>/img/<?php echo SITE_LOGO; ?>-192x192.png">

<?php if (!is_null(ENABLE_PWA) && ENABLE_PWA): ?>
<!-- Configuration for an installable web application. -->
<link rel="manifest" href="<?php echo SITE_PREFIX; ?>/manifest.json">
<?php endif; ?>

<!-- Reduce inconsistency between browsers. -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Twitter Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
    integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/base16/railscasts.min.css"
    integrity="sha512-rtvj6tMmkVaWoe4mh5qd8yiYRoWna8i4A6+sowSJgkVE0WONXLmAIE750g41aHKB6k5hHmD3HFZS2fQhg3m27g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php endif; ?>

<!-- Add more third-party style sheets here. -->

<!-- A site-specific style sheet -->
<link rel="stylesheet" href="<?php echo SITE_PREFIX; ?>/css/site.css">

<!-- Add more site-specific style sheets here. -->

<?php if (!is_null(ENABLE_PWA) && ENABLE_PWA): ?>
<!-- A service worker runs in the background to enrich
      user experiences under offline and slow network. -->
<script src="<?php echo SITE_PREFIX; ?>/register-service-worker.js"></script>
<?php endif; ?>
