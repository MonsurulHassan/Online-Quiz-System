<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/Session.php");
include_once($filepath."/../lib/Database.php");
include_once($filepath."/../helpers/Format.php");

class Admin{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function getAdminData($data){
		$username   = $this->fm->validation($data['adminUser']);
		$adminPass  = $this->fm->validation($data['adminPass']);
		$username   = mysqli_real_escape_string($this->db->link, $username);
		$adminPass  = mysqli_real_escape_string($this->db->link, md5($adminPass));
		
		$query = "SELECT * FROM tbl_admin WHERE adminUser = '$username' AND adminPass = '$adminPass'";
		$result = $this->db->select($query);
		if($result){
			$value = $result->fetch_assoc();
			Session::init();
			Session::set("adminLogin", true);
			Session::set("adminUser", $value['adminUser']);
			Session::set("adminId", $value['adminId']);
			header("location:index.php");
		}
		else{
			$msg = "<span class='error'>Username or Password not matched!</span>";
			return $msg;
		}
	}
}



?>