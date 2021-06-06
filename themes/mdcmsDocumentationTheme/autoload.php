<?php
# The main PHP script for a mdcms theme.


# `loadHome` function is mandatory for a mdcms theme.
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}

function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}

function loadPost()
{
    require __DIR__ . "/theme/" . "post.php";
}