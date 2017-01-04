<?php require_once 'CheckSession.php';
?>
<br>
讲 座 名 单
<div class='manage_chair-container'>

	<table class="manage_chair_table" style="width: 80%;margin-left: 100px;">

		<tbody>
			<tr>
				<th width="10%;">序号</th>
				<th width="20%;">学号</th>
				<th width="15%;">姓名</th>
				<th width="10%;">年级</th>
			</tr>
<?php
session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

$pagesize = 12; // 设置每一页显示的记录数

$id = $_GET ['id'];

if (isset ( $_GET ['page'] )) {
	$page = intval ( $_GET ['page'] );
} else {
	$page = 1; // 否则，设置为第一页
}

$sqlstr1 = "select stuno,stuname,grade from yq_info,yq_bookchair where yq_info.stuno=yq_bookchair.yqBooKNum and yqBookChair='$id' ";

$rs1 = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

$numrows = mysql_num_rows ( $rs1 );

$pages = intval ( $numrows / $pagesize ) + 1; 
                                            
// 计算记录偏移量
$offset = $pagesize * ($page - 1);
// 读取指定记录数
$sqlstr = "select stuno,stuname,grade from yq_info,yq_bookchair where yq_info.stuno=yq_bookchair.yqBooKNum and yqBookChair='$id' limit $offset,$pagesize ";

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
				<td width="30%;"><?php echo $myrow['stuno'];?></td>
				<td width="15%;"><?php echo $myrow['stuname'];?></td>
				<td width="10%;"><?php echo $myrow['grade'];?></td>
			</tr>
<?php }}?>
			<tr>

				<td width="40%;" colspan="2"><input class="Pagination small regular blue" id="prePage" value="上一页"
						type="button" /> <input class="Pagination small regular blue" id="nextPage" value="下一页"
						type="button" /></td>
				<td width="15%;"><?php echo "第".$page."页"?>&nbsp; &nbsp;<?php echo "共".$pages."页"?></td>
				<td width="10%;">	<input class="Pagination small regular orange" type="button" id="ListExport-btn" value="导出Excel" onclick="exportExcel()" style="margin-left: 0;"></td>

			</tr>
		</tbody>
	</table>
	<input type="hidden" id="pageNum" value="<?php echo $page;?>" />

</div>
<script type="text/javascript">
$(function(){

	
    });

$("#nextPage").click(function(){   
	 var num = parseInt($('#pageNum').val())+1;
	 var id = <?php echo $id;?>;
	 if(num><?php echo $pages;?>) {
		 prompt("最后一页啦");
			return;
			 }else {
	 $("#right-content").load("m_chair_ExportList.php?page="+num+"&id="+id);
			 }
	 });
$("#prePage").click(function(){   
	 var num = parseInt($('#pageNum').val())-1;
	 var id = <?php echo $id;?>;
	 if(num=="0") {
		 prompt("前面啥也没有");
		return;
		 }else {
			 $("#right-content").load("m_chair_ExportList.php?page="+num+"&id="+id);
	    }	
	 });

//查看预约情况
function exportExcel() {
	var id = <?php echo $id;?>;
	var v = encodeURIComponent(id);
	window.open ("m_chair_Exportexcel.php?id="+v,'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no') ;
// 	$("#right-content").load("m_chair_Exportexcel.php?id="+v);
	
}

</script>

