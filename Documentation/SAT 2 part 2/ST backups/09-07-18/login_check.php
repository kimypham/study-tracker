<?php
class Connect {	
	public $connect;
	

	public function __construct() {
		// connect to database
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
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
		date_default_timezone_set('Australia/Melbourne');
		$_SESSION['todayDate'] = date('Y-m-d');
	}
}

session_start();
//error_reporting(0);

$user = new Connect;
$user->Check();
$user-> setDate();
?>