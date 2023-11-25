<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
        include_once('header.php');
        if(isset($_SESSION["username"])) {
            echo $_SESSION["username"];
        }
        $sql = "SELECT * FROM user;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['Username'] . "<br>";
            }
        }
    ?>
</body>
</html>