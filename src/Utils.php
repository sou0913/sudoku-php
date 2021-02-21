<?php

namespace Utils;

// 二次元配列の転置
function transpose($array_2d) : array
{
    $width = count($array_2d[0]);
    $height = count($array_2d);
    $transposed = array_fill(0, $height, array());

    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $transposed[$j][$i] = $array_2d[$i][$j];
        }
    }

    return $transposed;
}

function array_flatten($arr) : array
{
    $v = [];
    array_walk_recursive($arr, function ($e) use (&$v) {
        $v[] = $e;
    });
    return $v;
}
