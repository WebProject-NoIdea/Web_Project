<?php
session_start();

function checkLogin(){
    $urlExt = "";

    $array = explode('/',$_SERVER['REQUEST_URI']);
    if( $array[count($array)-2]!="Web_Project"){
        $urlExt = "../";
    }

    if($_SESSION['webProjectLoggedIn'] == false){
        header( "Location: ".$urlExt."index.php" );
    }
}

function logout(){

    $urlExt = "";

    $array = explode('/',$_SERVER['REQUEST_URI']);
    if( $array[count($array)-2]!="Web_Project"){
        $urlExt = "../";
    }

    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();

    header( "Location: ".$urlExt."index.php" );
}

function getUserId(){
    return $_SESSION["webProjectUserId"];
}

