<?php
// Study Tracker - Help/about page, version 1.3, Kim Pham

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
		<a href="index.php" class="logo"><img src="./images/logo-light.png" width="250px"></a>
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
		<img src="./images/logo-dark.png" width="250px" style="padding: 3em 0em 3em 0em; float:right;">
		<p class="subtitle"> 
			Study Tracker is a web application designed to help students manage their time effectively through the process of
			tracking time spent on various subjects and tasks. Based on the Pomodoro Technique, a time management method 
			created by Francesco Cirillo, Study Tracker aims to prevent students from overworking and losing track of time by
			promoting users to focus on one task at a time and to work in shorter intervals with frequent short breaks. Study
			Tracker works best in Chrome.
		</p><br>
		
		
		<p class="title title_medium">What is the Pomodoro technique?</p>
		<p class="subtitle"> 
			The original Pomodoro Technique suggests to work in 25 minute intervals before taking a 5 minute break. After four
			of these intervals, it suggests to take a longer 15 minute break. Learn more about the technique <a href="https://francescocirillo.com/pages/pomodoro-technique" style="color: #486381;"> here</a>.<br>
			Study Tracker automates the tracking of time so users can find out how they distrubute their time and better manage it.<br><br>
			
			The Pomodoro Technique does not have to be followed and the timer used in Study Tracker can be modified to better suit your needs
			in the settings page.<br>
			<span class="bold">Trouble concentrating for long periods of time?</span> Use shorter work intervals<br>
			<span class="bold">Able to focus for longer periods of times?</span> Use longer work intervals<br>
			<span class="bold">Just want to track time spent without worrying about work/break intervals?</span> Switch to the 
			countup timer instead.<br><br>
		</p><br>
		
		<p class="title title_medium">How do I use it?</p><br>
		<p class="subtitle">
		<img src="./images/screenshots/main.png" width="500px" class="help_images">
		<span class="subsubtitle">Main page</span><br>
		This is your main page which contains your subject/task list.<br><br>
		<span class="bold">Adding subjects/tasks:</span> enter in the name of the subject/task and press enter.<br>
		<span class="bold">Remove subject/tasks:</span> click the delete buttons next to each task. (Deleting subject/tasks
		will also delete all information associated with it, effecting the report shown in the 'View Statistics'page)<br><br>
		<span class="bold">Start recording time for subject/tasks:</span> click on the subject/task.<br>
		Editing the subject/task name can be done in the setting pages.<br><br>
		</p>
		<br>
			
		<p class="subtitle">
		<img src="./images/screenshots/timer.png" width="500px" class="help_images">
		<span class="subsubtitle">Main timer page</span><br>
		Used to record subject/task times. <br><br>
		<span class="bold">Starting/pausing the timer:</span> Click on the start/stop button.<br>
		<span class="bold">Reseting/restarting the timer:</span> Click on the reset button (or on the start over button when the timer runs out)<br>
		<br>
		The type and length of the timers can be adjusted in the settings page.
		</p>
		<br><br><br><br><br>
			
		<p class="subtitle">
		<img src="./images/screenshots/timer-done.png" width="500px" class="help_images">
		<span class="subsubtitle">Timer done page</span><br>
		Confirm the time spent on the task. Manual time inputs can also be used. Accessible after using the timer.<br><br>
		<span class="bold">If the time shown is correct:</span> Click 'yes' to add the specified time to your records.<br>
		<span class="bold">If the time shown is incorrect/you forgot to use the timer:</span> Input the correct length of time in minutes<br>
		<br>
		Going back to the timer resets everything and all progress will be lost.
		</p>
		<br><br><br><br>
			
		<p class="subtitle">
		<img src="./images/screenshots/report.png" width="500px" class="help_images">
		<span class="subsubtitle">View statistics page</span><br>
		Shows a report of the time spent on a day. <br><br>
		<span class="bold">View previous day:</span> Click 'back one day'.<br>
		<span class="bold">View next day:</span> Click 'forward one day' (only if you are viewing a previous record).<br>
		<span class="bold">View current day:</span> Click 'today'.<br>
		</p>
		<br><br><br><br><br><br><br>
			
		<p class="subtitle">
		<img src="./images/screenshots/settings.png" width="500px" class="help_images">
		<span class="subsubtitle">Settings (timer) page</span><br>
		Adjust timer preferences. <br><br>
		Here you can change the timer type (countup/countdown), the timer's countdown length and whether to use browser push notifications and/or sounds to play when the countdown timer finishes.<br><br>
		Note that as of 2018, push notifications are only supported in Chrome, Edge, Firefox and Safari.
		</p>
		<br><br><br><br>
			
		<p class="subtitle">
		<img src="./images/screenshots/settings-account.png" width="500px" class="help_images">
		<span class="subsubtitle">Settings (account) page</span><br>
		Manage account details. Accessible from the settings page. <br><br>
		Here you can change your username, password and display name (the name shown on the home page).<br>
		You can also delete your account here.
		</p>
		<br><br><br><br><br><br><br>
			
		<p class="subtitle">
		<img src="./images/screenshots/settings-subj.png" width="500px" class="help_images">
		<span class="subsubtitle">Settings (subject/task) page</span><br>
		Manage the subject/task list. Accessible from the settings page. <br><br>
		Here you can edit a subject/task's name or delete a subject/task.<br>
		</p>
		<br><br><br><br><br><br><br><br><br>	
	</div>
</body>
</html>