<?php
// Study Tracker - OOP functions to add and delete subjects/tasks, version 1.1, Kim Pham
// To be used with index.php (v1.1)

class Add_del {
	// for use in the Display function
	public $connect;
	public $tasks;
	public $row;
	public $i;
	// for use in the Add and Del functions
	public $task;
	public $query;
	public $errors;
	
	
	// connect to database
	public function __construct() {
		$this->connect = mysqli_connect("localhost", "root", "") or die ("ERROR: Couldn't connect to database.<br><br>Please ensure that the database server is available and <a href='index.php'>try again</a>.");
		mysqli_select_db($this->connect, "todo") or die ("ERROR: Couldn't find database");
	}
	
	
	// Display, Add and Del functions uses modified code from CodeWithAwa http://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database
	
	// selects and displays all tasks
	public function Display() {
		$UserID = $_SESSION['user'];
		// Only display subjects/tasks that belong to the user, ignore duplicates, order by id (oldest subjects/tasks first, latest last)
		$this->tasks = mysqli_query($this->connect, "SELECT * FROM tasks WHERE UserID =".$UserID." GROUP BY task ORDER BY id");

		// displays the subjects/tasks as individual buttons alongside a delete buttton.
		// embedded into HTML in order for CSS styling
	?>
		<html>
			<table>
				<tbody>
				<?php $this->i = 1; while ($this->row = mysqli_fetch_array($this->tasks)) { ?>
					<tr>
						<td class="taskbox"><a class="task" href="work.php?select=<?php echo $this->row['task'] ?>"><?php echo $this->row['task'];?> <span style="float:right; margin-top: 0.6em; font-size: 10px;"><?php echo $this->row['time']; ?> mins</span></a></td>
						<td><a class="delete" onclick="return confirm('Delete this item?');" href="index.php?del_task=<?php echo $this->row['id']; ?>"><img src="delete.png" width="20px" height="20px"></a></td>
					</tr>
				<?php $this->i++; } ?>	
				</tbody>
			</table>
		</html>
	<?php
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
				$this->errors = "You haven't entered a subject or task";
			}else{
				$UserID = $_SESSION['user'];
				$task = $_POST['task'];
				$this->query = "INSERT INTO tasks (task, UserID) VALUES ('$task', '$UserID')";
				mysqli_query($this->connect, $this->query);
				header('location: index.php');
			}
	 }
	
	// delete a subject/task
	public function Del() {
		$id = $_GET['del_task'];
		mysqli_query($this->connect, "DELETE FROM tasks WHERE id=".$id);
		header('location: index.php');
	}	
}

$user = new Add_del;

if (isset($_POST['add'])) {
	$user->Add();
}
if (isset($_GET['del_task'])) {
	$user->Del();
}	
?>