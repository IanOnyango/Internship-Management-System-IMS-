<?php

header('Content-Type: application/json');
include_once("../database/constants.php");
include_once("./user.php");
include_once("./service.php");
include_once("./manage.php");
include_once("./time.php");

if (isset($_POST["getUserFullDetails"])) {
	$service = new Service();
	$rows = $service->getUserFullDetails($_POST["usertable"],$_POST["pk"],$_POST["userid"]);
	echo json_encode($rows);
}

if (isset($_POST["getStudentDailyProgress"])) {
	$service = new Service();
	$result = $service->getStudentProgress($_POST["studentRegno"]);
	$rows = $result["weekdata"];
	echo json_encode($rows);
	exit();
}

?>