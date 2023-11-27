<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

// Retrieve account information
$query = "SELECT * FROM user WHERE UIN = " . $_SESSION["userid"] . ";";
$accountInfo = [];

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $accountInfo = $row;
    }
    $result->free();
}

// Retrieve student information
$query = "SELECT * FROM collegestudent WHERE UIN = " . $_SESSION["userid"] . ";";
$studentInfo = [];

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $studentInfo = $row;
    }
    $result->free();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Include your stylesheets or additional head content here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .column1 {
            width: 25%;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .column2 {
            width: 70%;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column1">
        <h3>Change Login Credentials:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="New Username">New Username: </label><br>
              <input type="text" id="username" name="username"><br>
              <label for="New Password">New Password: </label><br>
              <input type="text" id="password" name="password"><br>
              <button type="updatelogin" name="updatelogin">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "usernametaken") {
                    echo "<p>Username is taken, try a new one!</p>";
                } else if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                } else if ($_GET["error"] == "changesuccess") {
                    echo "<p>Login Credentials have been successfully changed!</p>";
                }
            }
            ?>

            <br>

            <h3>Update Personal Information:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="Email">Email: </label><br>
              <input type="text" id="email" name="email"><br>
              <label for="Discord Name">Discord Name: </label><br>
              <input type="text" id="discord_name" name="discord_name"><br>
              <label for="gpa">GPA:</label><br>
              <input type="number" id="gpa" name="gpa" step="any"><br>
              <label for = "major"> Major: </label><br>
              <input type = "text" name = "major"><br>
              <label for = "minor1"> Minor 1: </label><br>
              <input type = "text" name = "minor1"><br>
              <label for = "minor2"> Minor 2: </label><br>
              <input type = "text" name = "minor2"><br>
              <label for="grad">Anticipated Graduation Year:</label><br>
              <input type="number" id="grad" name="grad" min="2023" max="2099"><br>
              <label for = "school"> School: </label><br>
              <input type = "text" name = "school"><br>
              <label for = "classification"> Classification: </label><br>
              <input type = "text" name = "classification"><br>
              <label for = "phone"> Phone Number: </label><br>
              <input type = "number" name = "phone"><br>
              <label for = "studenttype"> Type of Student: </label><br>
              <input type = "text" name = "studenttype"><br>
              <button type="updateinfo" name="updateinfo">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed2") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "emptyinput2") {
                    echo "<p>Fill in at least one of the fields!</p>";
                } else if ($_GET["error"] == "updatesuccess") {
                    echo "<p>Personal information has been successfully changed!</p>";
                }
            }
            ?>

            <br>

            <h3>DEACTIVATE ACCOUNT:</h3>
            <form action="includes/user.inc.php" method="post">
              <label>WARNING: PRESSING BUTTON WILL DEACTIVATE ACCOUNT!!<br></label>
              <button type="deactivate" name="deactivate">DEACTIVATE ACCOUNT</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed3") {
                    echo "<p>Something failed, try again!</p>";
                }
            }
            ?>
        </div>
        <div class="column2">
          <?php
              // Display account information
              echo "<br><b>Account Information</b>";
              if (!empty($accountInfo)) {
                  echo '<table> 
                      <tr> 
                          <th>UIN</th> 
                          <th>First Name</th>
                          <th>Middle Initial</th> 
                          <th>Last Name</th> 
                          <th>Username</th> 
                          <th>Password</th>
                          <th>Email</th>
                          <th>Discord Name</th>
                          <th>Gender</th>
                          
                      </tr>';

              
                  echo '<tr> 
                      <td>' . $accountInfo["UIN"] . '</td> 
                      <td>' . $accountInfo["First_Name"] . '</td> 
                      <td>' . $accountInfo["M_Initial"] . '</td> 
                      <td>' . $accountInfo["Last_Name"] . '</td> 
                      <td>' . $accountInfo["Username"] . '</td>
                      <td>' . $accountInfo["Passwords"] . '</td>
                      <td>' . $accountInfo["Email"] . '</td>
                      <td>' . $accountInfo["Discord_Name"] . '</td>
                      <td>' . $studentInfo["Gender"] . '</td>
                  </tr>';

                  echo '<tr>
                      <th>Hispanic/Latino</th> 
                      <th>Race</th> 
                      <th>U.S. Citizen</th> 
                      <th>First Generation</th>
                      <th>Date of Birth</th>
                      <th>GPA</th>
                      <th>Major</th>
                      <th>Minor 1</th>
                      <th>Minor 2</th>
                  </tr>';

                  echo'<tr>
                    <td>' . $studentInfo["Hispanic/Latino"] . '</td> 
                    <td>' . $studentInfo["Race"] . '</td> 
                    <td>' . $studentInfo["U.S._Citizen"] . '</td> 
                    <td>' . $studentInfo["First_Generation"] . '</td> 
                    <td>' . $studentInfo["DOB"] . '</td>
                    <td>' . $studentInfo["GPA"] . '</td>
                    <td>' . $studentInfo["Major"] . '</td>
                    <td>' . $studentInfo["Minor1"] . '</td>
                    <td>' . $studentInfo["Minor2"] . '</td>
                </tr>';
                  

                  echo '<tr>
                      <th>Expected Graduation Year</th>
                      <th>School</th>
                      <th>Classification</th>
                      <th>Phone</th>
                      <th>Student Type</th>
                  </tr>';

                  echo'<tr> 
                    <td>' . $studentInfo["Expected_Graduation"] . '</td>
                    <td>' . $studentInfo["School"] . '</td> 
                    <td>' . $studentInfo["Classification"] . '</td> 
                    <td>' . $studentInfo["Phone"] . '</td> 
                    <td>' . $studentInfo["Student_Type"] . '</td> 
                </tr>';
              }
              ?>
        </div>
    </div>

<!-- Close body and HTML tags -->
</body>
</html>
