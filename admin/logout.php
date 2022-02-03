<?php 

include_once("../database/constants.php");
if (isset($_SESSION["adminid"])) {
	session_destroy();
	header("location:".DOMAIN."/");
}

?>