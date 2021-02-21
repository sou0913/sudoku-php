<?php

namespace Mask;

require_once 'Utils.php';

function mask(Array $arr, int $until = 30)
{
    $unmasked = randoms();
    $copy = $arr;
    while (count($unmasked) > $until) {
        $num = array_pop($unmasked);
        $row = $num / 9;
        $col = $num % 9;
        $copy[$row][$col] = 0;
    }
    return $copy;
}

function pretty_print($arr, $until = 30)
{
    $masked = mask($arr, $until);
    foreach ($masked as $row) {
        echo implode(' ', $row) . PHP_EOL;
    }
}

function randoms($seed = null)
{
    $seed = $seed ?? rand();
    $randoms = range(0, 9 * 9 - 1);
    return \Utils\shuffle_with_seed($randoms, $seed);
}
