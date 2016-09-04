<?php 

session_start();

if( !isset($_SESSION["sess_logged_in"]) || $_SESSION["sess_logged_in"] == false )
{
	$_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "You must be logged in to acces a secure page!";
    header("Location: index.php");
}