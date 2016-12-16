<h id = "headline">
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

$nowTime = "2016-12-03 20:40:04";
require_once 'openDB.php';
$sqlstr = "select * from yq_chair where chBookTime >  '$nowTime'  order by id desc";
$result = mysql_query($sqlstr) or die("数据库请求失败！");
while ($rows = mysql_fetch_array($result)) {
	$id = $rows['id'];

	//检查讲座是否已经预约满
	$sql = "select * from yq_chair where id ='$id'";
	$result1 = mysql_query($sql) or die("数据库请求失败！");
	$row = mysql_fetch_array($result1);
	if($nowTime<$row['chBookStartTime']) {
	//预约时间还没到！
		
 ?>
<div class='chair-wrapper'>
	<ul>
        <li class="table"><b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>	
         <li class="table"><b class="title"> 主   讲   人</b><?php echo  $row['chAnchor']?></li>
        <li class="table"><b class="title"> 讲座名称</b><aside><?php echo  $row['chName']?></aside></li>
        <li class="table"><b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
        <li class="table"><b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
        <li class="table"><b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
        <li class="table"><b class="title">起始时间</b><?php echo  $row['chBookStartTime']?></li>
        <li class="table"><b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
        <li class="table"><b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
        <li class="table">预约时间还没到哦~</li>
   </ul>
</div>

<div class="Split_line"></div>

<?php
	}else if($row['chBookReady']<=0){
	//预约人数满
?>

<div class='chair-wrapper'>
	<ul>
        <li class="table"><b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>	
         <li class="table"><b class="title"> 主   讲   人</b><?php echo  $row['chAnchor']?></li>
        <li class="table"><b class="title"> 讲座名称</b><aside><?php echo  $row['chName']?></aside></li>
        <li class="table"><b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
        <li class="table"><b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
        <li class="table"><b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
        <li class="table"><b class="title">起始时间</b><?php echo  $row['chBookStartTime']?></li>
        <li class="table"><b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
        <li class="table"><b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
        <li class="table">预约人数已经满啦~请等待其他同学弃权</li>
   </ul>
</div>

<div class="Split_line"></div>

<?php 
	}else {
		
		$flag = "select * from yq_bookChair where yqBookChair = '$id' and yqBookNum = '$stuno'";
		$flag_result = mysql_query($flag) or die("数据库请求失败！");
		if(mysql_num_rows($flag_result)==0) {
	    //可以预约讲座
?>		
<div class='chair-wrapper'>
	<ul>
        <li class="table"><b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>	
         <li class="table"><b class="title"> 主   讲   人</b><?php echo  $row['chAnchor']?></li>
        <li class="table"><b class="title"> 讲座名称</b><aside><?php echo  $row['chName']?></aside></li>
        <li class="table"><b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
        <li class="table"><b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
        <li class="table"><b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
        <li class="table"><b class="title">起始时间</b><?php echo  $row['chBookStartTime']?></li>
        <li class="table"><b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
        <li class="table"><b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
   </ul>
   <input class='book-btn' type='button' id=<?php  $id_format = "sav".$row['id'];echo $id_format;?> value='预约此讲座' onclick='book(this.id)'/>
</div>

<div class="Split_line"></div>
		
<?php 		
		}else {
		//已经预约了该讲座
?>

<div class='chair-wrapper'>
	<ul>
        <li class="table"><b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>	
         <li class="table"><b class="title"> 主   讲   人</b><?php echo  $row['chAnchor']?></li>
        <li class="table"><b class="title"> 讲座名称</b><aside><?php echo  $row['chName']?></aside></li>
        <li class="table"><b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
        <li class="table"><b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
        <li class="table"><b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
        <li class="table"><b class="title">起始时间</b><?php echo  $row['chBookStartTime']?></li>
        <li class="table"><b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
        <li class="table"><b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
   </ul>
   <input class='book-btn' type='button' id=<?php  $id_format = "del".$row['id'];echo $id_format;?> value='取消预约' onclick='book(this.id)'/>
</div>

<div class="Split_line"></div>

<?php 
			
		}
	}
}


function timediff( $begin_time, $end_time )
{
	
	$timediff = $end_time - $begin_time;
	$days = intval( $timediff / 86400 );
	$remain = $timediff % 86400;
	$hours = intval( $remain / 3600 );
	$remain = $remain % 3600;
	$mins = intval( $remain / 60 );
	$secs = $remain % 60;
	$res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
	return $hours;
}


?>

	