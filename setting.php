<?php
# Project configuration file. Keep its name *as is*.


# Get root path of a mdcms site.
$rootDirectory = __DIR__;
# Get directory for configurations.
$configDirectory = $rootDirectory . "/config";

# Information of a site.
require_once $configDirectory . "/information.php";
# Social media for a site.
require_once $configDirectory . "/socialMedia.php";
# Parameters of a site.
require_once $configDirectory . "/parameters.php";
# Optional features in a site.
require_once $configDirectory . "/optionalFeatures.php";
# Sort callbacks.
require_once $configDirectory . "/sortCallbacks.php";
# Internals of a site.
require_once $configDirectory . "/internal.php";
