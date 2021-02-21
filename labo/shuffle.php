<?php

function shuffle_with_seed(array $array, int $seed = null): array
{
    if (!isset($seed)) {
        $seed = rand();
    }
    srand($seed);
    $size = count($array);
    $copy = $array;
    for ($i = 0; $i < $size; $i++) {
        [$chunk] = array_splice($copy, rand(0, $size - 1), 1);
        $copy[] = $chunk;
    }
    return $copy;
}

// $test = [1, 2, 3];
// echo implode(',', shuffle($test, 1)) . PHP_EOL;
// echo implode(',', $test);