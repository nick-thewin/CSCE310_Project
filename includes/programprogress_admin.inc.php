<?php 
require_once "dbh.inc.php";
require_once 'general_functions.inc.php';

if(isset($_POST['insert_class'])){
  $fields = array('uin','class_id','status','semester','year');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $sql = "INSERT INTO `class_enrollment`(`UIN`, `Class_ID`, `Status`, `Semester`, `Year`) 
    VALUES (?,?,?,?,?);";
  $bindtypes = "iisss";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['update_class'])) {
  $fields = array('uin','class_id','status','semester','year','CE_NUM');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $sql = "UPDATE `class_enrollment` SET `UIN` = ?, `Class_ID` = ?, `Status` = ?, `Semester` = ?, `Year` = ?
    WHERE `CE_NUM` = ?";
  $bindtypes = "iisssi";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['delete_class'])) {
  $fields = array('CE_NUM');
  if (emptyInput($fields) !== false) {
    header("location: ../admin_programprogress.php?error=emptyinput");
    exit();
  }
  $sql = "DELETE FROM `class_enrollment` WHERE `CE_NUM` = ?;";
  $bindtypes = "i";
  executeSQL($conn, $fields, $sql, $bindtypes);
} else if(isset($_POST['insert_intern'])) {
  
} else if(isset($_POST['update_intern'])) {

} else if(isset($_POST['insert_intern'])) {

} else if(isset($_POST['insert_cert'])) {

} else if(isset($_POST['update_cert'])) {

} else if(isset($_POST['delete_cert'])) {

} else if(isset($_POST['insert_track'])) {

} else if(isset($_POST['update_track'])) {

} else if(isset($_POST['delete_track'])) {

} else {
  // echo "<h2>End</h2>";
  header("location: ../admin_programprogress.php");
  exit();
}
header("location: ../admin_programprogress.php");
exit();