<?php
  include_once 'header.php';
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .required {
            font-size: 11px;
            color: red;
        }

        .container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .column1 {
            max-height: 4000px;
            overflow: auto;
            width: 25%;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .column2 {
            max-height: 500px;
            overflow: auto;
            width: 70%;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
  <div class="container">
    <div class="column1">

      <h3>Insert Document</h3>
      <form action="includes/docmanager.inc.php" method="post">
        <label>Application ID:</label><br>
        <input type="number" id="AppID" name="AppID"></input><br>
        <label>Link:</label><br>
        <input type="text" id="Link" name="Link"></input><br>
        <label>Document Type:</label><br>
        <input type="text" id="DocType" name="DocType"></input><br>
        <button type="insert_event" name="insert_doc">Submit</button>
      </form>


      <h3>Update Document</h3>
      <form action="includes/docmanager.inc.php" method="post">
        <label>Document ID:</label><br>
        <input type="number" id="DocID" name="DocID"></input><br>
        <label>Application ID:</label><br>
        <input type="number" id="AppID" name="AppID"></input><br>
        <label>Link:</label><br>
        <input type="text" id="Link" name="Link"></input><br>
        <label>Document Type:</label><br>
        <input type="text" id="DocType" name="DocType"></input><br>
        <button type="update_event" name="update_doc">Submit</button>
      </form>

      <h3>View Document</h3>
      <form action="includes/docmanager.inc.php" method="post">
        <label>Document ID:</label><br>
        <input type="number" id="DocID" name="DocID"></input><br>
        <button type="select_event" name="select_doc">Submit</button>
      </form>


      <h3>Delete Document</h3>
      <form action="includes/docmanager.inc.php" method="post">
        <label>Document ID:</label><br>
        <input type="number" id="DocID" name="DocID"></input><br>
        <button type="delete_event" name="delete_doc">Submit</button>
      </form>

    </div>
    <div class="column2">

      <?php
        echo "<br><b>Document Information<br>";
        echo "<table>
          <tr>
            <th>Document ID</th>
            <th>Application ID</th>
            <th>Link</th>
            <th>Document Type</th>
          </tr>
          ";

        $query = "SELECT * FROM document";

        if ($result = $conn->query($query)) {
          while ($row = $result->fetch_assoc()) {
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
      ?>
    </div>

  </div>
</body>

</html>

<?php
  /*
  $ProgQuery = "SELECT `Program_Num`, `Name` FROM programs";
  $ProgResult = $conn->query($ProgQuery);

  echo '<select id="Add_Delete" name="Add_Delete">';
  while ($row = $ProgResult->fetch_assoc()) {
    echo "<option value=" . $row["Program_Num"] . ">" . $row["Name"] . "</option>";
  }
  echo '</select>';
  */
?>