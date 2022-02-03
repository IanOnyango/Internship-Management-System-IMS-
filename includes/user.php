<?php

/**
 * 
 */
class User
{

	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getUser($uid){
		$pre_stmt = $this->con->prepare("SELECT * FROM collectors WHERE idno = ?");
		$pre_stmt->bind_param("s",$uid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_array();
		}else{
			$pre_stmt = $this->con->prepare("SELECT * FROM farmers WHERE idno = ?");
			$pre_stmt->bind_param("s",$uid);
			$pre_stmt->execute() or die($this->con->error);
			$result = $pre_stmt->get_result();
			if ($result->num_rows > 0) {
				$row = $result->fetch_array();
			}
		}
		return $row;
	}

	private function manageLogs($userid,$time){
		$pre_stmt = $this->con->prepare("SELECT id FROM logs WHERE userid=?");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$pre_stmt = $this->con->prepare("UPDATE `logs` SET `created_time`=? WHERE userid =?");
			$pre_stmt->bind_param("ss",$time,$userid);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}else{
			$pre_stmt = $this->con->prepare("INSERT INTO `logs`(`userid`, `created_time`) VALUES (?,?)");
			$pre_stmt->bind_param("ss",$userid,$time);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "INSERTED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	private function createTimeout($userid){
		$timeout_time = 0;
		$pre_stmt = $this->con->prepare("SELECT userid FROM timeout WHERE userid = ?");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$pre_stmt = $this->con->prepare("UPDATE `timeout` SET `timeout_time`=? WHERE userid=?");
			$pre_stmt->bind_param("is",$timeout_time,$userid);
			$result = $pre_stmt->execute() or die($this->con->error);
		}else{
			$pre_stmt = $this->con->prepare("INSERT INTO `timeout`(`userid`, `timeout_time`) VALUES (?,?)");
			$pre_stmt->bind_param("ss",$userid,$timeout_time);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "DONE";
			}else{
				return "ERROR";
			}
		}
	}

	public function loginTime($userid){

		$pre_stmt = $this->con->prepare("SELECT * FROM logs WHERE userid = ?");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row = $result->fetch_assoc();
		$time = $row["created_time"];

		$diff = time() - $time;

		$min = $diff / 60;

		if ($min == 5) {
			return "REQUEST";
		}else{
			return "NOT_YET";
		}

	}

	public function confirmPassword($table,$userid,$password){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE idno = ?");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$useridno = $row["idno"];
				$verifiedtime = time();
				$this->manageLogs($useridno,$verifiedtime);
				return "CONFIRMED";
			}else {
				return "CONFIRMED_FAILED";
			}
	}

/*=====NOTIFICATION CREATION=====*/
	
	private function createNewNotification($userid,$notifmessage){

		$time_created = time();

		$status = 0;

		$pre_stmt = $this->con->prepare("INSERT INTO `notifications`(`userid`, `notifmessage`, `time_created`, `status`) VALUES (?,?,?,?)");
		$pre_stmt->bind_param("ssss",$userid,$notifmessage,$time_created,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return $this->con->insert_id;
		}

	}

/*=====STUDENT REGISTRATION=====*/

	//CHECK WHETHER STUDENT IS REGISTERED
	private function studentAlreadyRegistered($regno){
		$pre_stmt = $this->con->prepare("SELECT id FROM students WHERE regno = ?");
		$pre_stmt->bind_param("s",$regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//REGISTER STUDENT
	public function registerStudent($supervisoremail, $firstname, $lastname, $regno, $phone, $email, $password){
		if ($this->studentAlreadyRegistered($regno)) {
			return "STUDENT_ALREADY_REGISTERED";
		}else {

			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

			$date = time();

			$pre_stmt = $this->con->prepare("INSERT INTO `students`(`supervisoremail`, `firstname`, `lastname`, `regno`, `phone`, `email`, `password`, `date_added`) VALUES (?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("ssssssss",$supervisoremail,$firstname,$lastname,$regno,$phone,$email,$pass_hash,$date);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_REGISTERED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
		
	}

/*=====END OF STUDENT REGISTRATION=====*/



/*=====SUPERVISOR REGISTRATION=====*/

	//CHECK WHETHER SUPERVISOR IS REGISTERED
	private function supervisorAlreadyRegistered($email){
		$pre_stmt = $this->con->prepare("SELECT id FROM supervisors WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//REGISTER SUPERVISOR
	public function registerSupervisor($firstname, $lastname, $phone, $email, $password){
		if ($this->supervisorAlreadyRegistered($email)) {
			return "SUPERVISOR_ALREADY_REGISTERED";
		}else {

			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$date = time();

			$pre_stmt = $this->con->prepare("INSERT INTO `supervisors`(`firstname`, `lastname`, `phone`, `email`, `password`, `date_added`) VALUES (?,?,?,?,?,?)");
			$pre_stmt->bind_param("ssssss",$firstname,$lastname,$phone,$email,$pass_hash,$date);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_REGISTERED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
		
	}

/*=====END OF SUPERVISOR REGISTRATION=====*/


/*=====ADMIN REGISTRATION=====*/

//CHECK WHETHER ADMIN IS REGISTERED
	private function adminAlreadyRegistered($email){
		$pre_stmt = $this->con->prepare("SELECT id FROM admin WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//REGISTER ADMIN
	public function registerAdmin($firstname, $lastname, $phone, $email, $password){
		if ($this->adminAlreadyRegistered($email)) {
			return "ADMIN_ALREADY_REGISTERED";
		}else {

			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

			$pre_stmt = $this->con->prepare("INSERT INTO `admin`(`firstname`, `lastname`, `phone`, `email`, `password`) VALUES (?,?,?,?,?)");
			$pre_stmt->bind_param("sssss",$firstname,$lastname,$phone,$email,$pass_hash);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_REGISTERED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
		
	}

/*=====END OF ADMIN REGISTRATION=====*/


/*=====STUDENT LOGIN=====*/

	public function studentLogin($regno, $password){
		$pre_stmt = $this->con->prepare("SELECT * FROM students WHERE regno = ?");
		$pre_stmt->bind_param("s",$regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$password_length = strlen($password);
				$_SESSION["studentpasswordlength"] = $password_length; 
				$_SESSION["studentid"] = $row["id"];
				$_SESSION["studentfirstname"] = $row["firstname"];
				$_SESSION["studentlastname"] = $row["lastname"];
				$_SESSION["studentregno"] = $row["regno"];
				$_SESSION["studentphone"] = $row["phone"];
				$_SESSION["studentemail"] = $row["email"];
				return "LOGGED_IN";
			}else {
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

/*=====END OF STUDENT LOGIN=====*/


/*=====SUPERVISOR LOGIN=====*/

	public function supervisorLogin($email, $password){
		$pre_stmt = $this->con->prepare("SELECT * FROM supervisors WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$_SESSION["supervisorid"] = $row["id"];
				$_SESSION["supervisorfirstname"] = $row["firstname"];
				$_SESSION["supervisorlastname"] = $row["lastname"];
				$_SESSION["supervisorphone"] = $row["phone"];
				$_SESSION["supervisoremail"] = $row["email"];
				return "LOGGED_IN";
			}else {
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

/*=====END OF SUPERVISOR LOGIN=====*/


/*=====ADMIN LOGIN=====*/

	public function adminLogin($email, $password){
		$pre_stmt = $this->con->prepare("SELECT * FROM admin WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$_SESSION["adminid"] = $row["id"];
				$_SESSION["adminfirstname"] = $row["firstname"];
				$_SESSION["adminlastname"] = $row["lastname"];
				$_SESSION["adminphone"] = $row["phone"];
				$_SESSION["adminemail"] = $row["email"];
				return "LOGGED_IN";
			}else {
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

/*=====END OF ADMIN LOGIN=====*/



/*=====COUNT NO OF USERS=====*/

	public function countUsers($table){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS countusers FROM ".$table);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

/*=====END OF COUNT NO OF USERS=====*/



}
//$user = new User();
//echo $user->registerStudent("john@gmail.com", "Leo", "Siku", "SCII/00327/2015", "0706209779", "leo@gmail.com", "leo12345");
//echo $user->registerSupervisor("John", "Desagu", "076453427", "john@gmail.com", "JOHN123");
//echo $user->registerAdmin("Ian", "Duncan", "0767476987", "duncan@gmail.com", "dancan123");
//echo $user->farmerLogin("15423678", "peterson123");
//echo $user->collectorLogin("33466987", "JOHN123");$user = new User();
//echo $user->adminLogin("1122334455", "peter123");
//$count = $user->countUsers("collectors");
//$rows = $user->getAllUsers("farmers");
//$rows = $user->searchFarmerId("9");
//echo json_encode($rows);
?>