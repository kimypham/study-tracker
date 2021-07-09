<?php
// Study Tracker - Settings (Manage Subjects and Tasks) page, version 1.2, Kim Pham
include 'login_check.php';
include 'settings_funct.php';
include 'display.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
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
<p class="title"> Settings - manage subjects and tasks </p>
<p> Enter in the text box to change the subject/task's name and use the delete button to delete the subject/task.</p>
		<?php
		if (isset($_GET['sort'])) {	// changes sorting only if changed
			$_SESSION['sort'] = $_GET['sort'];
			$user->Display($_SESSION['sort']);
		} elseif (isset($_SESSION['sort'])) {	// uses previous sorting preference
			$user->Display($_SESSION['sort']);
		} else {
			$user->Display('original');
		}
		?>
		<div class="input_container">
			<form method="post" action="index.php" class="input_form">
				<input type="text" name="subject" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
				<button type="submit" name="add" id="add_btn" style="width: 0px; height: 0px; opacity: 0;"></button>
			</form>
			</div>
	<form>
		<button class="inputs login-submit" type="submit" name="submitAccount"> Save Changes </button>
	</form>
	<?php
		if (isset($_SESSION['message'])) {
			echo "<p>".$_SESSION['message']."<p>";
		}
	?>
	<br>
	<a href="settings.php">Go back</a>

</body>
</html>