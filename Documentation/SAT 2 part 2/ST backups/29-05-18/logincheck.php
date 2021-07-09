<?php
// Study Tracker - Check user login function, version 1.1, Kim Pham

class Login {
	public $connect;
	
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "todo") or die ("ERROR: Couldn't find database");
		return $this->connect;
	}
	
	public function Check($username, $password) {
		if ($username&&$password) {
			$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username='$username'");
			$numrows = mysqli_num_rows($query);

			// if the username exists in the database, set values
			if ($numrows!=0) {
				while ($row = mysqli_fetch_assoc($query)) {
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
					$userID = $row['ID'];
				}
		
				//check to see if the user inputs match the database's
				if ($username==$dbusername&&$password==$dbpassword) {
					$_SESSION['user'] = $userID;
					$_SESSION['username']=$username;
					header('Location: index.php');
					exit;
				} else {
					$_SESSION['error'] = "Incorrect password!<br>Please try again.";
					header('Location: login.php');
					exit;
				}
			}
			else {
				$_SESSION['error'] = "That user doesn't exist!<br>Please try again.";
				header('Location: login.php');
				exit;
			}
		} else {
			$_SESSION['error'] = "Please enter a username and password.";
			header('Location: login.php');
			exit;
		}
	}
}

$user = new Login;
if (isset($_POST['login'])) {
	$user = new Login;
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->Check($username, $password);
}
?>