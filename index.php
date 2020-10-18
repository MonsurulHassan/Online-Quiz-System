<?php
include 'inc/header.php'; 
Session::checkLogin(); 


?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" id="email" type="text"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" id="password" type="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" name="login" id="login" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <div id="msg">
			<span class="empty" style="display:none; color:red">Fields must not be empty!</span>	
			<span class="disabled" style="display:none; color:red">Your ID is disabled!</span>	
			<span class="unmatched" style="display:none; color:red">Your login credentials don't match!</span>	
	   </div>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>