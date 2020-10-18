<?php 
include 'inc/header.php'; 
Session::checkSession();
$total = $exm->totalQuestions();
 
?>

<div class="main">
<h1>Questions and answer <?php echo $total; ?></h1>
	<div class="test">

		<table> 
		<?php
			$getQues = $exm->getQueByOrder();
			if($getQues){
				while($question = $getQues->fetch_assoc()){
		?>			
		
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question["quesNo"]; ?>: <?php echo $question["ques"]; ?></h3>
				</td>
			</tr>
			
			<?php
				$number = $question['quesNo'];
				$answers = $exm->getAnswer($number);
				if($answers){
					while($answer = $answers->fetch_assoc()){
			?>		
			<tr>
				<td>
				 <input type="radio" />
				 <?php 
					if($answer['rightAns'] == 1){
						echo "<span style='color:blue'>".$answer['ans']."</span>";
					}
					else{
						echo $answer["ans"]; 
					}
				 ?>
				</td>
			</tr>
			<?php
					}
				}
			?>
			<?php
					}
				}
			?>

			
		</table>
	</div>
 </div>
<?php include 'inc/footer.php'; ?>