<?php
include 'inc/header.php'; 
Session::checkSession();
$userid = Session::get("userid");

?>
<style>
	.profile{border:1px solid #ddd; padding:20px;}
</style>

<?php
	if(isset($_POST["update"])){
		$updatedData = $usr->updateUserData($_POST["name"], $_POST["username"], $_POST["email"], $userid);
	}
?>

<div class="main">
	<h1>Your Profile</h1>
	<div class="profile">
		<form action="" method="post">
		<?php
			$getData = $usr->getUserData($_SESSION['userid']);
			if($getData){
				$result = $getData->fetch_assoc();
		?>
		<table class="tbl">
			 <tr>
			   <td>Name</td>
			   <td><input name="name" id="name" type="text" value="<?php echo $result["name"]; ?>"></td>
			 </tr>
			 <tr>
			   <td>Username</td>
			   <td><input name="username" id="username" type="text" value="<?php echo $result["username"]; ?>"></td>
			 </tr>
			 <tr>
			   <td>Email</td>
			   <td><input name="email" id="email" type="email" value="<?php echo $result["email"]; ?>"></td>
			 </tr>
			 <tr>
			   <td></td>
			   <td><input type="submit" name="update" id="update" value="Update">
			   </td>
			 </tr>
       </table>
	   <?php } ?> 
	   </form>
	   <?php
		if(isset($updatedData)){
			echo "<span style='color:green'>User updated successfully.</span>";
		}
	   ?>
	</div>
</div>	

<?php include 'inc/footer.php'; ?>