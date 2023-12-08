<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: Another signup page, specifically when they sign up as a college student to fill in the collegestudent table details.

// Include necessary files
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

// Function to handle updating login credentials.
function updateLoginCredentials(){
    // Start output buffering
    ob_start();

    // Extract POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (emptyInputLogin($username, $password) !== false) {
        redirectToStudentUser("error=emptyinput");
    }

    // Check if the username is taken
    if (isUsernameTaken($username)) {
        redirectToStudentUser("error=usernametaken");
    }

    // Update username
    updateUserData('Username', $username);

    // Update password
    updateUserData('Passwords', $password);

    // Redirect with success message
    redirectToStudentUser("error=changesuccess");

    // End output buffering
    ob_end_flush();
}

// Function to handle updating user information.
function updateUserInfo(){
    // Start output buffering
    ob_start();

    // Extract POST data
    $email = $_POST['email'];
    $discord = $_POST['discord_name'];
    $gender = $_POST['gender'];
    $gpa = $_POST['gpa'];
    $major = $_POST['major'];
    $minor1 = $_POST['minor1'];
    $minor2 = $_POST['minor2'];
    $grad = $_POST['grad'];
    $school = $_POST['school'];
    $classification = $_POST['classification'];
    $phone = $_POST['phone'];
    $type = $_POST['studenttype'];

    // Validate input
    if (emptyUserInfoInput($email, $discord, $gender, $gpa, $major, $minor1, $minor2, $grad, $school, $classification, $phone, $type)) {
        redirectToStudentUser("error=emptyinput2");
    }

    // Update email
    if(!empty($email)){
        updateUserData('Email', $email);
    }
    
    // Update Discord name
    if(!empty($discord)){
        updateUserData('Discord_Name', $discord);
    }

    // Update gender
    if(!empty($gender)){
        updateCollegeStudentData('Gender', $gender);
    }

    // Update GPA
    if(!empty($gpa)){
        updateCollegeStudentData('GPA', $gpa);
    }

    // Update major
    if(!empty($major)){
        updateCollegeStudentData('Major', $major);
    }
    
    // Update minor1
    if(!empty($minor1)){
        updateCollegeStudentData('Minor1', $minor1);
    }
    

    // Update minor2
    if(!empty($minor2)){
        updateCollegeStudentData('Minor2', $minor2);
    }
    
    // Update graduation year
    if(!empty($grad)){
        updateCollegeStudentData('Expected_Graduation', $grad);
    }
    
    // Update school
    if(!empty($school)){
        updateCollegeStudentData('School', $school);
    }
    
    // Update classification
    if(!empty($classification)){
        updateCollegeStudentData('Classification', $classification);
    }
    
    // Update phone
    if(!empty($phone)){
        updateCollegeStudentData('Phone', $phone);
    }
    
    // Update student type
    if(!empty($type)){
        updateCollegeStudentData('Student_Type', $type);
    }
    
    // Redirect with success message
    redirectToStudentUser("error=updatesuccess");

    // End output buffering
    ob_end_flush();
}

// Function to handle updating user information.
function adminUpdate(){
    // Start output buffering
    ob_start();

    // Extract POST data
    $UIN = $_POST['uin'];
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $discord = $_POST['discord_name'];

    // Validate input
    if (emptyAdminInput($UIN, $first, $middle, $last, $email, $discord)) {
        redirectToAdminUser("error=emptyinput2");
    }
    
    // Update first name
    if(!empty($first)){
        updateUserData('First_Name', $first);
    }

    // Update middle initial
    if(!empty($middle)){
        updateUserData('M_Initial', $middle);
    }

    // Update last name
    if(!empty($last)){
        updateUserData('Last_Name', $last);
    }

    // Update email
    if(!empty($email)){
        updateUserData('Email', $email);
    }

    // Update discord
    if(!empty($discord)){
        updateUserData('Discord_Name', $discord);
    }

    // Redirect with success message
    redirectToAdminUser("error=infosuccess");

    // End output buffering
    ob_end_flush();
}

// Function to handle deactivating the account.
function updateRole($role, $msg){
    // Start output buffering
    ob_start();

    // Update user type to role
    updateUserData('User_Type', $role);

    // Redirect to index with deactivation message
    if($_SESSION['userPerm'] === "Admin"){
        redirectToAdminUser($msg);
    }
    else{
        session_unset();
        redirectToIndex("error=accountdeactivated");
    }

    // End output buffering
    ob_end_flush();
}

// Function to handle deleting the user account.
function deleteAccount() {
    global $conn;
    // Start output buffering
    ob_start();

    // Get the user's UIN from the session
    $uin = $_POST["uin"];

    // Delete the user from the 'user' table
    $sqlUser = "DELETE FROM `user` WHERE `UIN` = ?";
    $stmtUser = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtUser, $sqlUser)) {
        redirectToStudentUser("error=stmtfailed");
    }

    mysqli_stmt_bind_param($stmtUser, "i", $uin);
    mysqli_stmt_execute($stmtUser);
    mysqli_stmt_close($stmtUser);

    // Redirect to index with deletion message
    redirectToAdminUser("error=accountdeleted");

    // End output buffering
    ob_end_flush();
}

// Function to check if a username is already taken.
function isUsernameTaken($username){
    global $conn;

    $sql = 'SELECT * FROM user WHERE Username = ?;';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultData) !== null;
}

// Updates user data in the database.
function updateUserData($field, $value){
    global $conn;

    $uin = $_SESSION['userid'];

    if($_SESSION['userPerm'] === "Admin"){
        $uin = $_POST["uin"];
    }

    $sql = "UPDATE `user` SET `$field` = ? WHERE `user` . `UIN` = " . $uin . ";";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        redirectToStudentUser("error=stmtfailed");
    }

    mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Function to check if input is empty
function emptyUserInfoInput($email, $discord, $gender, $gpa, $major, $minor1, $minor2, $grad, $school, $classification, $phone, $type){
    return empty($email) && empty($discord) && empty($gender) && empty($gpa) && empty($major) && empty($minor1)
        && empty($minor2) && empty($grad) && empty($school) && empty($classification) && empty($phone) && empty($type);
}

function emptyAdminInput($UIN, $first, $middle, $last, $email, $discord){
    return empty($UIN) && empty($first) && empty($middle) && empty($last) && empty($email) && empty($discord);
}

// Updates college student data in the database.
function updateCollegeStudentData($field, $value){
    global $conn;

    $sql = "UPDATE `collegestudent` SET `$field` = ? WHERE `collegestudent` . `UIN` = " . $_SESSION["userid"] . ";";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        redirectToStudentUser("error=stmtfailed");
    }

    // Use appropriate data type for binding
    $dataType = is_numeric($value) ? "i" : "s";

    if($field == "GPA"){
        $dataType = "s";
    }

    mysqli_stmt_bind_param($stmt, $dataType, $value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Redirects to studentuser.php with the specified error message.
function redirectToStudentUser($errorMessage){
    header("location: ../studentuser.php?$errorMessage");
    exit();
}

function redirectToAdminUser($errorMessage){
    header("location: ../adminuser.php?$errorMessage");
    exit();
}

// Redirects to index.php with the specified error message.
function redirectToIndex($errorMessage){
    header("location: ../index.php?$errorMessage");
    exit();
}

// Checks which form is submitted and call the corresponding function
if (isset($_POST['updatelogin'])) {
    updateLoginCredentials();
} elseif (isset($_POST['updateinfo'])) {
    updateUserInfo();
} elseif (isset($_POST['updaterole'])) {
    $role = $_POST["role"];
    if(empty($_POST['uin'])){
        redirectToAdminUser("error=emptyinput");
    }
    else{
        updateRole($role, "error=updatesuccess");
    }
} elseif (isset($_POST['updateUser'])){
    if(empty($_POST['uin'])){
        redirectToAdminUser("error=emptyinput2");
    }
    else{
        adminUpdate();
    }
}elseif (isset($_POST['removeaccess'])) {
    $role = "Deactivated";
    if(empty($_POST['uin'])){
        redirectToAdminUser("error=emptyinput3");
    }
    else{
        updateRole($role, "error=accessremoved");
    }
} elseif(isset($_POST['deactivate'])){
    updateRole("Deactivated", ".");
} elseif (isset($_POST['deleteaccount'])){
    if(empty($_POST['uin'])){
        redirectToAdminUser("error=emptyinput4");
    }
    else{
        deleteAccount();
    }
}
?>
