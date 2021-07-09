<?php
// Study Tracker - Timer page, version 1.3, Kim Pham

include 'login_check.php';
include 'timer_funct.php';
include 'XML_funct.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	// depending on the user's selected type of timer, a countup or countdown timer is shown.
	if ($_SESSION['timerType'] == 'up') {
		echo '<script src="countup.js" type="text/javascript"></script>';
		}
	if ($_SESSION['timerType'] == 'down') {
			include 'countdown.php';	// countdown timer code is in a php file because it uses sessions
		}
	?>
	<script src="leave_page.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>

<header>
	<div class="header">
		<a href="index.php" class="logo" title="Home"><img src="./images/logo-light.png" width="250px"></a>
		<div class="header-right">
			<a href="index.php" class="menu">HOME</a>
			<a href="report.php" class="menu">VIEW STATISTICS</a>
			<a href="help.php" class="menu">HELP</a>
			<a href="settings.php" class="menu">SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
<header>

<body>
	<div class="main" style="background-color: #E3E5E8;">
		<p class="title">Working on <span class="subject"><?php echo $_SESSION['select'];?> . . .</span></p>
		<div class="timer_box">
			<div class="timer">
				<div class="timer_display">
				<?php
				// depending on the user's selected type of timer, the timer starts from 00 or for the length specified in the settings
				if ($_SESSION['timerType'] == 'up') {
					echo "<span id='hours'>00</span>:<span id='minutes'>00</span>:<span id='seconds'>00</span>";
				} else {
					echo "<span id='hours'>".$_SESSION['hours']."</span>:<span id='minutes'>".$_SESSION['minutes']."</span>:<span id='seconds'>00</span>";
				}
				?>
				</div>
			</div>

				<button class="controls control_left" id="color" onclick="startTimer(); change_color();"><span id="startstop">Start</span>
				<button class="controls control_right" onclick="resetTimer()">Reset
	
				<!--Hidden text box contains the length of time recorded, passed onto timer_done.php-->
				<form action="timer_done.php" method="POST">
					<input type="text" name="output" id="output" value=0 style="display:none";/>
					<!-- startTimer() is used so that if the user leaves the page (the onbeforeunload function is disabled on this button) the timer value is still saved. -->
					<button class="controls control_right" onclick="startTimer(); window.onbeforeunload = null;"/>Done!
				</form>
		</div>
	</div>
</body>
</html>