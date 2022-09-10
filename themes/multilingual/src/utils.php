<?php
# A private utility script.
#
# It is not included by the main loader of default theme of mdcms.


function includePartials ($partial)
{
    include __DIR__ . "/../partials/" . $partial;
}

function baseURI ()
{
    $uri = $_SERVER["REQUEST_URI"];
    if ("/" !== substr($uri, -1))
        $uri .= "/";

    if (0 === strpos($uri, "/zh-tw")) {
        return substr($uri, strlen("/zh-tw"));
    }
    else if (0 === strpos($uri, "/en-us")) {
        return substr($uri, strlen("/en-us"));
    }

    return $uri;
}

function homePage ()
{
    $uri = $_SERVER["REQUEST_URI"];
    if ("/" !== substr($uri, -1))
        $uri .= "/";

    if (0 === strpos($uri, SITE_PREFIX . "/zh-tw")) {
        return SITE_PREFIX . "/zh-tw/";
    }
    else if (0 === strpos($uri, SITE_PREFIX . "/en-us")) {
        return SITE_PREFIX . "/en-us/";
    }

    return SITE_PREFIX . "/";
}

function siteLanguage ()
{
    if (0 === strpos($_SERVER["REQUEST_URI"], "/zh-tw")) {
        return "zh-TW";
    }
    else if (0 === strpos($_SERVER["REQUEST_URI"], "/en-us")) {
        return "en-US";
    }

    /* Fallback to default site language. */
    return SITE_LANGUAGE;
}

function siteName ()
{
    return localize("siteName", SITE_NAME);
}

function siteShortName ()
{
    return localize("siteShortName", SITE_SHORT_NAME);
}

function siteDescription ()
{
    return localize("siteDescription", SITE_DESCRIPTION);
}

function localize ($key, $default)
{
    if (isZhTW()) {
        return getLocalizedText($key);
    }
    else if (isEnUS()) {
        return getLocalizedText($key);
    }

    /* Fallback to default site short name. */
    return $default;
}

function getLocalizedText ($textFor)
{
    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    # The locale file for the zh-TW subsite.
    if (isZhTW()) {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "zh-tw.json";
    }
    # The locale file for the en-US subsite.
    else if (isEnUS()) {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "en-us.json";
    }
    # The fallback locale file.
    #
    # You may set it to another locale file if the default locale
    #  of your site is not American English.
    else /* Fallback to default locale. */ {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "en-us.json";
    }

    $trans = json_decode(file_get_contents($jsonFile), true);

    return $trans[$textFor];
}

function isEnUS ()
{
    return 0 === strpos($_SERVER["REQUEST_URI"], SITE_PREFIX . "/en-us");
}

function isZhTW ()
{
    return 0 === strpos($_SERVER["REQUEST_URI"],  SITE_PREFIX . "/zh-tw");
}