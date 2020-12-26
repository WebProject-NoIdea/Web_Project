<?php

include("session.php");
checkLogin();

if(isset($_POST['task']) AND $_POST['task']!=null){
    var_dump($_POST);
}
