<?php
// Study Tracker - Timer page, version 1.1, Kim Pham

session_start();

$db = mysqli_connect("localhost", "root", "", "todo");
$tasks = mysqli_query($db, "SELECT * FROM tasks");

if (!isset($_GET['select'])) {
	echo "You haven't chosen a subject";
	}

$select = $_GET['select'];
$_SESSION['subject']=$select;
$time = $_POST['time'];

	// checking what values are being sent, not implemented in final solution
	echo "testing";
	echo $time;
	echo $select;
	
if (isset ($_GET['submitt'])) {
	$id = $_GET['select'];
	$time = $_POST['time'];
	$query = "UPDATE tasks SET time = 1000 WHERE id=23";
	mysqli_query($db, $query);
}
	
if (isset($_GET['select'])) {
	$id = $_GET['select'];
		$row = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM tasks WHERE id=".$id));
		if (empty($_POST['time'])) {
			$errors = "You haven't enteresjkskjrsask";
		}else{
			$id = $_GET['select'];
			$time = $_POST['time'];
			$query = "UPDATE tasks SET time = '$time' WHERE id=23";
			mysqli_query($db, $query);
		}
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">
	<a href="#default" class="logo">Study Tracker</a>
	<div class="header-right">
		<a href="index.php">HOME</a>
		<a href="#report">VIEW STATISTICS</a>
		<a href="#help">HELP</a>
		<a href="#settings">SETTINGS</a>
	</div>
</div>
</head>

<body>
<div class="main">
<p><?php echo "Working on: ".$select;?></p>

<form method="post" action="work.php">
	<input type="text" name="time" placeholder="Length of time studied">
	<button type="submit" name="submitt" id="add_btn"></button>
</form>
<a href="index.php">Go back</a>
</div>
</body>
</html>