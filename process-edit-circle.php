<?php

session_start();

$referrer = $_SERVER['HTTP_REFERER'];

$circle_title = trim($_POST['circle_title']);
$circle_id = trim($_POST['circle_id']);

//If email or password is empty
if( $circle_title == "" || $circle_id == "" ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = 'Fields marked with <span class="required-mark">*</span> are required.';
    header("Location: $referrer");
    exit();
}

require_once('database-connection.php'); 

//Check if already exists
$checkIfExists = mysqli_query($connection, "SELECT * FROM kr_circle WHERE id = $circle_id LIMIT 1");

$existsRowCount = mysqli_num_rows($checkIfExists);

if( $existsRowCount < 1 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "It seems somehow record ID was tempared! System couldn't be able to match it with any existing circle records.";
    header("Location: $referrer");
    exit();
}

//Update Data
$sqlUpdateKrCircle = "UPDATE kr_circle SET circle_title = '$circle_title' WHERE id = $circle_id";

$result = mysqli_query($connection, $sqlUpdateKrCircle);

if( $result )
{
    $_SESSION["flash_type"] = "success";
    $_SESSION["flash_message"] = "Record successfully updated.";
    header("Location: $referrer");
    exit();
}
else
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "Something wrong happened during updating the record! Error.";
    header("Location: $referrer");
    exit();    
}
