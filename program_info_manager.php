<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
?>
<h3>Insert Program</h3>
  <form action="includes/program_info_manager.inc.php" method="post">
    <label for="Program_Name">Program Name: </label><br>
    <input type="text" id="Program_Name" name="Program_Name"><br>
    <label for="Program_Desc">Program Description: </label><br>
    <input type="text" id="Program_Desc" name="Program_Desc"><br>
    <button type="insert_program" name="insert_program">Submit</button>
  </form>
  <br>

  <h3>Edit Program</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Program Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="Program_Name">Program Name: </label><br>
        <input type="text" id="Program_Name" name="Program_Name"><br>
        <label for="Program_Desc">Program Description: </label><br>
        <input type="text" id="Program_Desc" name="Program_Desc"><br>
        <button type="edit_program" name="edit_program">Submit</button>
    </form>
    <br>


<?php

$query = "SELECT * FROM programs";
echo "<br><b>Database Output</b>";
echo '<table> 
      <tr> 
          <th>Program_Num</th> 
          <th>Name</th>
          <th>Description</th> 
      </tr>';
if ($result = $conn->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["Program_Num"];
      $field2name = $row["Name"];
      $field3name = $row["Description"];

      echo '<tr> 
        <td>'.$field1name.'</td> 
        <td>'.$field2name.'</td> 
        <td>'.$field3name.'</td> 
      </tr>';
  }
$result->free();
}
?>

</body>
</html>