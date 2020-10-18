<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>
<?php
	if(isset($_POST["submit"])){
		$addQue = $exm->addQuestions($_POST);
	}
	
	//Number of questions
	$queNumber = $exm->totalQuestions();
?>	

<div class="main">
	<h3>Add Question</h3>
	<?php
		if(isset($addQue)){
			echo $addQue;
		}
	?>	
	<div class="adminpanel">
		<form action="" method="POST">
			<table style="margin-top:10px">
				<tr>
					<td>Question No</td>
					<td>:</td>
					<td><input type="number" min="1" name="quesNo" value="<?php if(isset($queNumber)){echo ++$queNumber;} ?>" required readonly /></td>
				</tr>
				<tr>
					<td>Question</td>
					<td>:</td>
					<td><input type="text" name="ques" placeholder="Enter question" required /></td>
				</tr>
				<tr>
					<td>Choice One</td>
					<td>:</td>
					<td><input type="text" name="ans1" placeholder="Enter choice one" required /></td>
				</tr>
				<tr>
					<td>Choice Two</td>
					<td>:</td>
					<td><input type="text" name="ans2" placeholder="Enter choice two" required /></td>
				</tr>
				<tr>
					<td>Choice Three</td>
					<td>:</td>
					<td><input type="text" name="ans3" placeholder="Enter choice three" required /></td>
				</tr>
				<tr>
					<td>Choice Four</td>
					<td>:</td>
					<td><input type="text" name="ans4" placeholder="Enter choice four" required /></td>
				</tr>
				<tr>
					<td>Correct No</td>
					<td>:</td>
					<td><input type="number" min="1" max="4" name="rightAns" required /></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="submit" value="Add Question" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php include 'inc/footer.php'; ?>