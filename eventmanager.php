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

      <h3>Insert Event</h3>
      <form action="includes/eventmanager.inc.php" method="post">
        <label>Program Number:</label><br>
        <input type="number" id="ProgNum" name="ProgNum"></input><br>
        <label>Start:</label><br>
        <input type="date" id="StartDate" name="StartDate"></input>
        <input type="time" id="StartTime" name="StartTime"></input><br>
        <label>End:</label><br>
        <input type="date" id="EndDate" name="EndDate"></input>
        <input type="time" id="EndTime" name="EndTime"></input><br>
        <label>Location:</label><br>
        <input type="text" id="Location" name="Location"></input><br>
        <label>Type:</label><br>
        <input type="text" id="Type" name="Type"></input><br>
        <button type="insert_event" name="insert_event">Submit</button>
      </form>


      <h3>Update Event</h3>
      <form action="includes/eventmanager.inc.php" method="post">
        <label>Event ID:</label><br>
        <input type="number" id="EventID" name="EventID"></input><br>
        <label>Program Number:</label><br>
        <input type="number" id="ProgNum" name="ProgNum"></input><br>
        <label>Start:</label><br>
        <input type="date" id="StartDate" name="StartDate"></input>
        <input type="time" id="StartTime" name="StartTime"></input><br>
        <label>End:</label><br>
        <input type="date" id="EndDate" name="EndDate"></input>
        <input type="time" id="EndTime" name="EndTime"></input><br>
        <label>Location:</label><br>
        <input type="text" id="Location" name="Location"></input><br>
        <label>Type:</label><br>
        <input type="text" id="Type" name="Type"></input><br>
        <button type="update_event" name="update_event">Submit</button>
      </form>

      <h3>Add/Remove Students</h3>
      <form action="includes/eventmanager.inc.php" method="post">
        <label>Event ID:</label><br>
        <input type="number" id="EventID" name="EventID"></input><br>
        <label>UIN:</label><br>
        <input type="number" id="UIN" name="UIN"></input><br>
        <select id="Add_Delete" name="Add_Delete">
          <option value="1">Add</option>
          <option value="0">Remove</option>
        </select><br>
        <button type="update_event_student" name="update_event_student">Submit</button>
      </form>

      <h3>View Event Details</h3>
      <form action="includes/eventmanager.inc.php" method="post">
        <label>Event ID:</label><br>
        <input type="number" id="EventID" name="EventID"></input><br>
        <button type="select_event" name="select_event">Submit</button>
      </form>


      <h3>Delete Event</h3>
      <form action="includes/eventmanager.inc.php" method="post">
        <label>Event ID:</label><br>
        <input type="number" id="EventID" name="EventID"></input><br>
        <button type="delete_event" name="delete_event">Submit</button>
      </form>

    </div>
    <div class="column2">

      <?php
        echo "<br><b>Event Information<br>";
        echo "<table>
          <tr>
            <th>Event ID</th>
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

        $query = "SELECT * FROM event";

        if ($result = $conn->query($query)) {
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
      ?>
    </div>

  </div>
</body>

</html>