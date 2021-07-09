<?php
// Study Tracker - write to XML from settings and read from XML files functions, version 1.3, Kim Pham

class mainSettings {
	public $connect;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
	}
	
	// updates user's settings in XML file
	public function Update($timerType, $timerLen, $timerRing, $timerNotif) {
		$handle = fopen('./XML/user_'.$_SESSION['user'].'.xml', 'w');	// Used user's unique ID instead of username as filename since users can have the same name but cannot have the same ID
			fwrite($handle,
			"<user>\n\t<input>\n\t\t<type>".$timerType."</type>\n\t\t<length>".$timerLen."</length>\n\t\t<ring>".$timerRing."</ring>\n\t\t<notif>".$timerNotif."</notif>\n\t</input>\n</user>");
			fclose($handle);
		$_SESSION['message'] = "Changes saved sucessfully!";
	}
	
	// reads XML file and creates sessions
	public function Auto(){
		$xml = simplexml_load_file('./XML/user_'.$_SESSION['user'].'.xml');
		foreach ($xml->input as $input) {
			$_SESSION['timerType'] = (string)$input->type;
			$_SESSION['timerLen'] = (string)$input->length;
			$_SESSION['timerRing'] = (string)$input->ring;
			$_SESSION['timerNotif'] = (string)$input->notif;
		}
		if ($_SESSION['timerLen'] == 00) {	// sets default timer length
			$_SESSION['minutes'] = 30;
		}
		if ($_SESSION['timerLen']>=60) {	// changes user input (minutes) to hours and minutes format if necessary
			$_SESSION['hours'] = floor($_SESSION['timerLen']/60);	// converts minutes to hours and only gets the whole number part (no of hours)
			$_SESSION['minutes'] = ($_SESSION['timerLen']/60 - $_SESSION['hours']) * 60; 	// converts minutes to hours and only gets the decimal places before converting back to minutes (no of minutes)
		} else {
			$_SESSION['minutes'] = $_SESSION['timerLen'];
			$_SESSION['hours'] = 0;
		}
		
		// adds a zero in front if hours/minutes is a single digit.
		// str_pad function documentation - http://www.php.net/manual/en/function.str-pad.php
		$_SESSION['hours'] = str_pad($_SESSION['hours'], 2, '0', STR_PAD_LEFT);
		$_SESSION['minutes'] = str_pad($_SESSION['minutes'], 2, '0', STR_PAD_LEFT);
	}
}

$user = new mainSettings;



if (!file_exists('./XML/user_'.$_SESSION['user'].'.xml')) {		// if XML file is missing, switch to default timer settings
	$timerType = "down";
	$timerLen = 30;
	$timerRing = "on";
	$timerNotif = "on";
    $user->Update($timerType, $timerLen, $timerRing, $timerNotif);
}

if (isset($_POST['submitTimer'])) {	// gets all variables from settings (timer) form
	$timerType = $_POST['type'];
	$timerLen = $_POST['length'];
	if (isset($_POST['ring'])) {
		$timerRing = "on";	// if checkbox is checked, timerRing is set to 'on'
	} else {
		$timerRing = "off";
	}
	if (isset($_POST['notif'])) {
		$timerNotif = "on";	// if checkbox is checked, timerRing is set to 'on'
	} else {
		$timerNotif = "off";
	}
	$user->Update($timerType, $timerLen, $timerRing, $timerNotif);	
}

$user->auto();
?>