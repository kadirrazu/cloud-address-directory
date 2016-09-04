<?php

session_start();

$referrer = $_SERVER['HTTP_REFERER'];

$circle_title = trim($_POST['circle_title']);

//If email or password is empty
if( $circle_title == "" ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = 'Circle title field is required.';
    header("Location: $referrer");
    exit();
}

require_once('database-connection.php'); 

//Check if already exists
$ifExistsResult = mysqli_query($connection, "SELECT * FROM kr_circle WHERE circle_title = '$circle_title' LIMIT 1");

$existsRowCount = mysqli_num_rows($ifExistsResult);

if( $existsRowCount > 0 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "It seems an entry with this same circle title already exits. Please consider a new title to insert!";
    header("Location: $referrer");
    exit();
}

//Insert as a new

$sqlInsertKrCircle = "INSERT INTO kr_circle (circle_title) VALUES ('$circle_title')";

$result = mysqli_query($connection, $sqlInsertKrCircle);

if( $result )
{
    $_SESSION["flash_type"] = "success";
    $_SESSION["flash_message"] = "Circle record successfully inserted in the directory.";
    header("Location: $referrer");
    exit();
}
else
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "There was some error during adding the circle record.";
    header("Location: $referrer");
    exit();   
}


