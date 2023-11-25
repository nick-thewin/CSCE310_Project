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
        <h2>Existing User Login:</h2>
        <form action = "includes/login.inc.php" method = "post">
            <input type = "text" name = "username" placeholder = "Username">
            <input type = "text" name = "password" placeholder = "Password">
            <button type = "signin" name = "signin">Sign in </button>
        </form>

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill in all fields!</p>";
                }
                else if($_GET["error"] == "wronglogin"){
                    echo "<p>Incorrect Login information</p>";
                }
                else if($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again</p>";
                }
            }
        ?>


</body>
</html>