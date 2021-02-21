<?php

require_once 'shuffle.php';

$base = array_fill(0, 9, range(1, 9));

$shuffled = array_map('shuffle_with_seed', $base);
$count = 0;
while(check_cols($shuffled) === false) {
    if ($count > 200000) {
        echo "見つからず";
        break;
    }
    $shuffled = array_map('shuffle_with_seed', $shuffled);
    $count++;
}
foreach($shuffled as $row) {
    echo implode(" ", $row) . PHP_EOL;
}
// 見つからず2 3 5 7 1 9 4 6 8
// 2 7 4 8 6 1 5 9 3
// 4 2 8 1 7 9 6 5 3
// 2 3 4 7 9 6 1 8 5
// 8 6 9 3 1 5 7 4 2
// 3 6 1 9 5 7 4 8 2
// 4 6 1 3 7 5 2 8 9
// 1 3 5 7 8 6 4 2 9
// 9 1 6 7 3 4 5 2 8

function check_cols($table)
{
    $transposed = transpose($table);
    $flag = true;
    foreach($transposed as $col) {
        if (count(array_diff(range(1, 9), $col)) !== 0) $flag = false;
    }
    return $flag;
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