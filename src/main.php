<?php

require_once 'Table.php';
require_once 'Point.php';
require_once 'Utils.php';
require_once 'Mask.php';

const Numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

function dfs($table, $point)
{
    if ($point->isFinished()) {
        return $table->base;
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
    return false;
}

$table = new Table;
$point = new Point;

$result = dfs($table, $point);

echo "Answer" . PHP_EOL;
foreach($result as $row) {
    echo implode(' ', $row) . PHP_EOL;
}

echo "Question" . PHP_EOL;
\Mask\pretty_print($result);
