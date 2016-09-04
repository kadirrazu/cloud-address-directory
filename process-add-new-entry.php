<?php

session_start();

$referrer = $_SERVER['HTTP_REFERER'];

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$mobile = trim($_POST['mata']['mobile']);
$circle_id = trim($_POST['circle_id']);

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
$ifExistsResult = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE email = '$email' LIMIT 1");

$existsRowCount = mysqli_num_rows($ifExistsResult);

if( $existsRowCount > 0 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "It seems an entry with this same email address already exits. We protected you from duplicate records!";
    header("Location: $referrer");
    exit();
}

//Insert as a new

$sqlInsertKrContact = "INSERT INTO kr_contacts (first_name, last_name, email, circle_id) VALUES ('$first_name', '$last_name', '$email', $circle_id)";

$result = mysqli_query($connection, $sqlInsertKrContact);

$last_id = mysqli_insert_id($connection);

foreach( $_POST['mata'] as $key => $value ){
	mysqli_query($connection, "INSERT INTO kr_contact_meta (`contact_id`, `key`, `value`) VALUES('$last_id', '$key', '$value')");
}

if( $result )
{
    $_SESSION["flash_type"] = "success";
    $_SESSION["flash_message"] = "Record successfully inserted in the directory.";
    header("Location: $referrer");
    exit();
}


