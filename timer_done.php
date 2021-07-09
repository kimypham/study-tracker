<?php
// Study Tracker - Timer done page, version 1.3, Kim Pham

include 'login_check.php';
include 'timer_funct.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<header>
	<div class="header">
		<a href="index.php" class="logo" title="Home"><img src="./images/logo-light.png" width="250px"></a>
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
	<div class="main" style="background-color: #E3E5E8;">
		<p class="title">Working on <span class="subject"><?php echo $_SESSION['select'];?> . . .</span></p>
		<div class="timer_box">
			<div class="timer_done">
				<?php 
				$_SESSION['timeSpent'] = $_POST['output'];
				if ($_SESSION['timeSpent']>=60){	// timeSpent is in seconds. Converts to minutes to save in database.
					$_SESSION['timeSpent'] = round($_SESSION['timeSpent']/60);	// only whole values are stored
					
					if ($_SESSION['timeSpent'] == 1){
						echo "<label>Did you work on <span class='italic'>".$_SESSION['select']."</span> for <span class='italic'>".$_SESSION['timeSpent']." minute</span>?</label>";
					} else {
						echo "<label>Did you work on <span class='italic'>".$_SESSION['select']."</span> for <span class='italic'>".$_SESSION['timeSpent']." minutes</span>?</label>";
					}
				?>
					<div class="timer_done_controls">
						<form action="timer_funct.php" method="POST">
							<button class="controls" type="submit" name="confirm" value="<?php echo $_SESSION['timeSpent']; ?>" style="background-color: #58C898;">YES</button>
						</form>
					</div>
				<?php
				} else {
					$seconds = round($_SESSION['timeSpent']);
					unset($_SESSION['timeSpent']);	// Seconds aren't stored in database
					if ($seconds != 0) {
						if ($seconds == 1) {
							echo "Less than one minute ($seconds second) was recorded.";
						} else {
						echo "Less than one minute ($seconds seconds) was recorded.";
						}
					} else {
						echo "No time was recorded.";
					}
				}
				?>
				<br>
				<label>If incorrect, please input the correct length of time</label>
				<div class="timer_done_controls">
					<form action="timer_funct.php" method="POST">
						<input class="time_input" type="number" name="time" placeholder="Time in minutes" autocomplete="off" max="450">
						<button class="controls material-icons" type="submit" name="timeInput" style="position:absolute; padding:0.5em; background-color:#58C898;">done</button>
				</div>
				<br><br>
			</div>
				</form>
				<form action="work.php?select=<?php echo $_SESSION['select'];?>">
					<button class="controls control_right">Go back to timer</button>
				</form>
		</div>
		<label style="margin-left:1em; font-size:1.5vw;">Note: This timer session will not be <br>recorded and the timer will be reset</label>	
	</div>
</body>