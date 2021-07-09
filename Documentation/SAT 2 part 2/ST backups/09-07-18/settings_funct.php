<?php
// Study Tracker - Change user or subject/task info from settings, version 1.2, Kim Pham

class Settings {
	public $connect;
	public $dbusername;
	public $dbpassword;
	public $dbname;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
	}
	
	// reads database and sets variables
	public function Auto($id){
		$query = mysqli_query($this->connect, "SELECT * FROM users WHERE ID = $id");
		$numrows = mysqli_num_rows($query);

		// if the username exists in the database, set values
		if ($numrows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$this->dbusername = $row['username'];
				$this->dbpassword = $row['password'];
				$this->dbname = $row['name'];
			}
		}
	}
	
	// updates user's settings
	public function Update($INusername, $INpassword, $INnewPass, $INconfirmPass, $INname, $id) {
		
		if ($INusername != $this->dbusername){
			mysqli_query($this->connect, "UPDATE users SET username = '$INusername' WHERE ID = '$id'");
			$_SESSION['username'] = $INusername;
			$_SESSION['userMess'] = "Username changed to $INusername";
		}
		
		if ($INpassword != NULL) {
			if ($INpassword && $INnewPass && $INconfirmPass){
				if ($INpassword == $this->dbpassword){	// if current password matches database
					if ($INnewPass == $INconfirmPass){
						if ($INnewPass == $this->dbpassword){
							$_SESSION['passMess'] = "old and new passwords are the same";
						} else {
							mysqli_query($this->connect, "UPDATE users SET password = '$INnewPass' WHERE ID = '$id'");
							$_SESSION['passMess'] = "Password changed sucessfully.";
						}
					} else {
						$_SESSION['passMess'] = "new passwords do not match. Please retype in your passwords carefully";
					}
				} else {
					$_SESSION['passMess'] = "current password does not match";
					}
			} else {
			$_SESSION['passMess'] = "to change your password, please input in all password fields";
		}
		}
		
		if ($INname != $this->dbname){
			mysqli_query($this->connect, "UPDATE users SET name = '$INname' WHERE ID = '$id'");
			$_SESSION['name'] = $INname;
			$_SESSION['nameMess'] = "Display name changed to $INname";
		}
	}
	
	public function delAcc($acc) {
		
		echo "deleting $acc";
	}
	
	
}

$user = new Settings;
$user->auto($_SESSION['user']);

if (isset($_POST['submitAccount'])) {	// gets all variables from settings (account) form
	$INusername = $_POST['username'];
	$INpassword = $_POST['password'];
	$INnewPass = $_POST['newPass'];
	$INconfirmPass = $_POST['confirmPass'];
	$INname = $_POST['displayName'];
	$id = $_SESSION['user'];
	
	$user->Update($INusername, $INpassword, $INnewPass, $INconfirmPass, $INname, $id);
}

if (isset($_GET['del_acc'])) {
	$acc = $_GET['del_acc'];
	$user->delAcc($acc);
}
?>
	