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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate_program_report"])) {
  // Process form data
  $programNum = isset($_POST["Program_Num"]) ? $_POST["Program_Num"] : '';

  // Validate or sanitize input if needed

  // Retrieve data from the database
  $sql = "SELECT Name, Description FROM programs WHERE Program_Num = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $programNum);
  $stmt->execute();
  $stmt->bind_result($name, $description);
  $stmt->fetch();
  $stmt->close();

  // Generate the report
  $report = "Program Number: $programNum<br>";
  $report .= "Name: $name<br>";
  $report .= "Description: $description";

  // Display the report on the screen
  echo "<h3>Generated Program Report</h3>";
  echo '<div style="border: 1px solid #ccc; padding: 15px; margin: 20px; max-width: 400px;">';
  echo "<p><strong>Program Number:</strong> $programNum</p>";
  echo "<p><strong>Name:</strong> $name</p>";
  echo "<p><strong>Description:</strong> $description</p>";
  echo '</div>';
  echo '<button style="margin-top: 10px;" onclick="history.go(-1);">Back</button>';
}


if (isset($_POST['delete_program_data'])) {
    $programNum = $_POST['Program_Num'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "DELETE FROM `programs` WHERE `Program_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $programNum);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Program deleted successfully";
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

