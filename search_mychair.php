<h class="headline">已约讲座 </h>
<?php
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

// $sqlstr1 = "select chData,chAnchor,chName,chTerm from yq_chair a,yq_clickcard b where a.id = b.yqChair and b.yqNum ='$stuno'";
// $result = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

?>

<div class='manage_chair-container'>

	<table class="manage_chair_table">

		<tbody>
			<tr>
				<th width="10%;">序号</th>
				<th width="20%;">讲座日期</th>
				<th width="45%;">讲座名称</th>
				<th width="25%;">开展学期</th>
			</tr>
<?php

$pagesize = 8; // 设置每一页显示的记录数

$sqlstr1 = "select chData,chName,chTerm from yq_chair a,yq_clickcard b where a.id = b.yqChair and b.yqNum ='$stuno'";

$rs1 = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

$numrows = mysql_num_rows ( $rs1 );

$pages = intval ( $numrows / $pagesize ) + 1;

if (isset ( $_GET ['page'] )) {
	$page = intval ( $_GET ['page'] );
} else {
	$page = 1; // 否则，设置为第一页
}

// 计算记录偏移量
$offset = $pagesize * ($page - 1);
// 读取指定记录数
$sqlstr = "select chData,chName,chTerm from yq_chair a,yq_clickcard b where a.id = b.yqChair and b.yqNum ='$stuno' limit $offset,$pagesize";

$rs = mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );

if (mysql_num_rows ( $rs ) == 0) {
	?>
			<tr>
				<td width="100%;" colspan="5">Nothing to show</td>
			</tr>
<?php
} else {
	$i = 1;
	while ( $myrow = mysql_fetch_array ( $rs ) ) {
		
		?>		
				
					<tr>
				<td width="10%;"><?php echo $i;$i++;?></td>
				<td width="20%;"><?php echo $myrow['chData'];?></td>
				<td width="45%;"><?php echo $myrow['chName'];?></td>
				<td width="25%;"><?php echo $myrow['chTerm'];?></td>
			</tr>
<?php
	}
}
?>
			<tr>

				<td width="30%;" style="font-weight: bold;" colspan="2"></td>
				<td width="45%;"><input class="Pagination small regular blue" id="prePage" value="上一页"
						type="button" /> <input class="Pagination small regular blue" id="nextPage" value="下一页"
						type="button" /></td>
				<td width="25%;"><?php echo "第".$page."页"?> &nbsp; &nbsp;<?php echo "共".$pages."页"?></td>

			</tr>
		</tbody>
	</table>
	<input type="hidden" id="pageNum" value="<?php echo $page;?>" />
</div>
<script type="text/javascript">
$(function(){

	 $("#nextPage").click(function(){   
		 var num = parseInt($('#pageNum').val())+1;
		 if(num><?php echo $pages;?>) {
			 prompt("最后一页啦");
				return;
				 }else {
		 $("#right-content").load("search_mychair.php?page="+num);
				 }
		 })
     $("#prePage").click(function(){   
		 var num = parseInt($('#pageNum').val())-1;
		 if(num=="0") {
			 prompt("前面啥也没有");
			return;
			 }else {
				 $("#right-content").load("search_mychair.php?page="+num);
 		    }	
    	 })
    });





</script>

