<?php require_once 'CheckSession.php';
?>
<div class='manage_chair-container'>
	<table class="manage_chair_table">

		<tbody>
			<tr>
				<th width="20%;">学号</th>
				<th width="20%;">姓名</th>
				<th width="20%;">年级</th>
				<th width="30%;">学期</th>
				<th width="10%;">次数</th>
			</tr>
<?php

require_once 'openDB.php';

$pagesize=12; //设置每一页显示的记录数

if(isset($_GET['operation'])){
	$grade = $_GET['grade'];
	$term = $_GET['term'];
	$operation = $_GET['operation'];
	$times = $_GET['times'];
	
	if (isset($_GET['page'])){
		$page=intval($_GET['page']);
	}
	else{
		$page=1; //否则，设置为第一页
	}
	//计算记录偏移量
	$offset=$pagesize*($page - 1);
	//读取指定记录数
	
	switch ($operation) {
		case '大于':
			$oper = ">";
			$strBuilder = $oper.$times;
			break;
		case '小于':
			$oper = "<";
			$strBuilder = $oper.$times;
			break;
		case '等于':
			$oper = "=";
			$strBuilder = $oper.$times;
			break;
	}
	
	$numrows=200;
	
	$pages=intval($numrows/$pagesize);
	
	if(isset($_GET['term'])) {
		$strTerm = ($_GET['term']=='')?"":$_GET['term'];
		$term = ($_GET['term']=='')?"全部":$_GET['term'];
		if($_GET['term']=='') {
			$sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_clickcard,yq_info,yq_chair where yq_clickcard.yqNum=yq_info.stuno and yq_clickcard.yqChair=yq_chair.id  and grade='$grade' GROUP BY stuno  HAVING total $strBuilder limit $offset,$pagesize ";
	
		}else {
			$sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_clickcard,yq_info,yq_chair whereyq_clickcard.yqNum=yq_info.stuno and yq_clickcard.yqChair=yq_chair.id  and grade='$grade' and chTerm = '$strTerm' GROUP BY stuno  HAVING total $strBuilder limit $offset,$pagesize ";
	
		}
	
	} else {
		$term = "全部";
	
	}
	
// 		   $sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_clickcard,yq_info,yq_chair where yq_clickcard.yqChair=yq_info.stuno and yq_clickcard.yqBookChair=yq_chair.id and grade = '$grade' and chTerm = '$term'  GROUP BY stuno  HAVING total $strBuilder limit $offset,$pagesize";
	
	$rs =  mysql_query ( $sqlstr ) or die ( "sqlstrA数据库请求失败！" );
	

}else if(isset($_GET['grade'])){
	
	$grade = $_GET['grade'];
	$term = $_GET['term'];
	
	if (isset($_GET['page'])){
		$page=intval($_GET['page']);
	}
	else{
		$page=1; //否则，设置为第一页
	}
	
	//计算记录偏移量
	$offset=$pagesize*($page - 1);
	//读取指定记录数
	
	$numrows=200;
	
	$pages=intval($numrows/$pagesize);
	
	if(isset($_GET['term'])) {
		$strTerm = ($_GET['term']=='')?"":$_GET['term'];
		$term = ($_GET['term']=='')?"全部":$_GET['term'];
		if($_GET['term']=='') {
			$sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_clickcard,yq_info,yq_chair where yq_clickcard.yqNum=yq_info.stuno and yq_clickcard.yqChair=yq_chair.id  and grade='$grade' GROUP BY stuno  limit $offset,$pagesize ";
	
		}else {
			$sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_clickcard,yq_info,yq_chair whereyq_clickcard.yqNum=yq_info.stuno and yq_clickcard.yqChair=yq_chair.id  and grade='$grade' and chTerm = '$strTerm' GROUP BY stuno  limit $offset,$pagesize ";
	
		}
	
	} else {
		$term = "全部";
	}
	$rs =  mysql_query ( $sqlstr ) or die ( "sqlstrB数据库请求失败！" );
}else {
	$term = '全部';
	
	if (isset($_GET['page'])){
		$page=intval($_GET['page']);
	}
	else{
		$page=1; //否则，设置为第一页
	}
	
	//计算记录偏移量
	$offset=$pagesize*($page - 1);
	//读取指定记录数
	$sqlstr1="select stuno, stuname, grade, count(*) as total from yq_clickcard,yq_info where yq_clickcard.yqNum=yq_info.stuno  GROUP BY stuno";
	
	$rs1 =  mysql_query ( $sqlstr1 ) or die ( "sqlstrC数据库请求失败！" );
	
	$numrows=200;
	
	$pages=intval($numrows/$pagesize);
	
	$sqlstr="select stuno, stuname, grade, count(*) as total from yq_clickcard,yq_info where yq_clickcard.yqNum=yq_info.stuno  GROUP BY stuno limit $offset,$pagesize";
	
	$rs =  mysql_query ( $sqlstr ) or die ( "sqlstrC数据库请求失败！" );
}


while($myrow = mysql_fetch_array($rs)) {
?>		
				
					<tr>
				<td width="20%;"><?php echo $myrow['stuno'];?></td>
				<td width="20%;"><?php echo $myrow['stuname'];?></td>
				<td width="20%;" ><?php echo $myrow['grade'];?></td>
				<td width="30%;" ><?php echo $term;?></td>
				<td width="10%;" ><?php echo $myrow['total'];?></td>
			</tr>
<?php }?>
			<tr>

				<td width="100%;" colspan="5"><input class="Pagination small regular blue" id="query_prePage" value="上一页"
						type="button" /> <input class="Pagination small regular blue" id="query_nextPage" value="下一页"
						type="button" /></td>

			</tr>
		</tbody>
	</table>
	<input type="hidden" id="query_pageNum" value="<?php echo $page;?>" />
</div>
<script type="text/javascript">
$(function(){

	
    });

$("#query_nextPage").click(function(){
	 var num = parseInt($('#query_pageNum').val())+1;
	 if(num>=<?php echo $pages;?>) {
		 prompt("最后一页啦");
		 return;
	 }else {
		 
		 query_count(num);
	 }
});

$("#export-btn").click(function(){   
	var a = $('#grade').val();
	var b = $('#term').val();
	var c = $('#operation').val();
	var d = $('#times').val();
	
	var aa = encodeURIComponent(a);
	var bb = encodeURIComponent(b);
	var cc = encodeURIComponent(c);
	var dd = encodeURIComponent(d);

	if(a =="") {
		prompt("年级不能为空");
		return false;
	}
	else {
		window.open ("m_attendance_exportExcel.php?grade="+aa+'&term='+bb+'&operation='+cc+'&times='+dd,'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') ;
		}
});


$("#query_prePage").click(function(){   
	 var num = parseInt($('#query_pageNum').val())-1;
	 if(num=="0") {
		 prompt("前面啥也没有");
		 return;
	 }else {
// 		 $("#tab1").load("m_attendance_add.php?page="+num);
		 query_count(num);
	 }	
});

//查询
function operation_query() {
	var a = $('#grade').val();
	var b = $('#term').val();
	var c = $('#operation').val();
	var d = $('#times').val();

	if(a =="") {
		prompt("年级不能为空");
		return false;
	}

	else if (c=="") {
		var aa = encodeURIComponent(a);
		var bb = encodeURIComponent(b);
		$("#data_tab").load("m_attendance_query.php?grade="+aa+"&term="+bb);
	}
	else if (d=="") {
		prompt("次数不能为空");
		return false;
	}else {
	var aa = encodeURIComponent(a);
	var bb = encodeURIComponent(b);
	var cc = encodeURIComponent(c);
	var dd = encodeURIComponent(d);
	$("#data_tab").load("m_attendance_query.php?grade="+aa+"&term="+bb+"&operation="+cc+"&times="+dd);
	}
}


//
function query_count(page) {
	var a = $('#grade').val();
	var b = $('#term').val();
	var c = $('#operation').val();
	var d = $('#times').val();

	if (a=="") {
		var aa = encodeURIComponent(a);
		var bb = encodeURIComponent(b);
		$("#data_tab").load("m_attendance_query.php?page="+page);
	}
	else if (c=="") {
		var aa = encodeURIComponent(a);
		var bb = encodeURIComponent(b);
		$("#data_tab").load("m_attendance_query.php?grade="+aa+"&term="+bb+"&page="+page);
	}else {
		var aa = encodeURIComponent(a);
		var bb = encodeURIComponent(b);
		var cc = encodeURIComponent(c);
		var dd = encodeURIComponent(d);
		$("#data_tab").load("m_attendance_query.php?grade="+aa+"&term="+bb+"&operation="+cc+"&times="+dd+"&page="+page);
	}
}


</script>

