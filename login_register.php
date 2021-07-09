<?php
// Study Tracker - Check user login and register new user functions, version 1.3, Kim Pham

class loginRegist {
	public $connect;
	public $query;
	
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		return $this->connect;
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
					header('Location: login.php');
					$_SESSION['error'] = "Incorrect username or password!<br>Please try again.";
					exit;
				}
			} else {
				header('Location: login.php');
				$_SESSION['error'] = "That user doesn't exist!<br>Please try again.";
				exit;
			}
		} else {
			header('Location: login.php');
			$_SESSION['error'] = "Please enter a username and password.";
			exit;
		}
	}
	
	public function Register($username, $password) {
		if ($username&&$password) {
			$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username='$username'");	//check if username already exists
			$numrows = mysqli_num_rows($query);
			if ($numrows != 0) {
				header('Location: register.php');
				$_SESSION['error'] = "That username is already taken.";
			} else {
				$query = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$username')";
				mysqli_query($this->connect, $query);
			
				// set up new user session
				$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username='$username'");
				while ($row = mysqli_fetch_assoc($query)) {
					$userID = $row['ID'];
				}
				$_SESSION['user'] = $userID;
				$_SESSION['username'] = $username;
				$_SESSION['name'] = $username;
				header('Location: index.php');
			}
		} else {
			header('Location: register.php');
			$_SESSION['error'] = "Please enter a username and password.";
			exit;
		}
		include 'XML_funct.php';
		exit;
	}
}

$user = new loginRegist;

if (isset($_POST['login'])) {
	unset($_SESSION['error']);
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->Login($username, $password);
}

if (isset($_POST['register'])) {
	unset($_SESSION['error']);
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->Register($username, $password);
}

// if the user has already logged in there no need to login in again, redirects to index.php
if (isset($_SESSION['user'])) {
	header('Location: index.php');
}
?>