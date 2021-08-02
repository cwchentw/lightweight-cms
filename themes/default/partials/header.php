<?php
# Header of a mdcms theme.
#
# The PHP script includes stuffs within `<head>` tags.
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#578583"/>

<!-- icon in the highest resolution we need it for -->
<link rel="icon" sizes="192x192" href="/img/<?php echo SITE_LOGO; ?>-192x192.png">

<!-- Reuse same icon for Safari -->
<link rel="apple-touch-icon" href="/img/<?php echo SITE_LOGO; ?>-192x192.png">

<?php if (!is_null(ENABLE_PWA) && ENABLE_PWA): ?>
<!-- Configuration for an installable web application. -->
<link rel="manifest" href="/manifest.json">
<?php endif; ?>

<!-- Reduce inconsistency between browsers. -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Twitter Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css"
    integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/base16/railscasts.min.css"
        integrity="sha512-niK2LUYUB+oLfsoDK9tf+0zsedmJQJ9I7K911XkFoyc3YUT6+ISap8UIn35MfMD7Untol5bhHXvTAd13CKPg3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php endif; ?>

<!-- Add more third-party style sheets here. -->

<!-- A site-specific style sheet -->
<link rel="stylesheet" href="/css/site.css">

<!-- Add more site-specific style sheets here. -->

<?php if (!is_null(ENABLE_PWA) && ENABLE_PWA): ?>
<!-- A service worker runs in the background to enrich
      user experiences under offline and slow network. -->
<script src="/register-service-worker.js"></script>
<?php endif; ?>
