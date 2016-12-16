<?php 
session_start();

//学号
$stuno = $_SESSION['stuno'];

require_once 'openDB.php';

$method = $_POST['myMethod'];
$id = $_POST['id'];
$nowTime = date('Y-m-d H:i:s',time());

//讲座的id
$yqBookChair = substr($id,3);

if($method == "sav") {
	
	//检查讲座是否已经预约满
	$sql = "select chBookReady from yq_chair where id ='$yqBookChair'";
	$result = mysql_query($sql) or die("数据库请求失败！");
	$row = mysql_fetch_array($result);
	
	
	if($row['chBookReady']<=0) {
		echo "full";
	}else {
		//在此处限制讲座次数
		if(clickcardFull(6, $row['chTerm'], $stuno)) {
			echo "overflow";
		}else {
			$sql1 = "update yq_chair set chBookReady = chBookReady-1 where id ='$yqBookChair'";
			mysql_query($sql1) or die("数据库请求失败！");
			
			
			$sql2 = "insert into yq_bookChair (yqBookChair,yqBookNum,yqBookTime) values ('$yqBookChair','$stuno','$nowTime')";
			mysql_query($sql2) or die("数据库请求失败！");
			echo "sav_ok";
		}
		
		
	}
}else if ($method == "del"){
	
	$sql1 = "update yq_chair set chBookReady = chBookReady+1 where id ='$yqBookChair'";
	mysql_query($sql1) or die("数据库请求失败！");
	
	
	$sql2 = "delete from yq_bookChair where yqBookChair = '$yqBookChair' and yqBookNum = '$stuno'";
	mysql_query($sql2) or die("数据库请求失败！");
	
	echo "del_ok";
}

//预约满n场
function  clickcardFull($nNum,$chTerm,$stuno)
{
	
	//限制个别年级
	//$sqlstr = "select * from yq_chair,yq_clickCard,yq_info where yq_chair.id=yq_clickCard.yqChair and yq_info.stuno=yq_clickCard.yqNum and yq_info.grade ='2016' and yq_chair.chTerm='" + chTerm + "' and yq_clickCard.yqNum='" + stuNo + "'";
	//全年级限制
	//$sqlstr = "select * from yq_chair,yq_clickCard,yq_info where yq_chair.id=yq_clickCard.yqChair and yq_info.stuno=yq_clickCard.yqNum and yq_chair.chTerm='" + chTerm + "' and yq_clickCard.yqNum='" + stuNo + "'";
	
	$sqlstr = "select * from yq_chair,yq_clickCard where yq_chair.id=yq_clickCard.yqChair and chTerm='$chTerm' and yqNum='$stuno'";
	$result = mysql_query($sqlstr) or die("数据库请求失败！");
  
	if (mysql_num_rows($result)>=$nNum)
	{
		return true;
	}
	else
		return false;
}


?>