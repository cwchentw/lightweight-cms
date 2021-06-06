<?php
# The main PHP script for a mdcms theme.


# `loadLayout` function is mandatory for a mdcms theme.
#
# Everything in a mdcms theme should be self contained,
#  which merely depends on mdcms itself.
function loadLayout($layout)
{
    $themeDirectory = __DIR__ . "/theme";

    require $themeDirectory . "/" . $layout;
}
