<?php

// $table内をstopまで'hoge'で埋めていく。stopがない場合最大10個
$table = [];
$table[8] = 'stop';

// 再帰
function dfs($table, $index) {
    if ($index === 10) return $table;
    if (isset($table[$index]) && $table[$index] === 'stop') {
        return $table;
    }
    $table[$index] = 'hoge';
    return dfs($table, $index + 1);
}

$result = dfs($table, 0);
var_dump($result);

// var_dump($result);

// 再帰なし
// for($index = 0; $index < 10; $index++) {
//     if (isset($table[$index]) && $table[$index] === 'stop') {
//         break;
//     }
//     $table[$index] = 'hoge';
// }

// var_dump($table);
