<?php

include("session.php");
checkLogin();

var_dump($_POST);

if(isset($_POST['task'])){
    var_dump($_POST);
}
