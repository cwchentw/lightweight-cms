<?php
# Generate site settings for shell dynamically.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
require_once $rootDirectory . $sep . "setting.php";

echo "# Dynamically-generated site settings. Don't edit it" . PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo "root=" . $rootDirectory . PHP_EOL;
echo "content=" . $rootDirectory . $sep . CONTENT_DIRECTORY . PHP_EOL;
echo "theme=" . $rootDirectory . $sep . THEME_DIRECTORY . PHP_EOL;
echo "plugin=" . $rootDirectory . $sep . PLUGIN_DIRECTORY . PHP_EOL;
echo "asset=" . $rootDirectory . $sep . ASSET_DIRECTORY . PHP_EOL;
echo "src=" . $rootDirectory . $sep . LIBRARY_DIRECTORY . PHP_EOL;
echo "www=" . $rootDirectory . $sep . APPLICATION_DIRECTORY . PHP_EOL;
echo "static=" . $rootDirectory . $sep . STATIC_DIRECTORY . PHP_EOL;
echo "public=" . $rootDirectory . $sep . PUBLIC_DIRECTORY . PHP_EOL;
