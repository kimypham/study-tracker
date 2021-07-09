<?php
// Study Tracker - Change user or subject/task info from settings, version 1.3, Kim Pham

class Settings {
	public $connect;
	public $dbusername;
	public $dbpassword;
	public $dbname;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
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
		?>
		<script>
			function confirmDel()	{
				var txt;
				var return_value = prompt("Are you sure you want to delete your account? This action cannot be reversed!\n\nTo proceed please enter your password:");
				if(return_value != "<?php echo $this->dbpassword; ?>"){
					return false;
				}
			}
		</script>
		<?php
	}
	
	// updates user's settings
	public function Update($INusername, $INpassword, $INnewPass, $INconfirmPass, $INname, $id) {
		
		if ($INusername != $this->dbusername){
			$query = mysqli_query($this->connect, "SELECT * FROM users WHERE username = '$INusername'");	//check if username already exists
			$numrows = mysqli_num_rows($query);
			if ($numrows != 0) {
				$_SESSION['userMess'] = "That username is already taken.";
			} else {
				mysqli_query($this->connect, "UPDATE users SET username = '$INusername' WHERE ID = '$id'");
				$_SESSION['username'] = $INusername;
				$_SESSION['userMess'] = "Username changed to $INusername";
			}
		}
		
		if ($INpassword != NULL) {
			if ($INpassword && $INnewPass && $INconfirmPass){
				if ($INpassword == $this->dbpassword){	// if current password matches database
					if ($INnewPass == $INconfirmPass){
						if ($INnewPass == $this->dbpassword){
							$_SESSION['passMess'] = "Old and new passwords are the same";
						} else {
							mysqli_query($this->connect, "UPDATE users SET password = '$INnewPass' WHERE ID = '$id'");
							$_SESSION['passMess'] = "Password changed sucessfully.";
						}
					} else {
						$_SESSION['passMess'] = "New passwords do not match. Please retype in your passwords carefully";
					}
				} else {
					$_SESSION['passMess'] = "Current password does not match";
					}
			} else {
				$_SESSION['passMess'] = "To change your password, please input in all password fields";
			}
		}
		
		if ($INname != $this->dbname){
			mysqli_query($this->connect, "UPDATE users SET name = '$INname' WHERE ID = '$id'");
			$_SESSION['name'] = $INname;
			$_SESSION['nameMess'] = "Display name changed to $INname";
		}
	}
	
	public function delAcc($acc) {
		session_destroy();
		mysqli_query($this->connect, "DELETE FROM users WHERE ID = '$acc'");
		header('Location: login.php');
	}
	
	public function changeSubjName($id) {
		$single = array();
		foreach($_SESSION['array'] as $subject => $time) {	//changes associative array holding subject/task list into indexed array
			$single[] = $subject;
		}
		
		$sum = count($_SESSION['array']);
		$i = 1; $a = 0; while ($i <= $sum) {	//checks for any differences in subject/task names and changes them
			if ($_POST[$i] != $single[$a]){
				$new = $_POST[$i];
				$old = $single[$a];
				
				if (empty($new)) {
					$_SESSION['error'] = "No name was entered";
				} else {
					if (strlen($new) > 25) {
						$_SESSION['error'] = "Subject name is too long.";
					} else {
					$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$id' AND subject = '$new'");
					$numrows = mysqli_num_rows($subList);
					if ($numrows!=0) {
						$_SESSION['error'] = "You've already named another subject/task that!";
					} else {
						mysqli_query($this->connect, "UPDATE sublist SET subject = '$new' WHERE subject = '$old' AND UserID = '$id'");
						if(isset($_SESSION['message'])){	// concatenates messages
							$_SESSION['message'].="updated $single[$a] to $new<br>";
						} else {
							$_SESSION['message']="updated $single[$a] to $new<br>";
						}
					}
					}
				}
			}
		$i++;
		$a++;
		}
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

if (isset($_POST['delAcc'])) {	//only runs after user confirms with a password
	$acc = $_POST['account'];
	$user->delAcc($acc);
}

if(isset($_POST['submitList'])){
	$user->changeSubjName($_SESSION['user']);
}
?>

	