<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: User authentication and roles on the admin side.

// Include necessary files
include_once 'header.php';
include_once 'includes/dbh.inc.php';

// Function to display error messages
function displayError($errorType) {
    $errorMessages = [
        "admincreated_admincreated" => "New Admin has been created!",
        "updaterole_stmtfailed" => "Something failed, try again!",
        "updaterole_emptyinput" => "Fill in the UIN field!",
        "updaterole_updatesuccess" => "Role has been successfully changed!",
        "updaterole_nomatchinguin" => "The given UIN does not exist!",
        "updateUser_stmtfailed" => "Something failed, try again!",
        "updateUser_emptyuin" => "Fill in the UIN for the user you wish to update!",
        "updateUser_emptyinput2" => "Fill in all fields!",
        "updateUser_infosuccess" => "That user's information has been successfully changed!",
        "updateUser_nomatchinguin2" => "The given UIN does not exist!",
        "removeaccess_stmtfailed" => "Something failed, try again!",
        "removeaccess_emptyinput3" => "Fill in the UIN for the user you wish to update!",
        "removeaccess_accessremoved" => "The access for that user has been removed!",
        "removeaccess_nomatchinguin3" => "The given UIN does not exist!",
        "deleteaccount_stmtfailed" => "Something failed, try again!",
        "deleteaccount_emptyinput4" => "Fill in the UIN for the user you wish to update!",
        "deleteaccount_accountdeleted" => "That user's account and all information have been deleted!",
        "deleteaccount_nomatchinguin4" => "The given UIN does not exist!"
    ];

    $fullErrorType = $errorType . (isset($_GET["error"]) ? "_" . $_GET["error"] : "");
    
    if (!empty($_GET["error"]) && isset($errorMessages[$fullErrorType])) {
        echo "<p>{$errorMessages[$fullErrorType]}</p>";
        unset($_GET["error"]); // Clear the error to avoid persistence
    }
}

// Retrieve account information
$query = "SELECT UIN, First_Name, M_Initial, Last_Name, User_Type, Email, Discord_Name FROM user";
$adminInfo = [];
if ($result = $conn->query($query)) {
    $adminInfo = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
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

            <!-- This portion demonstrates part of my table "Insert" Query 
                 It allows an administrator to create another new administrator with the admin role-->
            <button class="create" onclick="window.location.href='createadmin.php'">Create New Admin</button>
            <?php displayError("admincreated"); ?>

            <!-- This portion demonstrates part of my table "Update" Query 
                 It gives the admin the option to modify the roles user types-->
            <h3>Update User Role:</h3>
            <form action="includes/user.inc.php" method="post">
                <label for="uin">UIN: </label>
                <label class="required">Required</label><br>
                <input type="number" id="uin" name="uin"><br>
                <label for="role">Role: </label><br>
                <select id="role" name="role">
                    <option value="Student">College Student</option>
                    <option value="Admin">Admin</option>
                    <option value="Other">Other</option>
                </select><br>
                <button type="updaterole" name="updaterole">Submit</button>
            </form>
            <?php displayError("updaterole"); ?>

            <!-- This portion demonstrates part of my table "Update" Query 
                 It gives the admin the option to modify the details of user types-->
            <h3>Update User Details:</h3>
            <form action="includes/user.inc.php" method="post">
                <label for="UIN">UIN: </label>
                <label class="required">Required</label><br>
                <input type="text" id="uin" name="uin"><br>
                <label for="first">First Name: </label><br>
                <input type="text" id="first" name="first"><br>
                <label for="middle">Middle Initial: </label><br>
                <input type="text" maxlength="1" id="middle" name="middle"><br>
                <label for="last">Last Name: </label><br>
                <input type="text" id="last" name="last"><br>
                <label for="Email">Email: </label><br>
                <input type="text" id="email" name="email"><br>
                <label for="Discord Name">Discord Name: </label><br>
                <input type="text" id="discord_name" name="discord_name"><br>
                <button type="updateUser" name="updateUser">Submit</button>
            </form>
            <?php displayError("updateUser"); ?>

            <!-- This portion demonstrates part of my table "Delete" Query 
                 Because there are two different kind of deletes, this one is the first kind, which simply removes access to the system-->
            <h3>Remove Access:</h3>
            <form action="includes/user.inc.php" method="post">
                <label for="uin">UIN: </label>
                <label class="required">Required</label><br>
                <input type="number" id="uin" name="uin"><br>
                <button type="removeaccess" name="removeaccess">Submit</button>
            </form>
            <?php displayError("removeaccess"); ?>

            <!-- This portion demonstrates part of my table "Delete" Query 
                 This is the second form of delete, which will fully delete an existing user-->
            <h3>Delete Account:</h3>
            <form action="includes/user.inc.php" method="post">
                <label for="uin">UIN: </label>
                <label class="required">Required</label><br>
                <input type="number" id="uin" name="uin"><br>
                <button type="deleteaccount" name="deleteaccount">Submit</button>
            </form>
            <?php displayError("deleteaccount"); ?>
        </div>

        <!-- This portion demonstrates my "Select" Query 
             It displays a table of all existing user types along with their name, role and contact information -->
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

                foreach ($adminInfo as $info) {
                    echo '<tr> 
                        <td>' . $info["UIN"] . '</td> 
                        <td>' . $info["First_Name"] . '</td> 
                        <td>' . $info["M_Initial"] . '</td> 
                        <td>' . $info["Last_Name"] . '</td> 
                        <td>' . $info["User_Type"] . '</td>
                        <td>' . $info["Email"] . '</td>
                        <td>' . $info["Discord_Name"] . '</td>
                    </tr>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
