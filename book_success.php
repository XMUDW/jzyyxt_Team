<?php 
session_start();
$stuno = $_SESSION['stuno'];

require_once 'openDB.php';

// $id = $_POST["chair_id"];
$method = $_POST['myMethod'];
$id = $_POST['id'];
$nowTime = date('Y-m-d H:i:s',time());

$yqBookChair = substr($id,3);

if($method == "sav") {
	
	//检查讲座是否已经预约满
	$sql = "select chBookReady from yq_chair where id ='$yqBookChair'";
	$result1 = mysql_query($sql) or die("数据库请求失败！");
	$row = mysql_fetch_array($result1);
	if($row['chBookReady']<=0) {
		echo "full";
	}else {
	
		$sql1 = "update yq_chair set chBookReady = chBookReady-1 where id ='$yqBookChair'";
		mysql_query($sql1) or die("数据库请求失败！");
		
		
		$sql2 = "insert into yq_bookChair (yqBookChair,yqBookNum,yqBookTime) values ('$yqBookChair','$stuno','$nowTime')";
		mysql_query($sql2) or die("数据库请求失败！");
		echo "sav_ok";
	}
}elseif ($method == "del"){
	echo "del_ok";
}

?>