<?php
# A private utility script.
#  It is not included by the main loader of a mdcms theme.


function includePartials($partial)
{
    include __DIR__ . "/../partials/" . $partial;
}
