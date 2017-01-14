<h class="headline"> 讲座预约 </h>
<div class="Split_line"></div>
<div class="clock" id="clock2"></div>
<?php
require_once 'CheckSession.php';
session_start ();
// date('Y-m-d H:i:s',time());
// $nowTime = DateTime.Now.ToString("yyyy-MM-dd H:m:s");
$nowTime = date('Y-m-d H:i:s',time());
$stuno = $_SESSION ['stuno'];
// var_dump($stuno);
?>

	
<?php

// $nowTime = "2016-05-14 20:40:04";
require_once 'openDB.php';
$sqlstr = "select * from yq_chair where chBookTime >  '$nowTime'  order by id";
$result = mysql_query ( $sqlstr ) or die ( "数据库请求失败！" );

$num=1;

$sql2 = "select * from yq_clickcard where yqNum ='$stuno' and absent = 1 ";
$result2 = mysql_query ( $sql2 ) or die ( "sql2数据库请求失败！" );
$row2 = mysql_fetch_array ( $result2 );
$status = $row2['yqChair'];
// $status = 600;
// echo $status;
if(mysql_num_rows($result)==0) {
	?>
	<div class="chair-wrapper">
		<ul >
			<li class="table" style="margin-left: -5%;">
				提示
			</li>
			<li class="table" style="min-height: 10%;margin-left: -5%;">
			目前还没有讲座可以预约<br>
			关注学院公众号，获得最新动态！
				<div class="erweima">
					<div class="light">
						<img src="images/light.png">
					</div>
					<img src="https://adl.netease.com/d/g/yys/c/fabpcb/qr" style="width: 100%; height: 100%;display: block;">
				</div>
			</li>
		</ul>
	</div>
<?php 
}else {
while ( $rows = mysql_fetch_array ( $result ) ) {
	$id = $rows ['id'];
	
	// 检查讲座是否已经预约满
	$sql1 = "select * from yq_chair where id ='$id'";
	$result1 = mysql_query ( $sql1 ) or die ( "数据库请求失败！" );
	$row = mysql_fetch_array ( $result1);
	
	//如果缺席则下面连续两场讲无法预约
	if($id==$status+1 ||$id == $status+2) {
		?>
		<div class='chair-wrapper'>
			<ul>
				<li class="table">
					<b class="title"> 讲座名称</b>
					<aside><?php echo  $row['chName']?></aside>
				</li>
				<li class="table">
					<b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>
				<li class="table">
					<b class="title"> 主 讲 人</b><?php echo  $row['chAnchor']?></li>
				
				<li class="table">
					<b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
				<li class="table">
					<b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
				<li class="table">
					<b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
				<li class="table">
					<b class="title">预约时间</b><?php echo  $row['chBookStartTime']?></li>
				<li class="table">
					<b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
				<li class="table">
					<b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
				<li class="table" style="font-weight: bold;">由于你上次讲座缺席，本次讲座不可预约</li>
			</ul>
		</div>
		
		<div class="Split_line" style="margin-top: 0;"></div>
		
		<?php 
// 		$status = $status-1;
// 		$sql3 = "UPDATE yq_info SET absent = '$status' WHERE stuno = '$stuno' ";
// 		mysql_query ( $sql3 ) or die ( "UPDATE数据库请求失败！" );
// 		break;
	}
	
	
	else if ($nowTime < $row ['chBookStartTime']) {
		// 预约时间还没到！
		
		?>
<div class='chair-wrapper'>
	<ul>
		<li class="table">
			<b class="title"> 讲座名称</b>
			<aside><?php echo  $row['chName']?></aside>
		</li>
		<li class="table">
			<b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>
		<li class="table">
			<b class="title"> 主 讲 人</b><?php echo  $row['chAnchor']?></li>
		
		<li class="table">
			<b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
		<li class="table">
			<b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
		<li class="table">
			<b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
		<li class="table">
			<b class="title">预约时间</b><?php echo  $row['chBookStartTime']?></li>
		<li class="table">
			<b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
		<li class="table">
			<b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
		<li class="table">预约时间还没到哦~</li>
	</ul>
</div>

<div class="Split_line"></div>

<?php
	} else if ($row ['chBookReady'] <= 0) {
		// 预约人数满
		?>

<div class='chair-wrapper'>
	<ul>
		<li class="table">
			<b class="title"> 讲座名称</b>
			<aside><?php echo  $row['chName']?></aside>
		</li>
		<li class="table">
			<b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>
		<li class="table">
			<b class="title"> 主 讲 人</b><?php echo  $row['chAnchor']?></li>
		
		<li class="table">
			<b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
		<li class="table">
			<b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
		<li class="table">
			<b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
		<li class="table">
			<b class="title">预约时间</b><?php echo  $row['chBookStartTime']?></li>
		<li class="table">
			<b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
		<li class="table">
			<b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
		<li class="table">预约人数已经满啦~请等待其他同学弃权</li>
	</ul>
</div>

<div class="Split_line"></div>

<?php
	} else {
		
		$flag = "select * from yq_bookChair where yqBookChair = '$id' and yqBookNum = '$stuno'";
		$flag_result = mysql_query ( $flag ) or die ( "数据库请求失败！" );
		if (mysql_num_rows ( $flag_result ) == 0) {
			// 可以预约讲座
			?>
<div class='chair-wrapper'>
	<ul>
		<li class="table">
			<b class="title"> 讲座名称</b>
			<aside><?php echo  $row['chName']?></aside>
		</li>
		<li class="table">
			<b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>
		<li class="table">
			<b class="title"> 主 讲 人</b><?php echo  $row['chAnchor']?></li>
		
		<li class="table">
			<b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
		<li class="table">
			<b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
		<li class="table">
			<b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
		<li class="table">
			<b class="title">预约时间</b><?php echo  $row['chBookStartTime']?></li>
		<li class="table">
			<b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
		<li class="table">
			<b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
	</ul>
	<input class='book-btn' type='button' id=<?php  $id_format = "sav".$row['id'];echo $id_format;?>
		value='预约此讲座' onclick='book(this.id)' />
</div>

<div class="Split_line"></div>

<?php
		} else {
			// 已经预约了该讲座
			?>

<div class='chair-wrapper'>
	<ul>
		<li class="table">
			<b class="title"> 讲座名称</b>
			<aside><?php echo  $row['chName']?></aside>
		</li>
		<li class="table">
			<b class="title"> 讲座日期</b><?php echo  $row['chData']?></li>
		<li class="table">
			<b class="title"> 主 讲 人</b><?php echo  $row['chAnchor']?></li>
		
		<li class="table">
			<b class="title"> 开展学期</b><?php echo  $row['chTerm']?></li>
		<li class="table">
			<b class="title"> 可预约数</b><?php echo  $row['chTotalNum']?></li>
		<li class="table">
			<b class="title"> 剩余票数</b><?php echo  $row['chBookReady']?></li>
		<li class="table">
			<b class="title">预约时间</b><?php echo  $row['chBookStartTime']?></li>
		<li class="table">
			<b class="title"> 讲座时间</b><?php echo  $row['chBookTime']?></li>
		<li class="table">
			<b class="title"> 讲座地点</b><?php echo  $row['chAddress']?></li>
	</ul>
	<input class='book-btn' type='button' id=<?php  $id_format = "del".$row['id'];echo $id_format;?>
		value='取消预约' onclick='book(this.id)' />
</div>

<div class="Split_line"></div>

<?php
		}
	}
}}
function timediff($begin_time, $end_time) {
	$timediff = $end_time - $begin_time;
	$days = intval ( $timediff / 86400 );
	$remain = $timediff % 86400;
	$hours = intval ( $remain / 3600 );
	$remain = $remain % 3600;
	$mins = intval ( $remain / 60 );
	$secs = $remain % 60;
	$res = array (
			"day" => $days,
			"hour" => $hours,
			"min" => $mins,
			"sec" => $secs 
	);
	return $hours;
}

?>
<script type="text/javascript">

$(function(){
	var clock2 = $("#clock2").clock({
		width: 150,
		height: 220,
		theme: 't2'
	});	
   });

//预约讲座按钮
function book(id) {
	var v = $('#'+id).val();
	var method = id.substr(0,3);
	if(method =="sav") {
		jQuery.ajax({
	        url: "book_success.php",  
	        type: "POST",
	        data:{myMethod:method,id:id},
	        dataType: "text",
	        error: function(){  
	            alert('Error loading XML document');  
	        },  
	        success: function(data,status){//如果调用php成功          
	//         	var str = data.toJSONString(); 
	//         	var obj = eval("("+data+")"); 
	//         	alert(data);
	//			var str = JSON.stringify(data);  $('#'+id).attr("disabled","true");
	// 			var str1 = JSON.parse(data); 
	//          x.innerHTML=data;  
	//          data  = data.trim();
	//          var content=$.trim(data)+"";
	//          var ok = $.trim("ok")+"";
	            if(data.indexOf("sav_ok")>0) {
	            	$('#'+id).val("取消预约");
	            	//改变元素的id值
	            	document.getElementById(id).setAttribute("id", id.replace(/sav/,"del"));
	            	prompt("恭喜你，预约成功~");
	            	
	            }else if (data.indexOf("del_ok")>0){
	            	$('#'+id).val("预约此讲座");
	            	document.getElementById(id).setAttribute("id", id.replace(/del/,"sav"));
	            	prompt("成功取消预约~");
	
	            }else if (data.indexOf("full")>0) {
	            	prompt("由于页面延时，您刚才看到的数据已过期！现讲座预约名额已满，谢谢您对研会工作的支持！");
	            }else if (data.indexOf("overflow")>0)  {
	            	prompt("本学期您已听满5场，不用再预约！！！");
	                }
	          
	        }
	    });
	}else {
		 $.alertable.confirm('确定要取消该讲座？'
		 ).then(function() {

			 jQuery.ajax({
			        url: "book_success.php",  
			        type: "POST",
			        data:{myMethod:method,id:id},
			        dataType: "text",
			        error: function(){  
			            alert('Error loading XML document');  
			        },  
			        success: function(data,status){//如果调用php成功         
			        	
						 if (data=="del_ok"){
			            	$('#'+id).val("预约此讲座");
			            	document.getElementById(id).setAttribute("id", id.replace(/del/,"sav"));
			            	prompt("成功取消预约~");
			
			       		 }
			       	}
			    });
		 }, function() {
			   console.log('Cancel');      
		 });

		}
	
}
</script>	