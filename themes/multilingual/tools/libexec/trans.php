<?php

# Get the absolute path of the root path.
$sep = DIRECTORY_SEPARATOR;
$themeDirectory = __DIR__ . $sep . ".." . $sep . "..";
$rootDirectory = $themeDirectory . $sep . ".." . $sep . "..";

require_once $rootDirectory . $sep . "setting.php";

$transJSON = $themeDirectory . $sep . "trans" . $sep . strtolower(SITE_LANGUAGE) . ".json";
$fallbackJSON = $themeDirectory . $sep . "trans" . $sep . "en-us.json";

if (file_exists($transJSON)) {
    $json = json_decode(file_get_contents($transJSON), true);
}
else {
    $json = json_decode(file_get_contents($fallbackJSON), true);
}

$json["siteName"] = SITE_NAME;
$json["siteShortName"] = SITE_SHORT_NAME;
$json["siteDescription"] = SITE_DESCRIPTION;

file_put_contents(
    $transJSON,
    json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)
);
