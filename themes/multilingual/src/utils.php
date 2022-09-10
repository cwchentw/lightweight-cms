<?php
# A private utility script.
#
# It is not included by the main loader of default theme of mdcms.


function includePartials ($partial)
{
    include __DIR__ . "/../partials/" . $partial;
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

function siteShortName ()
{
    if (0 === strpos($_SERVER["REQUEST_URI"], "/zh-tw")) {
        return getLocalizedText("siteShortName");
    }
    else if (0 === strpos($_SERVER["REQUEST_URI"], "/en-us")) {
        return getLocalizedText("siteShortName");
    }

    /* Fallback to default site short name. */
    return SITE_SHORT_NAME;
}

function getLocalizedText ($textFor)
{
    # Get the root path of default theme of mdcms.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    # The locale file for the zh-TW subsite.
    if (0 === strpos($_SERVER["REQUEST_URI"], "/zh-tw")) {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "zh-tw.json";
    }
    # The locale file for the en-US subsite.
    else if (0 === strpos($_SERVER["REQUEST_URI"], "/en-us")) {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "en-us.json";
    }
    # The fallback locale file.
    #
    # You may set it to another locale file if the default locale
    #  of your site is not American English.
    else /* Fallback to English locale. */ {
        $jsonFile = $rootDirectory . $sep . "trans" . $sep . "en-us.json";
    }

    $trans = json_decode(file_get_contents($jsonFile), true);

    return $trans[$textFor];
}
