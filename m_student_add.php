<?php
require_once 'CheckSession.php';

session_start ();

$res = '';

// var newstudentName = $('#newstudentName').val();
// var newStuno = $('#newStuno').val();
// var newstudentMajor = $('#newstudentMajor').val();
// var newstudentGrade = $('#newstudentGrade').val();


require_once 'openDB.php';

$defaultPassword = strtoupper ( md5 ( "123456" ) );


// if(isset($_POST ['newadmin'])) {
	$newstudentName = $_POST ['newstudentName'];
	$newStusex = $_POST ['newStusex'];
	$newStuno = $_POST ['newStuno'];
	$newstudentMajor = $_POST ['newstudentMajor'];
	$newstudentGrade = $_POST ['newstudentGrade'];
	
	$flag = "select * from yq_info where stuno = '$newStuno'";
	$flag_result = mysql_query ( $flag ) or die ( "数据库请求失败！" );
	if (mysql_num_rows ( $flag_result ) == 0) {
	
		$sqlstr =  "insert into yq_info(stuname,stuno,stusex,specialty,grade,stupassword) values('$newstudentName','$newStuno','$newStusex','$newstudentMajor','$newstudentGrade','$defaultPassword')";
		mysql_query ( $sqlstr ) or die ( "插入数据库请求失败！" );
		$res = "添加成功";
	}else {
		$res = "用户已存在";
	}
// }else {
// 	$modify_admin_pwd =strtoupper (md5($_POST ['modify_admin_pwd']));
	
// 	$sqlstr =  "UPDATE yq_adminuser SET yq_password = '$modify_admin_pwd' WHERE yq_username = '$stuno' ";
// 	mysql_query ( $sqlstr ) or die ( "更新数据库请求失败！" );
// 	$res = "修改成功";
	
// }


echo $res;
?>