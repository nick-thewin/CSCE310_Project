<?php 
require_once 'dbh.inc.php';
require_once 'functions.inc.php';


if(isset($_POST['Apply'])){
    $programNum = $_POST['Program_Num'];
    $uncomCert = $_POST['Uncom_Cert'];
    $comCert = $_POST['Com_Cert'];
    $purposeStatement = $_POST['Purpose_Statement'];
    // Check if 'userid' is set in the session
    if (isset($_SESSION['userid'])) {
        $UIN = $_SESSION['userid'];
    } else {
        // Handle the case where 'userid' is not set in the session
        // You can set a default value or redirect the user to a login page
        // depending on your application logic.
        $UIN = '11111'; // Change this to your desired default value
    }

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "INSERT INTO `applications`(`Program_Num`, `UIN` ,`Uncom_Cert`, `Com_Cert`, `Purpose_Statement`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iisss", $programNum, $UIN, $uncomCert, $comCert, $purposeStatement);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Application inserted successfully";
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


if(isset($_POST['edit_app'])){
    $appNum = $_POST['App_Num'];
    $programNum = $_POST['Program_Num'];
    $uncomCert = $_POST['Uncom_Cert'];
    $comCert = $_POST['Com_Cert'];
    $purposeStatement = $_POST['Purpose_Statement'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "UPDATE `applications` SET `Program_Num`=?,`Uncom_Cert`=?,`Com_Cert`=?,`Purpose_Statement`=? WHERE `App_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "isssi", $programNum, $uncomCert, $comCert, $purposeStatement, $appNum);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Application updated successfully";
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate_app_report"])) {
  // Process form data
    $appNum = isset($_POST["App_Num"]) ? $_POST["App_Num"] : '';

    // Validate or sanitize input if needed

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


if (isset($_POST['delete_app_data'])) {
    $appNum = $_POST['App_Num'];

    // Sanitize and validate inputs if needed

    // Insert into database
    $sql = "DELETE FROM `applications` WHERE `App_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $appNum);

        if (mysqli_stmt_execute($stmt)) {
            // Success
            mysqli_stmt_close($stmt);
            echo "Application deleted successfully";
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

?>

