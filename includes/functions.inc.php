<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: Functions used for login and signup.

session_start();
include_once 'dbh.inc.php';

// checks to see if the username exists already, error sent to login
function usernameExists($conn, $username){
    $sql = 'SELECT * FROM user WHERE Username = ?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// checks to make sure that the input is not empty during login
function emptyInputLogin($username, $password) {
    return empty($username) || empty($password);
}

// function to login the user
function loginUser($conn, $username, $password){
    $usernameExists = usernameExists($conn, $username);

    if($usernameExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $userPassword = $usernameExists["Passwords"];
    if($usernameExists["User_Type"] === "Deactivated"){
        header("location: ../login.php?error=deactivatedaccount");
        exit();
    }
    
    $result;
    if(strcmp($userPassword, $password) !== 0){
        $result = true;
    }
    else{
        $result = false;
    }
    

    if($result === true){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else{
        session_start();
        $_SESSION["userid"] = $usernameExists["UIN"];
        $_SESSION["userName"] = $usernameExists["First_Name"];
        $_SESSION["userLast"] = $usernameExists["Last_Name"];
        $_SESSION["userPerm"] = $usernameExists["User_Type"];
        header("location: ../index.php");
        exit();
    }

}

// function to check that signup input is not empty
function emptyInputSignup($Fname, $MI, $LName, $Username, $Password, $userType, $Email, $Discord){
    return empty($Fname) || empty($MI) || empty($LName) || empty($Username) || empty($Password) || empty($Email) || empty($Discord);
}

// function to create a new user in the database
function createUser($conn, $FName, $MI, $LName, $Username, $Password, $userType, $Email, $Discord){
    
    $sql = 'INSERT INTO user(First_Name, M_Initial, Last_Name, Username, Passwords, User_Type, Email, Discord_Name) VALUES (?,?,?,?,?,?,?,?)';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss", $FName, $MI, $LName, $Username, $Password, $userType, $Email, $Discord);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if($userType === "Student"){
        session_start();
        $_SESSION["Username"] = $Username;
        header("location: ../studentsignup.php");
        exit();
    }
    if($_SESSION["userType"] = "Admin"){
        header("location: ../adminuser.php?error=admincreated");
        exit();
    }
    else{
        header("location: ../signup.php?error=signupsuccess");
        exit();
    }
}

// function that checks if the uin exists in the system
function uinExists($conn, $UIN){
    $sql = 'SELECT * FROM user WHERE UIN = ?;';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $UIN);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        $result = true;
        return $result;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}