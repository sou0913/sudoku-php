<?php

class Point
{
    public $row;
    public $col;
    public $height;
    public $width;

    public function __construct($row = 0, $col = 0, $height = 9, $width = 9)
    {
        $this->row = $row;
        $this->col = $col;
        $this->height = $height;
        $this->width = $width;
    }

    public function next(): Point
    {
        $this->col = ($this->col + 1) % $this->width;
        if ($this->col === 0) {
            $this->row += 1;
        }
        return $this;
    }

    public function copy(): Point
    {
        return clone $this;
    }

    public function isFinished(): bool
    {
        return $this->row === $this->height && $this->col === 0;
    }
}
