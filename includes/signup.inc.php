<?php 

if(isset($_POST["createAccount"])){

    $FName = $_POST["FName"];
    $MI = $_POST["MI"];
    $LName = $_POST["LName"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $userType = $_POST["userType"];
    $Email = $_POST["Email"];
    $Discord = $_POST["Discord"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($FName, $MI, $LName, $Username, $Password, $userType, $Email, $Discord) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    
    if(usernameExists2($conn,$Username) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $FName, $MI, $LName, $Username, $Password, $userType, $Email, $Discord);

}