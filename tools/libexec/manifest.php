<?php
# The manifest.json generator for Lightweight CMS.


$sep = DIRECTORY_SEPARATOR;
$rootDirectory = __DIR__ . $sep . ".." . $sep . "..";

# Load the site settings.
require_once $rootDirectory . $sep . "setting.php";

$image = SITE_LOGO;

# We assume a site logo is a PNG file,
#  which may be incorrect.
$imageExtension = ".png";
$imageType = "image/png";

$imagePath = "/img";  # A URI path, not a file system path.


$json = array();

$json["short_name"] = SITE_SHORT_NAME;
$json["name"] = SITE_NAME;
$json["start_url"] = "/?source=pwa";
$json["scope"] = ".";
$json["display"] = "standalone";
$json["background_color"] = THEME_COLOR;
$json["theme_color"] = THEME_COLOR;
$json["description"] = SITE_DESCRIPTION;
$json["dir"] = SCRIPT_DIRECTION;
$json["lang"] = SITE_LANGUAGE;
$json["orientation"] = SITE_ORIENTATION;

$json["icons"] = array();

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-48x48" . $imageExtension;
    $icon["sizes"] = "48x48";

    array_push($json["icons"], $icon);
}

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-64x64" . $imageExtension;
    $icon["sizes"] = "64x64";

    array_push($json["icons"], $icon);
}

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-128x128" . $imageExtension;
    $icon["sizes"] = "128x128";

    array_push($json["icons"], $icon);
}

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-192x192" . $imageExtension;
    $icon["sizes"] = "192x192";

    array_push($json["icons"], $icon);
}

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-256x256" . $imageExtension;
    $icon["sizes"] = "256x256";

    array_push($json["icons"], $icon);
}

{
    $icon = array();

    $icon["src"] = $imagePath . "/" . $image . "-512x512" . $imageExtension;
    $icon["sizes"] = "512x512";

    array_push($json["icons"], $icon);
}

$len = count($json["icons"]);
for ($i = 0; $i < $len; ++$i) {
    $json["icons"][$i]["type"] = $imageType;
    $json["icons"][$i]["purpose"] = "any maskable";
}

# Render manifest.json
header('Content-Type: application/json');
echo json_encode($json, JSON_UNESCAPED_SLASHES);
