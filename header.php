<?php
  include_once 'includes/dbh.inc.php';
  session_start();

  $_SESSION["username"] = "a";
  // unset($_SESSION["username"]);
  //session_unset();
  //setcookie("name", "a", time()+86400);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cybersecurity Center Student Tracking and Reporting Tool</title>
  <link rel="icon" type="image/png" sizes="32x32" href="TAM-LogoBox.png">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <h1>Admin Functionalities</h1>
  <hr>
  <nav>
    <a href="toname.php">User Authentication and Roles</a>
    <a href="toname.php">Program Information Management</a>
    <a href="programprogress.php">Program Progress Tracking</a>
    <a href="toname.php">Event management</a>
  </nav>
  <hr>
  <h1>Student Functionalities</h1>
  <hr>
  <nav>
    <a href="toname.php">User Authentication and Roles</a>
    <a href="toname.php">Application Information Management</a>
    <a href="programprogress.php">Program Progress Tracking</a>
    <a href="toname.php">Document Upload and Management</a>
  </nav>
  <hr>