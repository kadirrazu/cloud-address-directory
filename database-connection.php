<?php

//Database Credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "address_directory";

$connection = mysqli_connect($host, $username, $password);

// Check connection
if( mysqli_connect_errno() )
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$dbSelection = mysqli_select_db($connection, $database);

//Create DB if not exists
if( !$dbSelection )
{
	mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS $database");
	mysqli_select_db($connection, $database);
}