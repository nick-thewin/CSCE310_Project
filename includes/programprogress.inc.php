<?php 
require_once 'dbh.inc.php';
if(isset($_POST['insert_class'])){
  echo "<h2>Insert Class</h2>";  
  // $field1 = $conn->real_escape_string($_POST['field1']);
  // $field2 = $conn->real_escape_string($_POST['field2']);
  // $field3 = $conn->real_escape_string($_POST['field3']);
  // $field4 = $conn->real_escape_string($_POST['field4']);
  // $field5 = $conn->real_escape_string($_POST['field5']);

  $sql = "INSERT INTO `class_enrollment`(`UIN`, `Class_ID`, `Status`, `Semester`, `Year`) 
    VALUES (?,?,?,?,?)";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_bind_param($stmt, "iisss", $_POST['uin'],$_POST['class_id'],$_POST['status'],$_POST['semester'],$_POST['year']);
  mysqli_stmt_execute($stmt);
  // $resultData = mysqli_stmt_get_result($stmt);
  // if($row = mysqli_fetch_assoc($resultData)){
  //   return $row;
  // } else{
  //     $result = false;
  //     return $result;
  // }
  mysqli_stmt_close($stmt);
} else if(isset($_POST['insert_intern'])) {
  echo "<h2>Insert Internship</h2>";
} else {
  // echo "<h2>End</h2>";
  header("location: ../programprogress.php");
  exit();
}
