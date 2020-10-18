<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../inc/header.php");


class Process{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function processData($data){
		$selectedAns = $this->fm->validation($data["ans"]);
		$number = $this->fm->validation($data["number"]);
		
		$selectedAns = mysqli_real_escape_string($this->db->link, $selectedAns);
		$number = mysqli_real_escape_string($this->db->link, $number);
		$next = $number+1;
		
		if(!isset($_SESSION["score"])){
			//Session:init();
			$_SESSION['score'] = 0;
		}
		
		$total = $this->getTotal();
		$right = $this->rightAns($number);
		if($right == $selectedAns){
			$_SESSION['score']++;
		}
		if($number == $total){
			header("location:final.php");
			exit();
		}
		else{
			header("location:test.php?q=".$next);
		}
	}
	
	private function getTotal(){
		$query  = "SELECT * FROM tbl_ques";
		$result = $this->db->select($query);
		$total  = $result->num_rows;
		return $total;
	}
	
	private function rightAns($number){
		$query  = "SELECT * FROM tbl_ans where quesNo = '$number' and rightAns = '1'";
		$getdata = $this->db->select($query)->fetch_assoc();
		$result  = $getdata['id'];
		return $result;
	}
	
}




?>