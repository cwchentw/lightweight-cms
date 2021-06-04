<?php
# The layout of the header of a site.
require_once __DIR__ . "/../setting.php";
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Configuration for an installable web application. -->
<!-- TODO: Test the code. -->
<?php if (ENABLE_PWA): ?>
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

<!-- highlight.js CSS -->
<!-- TODO: Test the code. -->
<?php if (ENABLE_CODE_HIGHTLIGHT): ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/railscasts.min.css"
        integrity="sha512-0UdQ2subH1uPQAASCGB83KophEAoaJd6ii3D1jKEZ8YMnP7W3dGh3Pn3Pf8P5zKvX+T8Ltp+kY0ABON0mUqP3w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php endif; ?>

<!-- Add more style sheets here. -->

<!-- Site-specific style sheet -->
<link rel="stylesheet" href="/css/site.css">

<!-- A service worker, a JavaScript script, runs in the background
      to enrich user experiences under offline and slow network. -->
<!-- TODO: Test the code. -->
<?php if (ENABLE_PWA): ?>
<script src="/register-service-worker.js"></script>
<?php endif; ?>
