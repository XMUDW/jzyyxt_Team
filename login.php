<?php
session_start ();

$_SESSION ['stuno'] = $_POST ["username"];
$stuno = $_POST ["username"];
$stupassword = strtoupper ( md5 ( $_POST ["password"] ) );
// $_SESSION['stuno'] = null;

include 'sys_conf.inc';

$connection = @mysql_connect ( $DBHOST, $DBUSER, $DBPWD ) or die ( "无法连接数据库！" );
@mysql_query ( "set names 'gb2312" );
@mysql_select_db ( $DBNAME ) or die ( "无法选择数据库！" );

// 在这添加权限认证
$query = "select * from yq_info where stuno='$stuno'";
$result = @mysql_query ( $query, $connection ) or die ( "数据库请求失败！" );
$password = "stupassword";
if ($row = mysql_fetch_array ( $result )) {
	if ($row [$password] == $stupassword) {
		echo "success";
	} else {
		
		echo "error";
	}
}

?>