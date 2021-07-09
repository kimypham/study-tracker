<?php
// Study Tracker - Timer page functions, version 1.2, Kim Pham
session_start();
class Timer {
	public $connect;
	public $query;
	
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
		
		return $this->connect;
	}
	
	// checks if subject/task belongs to the user
	public function checkSubjExists($subj) {
		$UserID = $_SESSION['user'];
		$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$UserID' AND subject = '$subj'");
		$numrows = mysqli_num_rows($subList);
		if ($numrows == 0) {	// doesn't belong to user, redirect to main page
			header('Location: index.php');
		}
	}

	// adds time to the subject
	public function timeInput($time) {
		$UserID = $_SESSION['user'];
		$select = $_SESSION['select'];
		$todayDate = $_SESSION['todayDate'];
		
		/*
		$this->query = "INSERT INTO subList (subject, UserID, time, date) VALUES ('$select', '$UserID', '$time', '$todayDate')";
		mysqli_query($this->connect, $this->query);
		header('Location: index.php');
		*/
		
		$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID ='$UserID' AND subject = '$select' AND date = '$todayDate'");
		$numrows = mysqli_num_rows($subList);
		//echo $numrows;
		if ($numrows!=0) {
			$this->query = "UPDATE subList SET time = time + '$time' WHERE UserID = '$UserID' AND subject = '$select'";
			mysqli_query($this->connect, $this->query);
		} else {
			$this->query = "INSERT INTO subList (subject, UserID, time, date) VALUES ('$select', '$UserID', '$time', '$todayDate')";
			mysqli_query($this->connect, $this->query);
		}
		header('Location: index.php');
	}
}


$user = new Timer();

if (isset($_GET['select'])){		// sets session for subject/task
	$_SESSION['select'] = $_GET['select'];
	$user->checkSubjExists($_SESSION['select']);
}

if (isset($_POST['confirm'])) {		// If 'yes' is pressed, timer value is saved
	$user->timeInput($_SESSION['timeSpent']);
}

if (isset($_POST['timeInput'])) {	// Manual time inputted is saved
	$user->timeInput($_POST['time']);
}

if(isset($_SESSION['message'])){	// If user leaves settings page, the 'changes saved' prompt from settings page is removed
        unset($_SESSION['message']);
}
?>