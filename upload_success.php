<?php
session_start ();

$uploaded = $_SESSION ['uploaded'];
$name = $_SESSION ['filename'];
$uploadfile = iconv ( "gb2312", "UTF-8", $name );
$stuno = $_SESSION ['stuno'];

$p_title = $_POST ['paper_name'];
$p_type = $_POST ['paper_select'];
$p_keyword = $_POST ['paper_key'];
$p_summary = $_POST ['paper_abstract'];

// $p_indexed = $_POST['paper_included'];

$p_indexed = "";
if (! empty ( $_POST ['paper_included'] )) {
	foreach ( $_POST ['paper_included'] as $i ) {
		$p_indexed .= $i . ' ';
	}
} else {
	$p_indexed = "尚未检索";
}
$p_writer = $_POST ['paper_author'];
$p_teacher = $_POST ['paper_teacher'];
$p_first_addr = $_POST ['paper_unit'];
$p_lab = $_POST ['paper_lab'];
$p_place = $_POST ['paper_publication'];
$p_uptime = $_POST ['paper_time'];

// $info_array = array($stuno,$papername,$paperselect,$paperkey,$paperabstract,$paperincluded);
$array_key = explode ( " ", $p_keyword );

$nowTime = date ( 'Y-m-d H:i:s', time () );

$res = '';

require_once 'openDB.php';

// $sqlstr = "select * from paper_list";

$sqlstr = "insert into paper_list (p_stuno,p_title,p_type,p_name,p_summary,p_writer,p_teacher,p_lab,p_place,p_uptime,p_writetime,p_modifytime,p_keyword,p_verify,p_writertype,p_first_addr,p_indexed,p_instructor)
values ('$stuno','$p_title','$p_type','$uploadfile','$p_summary','$p_writer','$p_teacher','$p_lab','$p_place','$p_uptime','$p_uptime','$p_uptime','$p_keyword','未审核','$p_type','$p_first_addr','$p_indexed','一')";
// echo $sqlstr;

$sqlstr3 = "select @@identity as increid";

$sqlstr2 = "select * from paper_list where p_title = '$p_title' ";
$flag_result = mysql_query ( $sqlstr2 ) or die ( "数据库请求失败！" );

if (mysql_num_rows ( $flag_result ) > 0) {
	$res = "请先不要重复提交";
} elseif ($uploaded == false) {
	$res = "请先上传文件";
} else {
	mysql_query ( $sqlstr ) or die ( "数据库请求失败！" );
	$result = mysql_query ( $sqlstr3 ) or die ( "increid数据库请求失败！" );
	$rows = mysql_fetch_array ( $result );
	$paperid = $rows ['increid'];
	foreach ( $array_key as $i ) {
		$sqlstr1 = "insert into paper_keyword(k_pid,k_keyword) values('$paperid','$i')";
		mysql_query ( $sqlstr1 ) or die ( "关键字插入数据库请求失败！" );
	}
	$res = "提交成功";
}

$_SESSION ['uploaded'] = false;
echo $res;
?>
