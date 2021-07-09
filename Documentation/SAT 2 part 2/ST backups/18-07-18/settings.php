<?php
// Study Tracker - Main settings page (timer), version 1.2, Kim Pham

include 'login_check.php';
unset($_SESSION['message']);
include 'display.php';
include 'XML_funct.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
	<script>
function show() {
	var countdown = document.getElementById("check");
    var settings = document.getElementById("settings");
    if (countdown.checked == true){
        settings.style.display = "block";
    } else {
       settings.style.display = "none";
    }
}
</script>
</head>
<header>
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php">HOME</a>
			<a href="report.php">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a>SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</header>

<body onload="show();">	<!-- show() is called beforehand so that if the user has previously selected the countdown timer, their settings are still shown -->
	<div class="main">
		<p class="title"> Settings </p><br>
		<a href="settings_account.php">Manage account</a>
		<a href="settings_list.php">Manage subjects/tasks</a>
		<br><br>
		<form action="settings.php" method="POST">
			Change timer preferences:<br>											<!-- used to autofill form based on user's previously set settings -->
			<input type="radio" name="type" id="type" value="up" onClick="show()" <?php if ($_SESSION['timerType'] == 'up') { echo "checked=checked";}?>>Count up timer<br>
			<input type="radio" name="type" id="check" value="down" onClick="show()" <?php if ($_SESSION['timerType'] == 'down') { echo "checked=checked"; }?>>Countdown timer<br>
		
			<div id="settings" style="display:none">
				Countdown timer length in minutes: <input type="number" min="1" name="length" id="length" value=<?php echo $_SESSION['timerLen'];?> required><br>
				Timer ring: <input type="checkbox" name="ring" id="ring" <?php if ($_SESSION['timerRing'] == 'on') { echo "checked=checked";}?>><br>
				Timer notification: <input type="checkbox" name="notif" id="notif" <?php if ($_SESSION['timerNotif'] == 'on') { echo "checked=checked";}?>><br>
			</div>
			<br>
			<button class="btn" type="submit" name="submitTimer">Save Changes</button>
			<?php
				if (isset($_SESSION['message'])) {
					echo "<p>".$_SESSION['message']."<p>";
				}
			?>
			<button class="btn"><a href="index.php" class="no_link">Go back</a></button>
		</form>
	</div>
</body>
</html>