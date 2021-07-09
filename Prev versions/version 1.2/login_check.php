<?php
// Study Tracker - functions that run on every page, version 1.2, Kim Pham

class Connect {	
	public $connect;
	

	public function __construct() {
		// connect to database
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		return $this->connect;
	}
	
	public function Check() {
		// if the user is not logged in they are not allowed access, redirects to login page
		if ($_SESSION['user']=='') {
			header('Location: login.php');
			die;
		}
	}
	
	public function setDate() {
		if (strpos($_SERVER['REQUEST_URI'], 'report_before.php')){
			$_SESSION['num'] += 1;
		} elseif (strpos($_SERVER['REQUEST_URI'], 'report_after.php')){
			$_SESSION['num'] -= 1;
		} else {
			$_SESSION['num'] = 0;
		}
		date_default_timezone_set('Australia/Melbourne');
		$num = $_SESSION['num'];
		$_SESSION['todayDate'] = date('Y-m-d', strtotime( "-$num days" ));
	}
}

session_start();
error_reporting(0);

$user = new Connect;
$user->Check();
$user-> setDate();
?>