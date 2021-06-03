<?php
require_once __DIR__ . "/../setting.php";


function includePartials($partial)
{
    include __DIR__ . "/../" . PARTIALS_DIRECTORY . "/" . $partial;
}
