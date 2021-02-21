<?php

class Validator
{
    public function isAllValid(Table $table, Point $point, int $number)
    {
        return $this->isValidInRow($table, $point, $number) &&
            $this->isValidInCol($table, $point, $number) &&
            $this->isValidInBlock($table, $point, $number);
    }

    public function isValidInRow($table, $point, $number)
    {
        $row = $table->base[$point->row];
        return !in_array($number, $row, true);
    }

    public function isValidInCol($table, $point, $number)
    {
        $col = [];
        foreach ($table->base as $row) {
            $col[] = $row[$point->col];
        }
        return !in_array($number, $col, true);
    }

    public function isValidInBlock($table, $point, $number)
    {
        return !in_array($number, $table->block($point), true);
    }
}
