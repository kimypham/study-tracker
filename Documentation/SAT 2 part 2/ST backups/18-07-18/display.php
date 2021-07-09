<?php
//session_start();
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
					} else{
						//if (strpos($_SERVER['REQUEST_URI'], 'index.php') === false) { // the list presented in /report.php will not display subjects/tasks that haven't been worked on
						$this->array[(string)$row['subject']] = 0;
					//}
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
					case strpos($_SERVER['REQUEST_URI'],'report.php'):
						$this->displayReport();
						break;
				}
				$_SESSION['array'] = $this->array;
		} else {
			$_SESSION['error'] = "You haven't added any subjects/tasks yet!";
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
							<a onclick="return confirm('Delete <?php echo $subject;?>?');" href="index.php?del_task=<?php echo $subject; ?>"><img src="./images/delete.png" width="20px" height="20px"></a>
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
		<!-- displays as individual buttons alongside a delete buttton. Embedded into HTML in order for CSS styling -->
		<div class="subject_list_settings">
				<?php foreach($this->array as $subject => $time) { ?>
						<div class="taskbox_settings"><input class="task_settings" type="text" name="<?php echo $i; ?>" value="<?php echo $subject;?>"></input></div>
						<div class="delete_settings"><a onclick="return confirm('Delete <?php echo $subject;?>?');" href="settings_list.php?del_task=<?php echo $subject; ?>"><img src="./images/delete.png" width="20px" height="20px"></a></div>
				<?php $i++;
				} ?>	
		</div>
		
		<button class="btn" type="submit" name="submitList">Save Changes</button>
			
			
		<?php
		/*
		*/
		
		$_SESSION['array'] = $this->array;
		
		//print_r($this->array);
	}
	
	public function displayReport() {
		if (count($this->array) != 0){
			$sum = array_sum($this->array);
			if ($sum == 0){
					$_SESSION['error'] = "No records available to show. Record the time on a subject/task today then check back here!";
				} else {
					?>
					<!-- select dropdown -->
					<div class="select_dropdown_settings">
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
					<?php
					if ($sum == 1){
						echo "<p> Today you worked for: ".$sum." minute in total </p><br>";
					} else {
						echo "<p> Today you worked for: ".$sum." minutes in total </p><br>";
					}
					echo "<p> You spent: </p><br>";
					
					foreach($this->array as $subject => $time) {
						if ($time != 0){
							if ($time == 1){
								echo $time." minute on ".$subject."<br>";
							} else {
								echo $time." minutes on ".$subject."<br>";
							}
						}
					}
				}
		} else {
			$_SESSION['error'] = "No records available to show. Record the time on a subject/task today then check back here!";
		}
	}
}

$user = new Display;
?>