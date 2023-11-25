<?php
	include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h2>New User Sign Up:</h2>
        <form action = "includes/signup.inc.php" method = "post">
            <input type = "text" name = "FName" placeholder = "First Name"><br>
            <input type = "text" maxlength = "1" name = "MI" placeholder = "Middle Initial"><br>
            <input type = "text" name = "LName" placeholder = "Last Name"><br>
            <input type = "text" name = "Username" placeholder = "Username"><br>
            <input type = "text" name = "Password" placeholder = "Password"><br>
            <label for="userType">I am a:</label>
            <select id="userType" name="userType">
                <option value="Student">College Student</option>
                <option value="Highschool">High School</option>
                <option value="Other">Other</option>
            </select><br>
            <input type = "text" name = "Email" placeholder = "Email"><br>
            <input type = "text" name = "Discord" placeholder = "Discord"><br>
            <button type = "createAccount" name = "createAccount">Create Account</button>
        </form>

        <h3>Back to Home</h3>
        <a href='index.php'>Home</a>

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