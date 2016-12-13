<h id = "heihei">
讲座预约
</h>
<?php 
session_start();
//date('Y-m-d H:i:s',time());
//$nowTime = DateTime.Now.ToString("yyyy-MM-dd H:m:s");
// $nowTime = date('Y-m-d H:i:s',time());
$stuno = $_SESSION['stuno'];
// var_dump($stuno);
?>

	
<?php

$nowTime = "2016-11-19 08:40:04";
require_once 'openDB.php';
$sqlstr = "select * from yq_chair where chBookTime >  '$nowTime'  order by id desc";
$result = mysql_query($sqlstr) or die("数据库请求失败！");
while ($rows = mysql_fetch_array($result)) {
	$id = $rows['id'];

	//检查讲座是否已经预约满
	$sql = "select chBookReady from yq_chair where id ='$id'";
	$result1 = mysql_query($sql) or die("数据库请求失败！");
	$row = mysql_fetch_array($result1);
	if($row['chBookReady']<=0) {
		echo "<div class='chair-wrapper'>".$rows['id']."    ".$rows['chName']."</br>"." <input class='book-btn'   value='预约人数已经满啦~' />"."</div>";
	}else {
	
		
		$flag = "select * from yq_bookChair where yqBookChair = '$id' and yqBookNum = '$stuno'";
		$flag_result = mysql_query($flag) or die("数据库请求失败！");
	// 	echo mysql_num_rows($flag_result);
		if(mysql_num_rows($flag_result)==0) {
			echo "<div class='chair-wrapper'>".$rows['id']."    ".$rows['chName']."</br>"." <input class='book-btn' type='button' id='sav".$rows['id']."' value='预约此讲座' onclick='book(this.id)'/>"."</div>";
		}else {
			echo "<div class='chair-wrapper'>".$rows['id']."    ".$rows['chName']."</br>"." <input class='book-btn' type='button' id='del".$rows['id']."' value='取消预约' onclick='book(this.id)'/>"."</div>";
		}
	}
}
?>

	