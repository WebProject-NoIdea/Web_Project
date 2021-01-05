<?php
session_start();

function checkLogin(){
    if($_SESSION['webProjectLoggedIn'] == false){
        header( "Location: http://www.breakvoid.com/Web_Project/index.php" );
    }
}

function logout(){
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();

    header( "Location: index.php" );
}

function getUserId(){
    return $_SESSION["webProjectUserId"];
}

