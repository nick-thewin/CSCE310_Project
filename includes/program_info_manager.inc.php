<?php 
// Author: Nicholas Nguyen
// UIN: 630003713
// Description: This code is for the functionality of the Program Information Manager Section of the Admin Page


require_once 'dbh.inc.php';

// This function will occur when the button for inserting a program is clicked
if(isset($_POST['insert_program'])){
    $programName = $_POST['Program_Name'];
    $programDesc = $_POST['Program_Desc'];
    $programAccess = $_POST['User_Access'];

    // Insert into database
    $sql = "INSERT INTO `programs`(`Name`, `Description`, `User_Access`) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssi", $programName, $programDesc, $programAccess);
        // Execute statement
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

// This function will occur when the button to display program information to edit is clicked
if (isset($_GET['Program_Num'])) {
    $programNum = $_GET['Program_Num'];

    // Fetch data based on the provided Program_Num
    $sql = "SELECT * FROM programs WHERE Program_Num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $programNum);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return relevant data as JSON
        $response = array(
            'Name' => $row['Name'],
            'Description' => $row['Description'],
            'User_Access' => $row['User_Access']
        );

        echo json_encode($response);
    } 
}

// This function will occur when the button to edit program information is clicked
if(isset($_POST['edit_program'])){
    $programNum = $_POST['Program_Num'];
    $programName = $_POST['Program_Name_Edit'];
    $programDesc = $_POST['Program_Desc_Edit'];
    $userAccess = $_POST['User_Access_Edit'];
   
    // Insert into database
    $sql = "UPDATE `programs` SET `Name`=?,`Description`=?, `User_Access`=? WHERE `Program_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssii", $programName, $programDesc, $userAccess, $programNum);
        // Execute statement
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

// This function will occur when the button to generate a program report is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate_program_report"])) {
 // Process form data
 $programNum = isset($_POST["Program_Num"]) ? $_POST["Program_Num"] : '';

 // Retrieve data from the database
 $sql = "SELECT Name, Description, USER_Access FROM programs WHERE Program_Num = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s", $programNum);
 $stmt->execute();
 $stmt->bind_result($name, $description, $access);
 $stmt->fetch();
 $stmt->close();

 // Count occurrences in the track table
 $trackCountSql = "SELECT COUNT(*) AS trackCount FROM track WHERE Program_Num = ?";
 $trackCountStmt = $conn->prepare($trackCountSql);
 $trackCountStmt->bind_param("s", $programNum);
 $trackCountStmt->execute();
 $trackCountStmt->bind_result($trackCount);
 $trackCountStmt->fetch();
 $trackCountStmt->close();

 // Count occurrences in the event table
 $eventCountSql = "SELECT COUNT(*) AS eventCount FROM event WHERE Program_Num = ?";
 $trackCountStmt = $conn->prepare($eventCountSql);
 $trackCountStmt->bind_param("s", $programNum);
 $trackCountStmt->execute();
 $trackCountStmt->bind_result($eventCount);
 $trackCountStmt->fetch();
 $trackCountStmt->close();

 // Count occurrences in the cert_enrollment table
 $certCountSql = "SELECT COUNT(*) AS certCount FROM cert_enrollment WHERE Program_Num = ?";
 $trackCountStmt = $conn->prepare($certCountSql);
 $trackCountStmt->bind_param("s", $programNum);
 $trackCountStmt->execute();
 $trackCountStmt->bind_result($certCount);
 $trackCountStmt->fetch();
 $trackCountStmt->close();

 // Generate the report
 $report = "Program Number: $programNum<br>";
 $report .= "Name: $name<br>";
 $report .= "Description: $description";
 $report .= "User Access: $access<br>";
 $report .= "Students tracked in the program: $trackCount";
 $report .= "Number of events for the program: $eventCount";
 $report .= "Number of certifications for the program: $certCount";

 // Display the report on the screen
 echo "<h3>Generated Program Report</h3>";
 echo '<div style="border: 1px solid #ccc; padding: 15px; margin: 20px; max-width: 400px;">';
 echo "<p><strong>Program Number:</strong> $programNum</p>";
 echo "<p><strong>Name:</strong> $name</p>";
 echo "<p><strong>Description:</strong> $description</p>";
 echo "<p><strong>User Access:</strong> $access</p>";
 echo "<p><strong>Students tracked in the program:</strong> $trackCount</p>";
 echo "<p><strong>Number of events for the program:</strong> $eventCount</p>";
 echo "<p><strong>Number of certifications for the program:</strong> $certCount</p>";
 echo '</div>';
 echo '<button style="margin-top: 10px;" onclick="history.go(-1);">Back</button>';
}

// This function will occur when the button to delete a program is clicked
if (isset($_POST['delete_program_data'])) {
    $programNum = $_POST['Program_Num'];
    // Stores query to delete program
    $sql = "DELETE FROM `programs` WHERE `Program_Num`=?";
    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $programNum);
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
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

// This function will occur when the button to delete/change program access is clicked
if (isset($_POST['delete_program_access'])) {
    $programNum = $_POST['Program_Num'];
    $programAccess = $_POST['User_Access'];

    // Stores query to delete program
    $sql = "UPDATE `programs` SET `User_Access`=? WHERE `Program_Num`=?";
    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ii", $programAccess, $programNum);
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
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

