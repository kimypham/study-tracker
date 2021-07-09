<?php
// Study Tracker - Report (view statistics) page, version 1.2, Kim Pham
include 'login_check.php';
unset($_SESSION['error']);
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
			<a>VIEW STATISTICS</a>
			<a href="help.php" class="menu">HELP</a>
			<a href="settings.php" class="menu">SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
</header>

<body>
<div class="main">
	<p class="title"> View statistics </p>
	<br>
	<a href="report_before.php" class="no_link"><button class="btn">Back one day</button></a>
	<a href="report_after.php" class="no_link"><button class="btn">Forward one day</button></a>
	<a href="report.php" class="no_link"><button class="btn">Today</button></a>
	<br><br>
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

	<div class="button_container">
		<a href="index.php" class="no_link"><button class="btn btn_right">Go back</button></a>
	</div>
</div>
</body>
</html>