<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: Another signup page, specifically when they sign up as a college student to fill in the collegestudent table details.

// Include necessary files
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';
include_once 'includes/signup.inc.php';

// Function to display and clear error messages
function displayError($errorType) {
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
    <title>Add Personal Information</title>
    <link href="style.php" rel="stylesheet">
</head>

<body>

    <!-- This portion demonstrates part of my table "Insert" Query 
     It allows a student user to insert details into their corresponding collegestudent table-->
    <h2>Add Personal Information:</h2>
    <form action="includes/signup.inc.php" method="post">
        <label for="gender">Gender:</label><br>
        <input type="text" name="gender"><br>

        <label for="hispanic">Are you Hispanic/Latino:</label>
        <input type="checkbox" id="hispanic" name="hispanic" value="1"><br>

        <label for="race">Race:</label><br>
        <input type="text" name="race"><br>

        <label for="citizen">Are you a U.S. Citizen:</label>
        <input type="checkbox" id="citizen" name="citizen" value="1"><br>

        <label for="firstgen">Are you a First Generation College Student:</label>
        <input type="checkbox" id="firstgen" name="firstgen" value="1"><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob"><br>

        <label for="gpa">GPA:</label><br>
        <input type="number" id="gpa" name="gpa" step="any"><br>

        <label for="major">Major:</label><br>
        <input type="text" name="major"><br>

        <label for="minor1">Minor 1 (If applicable):</label><br>
        <input type="text" name="minor1"><br>

        <label for="minor2">Minor 2 (If applicable):</label><br>
        <input type="text" name="minor2"><br>

        <label for="grad">Anticipated Graduation Year:</label><br>
        <input type="number" id="grad" name="grad" min="2023" max="2099"><br>

        <label for="school">School:</label><br>
        <input type="text" name="school"><br>

        <label for="classification">Classification:</label><br>
        <input type="text" name="classification"><br>

        <label for="phone">Phone Number:</label><br>
        <input type="number" name="phone"><br>

        <label for="studenttype">Type of Student:</label><br>
        <input type="text" name="studenttype"><br>

        <br>
        <button type="addInfo" name="addInfo">Submit Personal Information</button>
        
    </form>

    <?php displayError("addinfo"); ?>

</body>
</html>
