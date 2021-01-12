<?php
class test2{

    public function __construct()
    {
        include("session.php");
        checkLogin();
        echo "AHHAHA";
    }
}