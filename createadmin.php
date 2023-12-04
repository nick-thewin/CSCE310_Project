<?php
	include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';
    include_once 'includes/signup.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 1;
            padding: 0;
            box-sizing: border-box;
        }

        .required {
            font-size: 11px;
            color: red;
        }
    </style>
</head>
<body>
        <h2>Create Admin:</h2>
        <form action = "includes/signup.inc.php" method = "post">
            <label>First Name: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "FName"><br>
            <label>Middle Initial: </label>
            <label class = "required">Required</label><br>
            <input type = "text" maxlength = "1" name = "MI"><br>
            <label>Last Name: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "LName"><br>
            <label>Username: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "Username"><br>
            <label>Password: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "Password"><br>
            <label>Email: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "Email"><br>
            <label>Discord: </label>
            <label class = "required">Required</label><br>
            <input type = "text" name = "Discord"><br>
            <button type = "createAdmin" name = "createAdmin">Create Admin</button>
        </form>

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }
                else if($_GET["error"] == "usernametaken"){
                    echo "<p>The entered username is already taken, you need to create a new one.</p>";
                }
                else if($_GET["error"] == "signupsuccess"){
                    echo "<p>Your account has been successfully created.
                          <br><a href = 'login.php'> Please login here</a></p>";
                }
                else if($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again</p>";
                }
            }
        ?>


</body>
</html>