<?php
# A private utility script.
#
# It is not included by the main loader of default theme
#  of Lightweight CMS.


function includePartials($partial)
{
    include __DIR__ . "/../partials/" . $partial;
}
