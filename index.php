<?php
// Study Tracker - Main page, version 1.3, Kim Pham

include 'login_check.php';
unset ($_SESSION['error']);
include 'add_delete.php';
include 'display.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="clock.js"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>
<header>
	<div class="header">
		<a class="logo" title="Home"><img src="./images/logo-light.png" width="250px"></a>
		<div class="header-right">
			<a class="active" class="menu">HOME</a>
			<a href="report.php" class="menu">VIEW STATISTICS</a>
			<a href="help.php" class="menu">HELP</a>
			<a href="settings.php" class="menu">SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
</header>

<body onload="startTime()"> <!-- starts running the clock and date -->
	<div class="main_left">
			<h1>Subjects and Tasks</h1>
			<div class="info"> Select a subject/task below to start timing </div>
				<?php	
				// displays all of the user's subjects/tasks and sorts them if neccessary (from display.php)
				if (isset($_GET['sort'])) {				// changes sorting only if changed
					$_SESSION['sort'] = $_GET['sort'];
					$user->Display($_SESSION['sort']);
				} elseif (isset($_SESSION['sort'])) {	// uses previous sorting preference
					$user->Display($_SESSION['sort']);
				} else {
					$_SESSION['sort'] = "original";		// if no session was set (default)
					$user->Display($_SESSION['sort']);
				}
				?>
			
			<div class="input_container">
			<form method="post" action="index.php" class="input_form">
				<input type="text" name="subject" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
				<input type="submit" name="add" id="add_btn" class="hidden"></input>
			</form>
			</div>
			<div class="error_message">
			<?php
				if (isset($_SESSION['error'])) {	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
					echo "<p>".$_SESSION['error']."</p>";
				}
				if (isset($_SESSION['error_list'])) {	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
					echo "<p>".$_SESSION['error_list']."</p>";
				}
			?>
			</div>
	</div>
	
	<div class="main_right">
		<div class="datebox">
			<h1>Hello<?php if(isset($_SESSION['name'])) { echo " ".$_SESSION['name']; }?>,</h1>
			<p>It's currently:</p>
			<div id="clock"></div>
			<div id="date"></div>
		</div>
	
		<div class="quote">
			<p> "Thrive for progress, not perfection" </p>
		</div>
	</div>
</body>
</html>