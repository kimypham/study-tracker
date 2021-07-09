<?php
// Study Tracker - Main page, version 1.0, Kim Pham

error_reporting(0);
session_start();
include 'logincheck.php';
$user = new Login;
  
// if the user has not logged in
if ($_SESSION['user']=='') {
	header('Location: login.php');
	die;
}
  
  $errors = "";

  $UserID = $_SESSION['user'];
  
	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	
	
	// insert a new subject/task if submit button is clicked
	if (isset($_POST['submi'])) {
		if (empty($_POST['task'])) {
			$errors = "You haven't entered a subject or task";
		}else{
			$task = $_POST['task'];
			$query = "INSERT INTO tasks (task, UserID) VALUES ('$task', '$UserID')";
			mysqli_query($db, $query);
			header('location: index.php');
		}
	}
	
	// delete task
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
		header('location: index.php');
	}
	
	// select all tasks if page is visited or refreshed
	$tasks = mysqli_query($db, "SELECT * FROM tasks WHERE UserID =".$UserID." GROUP BY task ORDER BY id");
	
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
		<h1 style="line-height:0;">Hello <?php echo $_SESSION['username']; ?>,</h1>
		<p>It's currently:</p>
		<div id="clock"></div>
		<div id="date"></div>
	</div>



	<div class="main">
		<h1>Subjects and Tasks</h1>

		<table>
			<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td class="taskbox"><a class="task" href="work.php?select=<?php echo $row['task'] ?>"><?php echo $row['task'];?> <span style="padding-left:350px; font-size: 10px;"><?php echo $row['time']; ?> mins</span></a></td>
					<td><a class="delete" onclick="return confirm('Delete this item?');" href="index.php?del_task=<?php echo $row['id'] ?>"><img src="delete.png" width="20px" height="20px"></a></td>
				</tr>
			<?php $i++; } ?>	
			</tbody>
		</table>
	
		<form method="post" action="index.php" class="input_form">
			<input type="text" name="task" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
			<button type="submit" name="submi" id="add_btn" class="add_btn" style="display: none;">Add Task</button>
			
			<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
			<?php } ?>
		</form>
		
	<form method="post" action="index.php">
			<input type="text" name="time" autocomplete="off" placeholder="Length of time studied">
			<button type="submit" name="submitt" id="add_btn">jnjkj</button>
	</form>

	
	</div>
<!--JavaScript code for single Motivational Quote of the Day, http://www.tqpage.com/-->
<!--<script language="javascript" src="http://www.quotationspage.com/data/1mqotd.js">
</script> <!--End JavaScript Quotations code-->	
	
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