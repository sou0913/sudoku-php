<?php

class Hoge {
    public function copy()
    {
        return clone $this;
    }
}

$hoge = new Hoge;
$hoge2 = $hoge->copy();
var_dump($hoge);
var_dump($hoge2);
var_dump($hoge === $hoge);
var_dump($hoge === $hoge2);