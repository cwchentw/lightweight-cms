<?php
# Site configuration reader for shell utilities.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";
# Load global settings.
require_once $rootDirectory . $sep . "setting.php";


$config = $argv[1];

if (is_null($config)) {
    file_put_contents(STDERR, 'No configuration', FILE_APPEND);
    exit(1);
}

echo constant($config) . PHP_EOL;