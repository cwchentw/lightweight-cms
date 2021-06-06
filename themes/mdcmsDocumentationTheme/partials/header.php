<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- TODO: Test the code. -->
<?php if (ENABLE_PWA): ?>
<!-- Configuration for an installable web application. -->
<link rel="manifest" href="/manifest.json">
<?php endif; ?>

<!-- Reduce inconsistency between browsers. -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Twitter Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"
    integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php if (null != ENABLE_CODE_HIGHTLIGHT && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/railscasts.min.css"
        integrity="sha512-0UdQ2subH1uPQAASCGB83KophEAoaJd6ii3D1jKEZ8YMnP7W3dGh3Pn3Pf8P5zKvX+T8Ltp+kY0ABON0mUqP3w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php endif; ?>

<!-- Add more third-party style sheets here. -->

<!-- A site-specific style sheet -->
<link rel="stylesheet" href="/css/site.css">

<!-- Add more site-specific style sheets here. -->

<?php if (null != ENABLE_PWA && ENABLE_PWA): ?>
<!-- A service worker, a JavaScript script, runs in the background
      to enrich user experiences under offline and slow network. -->
<!-- TODO: Test the code. -->
<script src="/register-service-worker.js"></script>
<?php endif; ?>
