<?php
// Study Tracker - Timer page functions, version 1.2, Kim Pham
session_start();
class Timer {
	public $connect;
	
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
	}
	
	public function checkSubjExists($subj) {
		$UserID = $_SESSION['user'];
		// Search for subjects/tasks that belong to the user
		$tasks = mysqli_query($this->connect, "SELECT * FROM tasks WHERE task = '$subj' AND UserID = '$UserID'");
		$numrows = mysqli_num_rows($tasks);
		if ($numrows == 0) {
			header('Location: index.php');
		}
	}

	// adds time to the subject
	public function timeInput($time) {
		$UserID = $_SESSION['user'];
		$select = $_SESSION['select'];
		$query = "UPDATE tasks SET time = time + '$time' WHERE UserID = '$UserID' AND task = '$select'";
		mysqli_query($this->connect, $query);
		header('Location: index.php');
	}
}


$user = new Timer();

if (isset($_GET['select'])){	// sets session for subject/task
	$_SESSION['select'] = $_GET['select'];
	$user->checkSubjExists($_SESSION['select']);
}

if (isset($_POST['timeInput'])) {
	$user->timeInput($_POST['time']);
}

if (isset($_POST['confirm'])) {
	$user->timeInput($_SESSION['timeSpent']);
}

if(isset($_SESSION['message'])){	// If user leaves settings page, the 'changes saved' prompt from settings page is removed
        unset($_SESSION['message']);
}
?>