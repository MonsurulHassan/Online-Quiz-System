<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/Session.php");

include_once($filepath."/../lib/Database.php");
include_once($filepath."/../helpers/format.php");


class User{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getAllUser(){
		$query  = "SELECT * FROM tbl_user ORDER BY userid DESC";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getUserData($userid){
		$query  = "SELECT * FROM tbl_user WHERE userid = '$userid'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function disableUser($disableId){
		$query  = "UPDATE `tbl_user` SET `status`=1 WHERE userid = '$disableId'";
		$result = $this->db->update($query);
		if($result){
			$msg = "<span style='color:green'>User disabled.</span>";
			return $msg;
		}
		else{
			$msg = "<span>Error in user disable.</span>";
			return $msg;
		}
	}
	
	public function enableUser($enableId){
		$query  = "UPDATE `tbl_user` SET `status`=0 WHERE userid = '$enableId'";
		$result = $this->db->update($query);
		if($result){
			$msg = "<span style='color:green'>User enabled.</span>";
			return $msg;
		}
		else{
			$msg = "<span>Error in user enable.</span>";
			return $msg;
		}
	}
	
	public function deleteUser($deleteId){
		$query  = "DELETE FROM `tbl_user` WHERE userid = '$deleteId'";
		$result = $this->db->delete($query);
		if($result){
			$msg = "<span style='color:green'>User removed.</span>";
			return $msg;
		}
		else{
			$msg = "<span>Error in user remove.</span>";
			return $msg;
		}
	}
	
	public function userRegistration($name, $username, $password, $email){
		$name 	  = $this->fm->validation($name);
		$username = $this->fm->validation($username);
		$password = $this->fm->validation($password);
		$email 	  = $this->fm->validation($email);
		$password = md5($password);
		
		
		if($name == "" or $username == "" or $password == "" or $email == ""){
			return "<span style='color:red'>Fields must not be empty!</span>";
		}
		elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			return "<span style='color:red'>Invalid email address!</span>";	
		}
		else{
			$query = "select * from tbl_user where email = '$email'";
			$result = $this->db->select($query);
			if($result){
				return "<span style='color:red'>Email address already exists!</span>";
			}
			else{
				$query = "INSERT INTO `tbl_user`(`name`, `username`, `password`, `email`, `status`) VALUES ('$name','$username','$password','$email','0')";
				$result = $this->db->insert($query);
				if($result){
					return "<span style='color:green'>Registration successful.</span>";
				}
			}	
		}
	}
	
	public function userLogin($email, $password){
		$email 	  = $this->fm->validation($email);
		$password = $this->fm->validation($password);
		$password = md5($password);
		
		if($password == "" or $email == ""){
			return "empty";
		}
		else{
			$query = "select * from tbl_user where email = '$email' and password = '$password'";
			$result = $this->db->select($query);
			if($result){
				$value = $result->fetch_assoc();
				if($value["status"] == 1){
					return "disabled";
				}
				else{
					Session::init();
					Session::set("login", true);
					Session::set("userid", $value['userid']);
					Session::set("username", $value['username']);
					Session::set("name", $value['name']);
					//header("location:exam.php");
				}
				
			}
			else{
				return "unmatched";
			}
		}
	}
	
	public function updateUserData($name, $username, $email, $userid){
		$name 	  = $this->fm->validation($name);
		$username = $this->fm->validation($username);
		$email 	  = $this->fm->validation($email);
		
		$query = "UPDATE `tbl_user` SET `name`='$name',`username`='$username',`email`='$email' WHERE userid = '$userid'";
		$result = $this->db->update($query);
		return $result;
	}
	
	
}




?>