<?php 
// Author: Nicholas Nguyen
// UIN: 630003713
// Description: This code is for the functionality of the Application Information Manager Section of the Student Page


require_once 'dbh.inc.php';
require_once 'functions.inc.php';

// This function will occur when the button for inserting an application is clicked
if(isset($_POST['Apply'])){
    // Extract POST data
    $programNum = $_POST['Program_Num'];
    $uncomCert = $_POST['Uncom_Cert'];
    $comCert = $_POST['Com_Cert'];
    $purposeStatement = $_POST['Purpose_Statement'];
    $UIN = $_SESSION['userid'];

    // Insert into database
    $sql = "INSERT INTO `applications`(`Program_Num`, `UIN` ,`Uncom_Cert`, `Com_Cert`, `Purpose_Statement`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "iisss", $programNum, $UIN, $uncomCert, $comCert, $purposeStatement);
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            header("Location: ../app_info_manager.php");
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

// This function will occur when the button to edit an application is clicked
if (isset($_POST['edit_app'])) {
    $appNum = $_POST['App_Num'];
    $programNum = $_POST['Program_Num_Edit'];
    $uncomCert = $_POST['Uncom_Cert_Edit'];
    $comCert = $_POST['Com_Cert_Edit'];
    $purposeStatement = $_POST['Purpose_Statement_Edit'];

    // Insert into database
    $sql = "UPDATE `applications` SET `Program_Num`=?,`Uncom_Cert`=?,`Com_Cert`=?,`Purpose_Statement`=? WHERE `App_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    // Prepare statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "isssi", $programNum, $uncomCert, $comCert, $purposeStatement, $appNum);
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            // Redirect before any output
            header("Location: ../app_info_manager.php");
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

// This function will occur when the button to generate a report is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate_app_report"])) {
  // Process form data
    $appNum = isset($_POST["App_Num"]) ? $_POST["App_Num"] : '';

    // Retrieve data from the database
    $sql = "SELECT Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement FROM applications WHERE App_Num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appNum);
    $stmt->execute();
    $stmt->bind_result($programNum, $UIN, $uncomCert, $comCert, $purposeStatement);
    $stmt->fetch();
    $stmt->close();

    //Generate the report
    $report = "Application Number: $appNum<br>";
    $report .= "Program Number: $programNum<br>";
    $report .= "UIN: $UIN<br>";
    $report .= "Uncompleted Certificate: $uncomCert<br>";
    $report .= "Completed Certificate: $comCert<br>";
    $report .= "Purpose Statement: $purposeStatement";
    
    // Display the report on the screen
    echo "<h3>Generated Application Report</h3>";
    echo '<div style="border: 1px solid #ccc; padding: 15px; margin: 20px; max-width: 400px;">';
    echo "<p><strong>Application Number:</strong> $appNum</p>";
    echo "<p><strong>Program Number:</strong> $programNum</p>";
    echo "<p><strong>UIN:</strong> $UIN</p>";
    echo "<p><strong>Uncompleted Certificate:</strong> $uncomCert</p>";
    echo "<p><strong>Completed Certificate:</strong> $comCert</p>";
    echo "<p><strong>Purpose Statement:</strong> $purposeStatement</p>";
    echo '</div>';
    echo '<button style="margin-top: 10px;" onclick="history.go(-1);">Back</button>';
}

// This function will occur when the button to delete an application is clicked
if (isset($_POST['delete_app_data'])) {
    $appNum = $_POST['App_Num'];
    // Stores query to delete application
    $sql = "DELETE FROM `applications` WHERE `App_Num`=?";
    // Prepare statement
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $appNum);
        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            header("Location: ../app_info_manager.php");
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

// This function will occur when the button to display application information to edit is clicked
if (isset($_GET['App_Num'])) {
    $appNum = $_GET['App_Num'];

    // Fetch data based on the provided App_Num
    $sql = "SELECT * FROM applications WHERE App_Num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $appNum);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data was found
    if ($result->num_rows > 0) {
        // Fetch data as associative array
        $row = $result->fetch_assoc();

        // Return relevant data as JSON with "_Edit" names
        $response = array(
            'Program_Num' => $row['Program_Num'],
            'Uncom_Cert' => $row['Uncom_Cert'],
            'Com_Cert' => $row['Com_Cert'],
            'Purpose_Statement' => $row['Purpose_Statement']
        );
        
        echo json_encode($response);
    } 
} 


?>