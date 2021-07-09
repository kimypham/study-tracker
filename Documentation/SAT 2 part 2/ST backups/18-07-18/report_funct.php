<?php
// Study Tracker - View reports functions, version 1.2, Kim Pham

class Report {
	public $connect;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
	}
	
	public function Display($sort) {
		$UserID = $_SESSION['user'];
		$todayDate = $_SESSION['todayDate'];
		// Only display subjects/tasks that belong to the user
		$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$UserID'");
		$numrows = mysqli_num_rows($subList);
		// if there are subjects/tasks associated with the user, display them
		if ($numrows!=0) {
			$array = array();
				$i = 1; while ($row = mysqli_fetch_array($subList)) { // only subjects worked on today are shown
					if ($row['date'] == $todayDate) {
						$array[(string)$row['subject']] = $row['time'];
					}
				$i++; }
				if (count($array) != 0){	// if there are subjects/tasks worked on today
				
				// sorting the array before displaying.
				// all implemented sorting functions use quicksort. Sorting documentation - http://php.net/manual/en/function.sort.php and http://php.net/manual/en/array.sorting.php
				if ($sort == "a-z") {
					ksort($array, SORT_STRING | SORT_FLAG_CASE);	// sort by key (subject/task name), alphabetical order (A-Z), case insensitive (sorted regardless of uppercase and lowercase letters)
				} 
				elseif ($sort == "z-a") {
					krsort($array, SORT_STRING | SORT_FLAG_CASE); // sort by key (subject/task name), alphabetical order (Z-A), case insensitive
				}
				elseif ($sort == "high-low") {
					arsort($array);	// sort by value (time)
				}
				elseif ($sort == "low-high") {
					asort($array);	// sort by value (time)
				}
	?>
	<!-- select dropdown -->
	<div class="select_dropdown">
	<form action="report.php" method="GET">
		<select name="sort" onchange="this.form.submit()">
			<option value='original' <?php if ($_SESSION['sort'] == "original") { echo "selected=selected"; } ?>> No sorting </option>
			<option value='a-z' <?php if ($_SESSION['sort'] == "a-z") { echo "selected=selected"; } ?>> Name: A - Z </option>
			<option value='z-a' <?php if ($_SESSION['sort'] == "z-a") { echo "selected=selected"; } ?>> Name: Z - A </option>
			<option value='high-low' <?php if ($_SESSION['sort'] == "high-low") { echo "selected=selected"; } ?>> Time: highest - lowest </option>
			<option value='low-high' <?php if ($_SESSION['sort'] == "low-high") { echo "selected=selected"; } ?>> Time: lowest - highest </option>
		</select>
	</form>
	</div>
		
		<!-- displays as individual buttons alongside a delete buttton. Embedded into HTML in order for CSS styling -->
		<p> Today you worked for: <?php echo array_sum($array) ?> minutes in total </p><br>
		<p> You spent: </p><br>
		<?php
		foreach($array as $subject => $time) {
				echo $time."minutes on ".$subject."<br>";
				} ?>

	<?php
		} else {
			$_SESSION['error'] = "No records available to show. Record the time on a subject/task today then check back here!";
		}
	}
}
}
	
$user = new Report;
?>