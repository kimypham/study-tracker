<?php
// Study Tracker - Display the subject/task list functions, version 1.3, Kim Pham

class Display {
	public $connect;
	public $query;
	public $array;
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		return $this->connect;
	}
	
	// Display function uses modified code from CodeWithAwa (http://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database)
	public function Display($sort) {
		$UserID = $_SESSION['user'];
		$todayDate = $_SESSION['todayDate'];
		
		// Only display subjects/tasks that belong to the user
		$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$UserID'");
		$numrows = mysqli_num_rows($subList);
		
		// if there are subjects/tasks associated with the user, display them
		if ($numrows!=0) {
			$this->array = array();
				$i = 1; while ($row = mysqli_fetch_array($subList)) { // subject/task time spent is shown as 0 unless the time has been updated today
					if ($row['date'] == $todayDate) {
						$this->array[(string)$row['subject']] = $row['time'];
					} elseif ((strpos($_SERVER['REQUEST_URI'], 'index.php')) OR (strpos($_SERVER['REQUEST_URI'], 'settings_list.php'))){	// when the report's times are reset to 0, it displays incorrectly (skips subjects/tasks)
						$this->array[(string)$row['subject']] = 0;
					}
					$i++;
				}
				
				// sorting the array before displaying.
				// all implemented sorting functions use quicksort. Sorting documentation - http://php.net/manual/en/function.sort.php and http://php.net/manual/en/array.sorting.php
				if ($sort == "a-z") {
					ksort($this->array, SORT_STRING | SORT_FLAG_CASE);	// sort by key (subject/task name), alphabetical order (A-Z), case insensitive (sorted regardless of uppercase and lowercase letters)
				} 
				elseif ($sort == "z-a") {
					krsort($this->array, SORT_STRING | SORT_FLAG_CASE); // sort by key (subject/task name), alphabetical order (Z-A), case insensitive
				}
				elseif ($sort == "high-low") {
					arsort($this->array);	// sort by value (time)
				}
				elseif ($sort == "low-high") {
					asort($this->array);	// sort by value (time)
				}
				
				// displays different subject/task lists depending on the page.
				switch (true) {
					case strpos($_SERVER['REQUEST_URI'], 'index.php'):
						$this->displayMain();
						break;
					case strpos($_SERVER['REQUEST_URI'],'settings_list.php'):
						$this->displayText();
						break;
					case strpos($_SERVER['REQUEST_URI'],'report.php') OR strpos($_SERVER['REQUEST_URI'], 'report_before.php') OR strpos($_SERVER['REQUEST_URI'], 'report_after.php'):
						$this->displayReport();
						break;
					case strpos($_SERVER['REQUEST_URI'],'report_week.php');
						$this->displayReportWeek();
						break;
				}
				$_SESSION['array'] = $this->array;
		} else {
			$_SESSION['error_list'] = "You haven't added any subjects/tasks yet!";
		}
	}
	
	
	// varied code for displaying the subject/task list with the correct styling.
	public function displayMain() {
	?>
	<!-- select dropdown -->
	<div class="select_dropdown">
	<form action="index.php" method="GET">
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
		<div class="subject_list">
			<table>
				<tbody>
				<?php foreach($this->array as $subject => $time) { ?>
					<tr>
						<td class="taskbox"><a class="task" href="work.php?select=<?php echo $subject ?>"><?php echo $subject;?> <span class="time_spent"><?php echo $time;?> mins</span></a></td>
						<td class="delete">
						<form action="index.php" method="POST">
							<input type="hidden" name="subject" value="<?php echo $subject ?>">
							<input type="image" onclick="return confirm('Delete <?php echo $subject;?>?');" name="deleteSubj" value="<?php echo $subject ?>" src="./images/delete.png" width="20px" height="20px"></input>
						</form>
						</td>
					</tr>
				<?php } ?>	
				</tbody>
			</table>
		</div>
	<?php
	}
	
	public function displayText() {
		$i = 1;
		?>
		<!-- select dropdown -->
		<div class="select_dropdown_settings">
		<form action="settings_list.php" method="GET">
			<select name="sort" onchange="this.form.submit()">
				<option value='original' <?php if ($_SESSION['sort'] == "original") { echo "selected=selected"; } ?>> No sorting </option>
				<option value='a-z' <?php if ($_SESSION['sort'] == "a-z") { echo "selected=selected"; } ?>> Name: A - Z </option>
				<option value='z-a' <?php if ($_SESSION['sort'] == "z-a") { echo "selected=selected"; } ?>> Name: Z - A </option>
				<option value='high-low' <?php if ($_SESSION['sort'] == "high-low") { echo "selected=selected"; } ?>> Time: highest - lowest </option>
				<option value='low-high' <?php if ($_SESSION['sort'] == "low-high") { echo "selected=selected"; } ?>> Time: lowest - highest </option>
			</select>
		</form>
		</div>
		
		<!-- Displays as individual buttons alongside a delete buttton. Embedded into HTML in order for CSS styling -->
		<!-- Two forms are used to edit and delete the subject/tasks respectively since forms cannot be nested. -->
		<form method="POST" action="settings_list.php">	<!-- This first form is used for editing the names so it contains the textboxes and the save button -->
			<div class="subject_list_settings">
				<?php foreach($this->array as $subject => $time) { ?>
					<div class="taskbox_settings"><input class="task_settings" type="text" name="<?php echo $i; ?>" value="<?php echo $subject;?>"></input></div>
						
					<div class="button_container">	<!-- styling allows buttons to sit at the bottom of the page -->
						<button class="btn" type="submit" name="submitList">Save Changes</button>
						
					</div>
		</form>
	
					<div class="delete_settings">
						<form method="POST" action="settings_list.php">
							<input type="hidden" name="subject" value="<?php echo $subject; ?>">
							<input type="image" onclick="return confirm('Delete <?php echo $subject;?>?');" name="deleteSubj" value="<?php echo $subject ?>" src="./images/delete.png" width="20px" height="20px"></input>
						</form>
					</div>
				<?php $i++;
					} ?>	
			</div>		
		<?php
		$_SESSION['array'] = $this->array;
	}
	
	public function displayReport() {
		echo date("l jS F Y", strtotime($_SESSION['todayDate']));	// converts date (numerical) to words (eg. 2018-07-26 is converted to Thursday 26th July 2018)
		echo "<br>";
		if (count($this->array) != 0){
			$sum = array_sum($this->array);
			if ($sum == 0){
				if ($_SESSION['num'] == 0){
					$_SESSION['error'] = "<br><br>No records available to show. Record the time on a subject/task today then check back here!";	// displays when viewing previous records
				} else {
					$_SESSION['error'] = "<br><br>No records available to show.";
				}
			} else {	
				if ($_SESSION['num'] == 0){
					echo "<br><br>Today";
				} else {
					echo "<br><br>".$_SESSION['num']." day";
					if ($_SESSION['num'] > 1){
						echo "s";
					}
					echo " ago";
				}
				echo " you worked for: <br><br><div class='tab line_space'>";
				if ($sum >= 60){
					echo floor($sum/60)." hour";
					if (floor($sum/60) > 1){
						echo "s";
					}
					echo " and ".($sum-(floor($sum/60)*60))." minutes ($sum minutes)";	
				} else {
					echo $sum." minute";
					if ($sum > 1){
						echo "s";
					}
				}
				echo " in total </p></div><br><br>";
					
				echo "<p> You spent: </p><br>";	
				echo "<div class='tab line_space'>";
				foreach($this->array as $subject => $time) {
					if ($time != 0){
						if ($time >= 60){
							echo floor($time/60)." hrs and ".($time-(floor($time/60)*60))." mins ($time minutes)";
						} else {
							echo $time." minute";
							if ($time > 1){
								echo "s";
							}
						}
						echo " on <span class='bold'>".$subject."</span><br>";
					}
				}
				echo "</div>";
				?>
				
				<script type="text/javascript">
					// Code for implementation of Google Charts based off code from w3schools (https://www.w3schools.com/howto/howto_google_charts.asp)
					google.charts.load('current', {'packages':['corechart']});	// Load google charts
					google.charts.setOnLoadCallback(drawChart);
	
					function drawChart() {	// Draw the chart and set the chart values
					var data = google.visualization.arrayToDataTable([
					['Subject/task', 'Minutes per Day'],
					<?php	
					foreach($this->array as $subject => $time) {
						if ($time != 0){
							echo "['".$subject."', ".$time."],";
						}
					}
					?>
					]);

					var options = {'title':'Distrubution of time', 'width':550, 'height':400};
					var chart = new google.visualization.PieChart(document.getElementById('piechart'));	// Display the chart inside the <div> element with id="piechart"
					chart.draw(data, options);
					}
				</script>
				<?php
			}
		} else {
			if ($_SESSION['num'] == 0){
				$_SESSION['error'] = "<br><br>No records available to show. Record the time on a subject/task today then check back here!";	// displays when viewing previous records
			} else {
				$_SESSION['error'] = "<br><br>No records available to show.";
			}
		}
	}
}

$user = new Display;
?>