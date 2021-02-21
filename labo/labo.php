<?php

namespace Labo;

use Exception;

$table = array_fill(0, 9, array_fill(0, 9, 0)); // 9x9;

$table[0][0] = 1; // 1~9なんでもok;

for ($i = 0; $i < 9; $i++) {
    for ($j = 0; $j < 9; $j++) {
        for ($k = 1; $k <= 9; $k++) { // $kはランダムな順番が望ましいか？
            if (invalid($table, $i, $j, $k)) continue;
            $table[$i][$j] = $k;
        }
        if (!isset($table[$i][$j])) throw new Exception('見つからなかったっぽい');
    }
}

foreach($table as $row) {
    echo implode(' ', $row) . PHP_EOL;
}
// 9 8 7 6 5 4 3 2 1
// 6 5 4 9 8 7 0 0 0
// 3 2 1 0 0 0 9 8 7
// 8 9 6 7 4 5 2 3 0
// 7 4 5 8 9 6 1 0 0
// 2 3 0 1 0 0 8 9 6
// 5 7 9 4 6 8 0 1 3
// 4 6 8 5 7 9 0 0 2
// 1 0 3 2 0 0 7 6 9


function valid($table, $row, $col, $value)
{
    return valid_block($table, $row, $col, $value) && valid_row($table, $row, $value) && valid_col($table, $col, $value);
}

function invalid($table, $row, $col, $value)
{
    return !valid($table, $row, $col,$value);
}

function block($table, $row, $col)
{
    if (0 <= $row && $row <= 2) $rows = array_slice($table, 0, 3);
    else if (3 <= $row && $row <= 5) $rows = array_slice($table, 3, 3);
    else if (6 <= $row && $row <= 8) $rows = array_slice($table, 6, 3);
    else throw new Exception('rowが範囲外');
    if (0 <= $col && $col <= 2) $slice_rows = array_map(function ($row) {
        return array_slice($row, 0, 3);
    }, $rows);
    else if (3 <= $col && $col <= 5) $slice_rows = array_map(function ($row) {
        return array_slice($row, 3, 3);
    }, $rows);
    else if (6 <= $col && $col <= 8) $slice_rows = array_map(function ($row) {
        return array_slice($row, 6, 3);
    }, $rows);
    else throw new Exception('colが範囲外');
    return array_flatten($slice_rows);
}

function valid_block($table, $row, $col, $value)
{
    $block = block($table, $row, $col);
    return in_array($value, $block) === false;
}

function valid_row($table, $row, $value)
{
    return in_array($value, $table[$row]) === false;
}

function valid_col($table, $col, $value)
{
    return valid_row(transpose($table), $col, $value);
}

// 転置する
function transpose(array $table): array
{
    $width  = count($table[0]);
    $height = count($table);
    $transposed = array_fill(0, $height, array());

    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $transposed[$j][$i] = $table[$i][$j];
        }
    }
    return $transposed;
}

function array_flatten($arr)
{
    $v = [];
    array_walk_recursive($arr, function ($e) use (&$v) {
        $v[] = $e;
    });
    return $v;
}


// $test = [[1,2],[3,4]];
// var_dump(valid_col($test, 0, 4));
// $test = [[0, 1, 2, 3, 4, 5, 6, 7, 8],[0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8], [0, 1, 2, 3, 4, 5, 6, 7, 8]];
// var_dump(block($test, 3, 3));
