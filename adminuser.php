<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

// Retrieve account information
$query = "SELECT * FROM user;";
$adminInfo = [];
$i = 0;
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $adminInfo[$i] = $row;
        $i++;
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
            max-height: 4000px;
            overflow: auto;
            width: 25%;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .column2 {
            max-height: 500px;
            overflow: auto;
            width: 70%;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column1">
        <h3>Update User Role:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="uin">UIN: </label><br>
              <input type="number" id="uin" name="uin"><br>
              <label for="role">Role: </label><br>
              <input type="text" id="role" name="role"><br>
              <button type="updaterole" name="updaterole">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in both fields!</p>";
                } else if ($_GET["error"] == "changesuccess") {
                    echo "<p>Role has been successfully changed!</p>";
                } else if ($_GET["error"] == "nomatchinguin") {
                    echo "<p>The given UIN does not exist!</p>";
                }
            }
            ?>

        <h3>Update User Details:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="UIN">UIN: </label><br>
              <input type="text" id="uin" name="uin"><br>
              <label for="first">First Name: </label><br>
              <input type="text" id="first" name="first"><br>
              <label for="middle">Middle Initial: </label><br>
              <input type="text" maxlength = "1" id="middle" name="middle"><br>
              <label for="last">Last Name: </label><br>
              <input type="text" id="last" name="last"><br>
              <label for="Email">Email: </label><br>
              <input type="text" id="email" name="email"><br>
              <label for="Discord Name">Discord Name: </label><br>
              <input type="text" id="discord_name" name="discord_name"><br>
              <button type="updateUser" name="updateUser">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "emptyuin") {
                    echo "<p>Fill in the UIN for the user you wish to update!</p>";
                } else if ($_GET["error"] == "emptyinput2") {
                    echo "<p>Fill in all fields!</p>";
                } else if ($_GET["error"] == "infosuccess") {
                    echo "<p>That user's information has been successfully changed!</p>";
                } else if ($_GET["error"] == "nomatchinguin2") {
                    echo "<p>The given UIN does not exist!</p>";
                }
            }
            ?>

        <h3>Remove Access:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="uin">UIN: </label><br>
              <input type="number" id="uin" name="uin"><br>
              <button type="removeaccess" name="removeaccess">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "emptyinput3") {
                    echo "<p>Fill in the UIN for the user you wish to update!</p>";
                } else if ($_GET["error"] == "accessremoved") {
                    echo "<p>The access for that user has been removed!</p>";
                } else if ($_GET["error"] == "nomatchinguin3") {
                    echo "<p>The given UIN does not exist!</p>";
                }
            }
            ?>

        <h3>Delete Account:</h3>
            <form action="includes/user.inc.php" method="post">
              <label for="uin">UIN: </label><br>
              <input type="number" id="uin" name="uin"><br>
              <button type="deleteaccount" name="deleteaccount">Submit</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something failed, try again!</p>";
                } else if ($_GET["error"] == "emptyinput4") {
                    echo "<p>Fill in the UIN for the user you wish to update!</p>";
                } else if ($_GET["error"] == "accountdeleted") {
                    echo "<p>That users account and all of the information has been deleted!</p>";
                } else if ($_GET["error"] == "nomatchinguin4") {
                    echo "<p>The given UIN does not exist!</p>";
                }
                
            }
            ?>
        

        </div>
        <div class="column2">
          <?php
              // Display account information
              echo "<br><b>Account Information</b>";
              if (!empty($adminInfo)) {
                  echo '<table> 
                      <tr> 
                          <th>UIN</th> 
                          <th>First</th>
                          <th>M</th> 
                          <th>Last</th> 
                          <th>Role</th>
                          <th>Email</th>
                          <th>Discord</th>                          
                      </tr>';

                  for($x = 0; $x < $i; $x++){
                    echo '<tr> 
                      <td>' . $adminInfo[$x]["UIN"] . '</td> 
                      <td>' . $adminInfo[$x]["First_Name"] . '</td> 
                      <td>' . $adminInfo[$x]["M_Initial"] . '</td> 
                      <td>' . $adminInfo[$x]["Last_Name"] . '</td> 
                      <td>' . $adminInfo[$x]["User_Type"] . '</td>
                      <td>' . $adminInfo[$x]["Email"] . '</td>
                      <td>' . $adminInfo[$x]["Discord_Name"] . '</td>
                    </tr>';
                  }
                  
              }
              ?>
        </div>
    </div>

<!-- Close body and HTML tags -->
</body>
</html>
