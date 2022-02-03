<?php

/**
* 
*/
class Report 
{
	
	function __construct()
	{
		include_once("../database/db.php");
		include_once("../fpdf182/fpdf.php");
		include_once("service.php");
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

	private function printReport($user,$rows,$student_regno){
		$pdf = new FPDf('l','mm','A5');
		$pdf->SetFillColor(117,138,190);
		$pdf->AddPage();
		$pdf->SetTitle('Internship Management System');
		

		$pdf->SetFont('Times','B',16);
		$pdf->SetTextColor(5,32,99);
		
		#company status

		$pdf->cell(190,12,'Internship Management System',0,1,'C','true');
		$timestamp = time();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(190,12,date("F d, Y", $timestamp),0,1,"R");

		$firstname = $user["firstname"];
		$lastname = $user["lastname"];

		if ($firstname != null && $lastname !=null) {
			$pdf->Cell(50,12,"Student Name",0,0);
			$pdf->Cell(50,12,": ".$firstname." ".$lastname,0,1);
			$pdf->Cell(50,12,"Reg No",0,0);
			$pdf->Cell(50,12,": ".$user["regno"],0,1);
		}


		$pdf->SetFont('Times','B',14);

		$pdf->cell(190,12,'Logbook',0,1,'C');

		foreach ($rows as $row) {
			$pdf->cell(190,12,'Week '.$row['week_name'],0,1,'C');
			$pdf->cell(40,10,'Day',1,0,'C','true');
			$pdf->cell(40,10,'Role',1,0,'C','true');
			$pdf->cell(60,10,'Task',1,0,'C','true');
			$pdf->cell(50,10,'Date',1,1,'C','true');

			$pdf->SetFont('Times','',14);

			$s = new Service();
			$rowz =  $s->getWeekTasks($row["week_name"],$student_regno);
			if (count($rowz) > 0) {
				foreach ($rowz as $row1) {
					$pdf->cell(40,10,$row1['week_day'],1,0);
					$pdf->cell(40,10,$row1['role'],1,0,'C');
					$pdf->cell(60,10,$row1['task'],1,0,'C');
					$pdf->cell(50,10,date("F d, Y", $row1['date_added']),1,1,'C');
				}
			}
			$pdf->cell(190,12,"Supervisor Remarks: ".$row['remarks'].", ".date("F d, Y", $row['date_created']),0,1,'C','true');
		}
		
		$pdf->cell(190,20,'',0,1);

		$pdf->Output("../student/studentslogbooks/PDF_LOGBOOK_".$user["firstname"].$user["lastname"].$timestamp.".pdf","F");

		$pdf->Output();

	}

	public function generateStudentLogbook($student_regno){
		
		$pre_stmt = $this->con->prepare("SELECT * FROM weeks WHERE student_regno=?");
		$pre_stmt->bind_param("s",$student_regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		$pre_stmt = $this->con->prepare("SELECT * FROM students WHERE regno = ? LIMIT 1");
		$pre_stmt->bind_param("s",$student_regno);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc(); 		
		}

		$this->printReport($user,$rows,$student_regno);

	}
}

//$r = new Report();
//echo $r->generateStudentLogbook("SCII/0900/2015");
//echo json_encode($rows);

?>