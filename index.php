<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<nav>
		<ul>
			<li><a href = "index.php"> Home </a></li>
			<?php
				if(isset($_SESSION["userid"])) {
					echo $_SESSION["userName"];
					echo " ";
					echo $_SESSION["userLast"];
					echo "<br>";

				}
				else{
					echo "<li><a href = 'login.php'> Login </a></li>";
					echo "<li><a href = 'signup.php'> Sign Up </a></li>";
				}
			?>
		</ul>

</body>
</html>