<?php

session_start();

require_once('database-connection.php');

$referrer = $_SERVER['HTTP_REFERER'];

$recordId = isset($_GET['id']) ? trim($_GET['id']) : 0;

$result = mysqli_query($connection, "SELECT * FROM kr_circle WHERE id = $recordId");

$rowcount = mysqli_num_rows($result);

if( $rowcount < 1 || $recordId == 1 ) 
{
    $_SESSION["flash_type"] = "danger";
    $_SESSION["flash_message"] = 'Invalid Record ID! System was not able to process your request.';
    header("Location: manage-circles.php");
    exit();
}
else
{
	$result = mysqli_query($connection, "DELETE FROM kr_circle WHERE id = $recordId");
	$result2 = mysqli_query($connection, "UPDATE kr_contacts SET `circle_id` = 1 WHERE circle_id = $recordId");

	if( $result ) 
	{
	    $_SESSION["flash_type"] = "success";
	    $_SESSION["flash_message"] = 'Circle record was deleted successfully from this directory. All entries these were belog to the deleted circle, were moved under the default circle.';
	    header("Location: $referrer");
	    exit();
	}
	else
	{
		$_SESSION["flash_type"] = "danger";
	    $_SESSION["flash_message"] = 'There was some error during deleting the circle record.';
	    header("Location: $referrer");
	    exit();
	}
}