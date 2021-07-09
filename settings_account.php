<?php
// Study Tracker - Settings (Manage Account) page, version 1.3, Kim Pham

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
		<a href="index.php" title="Home" class="logo"><img src="./images/logo-light.png" width="250px"></a>
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
			<div class="left">
				<label>Username:</label><input class="field" type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" autocomplete="off" maxlength="15" required><br><br><br>
				<input type="password" name="DummyPassword" style="display:none;"> <!-- prevents Firefox from autofilling the password fields -->
				<label>Current password:</label><input class="field" type="password" name="password" id="password" autocomplete="off" pattern=".{5,}" title="5 characters minimum" maxlength="15"><br><br>	<!-- minimum field input by user user123444555621 on Stackoverflow (https://stackoverflow.com/questions/10281962/is-there-a-minlength-validation-attribute-in-html5) -->
				<label>New password:</label><input class="field" type="password" name="newPass" id="newPass" autocomplete="off" pattern=".{5,}" title="5 characters minimum" maxlength="15"><br><br>
				<label>Confirm password:</label><input class="field" type="password" name="confirmPass" id="confirmPass" autocomplete="off" pattern=".{5,}" title="5 characters minimum" maxlength="15"><br>
			</div>
			<div class="right">
			<label>Display name:</label><input class="field" type="text" name="displayName" id="displayName" value="<?php echo $_SESSION['name']; ?>" autocomplete="off" maxlength="15"><br>
			<div class="display_caption"> This is the name that appears on your home page </div>
			</div>
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
		<br><br><br><br><br><br><br><br><br><br>
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