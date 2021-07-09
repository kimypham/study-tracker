<?php
// Study Tracker - Help/about page, version 1.2, Kim Pham

include 'login_check.php';
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
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php" class="menu">HOME</a>
			<a href="report.php" class="menu">VIEW STATISTICS</a>
			<a>HELP</a>
			<a href="settings.php" class="menu">SETTINGS</a>
			<a href="logout.php" class="menu">LOG OUT</a>
		</div>
	</div>
</header>

<body class="scrollbar">
	<div class="main">
		<p class="title"> Help </p><br>
		<p class="title title_medium">About Study Tracker</p>
		<p class="subtitle"> 
			Study Tracker is a web application designed to help students manage their time effectively through the process of
			tracking time spent on various subjects and tasks. Based on the Pomodoro Technique, a time management method 
			created by Francesco Cirillo, Study Tracker aims to prevent students from overworking and losing track of time by
			promoting users to focus on one task at a time and to work in shorter intervals with frequent short breaks.
		</p><br>
		
		<p class="title title_medium">What is the Pomodoro technique?</p>
		<p class="subtitle"> 
			The original Pomodoro Technique suggests to work in 25 minute intervals before taking a 5 minute break. After four
			of these intervals, it suggests to take a longer 15 minute break. Study Tracker automates the tracking of time so
			users can find out how they distrubute their time<br><br>
			
			However the Pomodoro Technique does not have to be followed and the timer can be modified to better suit your needs
			in the settings page.<br>
			<span class="bold">Trouble concentrating for long periods of time?</span> Use shorter work intervals<br>
			<span class="bold">Able to focus for longer periods of times?</span> Use longer work intervals<br>
			<span class="bold">Just want to track time spent without worrying about work/break intervals?</span> Switch to the 
			countup timer instead.<br><br>
		</p><br>
		
		<p class="title title_medium">How do I use it?</p><br>
		<div class="left">
		
			<p class="subtitle">
			<span class="subsubtitle">Main page</span><br>
			This is your main page which contains your subject/task list.<br><br>
			<span class="bold">Adding subjects/tasks:</span> enter in the name of the subject/task and press enter.<br>
			<span class="bold">Remove subject/tasks:</span> click the delete buttons next to each task. (Deleting subject/tasks
			will also delete all information associated with it, effecting the report shown in the 'View Statistics'page)<br><br>
			<span class="bold">Start recording time for subject/tasks:</span> click on the subject/task.<br>
			Editing the subject/task name can be done in the setting pages.<br><br>
			</p>
			
			<p class="subtitle">
			<span class="subsubtitle">Main timer page</span><br>
			Used to record subject/task times. <br><br>
			</p>
			
			<p class="subtitle">
			<span class="subsubtitle">Timer done page</span><br>
			Confirm the time spent on the task. Manual time inputs can also be used.
			<span class="bold">Trouble concentrating for long periods of time?</span> Use shorter work intervals<br>
			<span class="bold">Able to focus for longer periods of times?</span> Use longer work intervals<br>
			<span class="bold">Just want to track time spent without worrying about work/break intervals?</span> Switch to the countup timer instead.<br><br>
			</p>
		</div>
		<div class="right">
			
		</div>
	</div>
</body>
</html>