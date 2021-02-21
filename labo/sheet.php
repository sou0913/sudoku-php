<?php

namespace Models;

require_once 'block.php';

class Sheet
{
    public $blocks = [];
    public function __construct($seed = null)
    {
        for($i = 0; $i < 9; $i++) {
            $this->blocks[] = new Block($seed);
        }
    }

    public function valid(): bool
    {
        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[0]->row($i), $this->blocks[1]->row($i), $this->blocks[2]->row($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[3]->row($i), $this->blocks[4]->row($i), $this->blocks[5]->row($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[6]->row($i), $this->blocks[7]->row($i), $this->blocks[8]->row($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[0]->col($i), $this->blocks[3]->col($i), $this->blocks[6]->col($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[1]->col($i), $this->blocks[4]->col($i), $this->blocks[7]->col($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        for ($i = 0; $i < 3; $i++) {
            if (
                empty(array_diff(
                    array_merge($this->blocks[2]->col($i), $this->blocks[5]->col($i), $this->blocks[8]->col($i)),
                    [1, 2, 3, 4, 5, 6, 7, 8, 9]
                ))
            ) return false;
        }

        return true;
    }
}

$complete = false;
$count = 0;
while(!$complete) {
    $count++;
    if ($count > 1000000) break;
    $test = new Sheet();
    $complete = var_dump($test->valid());
}
