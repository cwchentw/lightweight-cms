<?php
require_once __DIR__ . "/../setting.php";
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Configuration for an installable web application.
      A part of PWA (progressive web application).  -->
<?php
if (ENABLE_PWA)
    echo "<link rel=\"manifest\" href=\"/manifest.json\">";
?>

<!-- Twitter Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"
    integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Site-specific style sheet -->
<link rel="stylesheet" href="/css/site.css">

<!-- Add more style sheets here. -->

<!-- A service worker, a JavaScript script, runs in the background
      to enrich user experiences under offline and slow network.
      A part of PWA (progressive web application). -->
<?php
if (ENABLE_PWA)
    echo "<script src=\"/register-service-worker.js\"></script>";
?>