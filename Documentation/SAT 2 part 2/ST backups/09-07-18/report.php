<?php
// Study Tracker - Report (view statistics) page, version 1.2, Kim Pham
include 'login_check.php';
include 'report_funct.php';
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
			<a class="active" href="index.php">HOME</a>
			<a>VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</header>

<body>
<p class="title"> View statistics </p>
	<br>
	<?php
	// displays all of the user's subjects/tasks and sorts them if neccessary (from display.php)
				if (isset($_GET['sort'])) {	// changes sorting only if changed
					$_SESSION['sort'] = $_GET['sort'];
					$user->Display($_SESSION['sort']);
				} elseif (isset($_SESSION['sort'])) {	// uses previous sorting preference
					$user->Display($_SESSION['sort']);
				} else {
					$user->Display('original');
				}

				if (isset($_SESSION['error'])) {echo "<p>".$_SESSION['error']."</p>";} 	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
				?>

	<a href="settings.php">Go back</a>

</body>
</html>