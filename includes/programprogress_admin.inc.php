<?php 
require_once "dbh.inc.php";
require_once 'general_functions.inc.php';

if(isset($_POST['insert_class'])){
  $sql = "INSERT INTO `class_enrollment`(`UIN`, `Class_ID`, `Status`, `Semester`, `Year`) 
    VALUES (?,?,?,?,?);";
  $fields = array('uin','class_id','status','semester','year');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "iisss";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_class'])) {
  $sql = "UPDATE `class_enrollment` SET `UIN` = ?, `Status` = ?, `Semester` = ?, `Year` = ?
    WHERE `Class_ID` = ?;";
  $fields = array('uin','status','semester','year','class_id');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "isssi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_class'])) {
  $sql = "DELETE FROM `class_enrollment` WHERE `Class_ID` = ?;";
  $fields = array('Class_ID');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_intern'])) {
  $sql = "INSERT INTO `intern_app`(`UIN`, `Intern_ID`, `Status`, `Year`) 
    VALUES (?,?,?,?);";
  $fields = array('uin','Intern_ID','status','year');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "iiss";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_intern'])) {
  $sql = "UPDATE `intern_app` SET `UIN` = ?, `Status` = ?, `Year` = ?
    WHERE `Intern_ID` = ?";
  $fields = array('uin','status','year','Intern_ID');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "issi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_intern'])) {
  $sql = "DELETE FROM `intern_app` WHERE `Intern_ID` = ?;";
  $fields = array('Intern_ID');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_cert'])) {
  $sql = "INSERT INTO `cert_enrollment`(`UIN`, `Cert_ID`, `Status`, `Training_Status`,  `Program_Num`, `Semester`, `Year`) 
    VALUES (?,?,?,?,?,?,?);";
  $fields = array('UIN','Cert_ID','Status','Training_Status','Program_Num','Semester','Year');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "iississ";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_cert'])) {
  $sql = "UPDATE `cert_enrollment` SET `UIN` = ?, `Status` = ?, `Training_Status` = ?,  `Program_Num` = ?, `Semester` = ?, `Year` = ?
    WHERE `Cert_ID` = ?;";
  $fields = array('UIN','Status','Training_Status','Program_Num','Semester','Year','Cert_ID');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "ississi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_cert'])) {
  $sql = "DELETE FROM `cert_enrollment` WHERE `Cert_ID` = ?;";
  $fields = array('Cert_ID');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_track'])) {
  $sql = "INSERT INTO `track`(`Program_Num`, `Student_Num`) 
    VALUES (?,?);";
  $fields = array('Program_Num','Student_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "ii";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_track'])) {
  $sql = "UPDATE `track` SET `Program_Num` = ?, `Student_Num` = ?
    WHERE `Tracking_Num` = ?";
  $fields = array('Program_Num','Student_Num','Tracking_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "iii";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_track'])) {
  $sql = "DELETE FROM `track` WHERE `Tracking_Num` = ?;";
  $fields = array('Tracking_Num');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else {
  // echo "<h2>End</h2>";
  header("location: ../admin_programprogress.php");
  exit();
}
header("location: ../admin_programprogress.php");
exit();