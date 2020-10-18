<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/Database.php");
include_once($filepath."/../helpers/Format.php");


class Exam{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function addQuestions($data){
		$quesNo   = $data['quesNo'];
		$ques     = $this->fm->validation($data['ques']);
		$ans1     = $this->fm->validation($data['ans1']);
		$ans2     = $this->fm->validation($data['ans2']);
		$ans3  	  = $this->fm->validation($data['ans3']);
		$ans4  	  = $this->fm->validation($data['ans4']);
		$rightAns = $this->fm->validation($data['rightAns']);
		$ques     = mysqli_real_escape_string($this->db->link, $ques);
		$ans1     = mysqli_real_escape_string($this->db->link, $ans1);
		$ans2     = mysqli_real_escape_string($this->db->link, $ans2);
		$ans3     = mysqli_real_escape_string($this->db->link, $ans3);
		$ans4     = mysqli_real_escape_string($this->db->link, $ans4);
		$rightAns = mysqli_real_escape_string($this->db->link, $rightAns);
		
		//INSERTION INTO `tbl_ques' table 
		$query   = "INSERT INTO `tbl_ques`(`quesNo`, `ques`) VALUES ('$quesNo', '$ques')";
		$result1 = $this->db->insert($query);
		
		//INSERTION INTO `tbl_ans' table 
		$ans = array();
		$ans[1] = $ans1;
		$ans[2] = $ans2;
		$ans[3] = $ans3;
		$ans[4] = $ans4;
		foreach($ans as $key => $answer){
			if($key == $rightAns){
				$query = "INSERT INTO `tbl_ans`(`quesNo`, `rightAns`, `ans`) VALUES ('$quesNo','1','$answer')";
			}
			else{
				$query = "INSERT INTO `tbl_ans`(`quesNo`, `rightAns`, `ans`) VALUES ('$quesNo','0','$answer')";
			}
			$result2 = $this->db->insert($query);
		}
		
		if($result1 && $result2){
			$msg = "<span style='color:green'>Question added successfully.</span>";
			return $msg;
		}
	}

	public function getQueByOrder(){
		$query  = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function delQuestion($delQueNo){
		$query  = "DELETE FROM `tbl_ques` WHERE quesNo = '$delQueNo'";
		$result1 = $this->db->delete($query);
		$query  = "DELETE FROM `tbl_ans` WHERE quesNo = '$delQueNo'";
		$result2 = $this->db->delete($query);
		if($result1 && $result2){
			$msg = "<span style='color:green'>Question deleted.</span>";
			return $msg;
		}
		else{
			$msg = "<span>Error in question delete.</span>";
			return $msg;
		}
	}
	
	public function totalQuestions(){
		$query  = "SELECT * FROM tbl_ques";
		$result = $this->db->select($query);
		$total  = $result->num_rows;
		return $total;
	}
	
	public function getQuestion(){
		$query   = "SELECT * FROM tbl_ques";
		$getdata = $this->db->select($query);
		$result   = $getdata->fetch_assoc();
		return $result;
	}
	
	public function getQuesByNumber($number){
		$query   = "SELECT * FROM tbl_ques where quesNo = '$number'";
		$getdata = $this->db->select($query);
		$result   = $getdata->fetch_assoc();
		return $result;
	}
	
	public function getAnswer($number){
		$query   = "SELECT * FROM tbl_ans where quesNo = '$number'";
		$getdata = $this->db->select($query);
		return $getdata;
	}
	
}

?>