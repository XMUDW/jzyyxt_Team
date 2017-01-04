<?php
require_once 'CheckSession.php';

session_start ();

$res = '';

require_once 'openDB.php';
if(isset($_POST['modify_type'])) {
	$id = $_POST['modify_type'];
	
	$modify_date = $_POST['modify_date'];
	$modify_author = $_POST['modify_author'];
	$modify_title = $_POST['modify_title'];
	$modify_term = $_POST['modify_term'];
	$modify_total = $_POST['modify_total'];
	
	$modify_bookdate1 = $_POST['modify_bookdate1'];
	$modify_bookdate2 = $_POST['modify_bookdate2'];
	$bookdate = $modify_bookdate1." ".$modify_bookdate2;
	
	$modify_startdate1 = $_POST['modify_startdate1'];
	$modify_startdate2 = $_POST['modify_startdate2'];
	$startdate = $modify_startdate1." ".$modify_startdate2;
	
	$modify_place = $_POST['modify_place'];
	
	$sqlstr =  "update yq_chair set chData='$modify_date',chAnchor='$modify_author',chName='$modify_title',chTerm='$modify_term',chTotalNum='$modify_total',chBookReady='$modify_total',chBookTime='$bookdate',chBookStartTime='$startdate',chAddress='$modify_place' where id = '$id'";
	mysql_query ( $sqlstr ) or die ( "更新数据库请求失败！" );
	$res = "修改成功";
} else {
	
	$add_date = $_POST['add_date'];
	$add_author = $_POST['add_author'];
	$add_title = $_POST['add_title'];
	$add_term = $_POST['add_term'];
	$add_total = $_POST['add_total'];
	
	$add_bookdate1 = $_POST['add_bookdate1'];
	$add_bookdate2 = $_POST['add_bookdate2'];
	$bookdate = $add_bookdate1." ".$add_bookdate2;
	
	$add_startdate1 = $_POST['add_startdate1'];
	$add_startdate2 = $_POST['add_startdate2'];
	$startdate = $add_startdate1." ".$add_startdate2;
	
	$add_place = $_POST['add_place'];
	
	$sqlstr =  "insert into yq_chair (chData,chAnchor,chName,chTerm,chTotalNum,chBookReady,chBookTime,chBookStartTime,chAddress) values ('$add_date','$add_author','$add_title','$add_term','$add_total','$add_total','$bookdate','$startdate','$add_place')";
	mysql_query ( $sqlstr ) or die ( "更新数据库请求失败！" );
	$res = "添加成功";
	
}
	echo $res;
?>