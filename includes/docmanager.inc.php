<?php 
//Author: Jack Hanna
//UIN: 930008789
//Description: Code for managing user actions in the document manager view
require_once 'dbh.inc.php';

//--------------------INSERT--------------------
if(isset($_POST['insert_doc'])){
    //Collect Form Values
    $AppID = $_POST['AppID'];
    $Link = $_POST['Link'];
    $DocType = $_POST['DocType'];

    if(empty($AppID)){
        returnError("No application selected");
    }
    if(empty($Link)){
        returnError("No file selected");
    }
    if(empty($DocType)){
        returnError("No filetype selected");
    }

    //Define SQL Statement
    $sql = "INSERT INTO `document`(`App_Num`, `Link`, `Doc_Type`) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    //Bind variables and execute
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iss", $AppID, $Link, $DocType);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "Document inserted successfully";
        } else {
            returnError(mysqli_stmt_error($stmt));
        }
    } else {
        returnError(mysqli_error($conn));
    }

    //Cleanup
    header("Location: ../docmanager.php");
    exit();
}

//--------------------UPDATE--------------------
if(isset($_POST['update_doc'])){
    //Collect Form Values
    $DocID = $_POST['DocID'];
    $AppID = $_POST['AppID'];
    $Link = $_POST['Link'];
    $DocType = $_POST['DocType'];

    if(empty($DocID)){
        returnError("No document selected");
    }

    if(empty($AppID) && empty($Link) && empty($DocType)){
        returnError("No attributes have been modified");
    }

    if(!empty($AppID)){
        $sql = "UPDATE `document` SET `App_Num`=? WHERE `document` . `Doc_Num`=" . $DocID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            returnError("Failed to update AppID");
        }
        mysqli_stmt_bind_param($stmt, "i", $AppID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($Link)){
        $sql = "UPDATE `document` SET `Link`=? WHERE `document` . `Doc_Num`=" . $DocID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            returnError("Failed to update Link");
        }
        mysqli_stmt_bind_param($stmt, "s", $Link);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if(!empty($DocType)){
        $sql = "UPDATE `document` SET `Doc_Type`=? WHERE `document` . `Doc_Num`=" . $DocID . ";";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            returnError("Failed to update Doc_Type");
        }
        mysqli_stmt_bind_param($stmt, "s", $DocType);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    //Cleanup
    header("Location: ../docmanager.php");
    exit();
}

//--------------------SELECT--------------------
if(isset($_POST['select_doc'])){
    //Collect Form Values
    $DocID = $_POST['DocID'];

    if(empty($DocID)){
        returnError("No document selected");
    }

    echo "<link href=\"../style.php\" rel=\"stylesheet\">";
    echo "<h3>Result<h3>";

    //Define SQL Statement
    $query = "SELECT * FROM `document` WHERE `Doc_Num`=" . $DocID;
    if ($result = $conn->query($query)) {
        echo "<br><b>Document Information<br>";
        echo "<table>
            <tr>
            <th>Document ID</th>
            <th>Application ID</th>
            <th>Link</th>
            <th>Document Type</th>
            </tr>
        ";
        while ($row = $result->fetch_assoc()) {
            $Link = $row["Link"];
            echo '<tr> 
            <td>'.$row["Doc_Num"].'</td> 
            <td>'.$row["App_Num"].'</td> 
            <td><a href='.$row["Link"].'>'.$row["Link"].'</a></td> 
            <td>'.$row["Doc_Type"].'</td> 
            </tr>';
        }
        echo "</table>";
        $result->free();
    }

    echo "<embed src=`".$Link."` width=`fit_content` height=`fit_content`>";
    echo "<br><button onclick=\"history.go(-1);\">Back</button>";

    exit();
}

//--------------------DELETE--------------------
if(isset($_POST['delete_doc'])){
    //Collect Form Values
    $DocID = $_POST['DocID'];

    //Define SQL Statement
    $sql = "DELETE FROM `document` WHERE `Doc_Num`=?";
    $stmt = mysqli_stmt_init($conn);

    //Bind variables and execute
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $DocID);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "Document deleted successfully";
        } else {
            returnError(mysqli_stmt_error($stmt));
        }
    } else {
        returnError(mysqli_error($conn));
    }

    //Cleanup
    header("Location: ../docmanager.php");
    exit();
}

function returnError($ErrorMsg){
    echo "<link href=`../style.php` rel=`stylesheet`>
    <div class=`containter`>
    <div class=`column1`>
    <body>
    <h3>ERROR:</h3>";
    echo "<p>".$ErrorMsg."</p>";
    echo "<br><button onclick=`history.go(-1);`>Back</button>
    </body>
    </div>
    </div>";
    exit();
}

function nullHandler($value){
    if(empty($value)){
        return NULL;
    }
    return $value;
}

?>