<?php
// Study Tracker - Settings (Manage Account) page, version 1.2, Kim Pham
include 'login_check.php';
unset($_SESSION['userMess']);
unset($_SESSION['passMess']);
unset($_SESSION['nameMess']);
include 'settings_funct.php';

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
	
	<script>
function do_check()
{
	var txt;
    var return_value = prompt("Password:");
    if(return_value == "password"){
		txt = "correct";
    } else {
		return false;
	}
	document.getElementById("demo").innerHTML = txt;
}
</script>
<p id="demo"></p>
</head>
<header>
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php">HOME</a>
			<a href="report.php">VIEW STATISTICS</a>
			<a href="help.php">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</header>

<body>
	<div class="main">
		<p class="title">Settings - manage account</p>
		<br>
		<br>
		<form action="settings_account.php" method="POST">
			<label>Username:</label><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" required><br><br>
		
			<label>Current password:</label><input type="password" name="password" id="password"><br>
			<label>New password:</label><input type="password" name="newPass" id="newPass"><br>
			<label>Confirm password:</label><input type="password" name="confirmPass" id="confirmPass"><br>
		
			<label>Display name:</label><input type="text" name="displayName" id="displayName" value="<?php echo $_SESSION['name']; ?>"><br>
			<p> This is the name that appears on your home page <p>
		
			<a onclick="do_check()" href="settings_account.php?del_acc=<?php echo $_SESSION['user']; ?>">Delete my account</a>
			<br><br>
			<button class="btn" type="submit" name="submitAccount">Save Changes</button>
			<button class="btn"><a href="settings.php" class="no_link">Go back</a></button>
		</form>
		<?php
			if (isset($_SESSION['userMess'])) {
				echo "<p>".$_SESSION['userMess']."<p>";
			}
			if (isset($_SESSION['passMess'])) {
				echo "<p>".$_SESSION['passMess']."<p>";
			}
			if (isset($_SESSION['nameMess'])) {
				echo "<p>".$_SESSION['nameMess']."<p>";
			}
		?>
	</div>
</body>
</html>