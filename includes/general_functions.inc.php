<?php
// Author: Daniel Huang
// UIN: 830008438
// Description: General functions that take in an array of fields representing the columns of a table

require_once 'dbh.inc.php';

//Makes a HTML table to display the result of a query
function displayTable($conn, $query, $fields) {
  echo '<table><tr>';
  foreach ($fields as $value) {
    echo'<th>'.$value.'</th>';
  }
  echo '</tr>';
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      foreach ($fields as $value) {
        echo'<td>'.$row[$value].'</td>';
        
      }
      echo '</tr>';
    }
  }
  $result->free();
  echo '</table>';
}

//Check if any field within the form is empty. Return true if yes, false if no.
function emptyInput($fields) {
  $result = false;
  foreach ($fields as $value) {
    if(empty($_POST[$value])) {
      $result = true;
      break;
    }
  }  
  return $result;
}

//Execute SQL command
function executeSQL($conn, $fields, $sql, $bindtypes) {
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  $field_values = array();
  foreach ($fields as $value) {
    array_push($field_values, $_POST[$value]);
  }  
  mysqli_stmt_bind_param($stmt, $bindtypes, ...$field_values);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}