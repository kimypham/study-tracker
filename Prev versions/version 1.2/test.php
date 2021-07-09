<?php
if(isset($_POST['submitLi'])){
	$in = $_POST['1'];
	echo $in;
}
$i = 1;
?>
<form method="post" action="test.php">
	<input type="text" name="<?php echo $i; ?>" value="Subject 1"></input>
	<button class="btn" type="submit" name="submitLi">Save Changes</button>
</form>
