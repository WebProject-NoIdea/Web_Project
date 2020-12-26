<?php

include("session.php");
checkLogin();

var_dump($_POST);

if(isset($_POST['submit'])){
    var_dump($_POST);
}
