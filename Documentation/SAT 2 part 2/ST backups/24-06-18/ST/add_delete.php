<?php
// Study Tracker - OOP functions to add and delete subjects/tasks, version 1.2, Kim Pham
// To be used with index.php (v1.1)

class Add_del {
	public $connect;
	public $tasks;
	public $row;
	public $i;
	public $task;
	public $query;
	
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "studyt") or die ("ERROR: Couldn't find database");
	}
	
	
	// Display, Add and Del functions uses modified code from CodeWithAwa (http://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database)
	
	// selects and displays all tasks
	public function Display() {
		$UserID = $_SESSION['user'];
		// Only display subjects/tasks that belong to the user, ignore duplicates, order by id (oldest subjects/tasks first, latest last)
		$this->tasks = mysqli_query($this->connect, "SELECT * FROM tasks WHERE UserID =".$UserID." GROUP BY task ORDER BY id");
		$numrows = mysqli_num_rows($this->tasks);
		
		// if there are subjects/tasks associated with the user, display them
		if ($numrows!=0) {
		// displays as individual buttons alongside a delete buttton. Embedded into HTML in order for CSS styling.
	?>
		<html>
			<table>
				<tbody>
				<?php $this->i = 1; while ($this->row = mysqli_fetch_array($this->tasks)) { ?>
					<tr>
						<td class="taskbox"><a class="task" href="work.php?select=<?php echo $this->row['task'] ?>"><?php echo $this->row['task'];?> <span class="time_spent"><?php echo $this->row['time']; ?> mins</span></a></td>
						<td ><a class="delete" onclick="return confirm('Delete <?php echo $this->row['task'];?>?');" href="index.php?del_task=<?php echo $this->row['task']; ?>"><img src="./images/delete.png" width="20px" height="20px"></a></td>
					</tr>
				<?php $this->i++; } ?>	
				</tbody>
			</table>
		</html>
	<?php
	} else {
		$_SESSION['error'] = "You haven't added any subjects/tasks yet!";
	}
		/*
		echo "<table>";
		echo "	<tbody>";
				$this->i = 1; while ($this->row = mysqli_fetch_array($this->tasks)) {
		echo "		<tr>";
		echo "			<td class='taskbox'><a class='task'>"; echo $this->row['task']; echo "</a></td>";
		echo "			<td><a class='delete' onclick='return confirm('Delete this item?');' href='add_delete.php?del_task= echo $this->row['id'] '><img src='delete.png' width='20px' height='20px'></a></td>";
		echo "		</tr>";
				$this->i++;
				};
		echo "	<tbody>";
		echo "<table>";*/
	}

	// insert a new subject/task
	 public function Add() {
		if (empty($_POST['task'])) {
				$_SESSION['error'] = "You haven't entered a subject or task";
			}else{
				unset($_SESSION['error']);
				$UserID = $_SESSION['user'];
				$task = $_POST['task'];
				
				$this->tasks = mysqli_query($this->connect, "SELECT * FROM tasks WHERE UserID =".$UserID." AND task = '$task'");
				$numrows = mysqli_num_rows($this->tasks);
				if ($numrows!=0) {
					$_SESSION['error'] = "You've already added that to your list!";
				} else {
					$this->query = "INSERT INTO tasks (task, UserID) VALUES ('$task', '$UserID')";
					mysqli_query($this->connect, $this->query);
					header('location: index.php');
				}
			}
	 }
	
	// delete a subject/task
	public function Del($task) {
		mysqli_query($this->connect, "DELETE FROM `tasks` WHERE task = '$task'");
		header('location: index.php');
	}
}

$user = new Add_del;

if (isset($_POST['add'])) {
	$user->Add();
}
if (isset($_GET['del_task'])) {
	$task = $_GET['del_task'];
	$user->Del($task);
}	

if(isset($_SESSION['message'])){ // If user leaves settings page, the 'changes saved' prompt from settings page is removed
        unset($_SESSION['message']);
}
?>