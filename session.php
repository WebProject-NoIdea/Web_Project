<?php
session_start();

function checkLogin(){
    if($_SESSION['webProjectLoggedIn'] == false){
        header( "Location: index.php" );
    }
}
