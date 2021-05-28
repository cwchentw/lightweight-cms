<?php

# TODO: Test the function.
function parsePage($page) {
    $result = array();

    $len = strlen($page);
    $i = 0;
    while ($i < $len) {
        if ("/" == substr($page, $i, 1)) {
            $j = $i + 1;
            while ($j < $len && "/" != substr($page, $j, 1))
                ++$j;
            $part = substr($page, $i+1, $j-$i-1);
            if ("" != $part)
                array_push($result, $part);
            $i = $j;
        }
        else {
            ++$i;
        }
    }

    return $result;
}
