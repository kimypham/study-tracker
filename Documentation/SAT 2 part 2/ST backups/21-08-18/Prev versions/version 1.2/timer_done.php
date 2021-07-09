<?php
// Study Tracker - Timer done page, version 1.2, Kim Pham

include 'login_check.php';
include 'timer_funct.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
</head>

<header>
	<div class="header">
		<a href="index.php" class="logo" title="Home">Study Tracker</a>
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
					<div style="float:right;">
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
					
					?>
					<div style="float:right;">
						<form action="timer_funct.php" method="POST">
							<button class="controls" type="submit" name="confirm" value="<?php echo $_SESSION['timeSpent']; ?>" style="background-color: #58C898;">YES</button>
						</form>
					</div>
					<?php
				}
				?>
				<br>
				<label>If incorrect, please input the correct length of time</label>
				<div style="float: right; display:inline-block; vertical-align:middle;">
					<form action="timer_done.php" method="POST">
						<input type="number" name="time" placeholder="Length of time studied">
						<button type="submit" name="timeInput" id="timeInput" style="display: none;"></button>
					</form>
				</div>
				<br><br>
			</div>
				<form action="work.php?select=<?php echo $_SESSION['select'];?>">
					<button class="controls control_left" style="width: 0%; visibility: hidden;"></button>
					<button class="controls control_right">Go back to timer</button>
				</form>
				<form action="timer_funct.php" method="POST">
					<button class="controls control_right" href="index.php" name="confirm" value="<?php echo $_SESSION['timeSpent']; ?>">Done!</button>
				</form>
		</div>
		<label style="float:right;">Note: This timer session will not be recorded and the timer will be reset</label>	
	</div>
</body>