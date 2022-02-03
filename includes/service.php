<?php 

/**
* 
*/
class Service 
{
	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
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

	public function countNewMessage($userid){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalnewmessages FROM chat WHERE status='0' AND userid=?");
		$pre_stmt->bind_param("s",$userid);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	public function updateMessageStatus($userid){
		$pre_stmt = $this->con->prepare("UPDATE `chat` SET `status`='1' WHERE recipientid=?");
		$pre_stmt->bind_param("s", $userid);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "MSG_UPDATED";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	public function sendMessage($senderid,$recipientid,$message){
		$send_time = time();
		$status = 0;
		$pre_stmt = $this->con->prepare("INSERT INTO `chat`(`senderid`, `recipientid`, `message`, `time_send`, `status`) VALUES (?,?,?,?,?)");
		$pre_stmt->bind_param("sssss",$senderid,$recipientid,$message,$send_time,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "SEND";
		}else{
			return "ERRROR";
		}
	}

	public function getMessage($userid){
		$pre_stmt = $this->con->prepare("SELECT * FROM chat WHERE recipientid = ? OR senderid = ? ORDER BY time_send DESC");
		$pre_stmt->bind_param("ss",$userid,$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function countNewNotification($userid){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalnewnotifs FROM notifications WHERE status='0' AND userid=?");
		$pre_stmt->bind_param("s",$userid);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	 public function getAllUsers(){
        $pre_stmt = $this->con->prepare("SELECT firstname,lastname,idno FROM farmers UNION ALL SELECT firstname, lastname, idno FROM collectors");
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";   
    
    }

	public function getAllNotification($userid){
		$pre_stmt = $this->con->prepare("SELECT * FROM notifications WHERE userid = ? ORDER BY time_created DESC");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function updateNotification($userid){
		$pre_stmt = $this->con->prepare("UPDATE `notifications` SET `status`='1' WHERE userid=?");
		$pre_stmt->bind_param("s", $userid);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "UPDATED";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	public function manageNotification($userid){

		$pre_stmt = $this->con->prepare("SELECT time_created FROM notifications WHERE userid = ?");
        $pre_stmt->bind_param("s",$userid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $row = $result->fetch_assoc();
        $time = $row["time_created"];

		$diff	 = time() - $time;

		// Convert time difference in minutes 
		$min	 = round($diff / 60 );
						
		// Convert time difference in days 
		$days	 = round($diff / 86400 ); 

		if ($min > 4) {
		 	$pre_stmt = $this->con->prepare("DELETE FROM `notifications` WHERE status='1' AND userid = ?");
		 	$pre_stmt->bind_param("s",$userid);
		 	$result = $pre_stmt->execute() or die($this->con->error);
		 	if ($result) {
		 		return "DELETED";
		 	}else{
		 		return "UNKOWN_ERROR";
		 	}
		 } 
	}

	public function getStudentProgress($student_regno){
		$pre_stmt = $this->con->prepare("SELECT id,week_name FROM weeks WHERE student_regno = ? ORDER BY id DESC LIMIT 1");
		$pre_stmt->bind_param("s",$student_regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_array();
			$weekid =  $row["week_name"];
			$pre_stmt = $this->con->prepare("SELECT * FROM logbookentries WHERE week_id = ? AND student_regno = ?");
			$pre_stmt->bind_param("is",$weekid,$student_regno);
			$pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        $rowz = array();
	        if ($result->num_rows > 0){
	            while($row1 = $result->fetch_assoc()){
	            $rowz[] = $row1;
	        	}
	        } 
	       return ["week"=>$row['week_name'],"weekdata"=>$rowz];
		}else{
			return ["week"=>1,"weekdata"=>1];
		}
		
	}

	public function supervisorCountNoOfStudents($email){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalstudents FROM students WHERE supervisoremail = ?");
		$pre_stmt->bind_param("s",$email);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	public function adminCountNoOfStudents(){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalstudents FROM students");
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	public function adminCountNoOfSupervisors(){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalsupervisors FROM supervisors");
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	public function deleteRecord($table,$pk,$id){
		if($table == "students"){
			$pre_stmt = $this->con->prepare("SELECT * FROM weeks WHERE student_regno = ?");
			$pre_stmt->bind_param("s",$id);
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->con->error);
			if ($result->num_rows > 0) {
				return "DEPENDENT_RECORD";
			}else{
				$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
				$pre_stmt->bind_param("s",$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "RECORD_DELETED";
				}
			}
		}

		if($table == "supervisors"){
			$pre_stmt = $this->con->prepare("SELECT * FROM students WHERE supervisoremail = ?");
			$pre_stmt->bind_param("s",$id);
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->con->error);
			if ($result->num_rows > 0) {
				return "DEPENDENT_RECORD";
			}else{
				$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
				$pre_stmt->bind_param("s",$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "RECORD_DELETED";
				}
			}
		}
	}

	public function updateRecord($table,$field_name,$field_value,$pk,$pk_value)
	{
		if ($field_name == "password") {
			$pass_hash = password_hash($field_value,PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt = $this->con->prepare("UPDATE ".$table." SET ".$field_name." = ?  WHERE ".$pk." = ?");
			$pre_stmt->bind_param("ss",$pass_hash,$pk_value);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}else{

			$pre_stmt = $this->con->prepare("UPDATE ".$table." SET ".$field_name." = ?  WHERE ".$pk." = ?");
			$pre_stmt->bind_param("ss",$field_value,$pk_value);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	public function addNewWeek($student_regno){
		$pre_stmt = $this->con->prepare("SELECT count(1) FROM weeks WHERE student_regno = ?");
		$pre_stmt->bind_param("s",$student_regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row = $result->fetch_array();
		$total = $row[0];
		$newweek = "Week ".($total + 1);
		$weekid = $total + 1;
		$date_added = time();
		$remarks = "";

		$pre_stmt = $this->con->prepare("INSERT INTO `weeks`(`week_name`, `student_regno`, `remarks`, `date_created`) VALUES (?,?,?,?)");
		$pre_stmt->bind_param("ssss",$weekid,$student_regno,$remarks,$date_added);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			//return "SUCCESSFULLY_ADDED";
			$i = 1;
			while($i <= 5){
			    $i++;
			    $this->createTaskTable($weekid,$student_regno);
			}
			return "ADDED_SUCCESSFULLY";
			//return ["newweek"=>$newweek,"weekid"=>$weekid];
		}else{
			return "UNKOWN_ERROR";
		}

	}

	public function getWeekTasks($weekid,$student_regno){
		$pre_stmt = $this->con->prepare("SELECT * FROM logbookentries WHERE week_id = ? AND student_regno = ?");
		$pre_stmt->bind_param("is",$weekid,$student_regno);
		$pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";   
    
	}

	public function createTaskTable($weekid,$student_regno){
		$role = "";
		$task = "";
		$weekday = "";
		$date_added = time();
		$pre_stmt = $this->con->prepare("SELECT count(1) FROM logbookentries WHERE student_regno = ? && week_id = ?");
		$pre_stmt->bind_param("si",$student_regno,$weekid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row = $result->fetch_array();
		$total = $row[0];
		if ($total == 0) {
			$weekday = "Monday";
		}
		if ($total == 1) {
			$weekday = "Tuesday";
		}
		if ($total == 2) {
			$weekday = "Wednesday";
		}
		if ($total == 3) {
			$weekday = "Thursday";
		}
		if ($total == 4) {
			$weekday = "Friday";
		}

		$pre_stmt = $this->con->prepare("INSERT INTO `logbookentries`(`week_id`, `week_day`, `student_regno`, `role`, `task`, `date_added`) VALUES (?,?,?,?,?,?)");
		$pre_stmt->bind_param("isssss",$weekid,$weekday,$student_regno,$role,$task,$date_added);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "SUCCESSFULLY_ADDED";
		}else{
			return "UNKOWN_ERROR";
		}

	}

	public function updateLogbookWeekStatus($weekid,$remarks){
		$update_time = time();
		$pre_stmt = $this->con->prepare("UPDATE `weeks` SET `remarks`=?,`date_created`=? WHERE id = ?");
		$pre_stmt->bind_param("ssi",$remarks,$update_time,$weekid);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "UPDATED_SUCCESSFULLY";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	public function updateDayTask($did,$dayrole,$daytask){
		$update_time = time();
		$pre_stmt = $this->con->prepare("UPDATE `logbookentries` SET `role`=?,`task`=?,`date_added`=? WHERE id = ?");
		$pre_stmt->bind_param("sssi",$dayrole,$daytask,$update_time,$did);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "UPDATED_SUCCESSFULLY";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	public function getUserFullDetails($table,$pk,$userid){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ?");
		$pre_stmt->bind_param("s",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function manageLogBookWeeks($student_regno,$pno){
		$a = $this->paginationLogBookWeeks($this->con,$student_regno,$pno,4);
		$sql = "SELECT * FROM weeks WHERE student_regno = '$student_regno' ORDER BY date_created ASC ".$a["limit"];
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];

	}

	private function paginationLogBookWeeks($con,$student_regno,$pno,$n){
		$query = $con->query("SELECT COUNT(*) as 'rows' FROM weeks WHERE student_regno = '$student_regno'");
		$row = mysqli_fetch_assoc($query);
		//$totalRecords = 100000;
		$pageno = $pno;
		$numberOfRecordsPerPage = $n;

		$last = ceil($row["rows"]/$numberOfRecordsPerPage);

		$pagination = "<ul class='pagination'>";

		if ($last != 1) {
			if ($pageno > 1) {
				$previous = "";
				$previous = $pageno - 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li></li>";
			}
			for($i=$pageno - 5;$i< $pageno ;$i++){
				if ($i > 0) {
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				}
				
			}
			$pagination .= "<li class='page-item active'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
			for ($i=$pageno + 1; $i <= $last; $i++) { 
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				if ($i > $pageno + 4) {
					break;
				}
			}
			if ($last > $pageno) {
				$next = $pageno + 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a></li></ul>";
			}
		}
	//LIMIT 0,10
		//LIMIT 20,10
		$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

		return ["pagination"=>$pagination,"limit"=>$limit];
	}
}

//$service = new Service();
//$rows = $service->getAllUsers();
//echo $service->saveMilkDetails("987654321","33466987","20");
//$rows = $service->getMilkDetails("milkdetails");
//$rows = $service->getMilkDetailsForFarmer("milkdetails","123456789");
//$rows = $service->getMilkTotalsDetailsForFarmer("milkdetails","987654321");
//$rows = $service->getAllNotification("34562789");
//$count = $service->countMilkLitresNO("milkdetails");
//$count = $service->countNewNotification("34562789");
//echo $rows[0]["satus"];
//echo $service->addNewWeek("SCII/0900/2015");
//$rows = $service->calcTimeout("timeout");
//$rows = $service->getMessage("15423678");
//echo json_encode($rows);
//33466987
//echo $service->sendMessage("33466987","15423678","I am fine.Thank you very much.....");
?>