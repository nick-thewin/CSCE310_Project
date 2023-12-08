<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: User authentication and roles on the student side.

// Note: For "Insert" table query, it is located in signup.php and studentsignup.php
// This was the design decision because a student has to be logged in to view this studentuser page,
// and the signup page is available on the home screen of the website

// Include necessary files
include_once 'header.php';
include_once 'includes/dbh.inc.php';

// Function to display and clear error messages
function displayError($errorType){
    $errorMessages = [
        "updatelogin" => [
            "stmtfailed" => "Something failed, try again!",
            "usernametaken" => "Username is taken, try a new one!",
            "emptyinput" => "Fill in all fields!",
            "changesuccess" => "Login Credentials have been successfully changed!",
        ],
        "updateinfo" => [
            "stmtfailed2" => "Something failed, try again!",
            "emptyinput2" => "Fill in at least one of the fields!",
            "updatesuccess" => "Personal information has been successfully changed!",
        ],
        "deactivate" => [
            "stmtfailed3" => "Something failed, try again!",
        ],
    ];

    if (isset($_GET["error"]) && isset($errorMessages[$errorType][$_GET["error"]])) {
        echo "<p>{$errorMessages[$errorType][$_GET["error"]]}</p>";
    }
}

// Retrieve account information from view
$query = "SELECT * FROM user_college_info WHERE UIN = ?";
$accountInfo = [];

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $_SESSION["userid"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $accountInfo = $result->fetch_assoc();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
</head>

<body>
    <div class="container">
        <div class="column1">

            <!-- This portion demonstrates part of my table "Update" Query 
                 It allows a user to change their login credentials-->
            <h3>Change Login Credentials:</h3>
            <form action="includes/user.inc.php" method="post">

                <label for="New Username">New Username: </label>
                <label class="required">Required</label><br>
                <input type="text" id="username" name="username"><br>

                <label for="New Password">New Password: </label>
                <label class="required">Required</label><br>
                <input type="text" id="password" name="password"><br>

                <button type="updatelogin" name="updatelogin">Submit</button>
            </form>

            <?php displayError("updatelogin"); ?>

            <br>

            <!-- This portion demonstrates part of my table "Update" Query 
                 It allows a user to update their personal information-->
            <h3>Update Personal Information:</h3>
            <form action="includes/user.inc.php" method="post">

                <label for="Email">Email: </label><br>
                <input type="text" id="email" name="email"><br>

                <label for="Discord Name">Discord Name: </label><br>
                <input type="text" id="discord_name" name="discord_name"><br>

                <?php if ($_SESSION["userPerm"] === "Student") : ?>
                    <label for="gender">Gender:</label><br>
                    <input type="text" id="gender" name="gender"><br>

                    <label for="gpa">GPA:</label><br>
                    <input type="float" id="gpa" name="gpa" step="any"><br>

                    <label for="major">Major:</label><br>
                    <input type="text" id="major" name="major"><br>

                    <label for="minor1">Minor 1:</label><br>
                    <input type="text" id="minor1" name="minor1"><br>

                    <label for="minor2">Minor 2:</label><br>
                    <input type="text" id="minor2" name="minor2"><br>

                    <label for="grad">Anticipated Graduation Year:</label><br>
                    <input type="number" id="grad" name="grad" min="2023" max="2099"><br>

                    <label for="school">School:</label><br>
                    <input type="text" id="school" name="school"><br>

                    <label for="classification">Classification:</label><br>
                    <input type="text" id="classification" name="classification"><br>

                    <label for="phone">Phone Number:</label><br>
                    <input type="number" id="phone" name="phone"><br>

                    <label for="studenttype">Type of Student:</label><br>
                    <input type="text" id="studenttype" name="studenttype"><br>

                <?php endif; ?>

                <button type="updateinfo" name="updateinfo">Submit</button>
            </form>

            <?php displayError("updateinfo"); ?>

            <br>

            <!-- This portion demonstrates my table "Delete" Query 
                 It allows a user to deactivate their account (note: it will not actually delete the user and their information, which is the intended result)-->
            <h3>DEACTIVATE ACCOUNT:</h3>
            <form action="includes/user.inc.php" method="post">
                <label>WARNING: PRESSING BUTTON WILL DEACTIVATE ACCOUNT!!<br></label>
                <button type="deactivate" name="deactivate">DEACTIVATE ACCOUNT</button>
            </form>

            <?php displayError("deactivate"); ?>
        </div>

        <!-- This portion demonstrates table "Select" Query 
             It displays the users profile information upon entering the page-->
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
                          <th>Discord Name</th>';

                if ($_SESSION["userPerm"] === "Student") {
                    echo '<th>Gender</th>
                          <th>Hispanic / Latino</th> 
                          <th>U.S. Citizen</th>';
                }

                echo '</tr>';

                echo '<tr> 
                      <td>' . $accountInfo["UIN"] . '</td> 
                      <td>' . $accountInfo["First_Name"] . '</td> 
                      <td>' . $accountInfo["Middle_Initial"] . '</td> 
                      <td>' . $accountInfo["Last_Name"] . '</td> 
                      <td>' . $accountInfo["Username"] . '</td>
                      <td>' . $accountInfo["Password"] . '</td>
                      <td>' . $accountInfo["Email"] . '</td>
                      <td>' . $accountInfo["Discord_Name"] . '</td>';

                if ($_SESSION["userPerm"] === "Student") {
                    echo '<td>' . $accountInfo["Gender"] . '</td>
                          <td>' . $accountInfo["Hispanic_Latino"] . '</td>
                          <td>' . $accountInfo["Race"] . '</td>';
                }

                echo '</tr>';

                if ($_SESSION["userPerm"] === "Student") {
                    echo '<tr>
                            <th>U.S. Citizen</th> 
                            <th>First Generation</th>
                            <th>GPA</th>
                            <th>Major</th>
                            <th>Minor 1</th>
                            <th>Minor 2</th>
                            <th>Anticipated Graduation Year</th>
                            <th>School</th>
                            <th>Classification</th>
                            <th>Phone</th>
                            <th>Student Type</th>
                        </tr>';

                    echo '<tr>
                            <td>' . $accountInfo["U_S_Citizen"] . '</td>
                            <td>' . $accountInfo["First_Generation"] . '</td>
                            <td>' . $accountInfo["GPA"] . '</td>
                            <td>' . $accountInfo["Major"] . '</td>
                            <td>' . $accountInfo["Minor1"] . '</td>
                            <td>' . $accountInfo["Minor2"] . '</td>
                            <td>' . $accountInfo["Expected_Graduation"] . '</td>
                            <td>' . $accountInfo["School"] . '</td>
                            <td>' . $accountInfo["Classification"] . '</td>
                            <td>' . $accountInfo["Phone"] . '</td>
                            <td>' . $accountInfo["Student_Type"] . '</td>
                        </tr>';
                }
            }
            ?>
        </div>
    </div>

</body>
</html>
