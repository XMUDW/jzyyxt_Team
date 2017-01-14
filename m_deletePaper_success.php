<?php
session_start ();

// 学号
$stuno = $_SESSION ['stuno'];
require_once 'openDB.php';
$id = $_POST ['id'];
// 讲座的id
$ChairId = substr ( $id, 1 );
$sql = "delete  from paper_list where p_id = $ChairId";
$result = mysql_query ( $sql ) or die ( "删除数据库请求失败！" );
?>