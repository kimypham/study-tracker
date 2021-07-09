<?php
// Study Tracker - Timer page, version 1.1, Kim Pham

session_start();

// if the user is not logged in they are not allowed access, redirects to login page
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}

include 'timer_funct.php';
include 'XML_funct.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	// depending on the user's selected type of timer, a countup or countdown timer is shown.
	if ($_SESSION['type'] == 'up') {
		echo "<script src='countup.js'></script>";
		}
	if ($_SESSION['type'] == 'down') {
			include 'countdown.php';	// countdown timer code is in a php file because it uses sessions
		}
		?>
	<script src="leave_page.js"></script>
	
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a class="active" href="index.php">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</head>

<body>
	<div class="main">
		<p><?php echo "Working on: ".$_SESSION['select'];?></p>
		
		<!--Timer-->
		<div class="timer">
			<?php
			// depending on the user's selected type of timer, the timer starts from 00 or for the length specified in the settings
			if ($_SESSION['type'] == 'up') {
				echo "<span id='hours'>00</span>:<span id='minutes'>00</span>:<span id='seconds'>00</span>";
			} else {
				echo "<span id='hours'>".$_SESSION['hours']."</span>:<span id='minutes'>".$_SESSION['minutes']."</span>:<span id='seconds'>00</span>";
			}
			?>
		</div>
		<div class="controls">
			<button onclick="startTimer()"><span id="startstop">START</span>
			<button onclick="resetTimer()">RESET
		</div>
		<!--End timer code-->
	
	
		<p id="status"></p> <!-- status of the timer. For developmental purposes. -->
		<!--<p id="output"></p>-->
		
		<!--Text box contains the length of time recorded. Normally wouldn't be displayed, just used for development purposes-->	
		<form action="timer_done.php" method="POST">
			<input type="text" name="output" id="output" value=0 />
			<!-- startTimer() is used so that if the user leaves the page (the onbeforeunload function is disabled on this button) the timer value is still saved. -->
			<input onclick="startTimer(); window.onbeforeunload = null;" type="submit" name="submit" id="submit" value="Done!" />
		</form>

		<!--Experiementing with manually adding time to the subject/task-->
		<form action="work.php" method="POST">
			<input type="number" name="time" placeholder="Length of time studied">
			<button type="submit" name="timeInput" id="add_btn"></button>
		</form>
		
	<a href="index.php">Go back</a>
	</div>
</body>
</html>