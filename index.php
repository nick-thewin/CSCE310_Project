<?php
// Author: Hunter Pearson
// UIN: 23005050
// Description: home page that gets errors sent to it like a notice that the account has been deactivated or the account has been created successfully

	include_once('header.php');
	if(isset($_GET["error"])){
		if($_GET["error"] == "accountdeactivated"){
		  echo "<p>Account has been deactivated</p>";
		}
		else if($_GET["error"] == "accountcreated"){
		  echo "<p>Account has been successfully created</p>";
		}
	  }
?>

</body>
</html>