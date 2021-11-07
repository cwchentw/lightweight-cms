<?php
# Loader of Google Analytics plugin.


$sep = DIRECTORY_SEPARATOR;
$sourceDirectory = __DIR__ . $sep . "src";
$prefixDirectory = $sourceDirectory . $sep . "mdcms" . $sep . "Plugin";
require_once $prefixDirectory . $sep . "googleAnalytics.php";
