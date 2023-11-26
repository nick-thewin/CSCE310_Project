<?php
	include_once('header.php');
	if(isset($_GET["error"])){
		if($_GET["error"] == "accountdeactivated"){
		  echo "<p>Account has been deactivated</p>";
		}
	  }
?>

</body>
</html>