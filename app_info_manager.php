<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
?>
<h3>Insert Program Application</h3>
  <form action="includes/app_info_manager.inc.php" method="post">
    <label for="App_Name">Application Name: </label><br>
    <input type="text" id="App_Name" name="App_Name"><br>
    <label for="Program_Num">Program Number: </label><br>
    <select id="Program_Num" name="Program_Num">
      <?php
      $sql = "SELECT * FROM programs";
      $result = $conn->query($sql);
      // Generate options for the dropdown based on database data
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row['Program_Num'] . '">' . $row['Name'] . '</option>';
          }
      } else {
          echo '<option value="">No programs available</option>';
      }
      ?>
    </select><br>
    <label for="Uncom_Cert">Are you currently enrolled in other uncompleted certifications sponsored by the Cybersecurity Center? </label><br>
    <input type="text" id="Uncom_Cert" name="Uncom_Cert"><br>
    <label for="Com_Cert">Have you completed any cybersecurity industy certifications via the Cybersecurity Center? </label><br>
    <input type="text" id="Com_Cert" name="Com_Cert"><br>
    <label for="Purpose_Statment">Purpose Statement: </label><br>
    <input type="text" id="Purpose_Statment" name="Purpose_Statment"><br>
    <button type="Apply" name="Apply">Submit</button>
  </form>
  <br>

  <h3>Edit Application</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Application Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="Program_Name">Application Name: </label><br>
        <input type="text" id="Program_Name" name="Program_Name"><br>
        <label for="Program_Desc">Application Description: </label><br>
        <input type="text" id="Program_Desc" name="Program_Desc"><br>
        <button type="edit_program" name="edit_program">Submit</button>
    </form>
    <br>

    <h3>Delete Application Data</h3>
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Application Number: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <button type="delete_program_data" name="delete_program_data">Submit</button>
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