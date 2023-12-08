<!-- 
    Author: Nicholas Nguyen
    UIN: 630003713
    Description: This code is for the Application Information Manager Section of the Student Page
 -->

<?php
  include_once('header.php');
  include_once 'includes/dbh.inc.php';
?>

<!-- This portion will demonstrate my table "Insert" Query, by inserting aan application into the "applications" table -->
<h3>Insert Program Application</h3>
    <!--  The form will keep track and store the inputs for the insertion into a variable-->
  <form action="includes/app_info_manager.inc.php" method="post">

    <label for="Program_Num">Choose an Eligible program to apply to: </label><br>
    <select id="Program_Num" name="Program_Num">
      <?php

      $sql = "SELECT * FROM programs WHERE User_Access = 1";
      $result = $conn->query($sql);

      // Generate options for the dropdown based on database data
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row['Program_Num'] . '">' . $row['Name'] . '</option>';
          }
      }

      ?>
    </select><br>
    <label for="Uncom_Cert">Are you currently enrolled in other uncompleted certifications sponsored by the Cybersecurity Center? </label><br>
    <input type="text" id="Uncom_Cert" name="Uncom_Cert"><br>
    <label for="Com_Cert">Have you completed any cybersecurity industy certifications via the Cybersecurity Center? </label><br>
    <input type="text" id="Com_Cert" name="Com_Cert"><br>
    <label for="Purpose_Statement">Purpose Statement: </label><br>
    <input type="text" id="Purpose_Statement" name="Purpose_Statement"><br>

    <!-- Clicking this button calls a function in the include, and performs the query with the set variables -->
    <button type="Apply" name="Apply">Submit</button>

  </form>
  <br>

  <!-- This portion will demonstrate my table "Update" Query, by updating an application in the "applications" table -->
  <h3>Edit Application</h3>
  <!-- The form will keep track and store the inputs for the insertion into a variable -->
  <form action="includes/app_info_manager.inc.php" method="post">
  <!-- Select dropdown for choosing application -->
  <label for="App_Num">Choose an application by application number to edit: </label><br>
  <select id="App_Num" name="App_Num">
      <?php
      $sql = "SELECT * FROM applications";
      $result = $conn->query($sql);

      // Generate options for the dropdown based on database data
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row['App_Num'] . '">' . $row['App_Num'] . '</option>';
          }
      } else {
          echo '<option value="">No applications available</option>';
      }
      ?>
  </select><br>

  <!-- Button to fetch and display App_Num data -->
  <button type="button" onclick="fetchAndDisplayData()">Display Application Information</button>

  <br>
  <br>

  <label for="Program_Num_Edit">Program applying to: </label><br>
      <select id="Program_Num_Edit" name="Program_Num_Edit">
        <?php
        $sql = "SELECT * FROM programs WHERE User_Access = 1";
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
  <label for="Uncom_Cert_Edit">Uncompleted Certification:</label><br>
  <input type="text" id="Uncom_Cert_Edit" name="Uncom_Cert_Edit"><br>
  <label for="Com_Cert_Edit">Completed Certification:</label><br>
  <input type="text" id="Com_Cert_Edit" name="Com_Cert_Edit"><br>
  <label for="Purpose_Statement_Edit">Purpose Statement:</label><br>
  <input type="text" id="Purpose_Statement_Edit" name="Purpose_Statement_Edit"><br>

  <script>
      function fetchAndDisplayData() {
          var selectedAppNum = document.getElementById("App_Num").value;

          // Use AJAX to fetch data based on selectedAppNum
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  // Parse the JSON response
                  var data = JSON.parse(xhr.responseText);

                  // Populate form fields with the fetched data
                  document.getElementById("Program_Num_Edit").value = data.Program_Num;
                  document.getElementById("Uncom_Cert_Edit").value = data.Uncom_Cert;
                  document.getElementById("Com_Cert_Edit").value = data.Com_Cert;
                  document.getElementById("Purpose_Statement_Edit").value = data.Purpose_Statement;
              }
          };

          xhr.open("GET", "includes/app_info_manager.inc.php?App_Num=" + selectedAppNum, true);
          xhr.send();
      }
  </script>
  <!-- Clicking this button calls a function in the include, and performs the query with the set variables -->
  <button type="edit_app" name="edit_app">Submit</button>
</form>
    

    <!-- This portion will demonstrate my table "Select" Query, by selecting specific application data -->
    <h3>Generate Application Report</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/app_info_manager.inc.php" method="post">
        <label for="App_Num">Choose an application by application number to generate a report: </label><br>
        <select id="App_Num" name="App_Num">
            <?php
            $sql = "SELECT * FROM applications";
            $result = $conn->query($sql);

            // Generate options for the dropdown based on database data
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['App_Num'] . '">' . $row['App_Num'] . '</option>';
                }
            } else {
                echo '<option value="">No applications available</option>';
            }
            ?>
        </select><br>
        <!-- When this button is clicked it calls a function in the include which performs the query and generate the report -->
        <button type="generate_app_report" name="generate_app_report">Submit</button>
    </form>
    <br>

    <!-- This portion will demonstrate my table "Delete" Query, by deleting an application in the "applications" table -->
    <h3>Delete Application Data</h3>
    <!--  The form will keep track and store the inputs in a variable-->
    <form action="includes/app_info_manager.inc.php" method="post">
        <label for="App_Num">Choose an application by application number to delete: </label><br>
        <select id="App_Num" name="App_Num">
            <?php
            $sql = "SELECT * FROM applications";
            $result = $conn->query($sql);

            // Generate options for the dropdown based on database data
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['App_Num'] . '">' . $row['App_Num'] . '</option>';
                }
            } else {
                echo '<option value="">No applications available</option>';
            }
            ?>
        </select><br>
        <!-- When this button is clicked it calls a function in the include which performs the query and deletes the application -->
        <button type="delete_app_data" name="delete_app_data">Submit</button>
    </form>
    <br>


<?php
// This displays the table for the "programs" table and the "applications" table
$query = "SELECT * FROM programs";
echo "<br><b>Database Output for Programs & Applications</b>";
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

<?php
  $query = "SELECT * FROM applications";
//   echo "<br><b>Database Output</b>";
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
?>


</body>
</html>