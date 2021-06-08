<?php
namespace mdcms;
# Section related functions.

$rootDirectory = __DIR__ . "/../..";

require_once $rootDirectory . "/vendor/autoload.php";
require_once $rootDirectory . "/setting.php";
require_once __DIR__ . "/const.php";
require_once __DIR__ . "/page.php";


function getSection($page)
{
    $result = array();

    # Initialize the data of a section.
    $result[MDCMS_SECTION_TITLE] = "";
    $result[MDCMS_SECTION_CONTENT] = "";
    $result[MDCMS_SECTION_STATUS] = 200;  # HTTP 200 OK.

    $rootDirectory = __DIR__ . "/../..";
    $indexPage = $rootDirectory . "/" . CONTENT_DIRECTORY
        . "/" . $page . SECTION_INDEX;

    # If a section index exists, extract data from it.
    if (file_exists($indexPage)) {
        $c = file_get_contents($indexPage);

        preg_match("/^# (.+)/", $c, $matches);
        if (isset($matches)) {
            $result[MDCMS_SECTION_TITLE] = $matches[1];
        }

        $c = preg_replace("/^# (.+)/", "", $c);

        $parser = new \Parsedown();
        $result[MDCMS_SECTION_CONTENT] = $parser->text($c);
    }
    # Otherwise, extract data from the directory name.
    else {
        $pages = parsePage($page);
        $title = preg_replace("/\/|-+/", " ", array_pop($pages));
        $title = ucwords($title);  # Capitalize a title.
        $result[MDCMS_SECTION_TITLE] = $title;
    }

    return $result;
}
