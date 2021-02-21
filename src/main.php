<?php

require_once 'Table.php';
require_once 'Point.php';
require_once 'Utils.php';

const Numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

function dfs($table, $point)
{
    if ($point->isFinished()) {
        foreach($table->base as $row) {
            echo implode(' ', $row) . PHP_EOL;
        }
        return true;
    };
    $seed = rand();
    $numbers = Utils\shuffle_with_seed(Numbers, $seed);
    foreach ($numbers as $number) {
        $add_result = $table->set($point, $number);
        if (!$add_result) continue;
        $result = dfs($table->copy(), $point->copy()->next());
        if ($result) {
            return $result;
        } else {
            continue;
        }
    }
    // foreach($table->base as $row) {
    //     echo implode(' ', $row) . PHP_EOL;
    // }
    return false;
}
// 1 2 3 4 5 6 7 8 9
// 4 5 6 7 8 9 1 2 3
// 7 8 9 1 2 3 4 5 6
// 2 1 4 3 6 5 8 9 7
// 3 6 5 8 9 7 2 1 4
// 8 9 7 2 1 4 3 6 5
// 5 3 1 6 4 2 9 7 8
// 6 4 2 9 7 8 5 3 1
// 9 7 8 5 3 1 6 4 2

$table = new Table;
$point = new Point;

$result = dfs($table, $point);
var_dump($result);
