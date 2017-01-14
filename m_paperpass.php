<?php
session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';
$id=$_POST['id'];
$type=$_POST['type'];
switch ($type){
	case "paperpass":
		$sql= "update paper_list set p_verify = '合格' where p_id = $id";	
		$p_verify="pass";
		break;
	case "paperunpass":
		$sql= "update paper_list set p_verify = '不合格' where p_id = $id";
		$p_verify="unpass";
		break;
	case "paperrestart":
		$sql= "update paper_list set p_verify = '未审核' where p_id = $id";
		$p_verify="restart";
		break;
	default:break;
}

mysql_query ($sql);
echo $p_verify;
?>