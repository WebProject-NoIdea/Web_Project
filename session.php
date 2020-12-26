<?php
session_start();

function checkLogin(){
    if($_SESSION['webProjectLoggedIn'] == false){
        header( "Location: index.php" );
    }
}

function logout(){
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
}

