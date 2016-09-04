<?php

require_once('database-connection.php');

session_start();

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$referrer = $_SERVER['HTTP_REFERER'];

//If email address is invalid
if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "Invalid email address!";
    header("Location: $referrer");
    exit();
}

//If email or password is empty
if( $email == "" && $password == "" ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "Please insert both email address and password.";
    header("Location: $referrer");
    exit();
}

//Check database
$encryptedPassword = md5($password);

$result = mysqli_query($connection, "SELECT * FROM kr_users WHERE email = '$email' AND password = '$encryptedPassword' LIMIT 1");

$rows = mysqli_fetch_assoc($result);
$rowcount = mysqli_num_rows($result);

$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) 
{
    $dir .= $parts[$i] . "/";
}

if( $rowcount > 0 )
{
	//Session Parameters Setting
	$_SESSION["sess_user_name"] = $rows['name'];
	$_SESSION["sess_user_email"] = $rows['email'];
	$_SESSION["sess_user_type"] = $rows['user_type'];
	$_SESSION["sess_logged_in"] = true;

    header("Location: http://". $dir . "directory-index.php");
}
else
{
	session_unset();
	$_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = "Email Address or Password does not matched!";
    header("Location: $referrer");
}

