<!-- 
    Author: Nicholas Nguyen
    UIN: 630003713
    Description: This code is for the functionality of the Program Information Manager Section of the Admin Page
 -->

<?php 
require_once 'dbh.inc.php';

if(isset($_POST['insert_program'])){
    $programName = $_POST['Program_Name'];
    $programDesc = $_POST['Program_Desc'];
    $programAccess = $_POST['User_Access'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "INSERT INTO `programs`(`Name`, `Description`, `User_Access`) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $programName, $programDesc, $programAccess);

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

if (isset($_GET['Program_Num'])) {
    $programNum = $_GET['Program_Num'];

    // Fetch data based on the provided Program_Num
    $sql = "SELECT * FROM programs WHERE Program_Num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $programNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return relevant data as JSON
        $response = array(
            'Name' => $row['Name'],
            'Description' => $row['Description'],
            'User_Access' => $row['User_Access']
        );

        echo json_encode($response);
    } else {
        // Handle case when no data is found
        echo json_encode(array('error' => 'No data found for the given Program_Num'));
    }
} else {
    // Handle case when Program_Num is not provided
    echo json_encode(array('error' => 'Program_Num parameter is missing'));
}


if(isset($_POST['edit_program'])){
    $programNum = $_POST['Program_Num'];
    $programName = $_POST['Program_Name_Edit'];
    $programDesc = $_POST['Program_Desc_Edit'];
    $userAccess = $_POST['User_Access_Edit'];
    

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "UPDATE `programs` SET `Name`=?,`Description`=?, `User_Access`=? WHERE `Program_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssii", $programName, $programDesc, $userAccess, $programNum);

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
  $sql = "SELECT Name, Description, USER_Access FROM programs WHERE Program_Num = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $programNum);
  $stmt->execute();
  $stmt->bind_result($name, $description, $access);
  $stmt->fetch();
  $stmt->close();

  //Generate the report
    $report = "Program Number: $programNum<br>";
    $report .= "Name: $name<br>";
    $report .= "Description: $description";
    $report .= "User Access: $access";

    // Display the report on the screen
    echo "<h3>Generated Program Report</h3>";
    echo '<div style="border: 1px solid #ccc; padding: 15px; margin: 20px; max-width: 400px;">';
    echo "<p><strong>Program Number:</strong> $programNum</p>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p><strong>User Access:</strong> $access</p>";
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
if (isset($_POST['delete_program_access'])) {
    $programNum = $_POST['Program_Num'];
    $programAccess = $_POST['User_Access'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "UPDATE `programs` SET `User_Access`=? WHERE `Program_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $programAccess, $programNum);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Program access updated successfully";
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

