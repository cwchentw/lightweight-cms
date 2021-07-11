<?php
# Generate site settings for batch dynamically.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
require_once $rootDirectory . $sep . "setting.php";

echo "@echo off" . PHP_EOL;
echo "rem Dynamically-generated site settings. Don't edit it" . PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo "set root=" . $rootDirectory . PHP_EOL;
echo "set content=" . $rootDirectory . $sep . CONTENT_DIRECTORY . PHP_EOL;
echo "set theme=" . $rootDirectory . $sep . THEME_DIRECTORY . $sep . SITE_THEME . PHP_EOL;
echo "set plugin=" . $rootDirectory . $sep . PLUGIN_DIRECTORY . PHP_EOL;
echo "set asset=" . $rootDirectory . $sep . ASSET_DIRECTORY . PHP_EOL;
echo "set src=" . $rootDirectory . $sep . LIBRARY_DIRECTORY . PHP_EOL;
echo "set www=" . $rootDirectory . $sep . APPLICATION_DIRECTORY . PHP_EOL;
echo "set static=" . $rootDirectory . $sep . STATIC_DIRECTORY . PHP_EOL;
echo "set public=" . $rootDirectory . $sep . PUBLIC_DIRECTORY . PHP_EOL;
