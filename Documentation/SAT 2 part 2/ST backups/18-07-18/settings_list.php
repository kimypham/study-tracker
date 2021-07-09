<?php
// Study Tracker - Settings (Manage Subjects and Tasks) page, version 1.2, Kim Pham
include 'login_check.php';
unset($_SESSION['error']);	//so that any errors from previous pages don't show here
include 'add_delete.php';
include 'settings_funct.php';
include 'display.php';
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link rel="stylesheet" type="text/css" href="./CSS/other-style.css">
</head>
<header>
	<div class="header">
		<a href="index.php" class="logo">Study Tracker</a>
		<div class="header-right">
			<a href="index.php">HOME</a>
			<a href="report.php">VIEW STATISTICS</a>
			<a href="help.php">HELP</a>
			<a href="settings.php">SETTINGS</a>
			<a href="logout.php">LOG OUT</a>
		</div>
	</div>
</header>

<body>
	<div class="main">
		<p class="title">Settings - manage subjects and tasks</p>
		<p class="subtitle"> Enter in the text box to change the subject/task's name and use the delete button to delete the subject/task.</p><br>
		<form method="post" action="settings_list.php">
			<?php
			
			if (isset($_GET['sort'])) {	// changes sorting only if changed
				$_SESSION['sort'] = $_GET['sort'];
				$user->Display($_SESSION['sort']);
			} elseif (isset($_SESSION['sort'])) {	// uses previous sorting preference
				$user->Display($_SESSION['sort']);
			} else {
				$user->Display('original');
			}
			$i = 1;
			
			/*
			<div class="subject_list_settings">
				<?php foreach($_SESSION['array'] as $subject => $time) { ?>
						<div class="taskbox_settings"><input class="task_settings" type="text" name="<?php echo $i; ?>" value="<?php echo $subject;?>"></input></div>
						<div class="delete_settings"><a onclick="return confirm('Delete <?php echo $subject;?>?');" href="settings_list.php?del_task=<?php echo $subject; ?>"><img src="./images/delete.png" width="20px" height="20px"></a></div>
				<?php $i++;
				}?>
			</div>
			*/
			?>
			
			</form>
			
			
			<div class="subject_list_settings">
				<input type="text" name="subject" class="task_input" autocomplete="off" placeholder=" + Add subject/task">
				<button type="submit" name="add" class="hidden"></button>
			</div>
			
			
			<div class="error_message">
			<?php
				if (isset($_SESSION['error'])) {echo "<p>".$_SESSION['error']."</p>";} 	// error displays if user has no subjects/tasks or if they try to add a duplicate subject/task
				?>
			</div>
			<button class="btn"><a href="settings.php" class="no_link">Go back</a></button>
		
	</div>
</body>
</html>