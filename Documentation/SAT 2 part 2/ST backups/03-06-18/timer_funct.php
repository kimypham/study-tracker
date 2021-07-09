<?php
// Study Tracker - Timer page functions, version 1.1, Kim Pham

class Timer {
	public $connect;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "todo") or die ("ERROR: Couldn't find database");
	}

	public function timeInput($time) {
		$UserID = $_SESSION['user'];
		$select = $_SESSION['select'];
		$query = "UPDATE tasks SET time = '$time' WHERE UserID = '$UserID' AND task = '$select'";
		mysqli_query($this->connect, $query);
	}
}

$user = new Timer();
if ($_GET['select']){
	$select = $_GET['select'];
	$_SESSION['select'] = $select;
} else {
	header('Location: index.php');
}

if (isset($_POST['timeInput'])) {
	$time = $_POST['time'];
	$user->timeInput($time);
}
?>