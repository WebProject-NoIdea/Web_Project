<?php
class test2{

    public function __construct()
    {
        include("session.php");
        checkLogin();
    }

    public function run(){
        echo "AHHAHA";
    }
}

(new test2())->run();