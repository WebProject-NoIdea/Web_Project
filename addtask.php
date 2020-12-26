<?php

include("session.php");
checkLogin();

if(isset($_POST['submit'])){
    var_dump($_POST);
}
