<?php

include_once("../database/constants.php");
include_once("./user.php");
include_once("./service.php");
include_once("./manage.php");
include_once("./time.php");
include_once("./report.php");

/*======Get Notifications======*/

if (isset($_POST["getNotification"])) {
	$service = new Service();
	$rows = $service->getAllNotification($_POST["Uid"]);
	if ($rows > 0) {
		foreach ($rows as $row) {
				?>
				<?php
				$status = $row["status"];
				if ($status == 0) {
				 	?>
				 	<a class="dropdown-item d-flex align-items-center" href="#">
		            <div class="mr-3">
		                <div class="icon-circle bg-success">
		                    <i class="fas fa-file-alt text-white"></i>
		               	</div>
		            </div>
		            <div>
		            <div class="small text-gray-500">
		                <?php
		                $received = "Received";
		                $time = $row["time_created"];
		                $t = new TimeManager();
		                $result = $t->calculateTime($time,$received);
		                echo $result;
		   				?>
		            </div>
            			
            		<span class="font-weight-bold"><?php echo $row["notifmessage"];?></span>
		                
		            </div>
		        </a>
				 	<?php
				 }else{
				 	?>

				 	<a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">
                    	<?php
                    	$received = "Received";
		                $time = $row["time_created"];
		                $t = new TimeManager();
		                $result = $t->calculateTime($time,$received);
		                echo $result;
		   				?>
                    </div>
                    <?php echo $row["notifmessage"];?>
                  </div>
                </a>

				 	<?php
				 } 
				?>
		<?php
		}
	}else{
			echo "<center><b>Your notifications will appear here</b></center>";
		}
	exit();
}

if (isset($_POST["supervisorCountNoOfStudents"])) {
	$service = new Service();
	$count = $service->supervisorCountNoOfStudents($_POST["sEmail"]);
	$studentsno = $count["totalstudents"];
	if ($studentsno > 0) {
			?>

			<p><?php echo $studentsno;?></p>

			<?php
	}else{
		?>
		<p>No record yet</p>
		<?php
	}
}

if (isset($_POST["adminCountNoOfStudents"])) {
	$service = new Service();
	$count = $service->adminCountNoOfStudents();
	$studentsno = $count["totalstudents"];
	if ($studentsno > 0) {
			?>

			<p><?php echo $studentsno;?></p>

			<?php
	}else{
		?>
		<p>No record yet</p>
		<?php
	}
}

if (isset($_POST["adminCountNoOfSupervisors"])) {
	$service = new Service();
	$count = $service->adminCountNoOfSupervisors();
	$supervisorsno = $count["totalsupervisors"];
	if ($supervisorsno > 0) {
			?>

			<p><?php echo $supervisorsno;?></p>

			<?php
	}else{
		?>
		<p>No record yet</p>
		<?php
	}
}

if (isset($_POST["generateStudentLogbook"])) {
	$r = new Report();
	$r->generateStudentLogbook($_POST["studentRegno"]);
	exit();
}

if (isset($_POST["getStudentProgress"])) {
	$service = new Service();
	$result = $service->getStudentProgress($_POST["studentRegno"]);
	$rows = $result["weekdata"];
	if ($rows == 1) {
		echo "No progress yet";
		
	}else{
		$weekname = $result["week"];
		echo "Week ".$weekname;
	}
	exit();
}

if (isset($_POST["manageNotification"])) {
	$service = new Service();
	$result = $service->manageNotification($_POST["Uid"]);
	echo $result;
	exit();
}

if (isset($_POST["countNewNotification"])) {
	$service = new Service();
	$count = $service->countNewNotification($_POST["Uid"]);
	$countno = $count["totalnewnotifs"];
	if ($countno > 0) {
		?>

		<?php echo $count["totalnewnotifs"];?>

		<?php
	}
	exit();
}

if (isset($_POST["updateNotification"])) {
	$service = new Service();
	$result = $service->updateNotification($_POST["Uid"]);
	echo $result;
	exit();
}

/*======Student Login======*/

if (isset($_POST["student_id"]) && isset($_POST["student_password"])) {
	$user = new User();
	$result = $user->studentLogin($_POST["student_id"],$_POST["student_password"]);
	echo $result;
	exit();
}

/*======Supervisor Login======*/

if (isset($_POST["supervisor_email"]) && isset($_POST["supervisor_password"])) {
	$user = new User();
	$result = $user->supervisorLogin($_POST["supervisor_email"],$_POST["supervisor_password"]);
	echo $result;
	exit();
}

/*======Admin Login======*/

if (isset($_POST["admin_email"]) && isset($_POST["admin_password"])) {
	$user = new User();
	$result = $user->adminLogin($_POST["admin_email"],$_POST["admin_password"]);
	echo $result;
	exit();
}

/*======Register Supervisor======*/

if (isset($_POST["txtSupervisorFirstName"]) && isset($_POST["txtSupervisorLastName"])) {

	$supervisorFirstname = filter_var($_POST["txtSupervisorFirstName"], FILTER_SANITIZE_STRING);
	$supervisorLastname = filter_var($_POST["txtSupervisorLastName"], FILTER_SANITIZE_STRING);
	$supervisorPhoneno = filter_var($_POST["txtSupervisorPhoneno"], FILTER_SANITIZE_STRING);
	$supervisorEmailaddress = filter_var($_POST["txtSupervisorEmailaddress"], FILTER_SANITIZE_STRING);
	$supervisorPassword = filter_var($_POST["txtPassword1"], FILTER_SANITIZE_STRING);

	$user = new User();
	$result = $user->registerSupervisor($supervisorFirstname,$supervisorLastname,$supervisorPhoneno,$supervisorEmailaddress,$supervisorPassword);
	echo $result;
	exit();
}

/*======Register Student======*/

if (isset($_POST["txtStudentFirstName"]) && isset($_POST["txtStudentLastName"])) {

	$studentFirstname = filter_var($_POST["txtStudentFirstName"], FILTER_SANITIZE_STRING);
	$studentLastname = filter_var($_POST["txtStudentLastName"], FILTER_SANITIZE_STRING);
	$studentregno = filter_var($_POST["txtStudentRegno"], FILTER_SANITIZE_STRING);
	$studentPhoneno = filter_var($_POST["txtStudentPhoneno"],FILTER_SANITIZE_STRING);
	$studentEmailaddress = filter_var($_POST["txtStudentEmailaddress"], FILTER_SANITIZE_STRING);
	$studentPassword = filter_var($_POST["txtPassword1"], FILTER_SANITIZE_STRING);

	$user = new User();
	$result = $user->registerStudent($_POST["supervisoremail"],$studentFirstname,$studentLastname,$studentregno,$studentPhoneno,$studentEmailaddress,$studentPassword);
	echo $result;
	exit();
}

/*======Get All Students======*/

if (isset($_POST["getAllStudents"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("students",$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5)+1;
		foreach ($rows as $row) {
			?>
			<tr>
                <td><?php echo $n;?></td>
                <td><?php echo $row["firstname"];?>&nbsp;<?php echo $row["lastname"];?></td>
                <td><?php echo $row["supervisorfirstname"];?>&nbsp;<?php echo $row["supervisorlastname"];?></td>
                <td><?php echo $row["regno"];?></td>
                <td><?php echo $row["phone"];?></td>
                <td><?php echo $row["email"];?></td>
   				<td>
   				<?php
   				$timestamp = $row["date_added"];
   				echo(date("F d, Y", $timestamp));
   				?>	
   				</td>
                <td>
                	<span class="nav-item dropdown">
                    	<a data-toggle="dropdown"><center><b class="caret"></b></center></a>
                      	<ul class="dropdown-menu">
                      		
                      	</ul>
                     </span>
                </td>
            </tr>
			<?php
			$n++;
		}
		?>
			<tr><td colspan="8"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
	}
}

/*======Get All Supervisors======*/

if (isset($_POST["getAllSupervisors"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("supervisors",$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5)+1;
		foreach ($rows as $row) {
			?>
				<tr>
                <td><?php echo $n;?></td>
                <td><?php echo $row["firstname"];?>&nbsp;<?php echo $row["lastname"];?></td>
                <td><?php echo $row["phone"];?></td>
                <td><?php echo $row["email"];?></td>
   				<td>
   				<?php
   				$timestamp = $row["date_added"];
   				echo(date("F d, Y", $timestamp));
   				?>	
   				</td>
                <td>
                <div class="dropdown">
				   <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-left: 45%;"></a>

				    <div class="dropdown-menu">
				        <a href="#" class="dropdown-item" title="Delete" semail="<?php echo $row['email'];?>" id="removesupervisor" data-toggle="tooltip"><i class="fas fa-trash" style="color: red;"></i>&nbsp;Delete</a>
				        <a href="#" class="dropdown-item" title="View" semail="<?php echo $row['email'];?>" id="viewsupervisor" data-toggle="tooltip"><i class="fas fa-eye" style="color: purple;"></i>&nbsp;View</a>
				    </div>
				</div>
                </td>
            </tr>

			<?php
			$n++;
		}
		?>
			<tr><td colspan="8"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
	}
}

/*======Get All Farmers For A Single Collector======*/

if (isset($_POST["supervisorGetAllStudents"])) {
	$m = new Manage();
	$result = $m->manageMultipleRecordWithPagination("students",$_POST["pageno"],$_POST["sEmail"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5)+1;
		foreach ($rows as $row) {
			?>
				<tr>
                <td><?php echo $n;?></td>
                <td><?php echo $row["firstname"];?>&nbsp;<?php echo $row["lastname"];?></td>
                <td><?php echo $row["regno"];?></td>
                <td><?php echo $row["phone"];?></td>
                <td><?php echo $row["email"];?></td>
                <td>
   				<?php
   				$timestamp = $row["date_added"];
   				echo(date("F d, Y", $timestamp));
   				?>	
   				</td>
                <td>
                <div class="dropdown">
				   <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-left: 45%;"></a>
				    <div class="dropdown-menu">
				    	<a href="#" class="dropdown-item" title="Delete" sregno="<?php echo $row['regno'];?>" id="remove" data-toggle="tooltip"><i class="fas fa-trash" style="color: red;"></i>&nbsp;Delete</a>
				    	<a href="#" class="dropdown-item" title="View" sregno="<?php echo $row['regno'];?>" id="viewstudent" data-toggle="tooltip"><i class="fas fa-eye" style="color: purple;"></i>&nbsp;View</a>
				        <a href="#" class="dropdown-item" sregno="<?php echo $row['regno'];?>" id="viewstudentlogbook" title="View" data-toggle="tooltip"><i class="fas fa-eye" style="color: indigo;"></i>&nbsp;View Student Logbook</a>
				    </div>
				</div>
                </td>
            </tr>

			<?php
			$n++;
		}
		?>
			<tr><td colspan="8"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
	}
}

//Delete Collector
if (isset($_POST["deleteSupervisor"])) {
	$service = new Service();
	$result = $service->deleteRecord("supervisors","email",$_POST["id"]);
	echo $result;
}

//Delete Farmerr
if (isset($_POST["deleteStudent"])) {
	$service = new Service();
	$result = $service->deleteRecord("students","regno",$_POST["id"]);
	echo $result;
}

if (isset($_POST["getAllUsers"])) {
	$service = new Service();
	$rows = $service->getAllUsers();
		foreach ($rows as $row) {
			echo "<option value='".$row["idno"]."'>".$row["firstname"]."&nbsp;".$row["lastname"]."</option>";
		}
	exit();
}

if (isset($_POST["countNewMessage"])) {
	$service = new Service();
	$count = $service->countNewMessage($_POST["userid"]);
	$countno = $count["totalnewmessages"];
	if ($countno > 0) {
		?>

		<?php echo $count["totalnewmessages"];?>

		<?php
	}
	exit();
}

if (isset($_POST["sendMessage"])) {
	$service = new Service();
	$result = $service->sendMessage($_POST["senderid"],$_POST["recipientid"],$_POST["message"]);
	echo $result;
	exit();
}

if (isset($_POST["updateMessageStatus"])) {
	$service = new Service();
	$result = $service->updateMessageStatus($_POST["userid"]);
	echo $result;
	exit();
}

if (isset($_POST["getUserMessage"])) {
	$sender = $_POST["Uid"];
	$service = new Service();
	$rows = $service->getMessage($_POST["Uid"]);
	if ($rows > 0) {
		foreach ($rows as $row) {
			?>
			<?php
			$cuser = $row["senderid"];
			if ($sender == $cuser) {
				?>
				 <div class="author-chat">
				 <div class="message-area">
                    <h3><span class="chat-date">
                    <?php
		                $time =  $row["time_send"];
		                $t = new TimeManager();
		                $result = $t->processTime($time);
		                echo $result;
		            ?>
                    </span></h3>
                    <h6>
                    <?php
	                 $status = $row["status"];
	                 if ($status == 0) {
	                 	?>
	                 	<i class="fa fa-check"></i>
	                 	<?php
	                 }
	                 if ($status == 1) {
	                 	?>
	                 	<i class="fa fa-check"></i><i class="fa fa-check"></i>
	                 	<?php
	                 }
	                 ?>
	                 </h6>
	                 </div>
                    <p><?php echo $row["message"];?></p>
                </div>
				<?php
			}else{
			?>
			<div class="client-chat">
                <h3><?php
	                $uid = $row["senderid"];
	                $user = new User();
	                $res = $user->getUser($uid);
	                echo $res["firstname"];
	                echo "&nbsp;";
	                echo $res["lastname"]; 

                ?><span class="chat-date"><?php
	                $time =  $row["time_send"];
	                $t = new TimeManager();
	                $result = $t->processTime($time);
	                echo $result;
                 ?></span></h3>
                <p><?php echo $row["message"];?></p>
            </div>
			<?php
			}
		}
	}
}

if (isset($_POST["updateUserInfo"])) {
	$service = new Service();
	$result = $service->updateRecord($_POST["tablename"],$_POST["field_name"],$_POST["field_value"],$_POST["pk"],$_POST["pk_value"]);
	echo $result;
	exit();
}

if (isset($_POST["getNewWeek"])) {
	$service = new Service();
	$result = $service->addNewWeek($_POST["studentRegno"]);
	echo $result;
	exit();
}

if (isset($_POST["updateDayTask"])) {
	$s = new Service();
	$result = $s->updateDayTask($_POST["DID"],$_POST["dayRole"],$_POST["dayTask"]);
	echo $result;
	exit();
}

if (isset($_POST["updateLogbookWeekStatus"])) {
	$service = new Service();
	$result = $service->updateLogbookWeekStatus($_POST["weekID"],$_POST["sremarks"]);
	echo $result;
	exit();
}

if (isset($_POST["getAllLogBookWeeks"])) {
	$s = new Service();
	$result = $s->manageLogBookWeeks($_POST["studentRegno"],$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];

	if (count($rows) > 0) {
		foreach ($rows as $row) {		
		?>
			<div class="sparkline8-list shadow-reset">
	            <div class="sparkline8-hd">
	                <div class="main-sparkline8-hd">
	                    <h1><?php echo "Week ".$row["week_name"]; ?></h1>
	                    <div class="sparkline8-outline-icon">
	                        <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up icon-t"></i></span>
	                    </div>
	                </div>
	            </div>
	            <div class="sparkline8-graph">
	                <div class="static-table-list">
	                    <table class="table">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Day</th>
	                                <th>Role</th>
	                                <th>Task</th>
	                                <th></th>
	                                <th>Date</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
	                        $rowz =  $s->getWeekTasks($row["week_name"],$_POST["studentRegno"]);
		                        if (count($rowz) > 0) {
		                        	$n = 1;
	                        		foreach ($rowz as $row1) {
	                        			?>
	                        				<tr>
				                                <td><?php echo $n;?></td>
				                                <td>
				                                <?php 
				                                $weekday = $row1["week_day"];
				                                if ($weekday != "") {
				                                	?>
				                                	<input type="text" class="form-control" name="weekday" id="weekday" value="<?php echo $weekday;?>" readonly/>
				                                	<?php
				                                }
				                                ?>	
				                                </td>
				                                <td>
				                                <?php 
				                                $role = $row1["role"];
				                                if ($role == "") {
				                                	?>
				                                	<select class="form-control" id="dayrole" name="dayrole">
				                                		<option value="">-- Select Role --</option>
				                                		<option value="DevOps">DevOps</option>
				                                		<option value="DbAdmin">DbAdmin</option>
				                                		<option value="NetOps">NetOps</option>
				                                	</select>
				                                	<?php
				                                }else{
				                                	echo $role;
				                                }
				                                ?>
				                                </td>
				                                <td>
				                                	<?php
				                                	$task = $row1["task"];
				                                	if ($task == "") {
				                                		?>
				                                		<textarea id="daytask" name="daytask" class="form-control" cols="3"></textarea>
				                                		<?php
				                                	}else{
				                                		echo $task;
				                                	}
				                                	?>
				                                </td>
				                                <td>
				                                <?php 
				                                	if (($row1["role"] == "") && ($row1["task"] == "")) {
				                                		?>
				                                			<span id="savedaytask" dayid="<?php echo $row1['id'];?>"><i class="fa fa-arrow-right"></i></span>
				                                		<?php
				                                	}else{
				                                		?>
				                                			<span style="color: #2dce89;"><i class="fa fa-check"></i><i class="fa fa-check"></i></span>
				                                		<?php
				                                	}
				                                ?>
				                                	
				                                </td>
				                                <td>
			                                	<?php
			                                		if (($row1["role"] != "") && ($row1["task"] != "")) {
			                                			 echo(date("F d, Y", $row1['date_added']));
			                                		}

			                                	?>
				                                </td>
				                            </tr>
	                        			<?php
	                        			$n++;
	                        		}
		                        }
	                        ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <?php
	            	$sremarks = $row["remarks"];
	            	if ($sremarks == "") {
	            		?>
	            		<div class="supervisor-remarks" style="width: 100%;height: auto;padding: 10px;border-style: solid;border-width: 1px;border-color: #e9ecef;background-color: #fb6340;color: #fff;">
			            	
			            		<center><p>No remarks available from supervisor</p></center>
			            		
			            </div>
	            		<?php
	            	}else{
	            		?>
	            		<div class="supervisor-remarks-available" sr="<?php echo $sremarks;?>" style="width: 100%;height: auto;padding: 10px;border-style: solid;border-width: 1px;border-color: #e9ecef;background-color: #2dce89;color: #fff;">
			            	
			            		<center><p><?php echo "<b>Supervisor Remarks: </b>".$sremarks;?>, &nbsp;&nbsp;<?php echo date("F d, Y",$row["date_created"]);?></p></center>
			            		
			            </div>
	            		<?php
	            	}
	            ?>
	        </div>
		<?php
		}
		?>
			<div class="main-pagination"><?php echo $pagination;?></div>
		<?php	
	}else{
		?>
			<center><p>No Logbook entries available click add new week button to start entering new entries</p></center>
		<?php
	}
}


if (isset($_POST["getStudentLogBookWeeks"])) {
	$s = new Service();
	$result = $s->manageLogBookWeeks($_POST["studentRegno"],$_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];

	if (count($rows) > 0) {
		foreach ($rows as $row) {		
		?>
			<div class="sparkline8-list shadow-reset">
	            <div class="sparkline8-hd">
	                <div class="main-sparkline8-hd">
	                    <h1><?php echo "Week ".$row["week_name"]; ?></h1>
	                    <div class="sparkline8-outline-icon">
	                        <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up icon-t"></i></span>
	                    </div>
	                </div>
	            </div>
	            <div class="sparkline8-graph">
	                <div class="static-table-list">
	                    <table class="table">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Day</th>
	                                <th>Role</th>
	                                <th>Task</th>
	                                <th></th>
	                                <th>Date</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
	                        $rowz =  $s->getWeekTasks($row["week_name"],$_POST["studentRegno"]);
		                        if (count($rowz) > 0) {
		                        	$n = 1;
	                        		foreach ($rowz as $row1) {
	                        			?>
	                        				<tr>
				                                <td><?php echo $n;?></td>
				                                <td>
				                                <?php 
				                                $weekday = $row1["week_day"];
				                                if ($weekday != "") {
				                                	?>
				                                	<input type="text" class="form-control" name="weekday" id="weekday" value="<?php echo $weekday;?>" readonly/>
				                                	<?php
				                                }
				                                ?>	
				                                </td>
				                                <td>
				                                <?php 
				                                $role = $row1["role"];
				                                if ($role == "") {
				                                	?>
				                                	<p>No role yet</p>
				                                	<?php
				                                }else{
				                                	echo $role;
				                                }
				                                ?>
				                                </td>
				                                <td>
				                                	<?php
				                                	$task = $row1["task"];
				                                	if ($task == "") {
				                                		?>
				                                		<p>No task yet</p>
				                                		<?php
				                                	}else{
				                                		echo $task;
				                                	}
				                                	?>
				                                </td>
				                                <td>
				                                <?php 
				                                	if (($row1["role"] == "") && ($row1["task"] == "")) {
				                                		?>
				                                			<span><i class="fa fa-thumbs-down"></i></span>
				                                		<?php
				                                	}else{
				                                		?>
				                                			<span style="color: #2dce89;"><i class="fa fa-thumbs-up"></i></span>
				                                		<?php
				                                	}
				                                ?>
				                                	
				                                </td>
				                                <td>
			                                	<?php
			                                		if (($row1["role"] != "") && ($row1["task"] != "")) {
			                                			 echo(date("F d, Y", $row1['date_added']));
			                                		}

			                                	?>
				                                </td>
				                            </tr>
	                        			<?php
	                        			$n++;
	                        		}
		                        }
	                        ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <?php
	            	$sremarks = $row["remarks"];
	            	if ($sremarks == "") {
	            		?>
	            		<div class="supervisor-remarks" style="width: 100%;height: auto;padding: 10px;border-style: solid;border-width: 1px;border-color: #e9ecef;">
			            	<div class="row">
			            		<div class="col-sm-3">
			            			<label>Your Remarks</label>
			            		</div>
			            		<div class="col-sm-6">
			            			<textarea id="txtsremarks" class="form-control" cols="5" placeholder="Enter your remarks"></textarea>
			            		</div>
			            		<div class="col-sm-3">
			            			<button class="btn btn-primary btn-small" style="bottom: 0;position: absolute;float: right;" id="sremarksbtn" weekid="<?php echo $row['id'];?>">Save</button>
			            		</div>
			            	</div>
			            </div>
	            		<?php
	            	}else{
	            		?>
	            		<div class="supervisor-remarks-available" sr="<?php echo $sremarks;?>" style="width: 100%;padding: 10px;border-style: solid;border-width: 1px;border-color: #e9ecef;background-color: #2dce89;color: #fff;">
			            	
			            		<center><p><?php echo "<b>Your Remarks: </b>".$sremarks;?>, &nbsp;&nbsp;<?php echo date("F d, Y",$row["date_created"]);?></p></center>
			            		
			            </div>
	            		<?php
	            	}
	            ?>
	        </div>
		<?php
		}
		?>
			<div class="main-pagination"><?php echo $pagination;?></div>
		<?php	
	}else{
		?>
			<center><p>No Logbook entries available for this particular student</p></center>
		<?php
	}
}



if (isset($_REQUEST["term"])) {
	$param_term = $_REQUEST["term"] . '%';
	$user = new User();
	$rows = $user->searchFarmerId($param_term);
	if ($rows > 0) {
		foreach ($rows as $row) {
			?>
			<span>
			<p faid="<?php echo $row['id'];?>"><?php echo $row["firstname"];?>&nbsp;<?php echo $row["lastname"];?></p>
			<input type="hidden" name="farmeridno" id="farmeridno" value="<?php echo $row['idno'];?>">
			</span>

			<?php
		}
	}else{
		?>

		<p>No matches found</p>

		<?php
	}
	exit();
}

?>