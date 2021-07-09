<?php
# Project configuration file. Keep its name *as is*.


# Information of a site.
readConfig("information");
# Social media for a site.
readConfig("socialMedia");
# Parameters of a site.
readConfig("parameters");
# Optional features in a site.
readConfig("optionalFeatures");
# Sort callbacks.
readConfig("sortCallbacks");
# Internals of a site.
readConfig("internal");

function readConfig($config)
{
    $sep = DIRECTORY_SEPARATOR;

    $rootDirectory = __DIR__;
    $configDirectory = $rootDirectory . $sep . "config";

    $configFile = $configDirectory . $sep . $config . ".php";

    if (file_exists($configFile)) {
        require_once $configFile;
    }
    else {
        require_once $configDirectory . $sep . $config . ".template.php";
    }
}
