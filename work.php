<?php
// Study Tracker - Timer page, version 1.3, Kim Pham

include 'login_check.php';
include 'timer_funct.php';
include 'XML_funct.php';
unset($_SESSION['message']);
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
	<script src="show_settings.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
</header>

<body onload="show();">	<!-- show() is called beforehand so that if the user has previously selected the countdown timer, their settings are still shown -->
	<div class="main" style="background-color: #E3E5E8;">
		<p class="title">Working on <span class="subject"><?php echo $_SESSION['select'];?> . . .</span></p>

		<!-- base code for the modal from W3Schools (https://www.w3schools.com/howto/howto_css_modals.asp)
		<!-- Trigger/Open The Modal -->
		<a class="material-icons" style="font-size:36px; position:absolute; top:2.5em; left:2em; cursor:pointer;" id="btn">settings</a>
		<!-- The Modal -->
		<div id="modal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="close">&times;</span>
					<p class="title"> Settings </p>
				</div>
	
				<div class="modal-body main">
					<form action="work.php" method="POST">
						Change timer preferences:<br><br>											<!-- used to autofill form based on user's previously set settings -->
						<input type="radio" name="type" value="up" onClick="show()" <?php if ($_SESSION['timerType'] == 'up') { echo "checked=checked";}?>>Count up timer<br><br>
						<input type="radio" name="type" id="check" value="down" onClick="show()" <?php if ($_SESSION['timerType'] == 'down') { echo "checked=checked"; }?>>Countdown timer<br><br>
		
					<div id="settings" style="display:none; padding-left:3em;">
						Countdown timer length in minutes: <input type="number" min="1" name="length" class="inputbox" value=<?php echo $_SESSION['timerLen'];?> required><br><br>
						Timer ring: <input type="checkbox" name="ring" <?php if ($_SESSION['timerRing'] == 'on') { echo "checked=checked";}?>><br><br>
						Timer notification: <input type="checkbox" name="notif" <?php if ($_SESSION['timerNotif'] == 'on') { echo "checked=checked";}?>><br><br>
					</div>
				</div>
				<div class="modal-footer">
					<div class="button_container">
						<button class="controls" style="font-size:1em; padding:0.5em; background-color:#45587A;" type="submit" name="submitTimer" onclick="window.onbeforeunload = null;">Save Changes</button>
						<label class="info" style="color:#486381"> Note: if the timer settings are changed, any current progress will be lost </label>
					</div>
				</div>
					</form>
			</div>
		</div>

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
	
	
	<script>
	// code from W3Schools (https://www.w3schools.com/howto/howto_css_modals.asp)
	var modal = document.getElementById('modal');	// Get the modal
	var btn = document.getElementById("btn");	// Get the button that opens the modal
	var span = document.getElementsByClassName("close")[0];	// Get the <span> element that closes the modal

	btn.onclick = function() {	// When the user clicks the button, open the modal 
		modal.style.display = "block";
	}

	span.onclick = function() {	// When the user clicks on <span> (x), close the modal
		modal.style.display = "none";
	}

	window.onclick = function(event) {	// When the user clicks anywhere outside of the modal, close it
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	</script>
	
	
</body>
</html>