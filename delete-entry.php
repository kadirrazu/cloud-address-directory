<?php

session_start();

require_once('database-connection.php');

$referrer = $_SERVER['HTTP_REFERER'];

$recordId = isset($_GET['id']) ? trim($_GET['id']) : 0;

$result = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE id = $recordId");

$rowcount = mysqli_num_rows($result);

if( $rowcount < 1 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = 'Invalid Record ID! System was not able to process your request.';
    header("Location: directory-index.php");
    exit();
}
else
{
	$result = mysqli_query($connection, "DELETE FROM kr_contacts WHERE id = $recordId");
	$result2 = mysqli_query($connection, "DELETE FROM kr_contact_meta WHERE contact_id = $recordId");

	if( $result && $result2 ) 
	{
	    $_SESSION["flash_type"] = "success";
	    $_SESSION["flash_message"] = 'Record was deleted successfully from this directory.';
	    header("Location: directory-index.php");
	    exit();
	}
	else
	{
		$_SESSION["flash_type"] = "danger";
	    $_SESSION["flash_message"] = 'There was some error during deleting the record.';
	    header("Location: directory-index.php");
	    exit();
	}
}