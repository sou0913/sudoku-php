<?php


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
