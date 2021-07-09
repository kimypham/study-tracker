<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="time.js"></script>
	<style>
	
	* {box-sizing: border-box;}

html, body {
    width: 100%;
    overflow-x: hidden;
}

body { 
  margin: 0;
  font-family: Arial;
  color:#486381;
 font-size: 20px;
}

a{
	color:#486381;
}

.header {
  overflow: hidden;
  background-color: #729dcb;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 15px; 
  line-height: 25px;
  border-radius: 4px;
  transition: 0.3s;
  letter-spacing: 2px;
}

.header a.logo {
  font-size: 25px;
  color: white;
  padding-left: 60px;
}

.header a:hover {
  background-color: #578ac1;
}

.header a.active {
}

.header-right {
  float: right;
}

h1 {
	font-family: "industry", sans-serif;
	color:#486381;
	font-weight: normal;
	font-size: 40px;
	margin-bottom:10px;
}

.task {
    display: inline-block;
    width: 325px;
    height: 20px;
	font-size: 20px;
	background-color: #e3e5e8;
	padding: 10px 15px 35px 15px;
	margin-bottom: 10px;
	transition: 0.3s;
	text-decoration:none;
}

.subject {
	color: #647383;
	text-align: left;
	font-size: 20px;
	transition: 0.3s;
	text-decoration:none;
}

.task:hover {
	background-color: #c5cbd3;
	
.add_btn{
	display: none;
}

}
.delete {
	height:50px;
	width: 20px;
	color: #647383;
	padding: 10px 50px 25px 10px;;
	cursor: pointer;
	transition: 0.3s;
	text-decoration: none;
	opacity:0.5;
	display:inline-block;
}

.delete:hover {
    opacity:1;
}

.task_input {
	width: 325px;
	height: 40px;
	padding: 20px;
}

input, input::-webkit-input-placeholder {
	margin-top: 10px;
    font-size: 15px;
	line-height: 3;
	
}

.main{
	float:left;
	padding-left:60px;
	padding-right: 20px;
}

.datebox{
	float: center;
	text-align: center;
	display: block;
	padding-top: 30px;
}
#clock{
	color:#486381;
	font-size: 130px;
	font-family: "Calibri Light";
	line-height:1;
}
#date{
	margin-bottom: 70px;
}
.ampm{
	font-size: 40px;
	display: inline;
}
	
	</style>
	
	<div class="header">
		<a href="#default" class="logo">Study Tracker</a>
		<div class="header-right">
			<a class="active">HOME</a>
			<a href="#report">VIEW STATISTICS</a>
			<a href="#help">HELP</a>
			<a href="#settings">SETTINGS</a>
			<a href="#logout">LOG OUT</a>
		</div>
	</div>
</head>

<?php
  session_start();
  error_reporting(0);
  
  $_SESSION['username'] = "Alex";
  
  $errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	
	
	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You haven't entered a subject or task";
		}else{
			$task = $_POST['task'];
			$query = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $query);
			header('location: pagemockup3.php');
		}
	}	
	
	// delete task
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
		header('location: pagemockup3.php');
	}
	
	// select all tasks if page is visited or refreshed
	$tasks = mysqli_query($db, "SELECT * FROM tasks");
  ?>

<body onload="startTime()">
<div class="main">
	
	<h1 style="line-height:0; padding-top: 30px;"><?php echo "Hello ".$_SESSION['username'].","?> <span style="font-family: Calibri Light; font-size:20px; float:right; padding-right:60px">"Thrive for progress, not perfection"</span></h1>
	<div class="datebox">
		<div id="clock"></div>
		<div id="date"></div>
	</div>

		<h1>Subjects and Tasks <span style="font-size:17px; line-height:0; padding-left: 30px;"> Select one below to start timing or select <span style="padding-left: 30px;"><a href=""><img src="timer.png" width="15px" height="15px" style="text-decoration: underline;"> Free timing mode</a></span></span></h1>

		
			<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<a href="work.php?select=<?php echo $row['id'] ?>" style="text-decoration:none;">
				<div class="task">
						<div class="subject"><?php echo $row['task']; ?></div>
				</div>
				</a>
					<a class="delete" onclick="return confirm('Delete this item?');" href="pagemockup3.php?del_task=<?php echo $row['id'] ?>"><img src="delete.png" width="20px" height="20px"></a>
				
			<?php $i++; } ?>	
	
		<form method="post" action="pagemockup3.php" class="input_form">
			<input type="text" name="task" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
			<button type="submit" name="submit" id="add_btn" class="add_btn" style="display: none;">Add Task</button>
			
			<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
			<?php } ?>
		</form>
	
	</div>

</body>
</html>