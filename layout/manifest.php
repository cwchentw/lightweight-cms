<?php
# The manifest.json generator of mdcms.
require_once __DIR__ . "/../setting.php";


/* Adjust these parameters as needed. */
$backgroundColor = "#6C757D";
$themeColor = "#6C757D";
/* The text of some languages displays right-to-left. */
$languageDirection = "ltr";
$image = "logo";
$imageExtension = ".png";
$imageType = "image/png";
$imagePath = "/img";


$json = array();

$json["short_name"] = SITE_SHORT_NAME;
$json["name"] = SITE_NAME;
$json["start_url"] = "/?source=pwa";
$json["scope"] = ".";
$json["display"] = "standalone";
$json["background_color"] = $backgroundColor;
$json["theme_color"] = $themeColor;
$json["description"] = SITE_DESCRIPTION;
$json["dir"] = $languageDirection;
$json["lang"] = SITE_LANGUAGE;
$json["orientation"] = "portrait-primary";

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

{
    $len = count($json["icons"]);
    for ($i = 0; $i < $len; ++$i) {
        $json["icons"][$i]["type"] = $imageType;
        $json["icons"][$i]["purpose"] = "any maskable";
    } 
}

# Render manifest.json
header('Content-Type: application/json');
echo json_encode($json, JSON_UNESCAPED_SLASHES);
