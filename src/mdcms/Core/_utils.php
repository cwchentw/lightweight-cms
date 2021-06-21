<?php
namespace mdcms\Core;
# Private utility functions for mdcms.


function isValidField($array, $key)
{
    return !is_null($array)
        && array_key_exists($key, $array)
        && "" != $array[$key];
}
