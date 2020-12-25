<?php
session_start();

if($_SESSION['webProjectLoggedIn'] == true){
    header( "Location: home.html" );
}