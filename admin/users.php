<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/User.php');
	$usr = new User();
?>
<?php
	if(isset($_GET["dis"])){
		$disUser = $usr->disableUser($_GET["dis"]);
	}
	
	if(isset($_GET["en"])){
		$enUser = $usr->enableUser($_GET["en"]);
	}
	
	if(isset($_GET["del"])){
		$delUser = $usr->deleteUser($_GET["del"]);
	}
?>

<div class="main">
	<h3>Manage Users</h3>
	<?php
		if(isset($disUser)){
			echo $disUser;
		}
		
		if(isset($enUser)){
			echo $enUser;
		}
		
		if(isset($delUser)){
			echo $delUser;
		}
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			
			<?php
				$userData = $usr->getAllUser();
				if($userData){
					$i = 0;
					while($result = $userData->fetch_assoc()){
						$i++;
			?>
			
			<tr>
				<td>
					<?php 
						if($result['status'] == 1){
							echo "<span class='error'>".$i."</span>"; 
						}
						else{
							echo $i;
						}	
					?>
				</td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['username']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td>
					<?php
						if($result['status'] == 0){
					?>		
							<a onclick="return confirm('Are you sure to disable?');" href="?dis=<?php echo $result['userid']; ?>">Disable</a> |
					<?php		
						}
						else{
					?>		
							<a onclick="return confirm('Are you sure to enable?');" href="?en=<?php echo $result['userid']; ?>">Enable</a> |
					<?php		
						}
					?>
					<a onclick="return confirm('Are you sure to remove?');" href="?del=<?php echo $result['userid']; ?>">Remove</a>
				</td>
			</tr>
			
			<?php
					}
				}
			?>
		</table>
	</div>
</div>








<?php include 'inc/footer.php'; ?>