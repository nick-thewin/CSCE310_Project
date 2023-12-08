<!-- 
    Author: Nicholas Nguyen
    UIN: 630003713
    Description: This code is for the Program Information Manager Section of the Admin Page
 -->

<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
?>

<!-- This portion will demonstrate my table "Insert" Query, by inserting a progam in the "programs" table -->
<h3>Insert Program</h3>
  <!--  The form will keep track and store the inputs in variables to be queried-->
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
    <!-- Clicking this button calls a function in the include, and performs the query with the set variables -->
    <button type="insert_program" name="insert_program">Submit</button>
  </form>
  <br>


    <!-- This portion will demonstrate my table "Update" Query, by updating an application in the "programs" table  -->
    <h3>Edit Program Information</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/program_info_manager.inc.php" method="post">
      <!-- Select dropdown for choosing application -->
      <label for="Program_Num">Choose a program by program number to edit: </label><br>
      <select id="Program_Num" name="Program_Num">
          <?php
          $sql = "SELECT * FROM programs";
          $result = $conn->query($sql);
          // Generate options for the dropdown based on database data
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['Program_Num'] . '">' . $row['Program_Num'] . '</option>';
              }
          } else {
              echo '<option value="">No programs available</option>';
          }
          ?>
      </select><br>

      <!-- Button to fetch and display App_Num data -->
      <button type="button" onclick="fetchAndDisplayData()">Display Program Information</button><br>

      <label for="Program_Name_Edit">Program Name: </label><br>
      <input type="text" id="Program_Name_Edit" name="Program_Name_Edit"><br>
      <label for="Program_Desc_Edit">Program Description: </label><br>
      <input type="text" id="Program_Desc_Edit" name="Program_Desc_Edit"><br>
      <label for="User_Access_Edit">User Access: </label><br>
      <select id="User_Access_Edit" name="User_Access_Edit">
          <option value="1">Yes</option>
          <option value="0">No</option>
      </select><br>
      <script>
          function fetchAndDisplayData() {
              var selectedProgramNum = document.getElementById("Program_Num").value;

              // Use AJAX to fetch data based on selectedProgramNum
              var xhr = new XMLHttpRequest();

              xhr.onreadystatechange = function () {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                      // Parse the JSON response
                      var data = JSON.parse(xhr.responseText);

                      // Populate form fields with the fetched data
                      document.getElementById("Program_Name_Edit").value = data.Name;
                      document.getElementById("Program_Desc_Edit").value = data.Description;
                      document.getElementById("User_Access_Edit").value = data.User_Access;
                  }
              };
              xhr.open("GET", "includes/program_info_manager.inc.php?Program_Num=" + selectedProgramNum, true);
              xhr.send();
          }
      </script>
        <br>
      <!-- When this button is clicked it activates a function in the include file, which performs the query -->
      <button type="edit_program" name="edit_program">Submit</button>
    </form>
    <br>

    <!-- This portion will demonstrate my table "Select" Query, by selecting specific program data  -->
    <h3>Generate Program Report</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Choose a program by program number to generate a report: </label><br>
        <select id="Program_Num" name="Program_Num">
          <?php
          $sql = "SELECT * FROM programs";
          $result = $conn->query($sql);
          // Generate options for the dropdown based on database data
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['Program_Num'] . '">' . $row['Program_Num'] . '</option>';
              }
          } else {
              echo '<option value="">No programs available</option>';
          }
          ?>
        </select><br>
        <!-- When this button is clicked it calls a function in the include which performs the query and generate the report -->
        <button type="generate_program_report" name="generate_program_report">Submit</button>
    </form>
    <br>

    
    <!-- This portion will demonstrate my table "Delete" Query and deletes a program from the table -->
    <h3>Delete Program Data</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Choose a program by program number to delete: </label><br>
        <select id="Program_Num" name="Program_Num">
          <?php
          $sql = "SELECT * FROM programs";
          $result = $conn->query($sql);
          // Generate options for the dropdown based on database data
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['Program_Num'] . '">' . $row['Program_Num'] . '</option>';
              }
          } else {
              echo '<option value="">No programs available</option>';
          }
          ?>
        </select><br>
        <!-- When this button is clicked it calls a function in the include which performs the query and deletes the desired entity -->
        <button type="delete_program_data" name="delete_program_data">Submit</button>
    </form>
    <br>

    <!-- This portion will demonstrate my table "Update" Query and changes a users access to a program in the table -->
    <h3>Delete/Change Program Access</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/program_info_manager.inc.php" method="post">
        <label for="Program_Num">Choose a program by program number to delete/change access: </label><br>
        <select id="Program_Num" name="Program_Num">
          <?php
          $sql = "SELECT * FROM programs";
          $result = $conn->query($sql);
          // Generate options for the dropdown based on database data
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['Program_Num'] . '">' . $row['Program_Num'] . '</option>';
              }
          } else {
              echo '<option value="">No programs available</option>';
          }
          ?>
        </select><br>
        <label for="User_Access">User Access: </label><br>
        <select id="User_Access" name="User_Access">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select><br>
        <!-- When this button is clicked it calls a function in the include which performs the query and updates "User_Access -->
        <button type="delete_program_access" name="delete_program_access">Submit</button>
    </form>


<?php
// This displays the table for the programs table
$query = "SELECT * FROM programs";
echo "<br><b>Database Output for Programs</b>";
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