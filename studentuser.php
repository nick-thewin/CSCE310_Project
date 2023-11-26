<?php
  include_once('header.php');
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>
  <!-- Include your stylesheets or additional head content here -->
</head>
<body>

<h3>Change Login Credentials:</h3>
<form action="includes/user.inc.php" method="post">
  <label for="New Username">New Username: </label><br>
  <input type="text" id="username" name="username"><br>
  <label for="New Password">New Password: </label><br>
  <input type="text" id="password" name="password"><br>
  <button type="updatelogin" name="updatelogin">Submit</button>
</form>

<?php
  if(isset($_GET["error"])){
    if($_GET["error"] == "stmtfailed"){
      echo "<p>Something failed, try again!</p>";
    }
    else if($_GET["error"] == "usernametaken"){
      echo "<p>Username is taken, try a new one!</p>";
    }
    else if($_GET["error"] == "emptyinput"){
      echo "<p>Fill in all fields!</p>";
    }
    else if($_GET["error"] == "changesuccess"){
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
  <button type="updateinfo" name="updateinfo">Submit</button>
</form>

<?php
  if(isset($_GET["error"])){
    if($_GET["error"] == "stmtfailed2"){
      echo "<p>Something failed, try again!</p>";
    }
    else if($_GET["error"] == "emptyinput2"){
      echo "<p>Fill in at least one of the fields!</p>";
    }
    else if($_GET["error"] == "updatesuccess"){
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
  if(isset($_GET["error"])){
    if($_GET["error"] == "stmtfailed3"){
      echo "<p>Something failed, try again!</p>";
    }
  }
?>

<?php
  // Display account information
  echo "<br><b>Account Information</b>";
  echo '<table> 
        <tr> 
            <th>UIN</th> 
            <th>First Name</th>
            <th>Middle Initial</th> 
            <th>Last Name</th> 
            <th>Username</th> 
            <th>Password</th>
            <th>User Type</th>
            <th>Email</th>
            <th>Discord Name</th>
        </tr>';

  if (!empty($accountInfo)) {
    echo '<tr> 
            <td>'.$accountInfo["UIN"].'</td> 
            <td>'.$accountInfo["First_Name"].'</td> 
            <td>'.$accountInfo["M_Initial"].'</td> 
            <td>'.$accountInfo["Last_Name"].'</td> 
            <td>'.$accountInfo["Username"].'</td>
            <td>'.$accountInfo["Passwords"].'</td>
            <td>'.$accountInfo["User_Type"].'</td>
            <td>'.$accountInfo["Email"].'</td>
            <td>'.$accountInfo["Discord_Name"].'</td>
          </tr>';
  }
?>

<!-- Close body and HTML tags -->
</body>
</html>
