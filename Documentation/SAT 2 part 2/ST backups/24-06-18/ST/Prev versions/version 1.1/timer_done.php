<?php
// Study Tracker - Timer done page, version 1.1, Kim Pham

// NOTE: currently does not have any of the orignal timer done features. For now this page is just used
// to test whether the variables from the Javascript can be passed to this page.

session_start();

$output = $_POST['output'];
echo $output." seconds"; // usually would be recorded in hours and minutes. 

echo $_SESSION['select'];
?>
<br>
<br>
<a href="work.php?select=<?php echo $_SESSION['select']; ?>">Go back</a> Note: this timer session will not be recorded and the timer will be reset