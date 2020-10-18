<?php 
include 'inc/header.php'; 
Session::checkSession(); 
$question = $exm->getQuestion();
$total = $exm->totalQuestions();
?>
<style>
.starttest{
	width:590px;
	border:1px solid #f4f4f4;
	padding:20px;
	margin: 0 auto;
}
.starttest h2{
	border-bottom:1px solid #ddd;
	font-size: 20px;
	margin-bottom: 10px;
	padding-bottom: 10px;
	text-align: center;
}
.starttest ul{margin:0; padding:0; list-style:none;}
.starttest ul li{margin-top:5px}
.starttest a{background: #f4f4f4; border: 1px solid #ddd; color:#444; display:block; margin-top: 10px; padding: 6px 10px; text-align:center; text-decoration: none}
</style>
<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="starttest">
		<h2>Test your knowledge</h2>
		<ul>
			<li><b>Number of questions: <?php echo $total; ?> </b></li>
			<li><b>Question type: Multiple Choice</b></li>
		</ul>
		<a href="test.php?q=<?php echo $question['quesNo']; ?>">Start Test</a>
	</div>
</div>
<?php include 'inc/footer.php'; ?>