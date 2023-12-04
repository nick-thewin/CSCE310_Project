<?php 
require_once 'dbh.inc.php';

//--------------------INSERT--------------------
if(isset($_POST['insert_event'])){
    //Setup
    ob_start();
    require_once 'functions.inc.php';

    //Collect Form Values
    $UIN = $_SESSION['userid'];
    $ProgNum = $_POST['ProgNum'];
    $StartDate = $_POST['StartDate'];
    $StartTime = $_POST['StartTime'];
    $EndDate = $_POST['EndDate'];
    $EndTime = $_POST['EndTime'];
    $Location = $_POST['Location'];
    $Type = $_POST['Type'];

    //Define SQL Statement
    $sql = "INSERT INTO `event`(`UIN`, `Program_Num`, `Start_Date`, `Time`, `Location`, `End_Date`, `EndTime`, `Event_Type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    //Bind variables and execute
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iissssss", $UIN, $ProgNum, $StartDate, $StartTime, $Location, $EndDate, $EndTime, $Type);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "Event inserted successfully";
        } else {
            echo "ERROR(runtime): " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "ERROR(setup): " . mysqli_error($conn);
    }

    //Cleanup
    header("Location: ../eventmanager.php");
    exit();
    ob_end_flush();
}

//--------------------UPDATE(event)--------------------
if(isset($_POST['update_event'])){
    //Collect Form Values
    $EventID = $_POST['EventID'];
    $ProgNum = $_POST['ProgNum'];
    $StartDate = $_POST['StartDate'];
    $StartTime = $_POST['StartTime'];
    $EndDate = $_POST['EndDate'];
    $EndTime = $_POST['EndTime'];
    $Location = $_POST['Location'];
    $Type = $_POST['Type'];

    if(empty($EventID)){
        echo "ERROR: No event selected";
        exit();
    }

    if(!empty($ProgNum)){
        $sql = "UPDATE `event` SET `Program_Num`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update Program_Num");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $ProgNum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($StartDate)){
        $sql = "UPDATE `event` SET `Start_Date`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update Start_Date");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $StartDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($StartTime)){
        $sql = "UPDATE `event` SET `Time`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update Time");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $StartTime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($EndDate)){
        $sql = "UPDATE `event` SET `End_Date`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update End_Date");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $EndDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($EndTime)){
        $sql = "UPDATE `event` SET `EndTime`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update EndTime");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $EndTime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($Location)){
        $sql = "UPDATE `event` SET `Location`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update Location");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $Location);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($Type)){
        $sql = "UPDATE `event` SET `Event_Type`=? WHERE `event` . `Event_ID`=" . $EventID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("ERROR: Failed to update Event_Type");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $Type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    //Cleanup
    header("Location: ../eventmanager.php");
    exit();
}

//--------------------UPDATE(event_tracking)--------------------
if(isset($_POST['update_event_student'])){
    //Collect Form Values
    $EventID = $_POST['EventID'];
    $UIN = $_POST['UIN'];
    $Add_Delete = $_POST['Add_Delete'];

    if(empty($EventID)){
        echo("ERROR: No event selected");
        exit();
    }
    if(empty($UIN)){
        echo("ERROR: No student selected");
        exit();
    }

    if($Add_Delete){
        //Define SQL Statement
        $sql = "INSERT INTO `event_tracking`(`Event_ID`, `UIN`) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);

        //Bind variables and execute
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $EventID, $UIN);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                echo "Student inserted successfully";
            } else {
                echo "ERROR(runtime): " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "ERROR(setup): " . mysqli_error($conn);
        }

        //Cleanup
        header("Location: ../eventmanager.php");
        exit();
    } else {
        //Define SQL Statement
        $sql = "DELETE FROM `event_tracking` WHERE `Event_ID`=? AND `UIN`=?";
        $stmt = mysqli_stmt_init($conn);

        //Bind variables and execute
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $EventID, $UIN);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                echo "Student deleted successfully";
            } else {
                echo "ERROR(runtime): " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "ERROR(setup): " . mysqli_error($conn);
        }

        //Cleanup
        header("Location: ../eventmanager.php");
        exit();
    }
}

//--------------------SELECT--------------------
if(isset($_POST['select_event'])){
    //Collect Form Values
    $EventID = $_POST['EventID'];

    echo"<link href=\"../style.php\" rel=\"stylesheet\">";
    echo "<h3>Result<h3>";

    //Define SQL Statement
    $query = "SELECT * FROM `event` WHERE `Event_ID`=" . $EventID;
    if ($result = $conn->query($query)) {
        echo "<br><b>Event Information<br>";
        echo "<table>
            <tr>
            <th>Event_ID</th>
            <th>UIN</th>
            <th>Program</th>
            <th>Start Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>End Date</th>
            <th>End Time</th>
            <th>Event Type</th>
            </tr>
        ";
        while ($row = $result->fetch_assoc()) {
            echo '<tr> 
              <td>'.$row["Event_ID"].'</td> 
              <td>'.$row["UIN"].'</td> 
              <td>'.$row["Program_Num"].'</td> 
              <td>'.$row["Start_Date"].'</td> 
              <td>'.$row["Time"].'</td> 
              <td>'.$row["Location"].'</td> 
              <td>'.$row["End_Date"].'</td> 
              <td>'.$row["EndTime"].'</td> 
              <td>'.$row["Event_Type"].'</td> 
            </tr>';
        }
        echo "</table>";
        $result->free();
    }

    $query = "SELECT * FROM `event_tracking` WHERE `Event_ID`=" . $EventID;
    if ($result = $conn->query($query)) {
        echo "<br><b>Participants<br>";
        echo "<table>
            <tr>
            <th>UIN</th>
            </tr>
        ";
        while ($row = $result->fetch_assoc()) {
            echo '<tr> 
              <td>'.$row["UIN"].'</td> 
            </tr>';
        }
        echo "</table>";
        $result->free();
    }
    echo "<br><button onclick=\"history.go(-1);\">Back</button>";

    exit();
}

//--------------------DELETE--------------------
if(isset($_POST['delete_event'])){
    //Collect Form Values
    $EventID = $_POST['EventID'];

    //Define SQL Statement
    $sql = "DELETE FROM `event` WHERE `Event_ID`=?";
    $stmt = mysqli_stmt_init($conn);

    //Bind variables and execute
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $EventID);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "Event deleted successfully";
        } else {
            echo "ERROR(runtime): " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "ERROR(setup): " . mysqli_error($conn);
    }

    //Cleanup
    header("Location: ../eventmanager.php");
    exit();
}

?>