<?php 
// Author: Hunter Pearson
// UIN: 23005050
// Description: File that has login functionality.

// signs in the user
if(isset($_POST["signin"])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $password) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();

    }
    
    loginUser($conn, $username, $password);
}

// sends back to login page
else {
    header("location: ../login.php");
    exit();
}
