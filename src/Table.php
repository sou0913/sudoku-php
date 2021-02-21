<?php

require_once 'Validator.php';
require_once 'Utils.php';

class Table
{
    public $base;

    private $height;
    private $width;
    private $validator;

    public function __construct($height = 9, $width = 9)
    {
        $this->height = $height;
        $this->width = $width;
        $this->base = array_fill(0, $height, array_fill(0, $width, 0));
        $this->validator = new Validator;
    }


    public function copy(): Table
    {
        return clone $this;
    }

    public function size() : int
    {
        return $this->height * $this->width;
    }

    public function set($point, $number)
    {
        if ($this->invalid($point, $number)) {
            return false;
        } else {
            $this->base[$point->row][$point->col] = $number;
            return true;
        }
    }

    public function invalid(Point $point, int $number): bool
    {
        return !$this->valid($point, $number);
    }

    public function valid(Point $point, int $number): bool
    {
        return $this->validator->isAllValid($this, $point, $number);
    }

    function block($point) : array
    {
        if (0 <= $point->row && $point->row <= 2) $rows = array_slice($this->base, 0, 3);

        else if (3 <= $point->row && $point->row <= 5) $rows = array_slice($this->base, 3, 3);

        else if (6 <= $point->row && $point->row <= 8) $rows = array_slice($this->base, 6, 3);

        else throw new Exception('rowが範囲外');

        if (0 <= $point->col && $point->col <= 2) $slice_rows = array_map(function ($row) {
            return array_slice($row, 0, 3);
        }, $rows);

        else if (3 <= $point->col && $point->col <= 5) $slice_rows = array_map(function ($row) {
            return array_slice($row, 3, 3);
        }, $rows);

        else if (6 <= $point->col && $point->col <= 8) $slice_rows = array_map(function ($row) {
            return array_slice($row, 6, 3);
        }, $rows);

        else throw new Exception('colが範囲外');

        return Utils\array_flatten($slice_rows);
    }
}
