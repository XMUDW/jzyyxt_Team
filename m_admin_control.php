<?php
require_once 'CheckSession.php';
session_start ();

$stuno = $_SESSION ['stuno'];

$res = '';

require_once 'openDB.php';

if(isset($_POST ['newadmin'])) {
	$newadmin = $_POST ['newadmin'];
	$pwd = strtoupper ( md5($_POST ['pwd']));
	
	$flag = "select * from yq_adminuser where yq_username = '$newadmin'";
	$flag_result = mysql_query ( $flag ) or die ( "数据库请求失败！" );
	if (mysql_num_rows ( $flag_result ) == 0) {
	
		$sqlstr =  "insert into yq_adminuser(yq_username,yq_password) values('$newadmin','$pwd')";
		mysql_query ( $sqlstr ) or die ( "插入数据库请求失败！" );
		$res = "添加成功";
	}else {
		$res = "用户已存在";
	}
}else {
	$modify_admin_pwd =strtoupper (md5($_POST ['modify_admin_pwd']));
	
	$sqlstr =  "UPDATE yq_adminuser SET yq_password = '$modify_admin_pwd' WHERE yq_username = '$stuno' ";
	mysql_query ( $sqlstr ) or die ( "更新数据库请求失败！" );
	$res = "修改成功";
	
}


echo $res;
?>
