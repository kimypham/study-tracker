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
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php">HOME</a>
			<a href="report.php">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</header>

<body>
	<div class="main" style="background-color: #E3E5E8;">
		<p class="title">Working on <span class="subject"><?php echo $_SESSION['select'];?> . . .</span></p>
		<div class="timer_box">
			<div class="timer_done" style=" line-height:1; display:inline-block; vertical-align: middle;">
			
				<?php 
				$_SESSION['timeSpent'] = $_POST['output'];
				if ($_SESSION['timeSpent'] != 0) {
					echo "<label>Did you work on <span class='italic'>".$_SESSION['select']."</span> for <span class='italic'>".$_SESSION['timeSpent']."</span>?</label>";
				?>
			<div style="display:inline-block; vertical-align:middle;">
				<form action="timer_funct.php" method="POST">
					<button class="controls" type="submit" name="confirm" value="<?php echo $_SESSION['timeSpent']; ?>" style="background-color: #58C898;">YES</button>
				</form>
				</div>
				
				<?php
				} else {
					echo "No time was recorded.";
				}
				?>
				<br>
				<label>If incorrect, please input the correct length of time</label>
				<div style="display:inline-block; vertical-align:middle;">
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
		
	</div>
</body>
</div>