<?php
include("session.php");

class test2{

    public function __construct()
    {
        checkLogin();
    }

    public function run(){
        echo getUserId();
    }
}

(new test2())->run();