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
	
public function Display($sort) {
		$UserID = $_SESSION['user'];
		// Only display subjects/tasks that belong to the user, ignore duplicates, order by id (oldest subjects/tasks first, latest last)
		$this->tasks = mysqli_query($this->connect, "SELECT * FROM tasks WHERE UserID =".$UserID." GROUP BY task ORDER BY id");
		$numrows = mysqli_num_rows($this->tasks);
		
		// if there are subjects/tasks associated with the user, display them
		if ($numrows!=0) {
			$list = array();
				$this->i = 1; while ($this->row = mysqli_fetch_array($this->tasks)) {
					$list[(string)$this->row['task']] = $this->row['time'];
				$this->i++; }
				//echo '<pre>', print_r($list, true), '</pre>';
				
				// sorting the array before displaying
				if ($sort == "a-z") {
					ksort($list, SORT_STRING | SORT_FLAG_CASE);
				} 
				elseif ($sort == "z-a") {
					krsort($list, SORT_STRING | SORT_FLAG_CASE);
				}
				elseif ($sort == "low-high") {
					asort($list);
				}
				elseif ($sort == "high-low") {
					arsort($list);
				}
	?>
	<!-- select dropdown -->
	<div class="select_dropdown">
	<form action="index.php" method="GET">
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
				<?php foreach($list as $subject => $time) { ?>
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
