<?php
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

// p_id
// p_stuno
// p_title
// p_writer
// p_type
// p_place
// p_keyword
// p_name
// p_summary
// p_teacher
// p_lab
// p_writetime
// p_uptime
// p_modifytime
// p_verify
// p_writertype
// p_first_addr
// p_indexed
// p_instructor

// $sqlstr1 = "select chData,chAnchor,chName,chTerm from yq_chair a,yq_clickcard b where a.id = b.yqChair and b.yqNum ='$stuno'";
// $result = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

?>
<div class='manage_chair-container'>

	<table class="manage_chair_table">

		<tbody>
			<tr>
				<th width="20%;">发表日期</th>
				<th width="45%;">论文标题</th>
				<th width="25%;">作者</th>
				<th width="10%;">实验室</th>
			</tr>
<?php
if (! isset ( $_GET ["search_type"] )) {
	$pagesize = 8; // 设置每一页显示的记录数
	
	$sqlstr1 = "select p_uptime,p_title,p_writer,p_lab from paper_list a";
	
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
	$sqlstr = "select p_uptime,p_title,p_writer,p_lab from paper_list a limit $offset,$pagesize";
	
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

				<td width="20%;"><?php echo explode(" ",$myrow['p_uptime'])[0];?></td>
				<td width="45%;"><?php echo $myrow['p_title'];?></td>
				<td width="25%;"><?php echo $myrow['p_writer'];?></td>
				<td width="10%;"><?php echo $myrow['p_lab'];?></td>
			</tr>
<?php
		}
	}
} else {
	
// 	<option value="grade">年级</option>
// 	<option value="p_writer">作者</option>
// 	<option value="p_title">标题</option>
// 	<option value="p_keyword">关键字</option>
// 	<option value="p_lab">实验室</option>
// 	<option value="p_teacher">指导老师</option > 

	$pagesize = 8; // 设置每一页显示的记录数
	
	$search_type = $_GET ['search_type'];
	$search_content = $_GET ['search_content'];
	
	switch ($search_type) {
		case 'grade' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a where a.p_stuno like '%$search_content%'";
			break;
		case 'p_writer' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a where a.p_writer like '%$search_content%'";
			break;
		case 'p_title' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a  where a.p_title ='$search_content'";
			break;
		case 'p_keyword' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a where a.p_title like '%$search_content%'";
			break;
		case 'p_lab' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a where a.p_lab ='$search_content'";
			break;
		case 'p_teacher' :
			$sqlstr2 = "select p_uptime,p_title,p_writer,p_lab from paper_list a where a.p_teacher ='$search_content'";
			break;
		default :
			break;
	}
	
	$rs2 = mysql_query ( $sqlstr2 ) or die ( "sqlstr1数据库请求失败！" );
	
	$numrows = mysql_num_rows ( $rs2);
	
	$pages = intval ( $numrows / $pagesize ) + 1;
	
	if (isset ( $_GET ['page'] )) {
		$page = intval ( $_GET ['page'] );
	} else {
		$page = 1; // 否则，设置为第一页
	}
	
	// 计算记录偏移量
	$offset = $pagesize * ($page - 1);
	// 读取指定记录数
	$sqlstr3 = $sqlstr2."limit $offset,$pagesize";
	
	$rs3 = mysql_query ( $sqlstr3 ) or die ( "sqlstr数据库请求失败！" );
	
	if (mysql_num_rows ( $rs3 ) == 0) {
		?>
				<tr>
					<td width="100%;" colspan="5">Nothing to show</td>
				</tr>
	<?php
		} else {
			$i = 1;
			while ( $myrow = mysql_fetch_array ( $rs3 ) ) {
				
				?>		
				<tr>
	
					<td width="20%;"><?php echo explode(" ",$myrow['p_uptime'])[0];?></td>
					<td width="45%;"><?php echo $myrow['p_title'];?></td>
					<td width="25%;"><?php echo $myrow['p_writer'];?></td>
					<td width="10%;"><?php echo $myrow['p_lab'];?></td>
				</tr>
	<?php
			}
		}
//====================	
}
?>
			<tr>

				<td width="20%;" style="font-weight: bold;"></td>
				<td width="45%;"><input class="Pagination small regular blue" id="prePage" value="上一页"
						type="button" /> <input class="Pagination small regular blue" id="nextPage" value="下一页"
						type="button" /></td>
				<td width="35%;" colspan="2"><?php echo "第".$page."页"?> &nbsp; &nbsp;<?php echo "共".$pages."页"?></td>

			</tr>
		</tbody>
	</table>
	<input type="hidden" id="pageNum" value="<?php echo $page;?>" />
</div>
<script type="text/javascript">
$(function(){

	 $("#nextPage").click(function(){   
		 var num = parseInt($('#pageNum').val())+1;
		 var a = $('#search_type').val();
		 var b = $('#search_content').val();
		 var aa = encodeURIComponent(a);
		 var bb = encodeURIComponent(b);
		 if(num><?php echo $pages;?>) {
			 prompt("最后一页啦");
				return;
				 }else if(a==''){
		 			 $("#pagination").load("search_paper_pagination.php?page="+num);
				 }else {
					 $("#pagination").load("search_paper_pagination.php?page="+num+"&search_type="+aa+"&search_content="+bb);
					 }
		 })
     $("#prePage").click(function(){   
		 var num = parseInt($('#pageNum').val())-1;
		 var a = $('#search_type').val();
		 var b = $('#search_content').val();
		 var aa = encodeURIComponent(a);
		 var bb = encodeURIComponent(b);
		 if(num=="0") {
			 prompt("前面啥也没有");
			return;
			 }else if(a==''){
	 			 $("#pagination").load("search_paper_pagination.php?page="+num);
			 }else {
				 $("#pagination").load("search_paper_pagination.php?page="+num+"&search_type="+aa+"&search_content="+bb);
 		    }	
    	 })
    });
</script>

