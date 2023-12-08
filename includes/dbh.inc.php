<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: File that includes the connection to the database.

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "Project";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}