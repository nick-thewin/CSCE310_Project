<?php

if(isset($_POST['updatelogin'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once '../studentuser.php';

    if (emptyInputLogin($username, $password) !== false) {
        header("location: ../studentuser.php?error=emptyinput");
        exit();
    }

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
        header("location: ../studentuser.php?error=usernametaken");
        exit();
    }
    else{
        
    }

    mysqli_stmt_close($stmt);

    $sql = 'UPDATE `user` SET `Username` = ? WHERE `user` . `UIN` = ' . $_SESSION["userid"] . ";";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = 'UPDATE `user` SET `Passwords` = ? WHERE `user` . `UIN` = ' . $_SESSION["userid"] . ";";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../studentuser.php?error=changesuccess");
    exit();

}

if(isset($_POST['updateinfo'])){

    $email = $_POST['email'];
    $discord = $_POST['discord_name'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once '../studentuser.php';

    if (empty($email) && empty($discord)) {
        header("location: ../studentuser.php?error=emptyinput2");
        exit();
    }

    if(!empty($email)){
        $sql = 'UPDATE `user` SET `Email` = ? WHERE `user` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($discord)){
        $sql = 'UPDATE `user` SET `Discord_Name` = ? WHERE `user` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $discord);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("location: ../studentuser.php?error=updatesuccess");
    exit();
}

if(isset($_POST['deactivate'])){


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once '../studentuser.php';

    $sql = 'UPDATE `user` SET `User_Type` = ? WHERE `user` . `UIN` = ' . $_SESSION["userid"] . ";";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed3");
        exit();
    }
    $type = "Deactivated";
    mysqli_stmt_bind_param($stmt, "s", $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=accountdeactivated");
    session_unset();
    exit();
}