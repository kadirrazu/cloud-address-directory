<?php

session_start();

$referrer = $_SERVER['HTTP_REFERER'];

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$mobile = trim($_POST['mata']['mobile']);
$circle_id = trim($_POST['circle_id']);
$record_id = trim($_POST['record_id']);

//If email or password is empty
if( $first_name == "" || $last_name == "" || $email == "" || $mobile == "" ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = 'Fields marked with <span class="required-mark">*</span> are required.';
    header("Location: $referrer");
    exit();
}

//If email address is invalid
if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "Invalid email address!";
    header("Location: $referrer");
    exit();
}

require_once('database-connection.php'); 

//Check if already exists
$checkIfExists = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE id = $record_id LIMIT 1");

$existsRowCount = mysqli_num_rows($checkIfExists);

if( $existsRowCount < 1 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "It seems somehow record ID was tempared! System couldn't able to match it with any existing records.";
    header("Location: $referrer");
    exit();
}

//Insert as a new
$sqlUpdateKrContact = "UPDATE kr_contacts SET first_name = '$first_name', last_name = '$last_name', email = '$email', circle_id = $circle_id WHERE id = $record_id";

$result = mysqli_query($connection, $sqlUpdateKrContact);

foreach( $_POST['mata'] as $key => $value ){
	mysqli_query($connection, "UPDATE `kr_contact_meta` SET `value` = '$value' WHERE `key` = '$key' AND contact_id = $record_id");
}

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
