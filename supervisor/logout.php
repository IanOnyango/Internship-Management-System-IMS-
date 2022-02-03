<?php 

include_once("../database/constants.php");
if (isset($_SESSION["supervisorid"])) {
	session_destroy();
	header("location:".DOMAIN."/");
}

?>