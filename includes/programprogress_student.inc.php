<?php
// Author: Daniel Huang
// UIN: 830008438
// Description: Handle the POST requests from the forms in student_programprogress.php

require_once "dbh.inc.php";
require_once 'general_functions.inc.php';
session_start();

if(isset($_POST['insert_class'])){
  $sql = "INSERT INTO `class_enrollment`(`UIN`, `Class_ID`, `Status`, `Semester`, `Year`) 
    VALUES (".$_SESSION["userid"].",?,?,?,?);";
  $fields = array('class_id','status','semester','year');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "isss";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_class'])) {
  $sql = "UPDATE `class_enrollment` SET `UIN` = ".$_SESSION["userid"].", `Class_ID` = ?, `Status` = ?, `Semester` = ?, `Year` = ?
    WHERE `CE_NUM` = ?;";
  $fields = array('class_id','status','semester','year','CE_NUM');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "isssi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_class'])) {
  $sql = "DELETE FROM `class_enrollment` WHERE `CE_NUM` = ?;";
  $fields = array('CE_NUM');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_intern'])) {
  $sql = "INSERT INTO `intern_app`(`UIN`, `Intern_ID`, `Status`, `Year`) 
    VALUES (".$_SESSION["userid"].",?,?,?);";
  $fields = array('Intern_ID','status','year');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "iss";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_intern'])) {
  $sql = "UPDATE `intern_app` SET `UIN` = ".$_SESSION["userid"].", `Intern_ID` = ?, `Status` = ?, `Year` = ?
    WHERE `IA_Num` = ?";
  $fields = array('Intern_ID','status','year','IA_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "issi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_intern'])) {
  $sql = "DELETE FROM `intern_app` WHERE `IA_Num` = ?;";
  $fields = array('IA_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_cert'])) {
  $sql = "INSERT INTO `cert_enrollment`(`UIN`, `Cert_ID`, `Status`, `Training_Status`,  `Program_Num`, `Semester`, `Year`) 
    VALUES (".$_SESSION["userid"].",?,?,?,?,?,?);";
  $fields = array('Cert_ID','Status','Training_Status','Program_Num','Semester','Year');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "ississ";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_cert'])) {
  $sql = "UPDATE `cert_enrollment` SET `UIN` = ".$_SESSION["userid"].", `Cert_ID` = ?, `Status` = ?, `Training_Status` = ?,  `Program_Num` = ?, `Semester` = ?, `Year` = ?
    WHERE `CertE_Num` = ?;";
  $fields = array('Cert_ID','Status','Training_Status','Program_Num','Semester','Year','CertE_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "ississi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_cert'])) {
  $sql = "DELETE FROM `cert_enrollment` WHERE `CertE_Num` = ?;";
  $fields = array('CertE_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_track'])) {
  $sql = "INSERT INTO `track`(`Program_Num`, `Student_Num`) 
    VALUES (?,".$_SESSION["userid"].");";
  $fields = array('Program_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_track'])) {
  $sql = "UPDATE `track` SET `Program_Num` = ?, `Student_Num` = ".$_SESSION["userid"]."
    WHERE `Tracking_Num` = ?";
  $fields = array('Program_Num','Tracking_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "ii";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_track'])) {
  $sql = "DELETE FROM `track` WHERE `Tracking_Num` = ?;";
  $fields = array('Tracking_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../student_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else {
  // echo "<h2>End</h2>";
  header("location: ../student_programprogress.php");
  exit();
}
header("location: ../student_programprogress.php");
exit();