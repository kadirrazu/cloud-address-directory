<?php

session_start();

session_unset();

$_SESSION["flash_type"] = "info";
$_SESSION["flash_message"] = "You have successfully logged out.";

header("Location: index.php");