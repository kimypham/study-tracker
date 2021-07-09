<?php
// Study Tracker - Main settings page (timer), version 1.3, Kim Pham

include 'login_check.php';
unset($_SESSION['message']);
include 'display.php';
include 'XML_funct.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="show_settings.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
</head>

<header>
	<div class="header">
		<a href="index.php" title="Home" class="logo"><img src="./images/logo-light.png" width="250px"></a>
		<div class="header-right">
			<a href="index.php" class="menu">HOME</a>
			<a href="report.php" class="menu">VIEW STATISTICS</a>
			<a href="help.php" class="menu">HELP</a>
			<a>SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
</header>

<body onload="show();">	<!-- show() is called beforehand so that if the user has previously selected the countdown timer, their settings are still shown -->
	<div class="main">
		<p class="title"> Settings </p><br><br>
		<a href="settings_account.php" class="settings_link">Manage account</a>
		<a href="settings_list.php" class="settings_link">Manage subjects/tasks</a>
		<br><br><br>
		<form action="settings.php" method="POST">
			Change timer preferences:<br><br>											<!-- used to autofill form based on user's previously set settings -->
			<input type="radio" name="type" value="up" onClick="show()" <?php if ($_SESSION['timerType'] == 'up') { echo "checked=checked";}?>>Count up timer<br><br>
			<input type="radio" name="type" id="check" value="down" onClick="show()" <?php if ($_SESSION['timerType'] == 'down') { echo "checked=checked"; }?>>Countdown timer<br><br>
		
			<div id="settings" style="display:none; padding-left:3em;">
				Countdown timer length in minutes: <input type="number" min="1" name="length" class="inputbox" value=<?php echo $_SESSION['timerLen'];?> required><br><br>
				Timer ring: <input type="checkbox" name="ring" <?php if ($_SESSION['timerRing'] == 'on') { echo "checked=checked";}?>><br><br>
				Timer notification: <input type="checkbox" name="notif" <?php if ($_SESSION['timerNotif'] == 'on') { echo "checked=checked";}?>><br><br>
			</div>
			
			<div class="button_container">
				<button class="btn" type="submit" name="submitTimer">Save Changes</button>
				<button class="btn btn_right"><a href="index.php" class="no_link">Go back</a></button>
			</div>
			
			<div class="subtitle">
			<?php
				if (isset($_SESSION['message'])) {
					echo "<p>".$_SESSION['message']."<p>";
				}
			?>
			</div>
		</form>
		
	</div>
</body>
</html>