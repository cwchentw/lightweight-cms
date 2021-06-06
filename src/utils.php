<?php
# Utility functions for mdcms.
require_once __DIR__ . "/../setting.php";


function isHome($page)
{
    return "/" == $page;
}

# The function doesn't distinguish between top sections
#  and nested ones.
function isSection($page)
{
    $path = __DIR__ . "/../" . CONTENT_DIRECTORY . "/" . $page;

    return is_dir($path);
}

function includePartials($partial)
{
    include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/" . $partial;
}
