<?php
require_once 'CheckSession.php';
session_start ();

$stuno = $_SESSION ['stuno'];

$res = '';

require_once 'openDB.php';

$modify_tudent_pwd = strtoupper ( md5 ( $_POST ['modify_student_pwd'] ) );

$sqlstr = "UPDATE yq_info SET stupassword = '$modify_tudent_pwd' WHERE stuno = '$stuno' ";
mysql_query ( $sqlstr ) or die ( "更新数据库请求失败！" );
$res = "修改成功";

echo $res;
?>
