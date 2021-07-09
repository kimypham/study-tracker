<?php
// Study Tracker - Timer done page, version 1.2, Kim Pham

include 'login_check.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a class="active" href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</head>

<div class="main">
<?php 
$_SESSION['timeSpent'] = $_POST['output'];
echo "<br> Did you work on ".$_SESSION['select']." for ".$_SESSION['timeSpent']."?";
?>
<form action="timer_done" method="POST">
	<input type="button" value="YES">
</form>
<!--Experiementing with manually adding time to the subject/task-->
		<!--<form action="work.php" method="POST">
			<input type="number" name="time" placeholder="Length of time studied">
			<button type="submit" name="timeInput" id="add_btn"></button>
		</form>-->

<a href="work.php?select=<?php echo $_SESSION['select']; ?>">Go back</a> Note: this timer session will not be recorded and the timer will be reset
</div>