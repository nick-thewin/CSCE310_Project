<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
?>
<h3>Insert Program Application</h3>
  <form action="includes/app_info_manager.inc.php" method="post">
    <label for="Program_Num">Choose an Eligible program to apply to: </label><br>
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
    <label for="Purpose_Statement">Purpose Statement: </label><br>
    <input type="text" id="Purpose_Statement" name="Purpose_Statement"><br>
    <button type="Apply" name="Apply">Submit</button>
  </form>
  <br>

  <h3>Edit Application</h3>
    <form action="includes/app_info_manager.inc.php" method="post">
        <label for="App_Num">Application Number: </label><br>
        <input type="text" id="App_Num" name="App_Num"><br>
        <label for="Program_Num">Choose an Eligible program to apply to: </label><br>
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
        <label for="Purpose_Statement">Purpose Statement: </label><br>
        <input type="text" id="Purpose_Statement" name="Purpose_Statement"><br>
        <button type="edit_app" name="edit_app">Submit</button>
    </form>
    <br>

    <h3>Generate Application Report</h3>
    <form action="includes/app_info_manager.inc.php" method="post">
        <label for="App_Num">Application Number: </label><br>
        <input type="text" id="App_Num" name="App_Num"><br>
        <button type="generate_app_report" name="generate_app_report">Submit</button>
    </form>
    <br>

    <h3>Delete Application Data</h3>
    <form action="includes/app_info_manager.inc.php" method="post">
        <label for="App_Num">Application Number: </label><br>
        <input type="text" id="App_Num" name="App_Num"><br>
        <button type="delete_app_data" name="delete_app_data">Submit</button>
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

$query = "SELECT * FROM applications";
echo "<br><b>Database Output</b>";
echo '<table> 
      <tr> 
          <th>App_Num</th> 
          <th>Program_Num</th>
          <th>UIN</th> 
          <th>Uncom_Cert</th> 
          <th>Com_Cert</th> 
          <th>Purpose_Statement</th> 
      </tr>';
if ($result = $conn->query($query)) {
  while ($row = $result->fetch_assoc()) {
      $field1name = $row["App_Num"];
      $field2name = $row["Program_Num"];
      $field3name = $row["UIN"];
      $field4name = $row["Uncom_Cert"];
      $field5name = $row["Com_Cert"];
      $field6name = $row["Purpose_Statement"];

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
}
?>


</body>
</html>
