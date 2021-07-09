<?php
// Study Tracker - Settings (Manage Subjects and Tasks) page, version 1.2, Kim Pham
include 'login_check.php';
unset($_SESSION['error']);	//so that any errors from previous pages don't show here
unset ($_SESSION['message']);
include 'add_delete.php';
include 'settings_funct.php';
include 'display.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
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
		<p class="title">Settings - manage subjects and tasks</p>
		<p class="subtitle"> Enter in the text box to change the subject/task's name and use the delete button to delete the subject/task.</p><br>
		
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
			
			<!-- the form and the submit buttons are located in display.php -->
			
			<div class="error_message">
			<?php
				if (isset($_SESSION['error'])) {echo "<p>".$_SESSION['error']."</p>";} 	// error displays if user leaves a blank textbox or if they try to add a duplicate subject/task
				?>
			</div>
			<div class="subtitle">
			<?php
				if (isset($_SESSION['message'])) {
					echo "<p>".$_SESSION['message']."<p>";
				}
				
				
			?>
			</div>
	</div>
</body>
</html>