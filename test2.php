<?php
class test2{

    public function __construct()
    {
    }

    public function run(){
        echo getUserId();
    }
}

(new test2())->run();