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
      <button class="tablinks" onclick="openProgress(event, 'class')">Class</button>
      <button class="tablinks" onclick="openProgress(event, 'internship')">Internship</button>
      <button class="tablinks" onclick="openProgress(event, 'certification')">Certification</button>
      <button class="tablinks" onclick="openProgress(event, 'program')">Program</button>
    </div>
    <div id="class" class="tabcontent">
      <h3>Insert Class Progress Record</h3>
      <form action="includes/programprogress_admin.inc.php" method="post">
        <label for="uin">UIN: </label><br>
        <input type="text" id="uin" name="uin"><br>
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
      <form action="includes/programprogress_admin.inc.php" method="post">
        <label for="CE_NUM">CE NUM: </label><br>
        <input type="text" id="CE_NUM" name="CE_NUM"><br>
        <label for="uin">UIN: </label><br>
        <input type="text" id="uin" name="uin"><br>
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
      <form action="includes/programprogress_admin.inc.php" method="post">
        <label for="CE_NUM">CE NUM: </label><br>
        <input type="text" id="CE_NUM" name="CE_NUM"><br>
        <button type="delete_class" name="delete_class">Submit</button>
      </form>
      <br>
    </div>
    <div id="internship" class="tabcontent">
      <h3>Insert Internship</h3>
      <form action="includes/programprogress_admin.inc.php" method="post">
        <label for="uin">UIN: </label><br>
        <input type="text" id="uin" name="uin"><br>
        <label for="intern_id">Intern ID: </label><br>
        <input type="text" id="intern_id" name="intern_id"><br>
        <label for="status">Status: </label><br>
        <input type="text" id="status" name="status"><br>
        <label for="year">Year: </label><br>
        <input type="text" id="year" name="year"><br>
        <button type="insert_intern" name="insert_intern">Submit</button>
      </form>
      <br>
    </div>
  </div>
  <div class="column2">
    <?php
      $query = "SELECT * FROM class_enrollment;";
      $fields = array('CE_NUM', 'UIN', 'Class_ID', 'Status', 'Semester', 'Year');
      echo "<br><b>Class Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT * FROM intern_app;";
      $fields = array('IA_Num', 'UIN', 'Intern_ID', 'Status', 'Year');
      echo "<br><b>Inernship Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT * FROM cert_enrollment;";
      $fields = array('CertE_Num', 'UIN', 'Cert_ID', 'Training_Status', 'Program_Num', 'Semester', 'Year');
      echo "<br><b>Certification Progress</b>";
      displayTable($conn, $query, $fields);

      $query = "SELECT * FROM track;";
      $fields = array('Program_Num', 'Student_Num', 'Tracking_Num');
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
</script>

</body>
</html>