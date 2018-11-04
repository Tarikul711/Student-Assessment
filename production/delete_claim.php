<?php
require_once("../db_connection/config.php");


if(isset($_REQUEST['c_id'])){
	$claim_id = $_REQUEST['c_id'];
	$result=mysql_query("DELETE FROM ecclaim WHERE ec_id='$claim_id'");
	header('location: student_profile.php');
}
else {
	header('location: student_profile.php');
}
?>