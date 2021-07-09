<?php
// Study Tracker - Login page, version 1.1, Kim Pham

session_start();
error_reporting(0); // since no sessions are set up, an error usually displays. error_reporting(0) turns off all error reports.  documentation - http://php.net/manual/en/function.error-reporting.php

// if the user has already logged in there no need to login in again, redirects to index.php
if ($_SESSION['user'] == 1) {
	header('Location: index.php');
}

include 'logincheck.php';
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="./CSS/login-style.css">
		<div class="header">
			<a class="logo">Study Tracker</a>
		</div>
	</head>
	
	<body>
		<div class="login-container">
			<h1 class="title"> Welcome back </h1>
			<p class="caption"> Let's get working! </p>
			<div class="inputs">
				<p class="subheading"> LOGIN </p>
				<form action="login.php" method="POST">
					<input type="text" name="username" placeholder="Username" required><br>
					<input type="password" name="password" placeholder="Password" required><br>
					<input class="inputs login-submit" type="submit" value="LOG IN" name="login">
				</form>
				<p class="link"> New to Study Tracker? <br><a href="register.php">Create an account</a> </p>
			</div>
		</div>
		<div class="error">
		<?php 
		echo $_SESSION['error'];
		?>
		</div>
	</body>
</html>