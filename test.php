<?php 
include 'inc/header.php'; 
Session::checkSession();
 
if(isset($_GET['q'])){
	$number = $_GET['q'];
}
else{
	header("location:exam.php");
}
$total = $exm->totalQuestions();
$question = $exm->getQuesByNumber($number);

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$process = $pro->processData($_POST);
}

?>
<div class="main">
<h1>Question <?php echo $question["quesNo"]; ?> of <?php echo $total; ?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question["quesNo"]; ?>: <?php echo $question["ques"]; ?></h3>
				</td>
			</tr>
			
			<?php
				$answers = $exm->getAnswer($number);
				if($answers){
					while($answer = $answers->fetch_assoc()){
			?>		
			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id']; ?>"/><?php echo $answer["ans"]; ?>
				</td>
			</tr>
			<?php
					}
				}
			?>

			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $number;  ?>"/>
			</td>
			</tr>
		</table>
	</div>
 </div>
<?php include 'inc/footer.php'; ?>