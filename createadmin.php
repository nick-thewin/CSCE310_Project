<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: Page for the creation of a new admin

// Include necessary files
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';
include_once 'includes/signup.inc.php';

// Function to display and clear error messages
function displayError($errorType) {
    $errorMessages = [
        "emptyinput" => "Fill in all fields!",
        "usernametaken" => "The entered username is already taken, you need to create a new one.",
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
    <title>Create Admin</title>
    <link href="style.php" rel="stylesheet">
</head>

<body>

    <!-- This portion demonstrates part of my table "Insert" Query 
         It allows an administrator to create another new administrator with the admin role-->
    <h2>Create Admin:</h2>
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
        <label>Email: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Email"><br>
        <label>Discord: </label>
        <label class="required">Required</label><br>
        <input type="text" name="Discord"><br>
        <button type="createAdmin" name="createAdmin">Create Admin</button>
    </form>

    <?php displayError("createadmin"); ?>

</body>
</html>