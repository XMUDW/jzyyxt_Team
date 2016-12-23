<?php
session_start ();

$_SESSION ['stuno'] = $_POST ["username"];
$stuno = $_POST ["username"];
$stupassword = strtoupper ( md5 ( $_POST ["password"] ) );
$_SESSION['userType'] = $_POST['userType'];
$userType = $_POST['userType'];
require_once 'openDB.php';

$msg = "";


// 在这添加权限认证
if($userType=="student") {
	$query = "select * from yq_info where stuno='$stuno'";
	$result = @mysql_query ( $query, $connection ) or die ( "数据库请求失败！" );
	$password = "stupassword";
	
	if ($row = mysql_fetch_array ( $result )) {
		if ($row [$password] == $stupassword) {
			$msg = "studentsuccess";
		} else {
	
			$msg ="error";
		}
	}else {
		$msg = "null";
	}
}elseif ($userType=="manager") {
	$query = "select * from yq_adminuser where yq_username='$stuno'";
	$result = @mysql_query ( $query, $connection ) or die ( "数据库请求失败！" );
	if ($row = mysql_fetch_array ( $result )) {
		if ($row ["yq_password"] == $stupassword) {
			$msg ="managersuccess";
		} else {
	
			$msg ="error";
		}
	}else {
		$msg = "null";
	}
}
echo $msg;

?>