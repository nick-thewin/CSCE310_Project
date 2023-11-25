<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
  
  // $sql = "SELECT * FROM user;";
  // $result = mysqli_query($conn, $sql);
  // $resultCheck = mysqli_num_rows($result);
  // if($resultCheck > 0) {
  //   while ($row = mysqli_fetch_assoc($result)) {
  //     echo $row['Username'] . "<br>";
  //   }
  // }
?>
<h3>Insert Class</h3>
  <form action="includes/programprogress.inc.php" method="post">
    <label for="uin">UIN: </label><br>
    <input type="text" id="uin" name="uin"><br>
    <label for="class_id">Class ID: </label><br>
    <input type="text" id="class_id" name="class_id"><br>
    <label for="status">Status: </label><br>
    <input type="text" id="status" name="status"><br>
    <label for="semester">Semester: </label><br>
    <input type="text" id="semester" name="semester"><br>
    <label for="year">Year: </label><br>
    <input type="text" id="year" name="year"><br>
    <button type="insert_class" name="insert_class">Submit</button>
  </form>
  <br>
  <h3>Insert Internship</h3>
  <form action="includes/programprogress.inc.php" method="post">
    <label for="uin">UIN: </label><br>
    <input type="text" id="uin" name="uin"><br>
    <label for="intern_id">Intern ID: </label><br>
    <input type="text" id="intern_id" name="intern_id"><br>
    <label for="status">Status: </label><br>
    <input type="text" id="status" name="status"><br>
    <label for="year">Year: </label><br>
    <input type="text" id="year" name="year"><br>
    <button type="insert_intern" name="insert_intern">Submit</button>
  </form>

<?php

$query = "SELECT * FROM class_enrollment";
echo "<br><b>Database Output</b>";
echo '<table> 
      <tr> 
          <th>CE_NUM</th> 
          <th>UIN</th>
          <th>Class_ID</th> 
          <th>Status</th> 
          <th>Semester</th> 
          <th>Year</th> 
      </tr>';
if ($result = $conn->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["CE_NUM"];
      $field2name = $row["UIN"];
      $field3name = $row["Class_ID"];
      $field4name = $row["Status"];
      $field5name = $row["Semester"];
      $field6name = $row["Year"];

      echo '<tr> 
        <td>'.$field1name.'</td> 
        <td>'.$field2name.'</td> 
        <td>'.$field3name.'</td> 
        <td>'.$field4name.'</td> 
        <td>'.$field5name.'</td>
        <td>'.$field6name.'</td>
      </tr>';
  }
$result->free();
}
?>

</body>
</html>