<?php
// Study Tracker - Timer page, version 1.1, Kim Pham
session_start();

// if the user is not logged in they are not allowed access, redirects to login page
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}

include 'XML_funct.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a class="active" href="index.php">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a>SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
	
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

<body onload="show();">	<!-- show() is called beforehand so that if the user has previously selected the countdown timer, their settings are still shown -->
	<form action="settings.php" method="POST">
		<a href="#">Manage account</a>
		<a href="#">Manage subjects/tasks</a>
		<br>
		<br>
		Change timer preferences:<br>											<!-- used to autofill form based on user's previously set settings -->
		<input type="radio" name="type" id="type" value="up" onClick="show()" <?php if ($_SESSION['type'] == 'up') { echo "checked=checked";}?>>Count up timer<br>
		<input type="radio" name="type" id="check" value="down" onClick="show()" <?php if ($_SESSION['type'] == 'down') { echo "checked=checked"; }?>>Countdown timer<br>
		
		<div id="settings" style="display:none">
			Countdown timer length in minutes: <input type="number" name="length" id="length" value=<?php echo $_SESSION['length'];?> required><br>
			Timer ring: <input type="checkbox" name="ring" id="ring" <?php if ($_SESSION['ring'] == 'on') { echo "checked=checked";}?>><br>
			Timer notification: <input type="checkbox" name="notif" id="notif" <?php if ($_SESSION['notif'] == 'on') { echo "checked=checked";}?>><br>
		</div>
		<br>
		<input class="inputs login-submit" type="submit" value="Save changes" value="submit" name="submit">
	</form>
	<?php if (isset($_SESSION['message'])) {
					echo "<p>".$_SESSION['message']."<p>";
				}
	?>
	<br>
	<a href="index.php">Go back</a>

</body>
</html>