<?php 
include 'inc/header.php'; 
Session::checkSession(); 

?>
<div class="main">
	<h1>You are done</h1>
	<p>Congrats! You have completed</p>
	<p>Final Score:
	<?php
		if(isset($_SESSION['score'])){
			echo $_SESSION['score'];
			unset($_SESSION['score']);
		}
	?>
	</p>
	
	<a href="viewans.php">View Answer</a>
	<a href="starttest.php">Start Again</a>
	
	
</div>
<?php include 'inc/footer.php'; ?>