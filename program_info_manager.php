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
    <label for="User_Access">User Access: </label><br>
    <select id="User_Access" name="User_Access">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br>
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

    <h3>Generate Program Report</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Program Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <button type="generate_program_report" name="generate_program_report">Submit</button>
    </form>
    <br>

    

    <h3>Delete Program Data</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Program Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <button type="delete_program_data" name="delete_program_data">Submit</button>
    </form>
    <br>

    <h3>Delete/Change Program Access</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Program Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="User_Access">User Access: </label><br>
        <select id="User_Access" name="User_Access">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select><br>
        <button type="delete_program_access" name="delete_program_access">Submit</button>
    </form>


<?php

$query = "SELECT * FROM programs";
echo "<br><b>Database Output</b>";
echo '<table> 
      <tr> 
          <th>Program_Num</th> 
          <th>Name</th>
          <th>Description</th> 
          <th>User_Access</th> 
      </tr>';
if ($result = $conn->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["Program_Num"];
      $field2name = $row["Name"];
      $field3name = $row["Description"];
      $field4name = $row["User_Access"];

      echo '<tr> 
        <td>'.$field1name.'</td> 
        <td>'.$field2name.'</td> 
        <td>'.$field3name.'</td> 
        <td>'.$field4name.'</td>
      </tr>';
  }
$result->free();
}
?>

</body>
</html>