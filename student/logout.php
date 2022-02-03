<?php 

include_once("../database/constants.php");
if (isset($_SESSION["studentid"]) OR isset($_GET["studentid"])) {
	session_destroy();
	header("location:".DOMAIN."/");
}

?>