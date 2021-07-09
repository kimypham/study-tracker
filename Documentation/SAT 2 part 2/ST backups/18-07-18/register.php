<?php
// Study Tracker - Register page, version 1.2, Kim Pham

session_start();
error_reporting(0); // since no sessions are set up, an error usually displays. error_reporting(0) turns off all error reports.  documentation - http://php.net/manual/en/function.error-reporting.php

// if the user has already logged in there no need to login in again, redirects to index.php
if ($_SESSION['user'] == 1) {
	header('Location: index.php');
}
unset($_SESSION['error']);
include 'login_register.php';
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
		<link rel="stylesheet" type="text/css" href="./CSS/login-style.css">
		<div class="header">
			<a class="logo">Study Tracker</a>
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
		if (isset($_SESSION['error'])) {
			echo $_SESSION['error'];
		}
		?>
		</div>
	</body>
</html>