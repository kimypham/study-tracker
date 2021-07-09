<?php
// Study Tracker - OOP functions to add and delete subjects/tasks, version 1.3, Kim Pham

class Add_del {
	public $connect;
	public $query;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		return $this->connect;
	}
	
	
	// Add and Del functions uses modified code from CodeWithAwa (http://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database)

	// insert a new subject/task
	 public function Add() {
		if (empty($_POST['subject'])) {
				$_SESSION['error'] = "You haven't entered a subject or task.";
			} else {
				unset($_SESSION['error']);
				$UserID = $_SESSION['user'];
				$subject = $_POST['subject'];
				
				if (strlen($subject) > 25) {
					$_SESSION['error'] = "Subject name is too long.";
				} else {
					$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$UserID' AND subject = '$subject'");
					$numrows = mysqli_num_rows($subList);
					if ($numrows!=0) {
						$_SESSION['error'] = "You've already added that to your list!";
					} else {
						$todayDate = $_SESSION['todayDate'];
						$this->query = "INSERT INTO subList (subject, UserID, time, date) VALUES ('$subject', '$UserID', 0, '$todayDate')";
						mysqli_query($this->connect, $this->query);
					}
				}
			}
	 }
	
	// delete a subject/task
	public function Del($subject) {
		mysqli_query($this->connect, "DELETE FROM subList WHERE subject = '$subject'");
	}
}

$user = new Add_del;

if (isset($_POST['add'])) {
	$user->Add();
}

if(isset($_POST['deleteSubj'])){
	$subject = $_POST['subject'];
	$user->Del($subject);
}
?>