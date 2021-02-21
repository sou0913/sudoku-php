<?php

namespace Models;

require_once('shuffle.php');

class Block {
    public $cells = [];
    public function __construct($seed = null)
    {
        if (!isset($seed)) $seed = rand();
        $this->cells = \Utils\shuffle(range(1, 9), $seed);
    }
    public function row($n) : array
    {
        switch ($n) {
            case 0:
                return [$this->cells[0], $this->cells[1], $this->cells[2]];
            case 1:
                return [$this->cells[3], $this->cells[4], $this->cells[5]];
            case 2:
                return [$this->cells[6], $this->cells[7], $this->cells[8]];
            default:
                throw new Exception('引数が不正');
        }
    }
    public function col($n) : array
    {
        switch ($n) {
            case 0:
                return [$this->cells[0], $this->cells[3], $this->cells[6]];
            case 1:
                return [$this->cells[1], $this->cells[4], $this->cells[7]];
            case 2:
                return [$this->cells[2], $this->cells[5], $this->cells[8]];
            default:
                throw new Exception('引数が不正');
        }
    }
}

// $test = new Block(1);
// echo implode(',', $test->row(0)) . PHP_EOL;
// echo implode(',', $test->row(1)) . PHP_EOL;
// echo implode(',', $test->row(2)) . PHP_EOL;

// $test = new Block(1);
// echo implode(',', $test->col(0)) . PHP_EOL;
// echo implode(',', $test->col(1)) . PHP_EOL;
// echo implode(',', $test->col(2)) . PHP_EOL;