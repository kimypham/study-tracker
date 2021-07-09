<?php
// Study Tracker - Main page, version 1.1, Kim Pham

error_reporting(0);
session_start();

// if the user is not logged in they are not allowed access, redirects to login page
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}

$_SESSION['error'] = '';

include 'add_delete.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="clock.js"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	
	<div class="header">
		<a class="logo" title="Home">Study Tracker</a>
		<div class="header-right">
			<a class="active">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</head>

<body onload="startTime()"> <!-- starts running the clock and date -->
	<div class="main">
			<h1>Subjects and Tasks</h1>
			<div class="subject_list">
				<?php
				$user->Display();	// displays all of the user's subjects/tasks
				
				if ($_SESSION['error']) {
					echo "<p>".$_SESSION['error']."<p>"; 	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
				}
				?>
			</div>
			<form method="post" action="index.php" class="input_form">
				<input type="text" name="task" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
				<button type="submit" name="add" id="add_btn" class="hidden" style="display: none;"></button>
			</form>
	</div>
	
	<div class="main_right">
	<div class="datebox">
		<h1>Hello<?php if(isset($_SESSION['username'])) { echo " ".$_SESSION['username']; }?>,</h1>
		<p>It's currently:</p>
		<div id="clock"></div>
		<div id="date"></div>
	</div>
	
	<div class="quote">
		<p> "Thrive for progress, not perfection" </p>
	</div>
<!--Experimenting with a daily quote generator.-->	
	<!--JavaScript code for single Motivational Quote of the Day, http://www.tqpage.com/-->
	<!--<script language="javascript" src="http://www.quotationspage.com/data/1mqotd.js">
	</script> <!--End JavaScript Quotations code-->	
	</div>
	
</body>
</html>