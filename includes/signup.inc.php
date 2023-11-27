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

function handleEmptyValue($value, $conn) {
    if ($value === "") {
        return NULL;
    } else {
        return mysqli_real_escape_string($conn, $value);
    }
}

if (isset($_POST["addInfo"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $Username = $_SESSION["Username"];

    $UIN;

    $sql = 'SELECT UIN FROM user WHERE Username = ?';
    $stmt = mysqli_stmt_init($conn);
        

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $Username);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
            
        $row = mysqli_fetch_assoc($resultData);    
        $UIN = $row['UIN'];
    }

    

    $sql = "UPDATE collegestudent
            SET 
                `Gender` = ?,
                `Hispanic/Latino` = ?,
                `Race` = ?,
                `U.S._Citizen` = ?,
                `First_Generation` = ?,
                `DOB` = ?,
                `GPA` = ?,
                `Major` = ?,
                `Minor1` = ?,
                `Minor2` = ?,
                `Expected_Graduation` = ?,
                `School` = ?,
                `Classification` = ?,
                `Phone` = ?,
                `Student_Type` = ?
            WHERE UIN = ?";

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        $gender = handleEmptyValue($_POST["gender"], $conn);
        $hispanic = isset($_POST['hispanic']) ? 1 : 0;
        $race = handleEmptyValue($_POST["race"], $conn);
        $citizen = isset($_POST['citizen']) ? 1 : 0;
        $firstgen = isset($_POST['firstgen']) ? 1 : 0;
        $dob = handleEmptyValue($_POST["dob"], $conn);
        $gpa = handleEmptyValue($_POST["gpa"], $conn);
        $major = handleEmptyValue($_POST["major"], $conn);
        $minor1 = handleEmptyValue($_POST["minor1"], $conn);
        $minor2 = handleEmptyValue($_POST["minor2"], $conn);
        $grad = handleEmptyValue($_POST["grad"], $conn);
        $school = handleEmptyValue($_POST["school"], $conn);
        $classification = handleEmptyValue($_POST["classification"], $conn);
        $phone = handleEmptyValue($_POST["phone"], $conn);
        $studenttype = handleEmptyValue($_POST["studenttype"], $conn);
        mysqli_stmt_bind_param(
            $stmt,
            "sisiisdssdsssisi",
            $gender,
            $hispanic,
            $race,
            $citizen,
            $firstgen,
            $dob,
            $gpa,
            $major,
            $minor1,
            $minor2,
            $grad,
            $school,
            $classification,
            $phone,
            $studenttype,
            $UIN
        );
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../index.php?error=accountcreated");
    }
}