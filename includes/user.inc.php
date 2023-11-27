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
    ob_start();

    $email = $_POST['email'];
    $discord = $_POST['discord_name'];
    $gpa = $_POST['gpa'];
    $major = $_POST['major'];
    $minor1 = $_POST['minor1'];
    $minor2 = $_POST['minor2'];
    $grad = $_POST['grad'];
    $school = $_POST['school'];
    $classification = $_POST['classification'];
    $phone = $_POST['phone'];
    $grad = $_POST['grad'];
    $type = $_POST['studenttype'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once '../studentuser.php';

    if (empty($email) && empty($discord) && empty($gpa) && empty($major) && empty($minor1) && empty($minor2) && empty($grad) && empty($school) && empty($classification) && empty($phone) && empty($grad) && empty($type)) {
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

    if(!empty($gpa)){
        $sql = 'UPDATE `collegestudent` SET `GPA` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $gpa);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($major)){
        $sql = 'UPDATE `collegestudent` SET `Major` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $major);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($minor1)){
        $sql = 'UPDATE `collegestudent` SET `Minor1` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $minor1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($minor2)){
        $sql = 'UPDATE `collegestudent` SET `Minor2` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $minor2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($grad)){
        $sql = 'UPDATE `collegestudent` SET `Expected_Graduation` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $grad);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($school)){
        $sql = 'UPDATE `collegestudent` SET `School` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $school);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($classification)){
        $sql = 'UPDATE `collegestudent` SET `Classification` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $classification);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($phone)){
        $sql = 'UPDATE `collegestudent` SET `Phone` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($type)){
        $sql = 'UPDATE `collegestudent` SET `Student_Type` = ? WHERE `collegestudent` . `UIN` = ' . $_SESSION["userid"] . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    header("location: ../studentuser.php?error=updatesuccess");
    exit();
    ob_end_flush();
}

if(isset($_POST['deactivate'])){
    ob_start();

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
    ob_end_flush();
}