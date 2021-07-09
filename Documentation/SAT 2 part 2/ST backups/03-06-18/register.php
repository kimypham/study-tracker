<?php
// Study Tracker - Register page, version 1.1, Kim Pham

session_start();
error_reporting(0);

include 'logincheck.php';
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./CSS/login-style.css">
		<div class="header">
			<div class="logo">Study Tracker</div>
		</div>
	</head>
	
	<body>
		<div class="login-container">
			<h1 class="title"> Welcome </h1>
			<p class="caption"> Let's get started! </p>
			<div class="inputs">
				<p class="subheading"> REGISTER </p>
				<form action="register.php" method="POST">
					<input type="text" name="username" placeholder="Username" required><br>
					<input type="password" name="password" placeholder="Password" required><br>
					<input class="inputs login-submit" type="submit" value="LOG IN" name="register">
				</form>
				<p class="link"> Already have an account? <br><a href="login.php">User login</a> </p>
			</div>
		</div>
	<div class="error">
		<?php 
		echo $_SESSION['error'];
		?>
	</div>
	</body>
	</html>