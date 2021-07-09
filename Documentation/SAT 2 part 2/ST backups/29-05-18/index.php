<?php
// Study Tracker - Main page, version 1.1, Kim Pham

error_reporting(0);
session_start();

// if the user is not logged in they are not allowed access, redirects to login page
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}

include 'add_delete.php';

$errors = "";
?>
 

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="time.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<div class="header">
		<a href="#default" class="logo">Study Tracker</a>
		<div class="header-right">
			<a class="active" href="index.php">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="#settings">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</head>

<body onload="startTime()">

	<div class="datebox">
		<h1 style="line-height:0;">Hello<?php if(isset($_SESSION['username'])) { echo " ".$_SESSION['username']; }?>,</h1>
		<p>It's currently:</p>
		<div id="clock"></div>
		<div id="date"></div>
	</div>



	<div class="main">
		<h1>Subjects and Tasks</h1>

		<?php $user->Display(); ?>
		
		<form method="post" action="index.php" class="input_form">
			<input type="text" name="task" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
			<button type="submit" name="add" id="add_btn" class="add_btn" style="display: none;"></button>
			
			<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
			<?php } ?>
		</form>
		
<!--Experimenting with a feature to manually add the time spent.-->	
	<form method="post" action="index.php">
			<input type="text" name="time" autocomplete="off" placeholder="Length of time studied">
			<button type="submit" name="submitt" id="add_btn">jnjkj</button>
	</form>
	
	</div>
	
<!--Experimenting with a daily quote generator.-->	
	<!--JavaScript code for single Motivational Quote of the Day, http://www.tqpage.com/-->
	<!--<script language="javascript" src="http://www.quotationspage.com/data/1mqotd.js">
	</script> <!--End JavaScript Quotations code-->	
	
	
<!--Testing JavaScript notifications for implementation in timer page. Not going to be part of the final main page.-->	
<audio id="beep">
	<source src="beep.wav" type="audio/mpeg">
</audio>
	
<button onclick="showNotification()">Show a Notification</button>
	
	<script type="text/javascript">
		var sound = document.getElementById("beep");
	
		function showNotification() {
			if(window.Notification) {
				Notification.requestPermission(function(status) { 
					console.log('Status: ', status);
					var n = new Notification("Time's up", { body: "Remember to take frequent breaks!", icon:'relax.png' }); 
					sound.play();
					setTimeout(function(){ n.close() }, 7000);
				});
			}
			else {
				alert('Your browser doesn\'t support notifications.');
			}
		}
	</script>
	
</body>
</html>