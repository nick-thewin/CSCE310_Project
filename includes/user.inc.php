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

// Function to handle deactivating the account.
function deactivateAccount(){
    // Start output buffering
    ob_start();

    // Update user type to 'Deactivated'
    updateUserData('User_Type', 'Deactivated');

    // Redirect to index with deactivation message
    redirectToIndex("error=accountdeactivated");

    // Clear session
    session_unset();

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

    $sql = "UPDATE `user` SET `$field` = ? WHERE `user` . `UIN` = " . $_SESSION["userid"] . ";";
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

    mysqli_stmt_bind_param($stmt, $dataType, $value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Redirects to studentuser.php with the specified error message.
function redirectToStudentUser($errorMessage){
    header("location: ../studentuser.php?$errorMessage");
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
} elseif (isset($_POST['deactivate'])) {
    deactivateAccount();
}
?>
