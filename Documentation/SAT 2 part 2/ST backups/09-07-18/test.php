<?php
session_start();

class Display {
	public $connect;
	public $query;
	
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
		return $this->connect;
	}
	
	
	// Display function uses modified code from CodeWithAwa (http://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database)
public function Display($sort) {
		$UserID = $_SESSION['user'];
		// Only display subjects/tasks that belong to the user, ignore duplicates, order by id (oldest subjects/tasks first, latest last)
		$subList = mysqli_query($this->connect, "SELECT * FROM subList WHERE UserID = '$UserID' GROUP BY subject ORDER BY id");
		$numrows = mysqli_num_rows($subList);
		
		// if there are subjects/tasks associated with the user, display them
		if ($numrows!=0) {
			$array = array();
				$i = 1; while ($row = mysqli_fetch_array($subList)) {
					if ($row['date'] == '2018-07-03') {
						$array[(string)$row['subject']] = $row['time'];
					} else {
						$array[(string)$row['subject']] = 0;
					}
				$i++; }
				// echo '<pre>', print_r($list, true), '</pre>';
				
				// sorting the array before displaying.
				// all implemented sorting functions use quicksort. Sorting documentation - http://php.net/manual/en/function.sort.php and http://php.net/manual/en/array.sorting.php
				if ($sort == "a-z") {
					ksort($array, SORT_STRING | SORT_FLAG_CASE);	// sort by key (subject/task name), alphabetical order (A-Z), case insensitive (sorted regardless of uppercase and lowercase letters)
				} 
				elseif ($sort == "z-a") {
					krsort($array, SORT_STRING | SORT_FLAG_CASE); // sort by key (subject/task name), alphabetical order (Z-A), case insensitive
				}
				elseif ($sort == "low-high") {
					asort($array);	// sort by value (time)
				}
				elseif ($sort == "high-low") {
					arsort($array);	// sort by value (time)
				}
	?>
	<!-- select dropdown -->
	<div class="select_dropdown">
	<form action="test.php" method="GET">
		<select name="sort" onchange="this.form.submit()">
			<option value='original' <?php if ($_SESSION['sort'] == "original") { echo "selected=selected"; } ?>> No sorting </option>
			<option value='a-z' <?php if ($_SESSION['sort'] == "a-z") { echo "selected=selected"; } ?>> Name: A - Z </option>
			<option value='z-a' <?php if ($_SESSION['sort'] == "z-a") { echo "selected=selected"; } ?>> Name: Z - A </option>
			<option value='low-high' <?php if ($_SESSION['sort'] == "low-high") { echo "selected=selected"; } ?>> Time: lowest - highest </option>
			<option value='high-low' <?php if ($_SESSION['sort'] == "high-low") { echo "selected=selected"; } ?>> Time: highest - lowest </option>
		</select>
	</form>
	</div>
	
	<!-- displays as individual buttons alongside a delete buttton. Embedded into HTML in order for CSS styling -->
		<div class="subject_list">
			<table>
				<tbody>
				<?php foreach($array as $subject => $time) { ?>
					<tr>
						<td class="taskbox"><a class="task" href="work.php?select=<?php echo $subject ?>"><?php echo $subject;?> <span class="time_spent"><?php echo $time;?> mins</span></a></td>
						<td class="delete"><a onclick="return confirm('Delete <?php echo $subject;?>?');" href="index.php?del_task=<?php echo $subject; ?>"><img src="./images/delete.png" width="20px" height="20px"></a></td>
					</tr>
				<?php } ?>	
				</tbody>
			</table>
		</div>
	<?php
		} else {
			$_SESSION['error'] = "You haven't added any subjects/tasks yet!";
		}
	}
}
	
$user = new Display;
?>

<div class="main_left">
			<h1>Subjects and Tasks</h1>
			<div class="info"> Select a subject/task below to start timing </div>
				<?php	
				// displays all of the user's subjects/tasks and sorts them if neccessary (from display.php)
				if (isset($_GET['sort'])) {	// changes sorting only if changed
					$_SESSION['sort'] = $_GET['sort'];
					$user->Display($_SESSION['sort']);
				} elseif (isset($_SESSION['sort'])) {	// uses previous sorting preference
					$user->Display($_SESSION['sort']);
				} else {
					$user->Display('original');
				}
				?>
			
			<div class="input_container">
			<form method="post" action="test.php" class="input_form">
				<input type="text" name="subject" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
				<button type="submit" name="add" id="add_btn" style="width: 0px; height: 0px; opacity: 0;"></button>
			</form>
			</div>
			<div class="error_message">
			<?php echo "<p>".$_SESSION['error']."</p>"; 	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
				?>
			</div>
	</div>