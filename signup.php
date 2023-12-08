<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: Signup page for a new user to enter themselves into the system.

// Include necessary files
include_once 'includes/dbh.inc.php';

// Function to display and clear error messages
function displayAndClearError($errorType) {
    $errorMessages = [
        "emptyinput" => "Fill in all fields!",
        "usernametaken" => "The entered username is already taken, you need to create a new one.",
        "signupsuccess" => "Your account has been successfully created. <br><a href='login.php'>Please login here</a>",
        "stmtfailed" => "Something went wrong, try again"
    ];

    $fullErrorType = isset($_GET["error"]) ? $_GET["error"] : "";

    if (!empty($fullErrorType) && isset($errorMessages[$fullErrorType])) {
        echo "<p>{$errorMessages[$fullErrorType]}</p>";
        unset($_GET["error"]); // Clear the error to avoid persistence
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Sign Up</title>
    <link href="style.php" rel="stylesheet">
</head>

<body>

    <!-- This portion demonstrates part of my table "Insert" Query 
     It allows users to create their own accounts and fill in their user table details-->
    <h2>New User Sign Up:</h2>
    <form action="includes/signup.inc.php" method="post">
        <label>First Name: </label>
        <label class="required">Required</label><br>
        <input type="text" name="FName"><br>

        <label>Middle Initial: </label>
        <label class="required">Required</label><br>
        <input type="text" maxlength="1" name="MI"><br>

        <label>Last Name: </label>
        <label class="required">Required</label><br>
        <input type="text" name="LName"><br>

        <label>Username: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Username"><br>

        <label>Password: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Password"><br>

        <label>User Type: </label>
        <label class="required">Required</label><br>
        <select id="userType" name="userType">
            <option value="Student">College Student</option>
            <option value="Other">Other</option>
        </select><br>

        <label>Email: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Email"><br>

        <label>Discord: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Discord"><br>

        <br>
        <button type="createAccount" name="createAccount">Create Account</button>

    </form>

    <h3>Back to Home</h3>
    <a href='index.php'>Home</a>

    <?php displayAndClearError("createaccount"); ?>

</body>
</html>
