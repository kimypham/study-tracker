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

<p id="demo"></p>
</head>
<header>
	<div class="header">
		<a href="index.php" title="Home" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php" class="menu">HOME</a>
			<a href="report.php" class="menu">VIEW STATISTICS</a>
			<a href="help.php" class="menu">HELP</a>
			<a href="settings.php" class="menu">SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
</header>

<body>
	<div class="main">
		<p class="title">Settings - manage account</p><br><br>
		<form action="settings_account.php" method="POST">
			<label>Username:</label><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" required><br><br><br>
		
			<input type="password" name="DummyPassword" style="display:none;"> <!-- prevents Firefox from autofilling the password fields -->
			<label>Current password:</label><input type="password" name="password" id="password" autocomplete="off"><br><br>
			<label>New password:</label><input type="password" name="newPass" id="newPass"><br><br>
			<label>Confirm password:</label><input type="password" name="confirmPass" id="confirmPass"><br>
			
			<label>Display name:</label><input type="text" name="displayName" id="displayName" value="<?php echo $_SESSION['name']; ?>"><br>
			<div class="info"> This is the name that <br>appears on your home page </div>
			
			<div class="button_container">
				<button class="btn" type="submit" name="submitAccount">Save Changes</button>
				<button class="btn btn_right"><a href="settings.php" class="no_link">Go back</a></button>
			</div>
		</form>
		<form action="settings_account.php" method="POST">
			<input type="hidden" name="account" value="<?php echo $_SESSION['user']; ?>">
			<input class="delete_link pretend_link" type="submit" onclick="return confirmDel();" name="delAcc" value="Delete my account"></input>
		</form>
		<div class="subtitle">
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
	</div>
</body>
</html>