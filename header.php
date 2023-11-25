<?php
	session_start();

	if(isset($_POST['button1'])){
		// Perform logout actions, e.g., destroying the session
		session_destroy();
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cybersecurity Center Student Tracking and Reporting Tool</title>
  <link rel="icon" type="image/png" sizes="32x32" href="TAM-LogoBox.png">
  <link href="style.php" rel="stylesheet">
</head>
<body>
	<nav>
		<ul>
			<?php
				if(isset($_SESSION["userid"])) {
					if($_SESSION["userPerm"] === "Admin"){
						echo "<h2>Admin Landing Page</h2>
						<li><a href='toname.php'>User Authentication and Roles</a></li>
						<li><a href='toname.php'>Program Information Management</a></li>
						<li><a href='programprogress.php'>Program Progress Tracking</a></li>
						<li><a href='toname.php'>Event management</a></li>";
					}
					else if($_SESSION["userPerm"] === "Student"){
						echo "<h2>Student Landing Page</h2>
							<li><a href='toname.php'>User Authentication and Roles</a></li>
							<li><a href='toname.php'>Application Information Management</a></li>
							<li><a href='programprogress.php'>Program Progress Tracking</a></li>
							<li><a href='toname.php'>Document Upload and Management</a></li>";
					}

					echo "<li>
							<form method='post'>
								<button type='submit' name='button1'>Sign Out</button>
							</form>
						  </li>";
				}
				else{
					echo "<li><a href = 'login.php'> Login </a></li>
						  <li><a href = 'signup.php'> Sign Up </a></li>";
				}
			?>
		</ul>