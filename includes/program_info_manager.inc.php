<?php 
require_once 'dbh.inc.php';

if(isset($_POST['insert_program'])){
    $programName = $_POST['Program_Name'];
    $programDesc = $_POST['Program_Desc'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "INSERT INTO `programs`(`Name`, `Description`) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $programName, $programDesc);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Program inserted successfully";
            header("Location: ../program_info_manager.php");
            exit();
        } else {
            // Error
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    } else {
        // Error preparing statement
        echo "Error: " . mysqli_error($conn);
    }
}
if(isset($_POST['edit_program'])){
    $programNum = $_POST['Program_Num'];
    $programName = $_POST['Program_Name'];
    $programDesc = $_POST['Program_Desc'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "UPDATE `programs` SET `Name`=?,`Description`=? WHERE `Program_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $programName, $programDesc, $programNum);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Program updated successfully";
            header("Location: ../program_info_manager.php");
            exit();
        } else {
            // Error
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    } else {
        // Error preparing statement
        echo "Error: " . mysqli_error($conn);
    }
}
?>

