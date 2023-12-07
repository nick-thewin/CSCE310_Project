<?php
  include_once 'header.php';
  include_once 'includes/dbh.inc.php';
  include_once 'includes/general_functions.inc.php';
  
  // $sql = "SELECT * FROM user;";
  // $result = mysqli_query($conn, $sql);
  // $resultCheck = mysqli_num_rows($result);
  // if($resultCheck > 0) {
  //   while ($row = mysqli_fetch_assoc($result)) {
  //     echo $row['Username'] . "<br>";
  //   }
  // }
?>
<div class="container">
  <div class="column1">
    <div class="tab">
      <button class="tablinks" onclick="openProgress(event, 'class')" id="defaultOpen">Class</button>
      <button class="tablinks" onclick="openProgress(event, 'internship')">Internship</button>
      <button class="tablinks" onclick="openProgress(event, 'certification')">Certification</button>
      <button class="tablinks" onclick="openProgress(event, 'track')">Track</button>
    </div>
    <div id="class" class="tabcontent">
      <h3>Insert Class Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="class_id">Class ID: </label><br>
        <input type="text" id="class_id" name="class_id"><br>
        <label for="status">Status: </label><br>
        <input type="text" id="status" name="status"><br>
        <label for="semester">Semester: </label><br>
        <input type="text" id="semester" name="semester"><br>
        <label for="year">Year: </label><br>
        <input type="text" id="year" name="year"><br>
        <button type="insert_class" name="insert_class">Submit</button>
      </form>
      <h3>Update Class Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="CE_NUM">CE NUM: </label><br>
        <input type="text" id="CE_NUM" name="CE_NUM"><br>
        <label for="class_id">Class ID: </label><br>
        <input type="text" id="class_id" name="class_id"><br>
        <label for="status">Status: </label><br>
        <input type="text" id="status" name="status"><br>
        <label for="semester">Semester: </label><br>
        <input type="text" id="semester" name="semester"><br>
        <label for="year">Year: </label><br>
        <input type="text" id="year" name="year"><br>
        <button type="update_class" name="update_class">Submit</button>
      </form>
      <h3>Delete Class Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="CE_NUM">CE NUM: </label><br>
        <input type="text" id="CE_NUM" name="CE_NUM"><br>
        <button type="delete_class" name="delete_class">Submit</button>
      </form>
      <br>
    </div>
    <div id="internship" class="tabcontent">
      <h3>Insert Internship Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="Intern_ID">Intern ID: </label><br>
        <input type="text" id="Intern_ID" name="Intern_ID"><br>
        <label for="status">Status: </label><br>
        <input type="text" id="status" name="status"><br>
        <label for="year">Year: </label><br>
        <input type="text" id="year" name="year"><br>
        <button type="insert_intern" name="insert_intern">Submit</button>
      </form>  
      <h3>Update Internship Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="IA_Num">IA Num: </label><br>
        <input type="text" id="IA_Num" name="IA_Num"><br>
        <label for="Intern_ID">Intern ID: </label><br>
        <input type="text" id="Intern_ID" name="Intern_ID"><br>
        <label for="status">Status: </label><br>
        <input type="text" id="status" name="status"><br>
        <label for="year">Year: </label><br>
        <input type="text" id="year" name="year"><br>
        <button type="update_intern" name="update_intern">Submit</button>
      </form>
      <h3>Delete Internship Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="IA_Num">IA Num: </label><br>
        <input type="text" id="IA_Num" name="IA_Num"><br>
        <button type="delete_intern" name="delete_intern">Submit</button>
      </form>
      <br>
    </div>
    <div id="certification" class="tabcontent">
      <h3>Insert Certification Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="Cert_ID">Cert ID: </label><br>
        <input type="text" id="Cert_ID" name="Cert_ID"><br>
        <label for="Status">Status: </label><br>
        <input type="text" id="Status" name="Status"><br>
        <label for="Training_Status">Training Status: </label><br>
        <input type="text" id="Training_Status" name="Training_Status"><br>
        <label for="Program_Num">Program Num: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="Semester">Semester: </label><br>
        <input type="text" id="Semester" name="Semester"><br>
        <label for="Year">Year: </label><br>
        <input type="text" id="Year" name="Year"><br>
        <button type="insert_cert" name="insert_cert">Submit</button>
      </form>
      <h3>Update Certification Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="CertE_Num">CertE Num: </label><br>
        <input type="text" id="CertE_Num" name="CertE_Num"><br>
        <label for="Cert_ID">Cert ID: </label><br>
        <input type="text" id="Cert_ID" name="Cert_ID"><br>
        <label for="Status">Status: </label><br>
        <input type="text" id="Status" name="Status"><br>
        <label for="Training_Status">Training Status: </label><br>
        <input type="text" id="Training_Status" name="Training_Status"><br>
        <label for="Program_Num">Program Num: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="Semester">Semester: </label><br>
        <input type="text" id="Semester" name="Semester"><br>
        <label for="Year">Year: </label><br>
        <input type="text" id="Year" name="Year"><br>
        <button type="update_cert" name="update_cert">Submit</button>
      </form>
      <h3>Delete Certification Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="CertE_Num">CertE Num: </label><br>
        <input type="text" id="CertE_Num" name="CertE_Num"><br>
        <button type="delete_cert" name="delete_cert">Submit</button>
      </form>
      <br>
    </div>
    <div id="track" class="tabcontent">
      <h3>Insert Track Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="Program_Num">Program Num: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <button type="insert_track" name="insert_track">Submit</button>
      </form>  
      <h3>Update Track Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="Program_Num">Program Num: </label><br>
        <input type="text" id="Program_Num" name="Program_Num"><br>
        <label for="Tracking_Num">Tracking Num: </label><br>
        <input type="text" id="Tracking_Num" name="Tracking_Num"><br>
        <button type="update_track" name="update_track">Submit</button>
      </form>
      <h3>Delete Track Progress Record</h3>
      <form action="includes/programprogress_student.inc.php" method="post">
        <label for="Tracking_Num">Tracking Num: </label><br>
        <input type="text" id="Tracking_Num" name="Tracking_Num"><br>
        <button type="delete_track" name="delete_track">Submit</button>
      </form>
      <br>
    </div>

  </div>
  <div class="column2">
    <?php
      $query = "SELECT `CE_NUM`, `Class_ID`, `Status`, `Semester`, `Year` 
        FROM class_enrollment WHERE `UIN` = ".$_SESSION["userid"].";";
      $fields = array('CE_NUM','Class_ID','Status','Semester','Year');
      echo "<br><b>Class Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT `IA_Num`, `Intern_ID`, `Status`, `Year` 
        FROM intern_app WHERE `UIN` = ".$_SESSION["userid"].";";
      $fields = array('IA_Num','Intern_ID','Status','Year');
      echo "<br><b>Inernship Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT `CertE_Num`, `Cert_ID`, `Status`, `Training_Status`,  `Program_Num`, `Semester`, `Year` 
        FROM cert_enrollment WHERE `UIN` = ".$_SESSION["userid"].";";
      $fields = array('CertE_Num','Cert_ID','Status','Training_Status','Program_Num','Semester','Year');
      echo "<br><b>Certification Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT `Program_Num`, `Tracking_Num` 
        FROM track WHERE `Student_Num` = ".$_SESSION["userid"].";";
      $fields = array('Program_Num','Tracking_Num');
      echo "<br><b>Program Progress</b>";
      displayTable($conn, $query, $fields);

    ?>
  </div>
</div>

<script>
function openProgress(evt, progress) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(progress).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>

</body>
</html>