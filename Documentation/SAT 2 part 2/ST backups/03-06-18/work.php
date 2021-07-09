<?php
// Study Tracker - Timer page, version 1.1, Kim Pham
session_start();
//error_reporting(0);

// if the user is not logged in they are not allowed access, redirects to login page
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}

include 'timer_funct.php';
//include 'timee.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="time.js"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	
	<div class="header">
		<a href="#default" class="logo">Study Tracker</a>
		<div class="header-right">
			<a class="active" href="index.php">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="#settings">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</head>

<body>
<div class="main">
<p><?php echo "Working on: ".$select;?></p>

<form action="work.php" method="POST">
	<input type="number" name="time" placeholder="Length of time studied">
	<button type="submit" name="timeInput" id="add_btn"></button>
</form>
<a href="index.php">Go back</a>
</div>
</body>
</html>