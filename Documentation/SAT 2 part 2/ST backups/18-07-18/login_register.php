<?php
// Study Tracker - Check user login and register new user functions, version 1.2, Kim Pham

class loginRegist {
	public $connect;
	public $query;
	
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		return $this->connect;
		
		unset($_SESSION['error']);	//prevents errors from index.php from displaying on the login/register page
	}
	
	public function Login($username, $password) {
		if ($username&&$password) {
			$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username='$username'");
			$numrows = mysqli_num_rows($query);

			// if the username exists in the database, set values
			if ($numrows != 0) {
				while ($row = mysqli_fetch_assoc($query)) {
					$userID = $row['ID'];
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
					$name = $row['name'];
				}
		
				// check to see if the user inputs match the database's and set sessions
				if ($username == $dbusername && $password == $dbpassword) {
					$_SESSION['user'] = $userID;
					$_SESSION['username'] = $username;
					$_SESSION['name'] = $name;
					header('Location: index.php');
					exit;
				} else {
					$_SESSION['error'] = "Incorrect username or password!<br>Please try again.";
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
	
	public function Register($username, $password) {
		if ($username&&$password) {
			$query = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$username')";
			mysqli_query($this->connect, $query);
			
			// set up new user session
			$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username='$username'");
			while ($row = mysqli_fetch_assoc($query)) {
				$userID = $row['ID'];
			}
			$_SESSION['user'] = $userID;
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $name;
			header('Location: index.php');
		} else {
			$_SESSION['error'] = "Please enter a username and password.";
			header('Location: register.php');
			exit;
		}
		include 'XML_funct.php';
		header('Location: index.php');
		exit;
	}
}

$user = new loginRegist;

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->Login($username, $password);
}

if (isset($_POST['register'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->Register($username, $password);
}
?>