<?php
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

$sqlstr1 = "select * from yq_chair order by id desc";
$result = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

?>


<br>
讲座名称:&nbsp; &nbsp;
<select name="chairName" id="search_content" style="width: 40%;">

	<option value=""></option>
<?php
while ( $rows = mysql_fetch_array ( $result ) ) {
	?>

<option value="<?php echo $rows['chName'];?>"><?php echo $rows['chName'];?></option>

<?php
}

?>
</select>
<input class="Pagination smaller regular orange" type="button" id="searchChair-btn" value="查询"
	onclick="query_chName()">

<div class='manage_chair-container'>

	<table class="manage_chair_table">

		<tbody>
			<tr>
				<th width="10%;">序号</th>
				<th width="20%;">讲座日期</th>
				<th width="50%;">讲座名称</th>
				<th colspan="2" style="width: 20%; text-align: center;">操作</th>
			</tr>
<?php

$pagesize = 8; // 设置每一页显示的记录数

if (isset ( $_GET ['chName'] )) {
	$chName = $_GET ['chName'];
	// iconv ( "UTF-8", "gb2312", $_FILES ["fileToUpload"] ['name'] );
	// $chName = iconv ( "gb2312", "UTF-8", $_GET['chName'] );
	$numrows = 10;
	
	$pages = intval ( $numrows / $pagesize ); // ====1
	
	if (isset ( $_GET ['page'] )) {
		$page = intval ( $_GET ['page'] );
	} else {
		$page = 1; // 否则，设置为第一页
	}
	
	// 计算记录偏移量
	$offset = $pagesize * ($page - 1);
	// 读取指定记录数
	$sqlstr = "select * from yq_chair where chName ='$chName'";
	
	$rs = mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" . $chName );
} else {
	
	$sqlstr1 = "select * from yq_chair order by id desc";
	
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
	$sqlstr = "select * from yq_chair order by id desc limit $offset,$pagesize";
	
	$rs = mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );
}
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
				<td width="50%;"><?php echo $myrow['chName'];?></td>
				<td width="10%;"><input class="Pagination small regular orange" id=<?php echo 'd'.$myrow['id']?>
						value="删除" type="button" onclick='delete_chair(this.id)' /></td>
				<td width="10%;"><input class="Pagination small regular blue" id=<?php echo 'm'.$myrow['id']?>
						value="修改 " type="button" onclick='modify(this.id)' /></td>
			</tr>
<?php
	
}
}
?>
			<tr>

				<td width="30%;" style="font-weight: bold;" colspan="2"></td>
				<td width="50%;"><input class="Pagination small regular blue" id="prePage" value="上一页"
						type="button" /> <input class="Pagination small regular blue" id="nextPage" value="下一页"
						type="button" /></td>
				<td width="10%;"><?php echo "第".$page."页"?></td>
				<td width="10%;"><?php echo "共".$pages."页"?></td>

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
		 $("#tab2").load("m_chair_Pagination.php?page="+num);
				 }
		 })
     $("#prePage").click(function(){   
		 var num = parseInt($('#pageNum').val())-1;
		 if(num=="0") {
			 prompt("前面啥也没有");
			return;
			 }else {
				 $("#tab2").load("m_chair_Pagination.php?page="+num);
 		    }	
    	 })
    });
function checkAll(obj) {
	var a = document.getElementsByTagName("input");
	if(obj.checked){
		for(var i = 0;i<a.length;i++){
			if(a[i].type == "checkbox") 
    			{a[i].checked = true;}
		}
	}
	else{
		for(var i = 0;i<a.length;i++){
			if(a[i].type == "checkbox") a[i].checked = false;
		}
	}
}

//查询
function query_chName() {
	var v = $('#search_content').val();
	var name = encodeURIComponent(v);
	$("#tab2").load("m_chair_Pagination.php?page=1&chName="+name);
	
}


//删除
function delete_chair(id) {
	 $.alertable.confirm('确定要删除么？该操作不可返回').then(function() {
	var v = $('#'+id).val();
	var method = id.substr(0,1);
	var num = parseInt($('#pageNum').val());
	
	jQuery.ajax({
        url: "m_chair_delete.php",  
        type: "POST",
        data:{myMethod:method,id:id},
        dataType: "text",
        error: function(){  
            alert('Error loading XML document');  
        },  
        success: function(data,status){//如果调用php成功          
        	prompt(data);
        	setTimeout(function () { 
        		$("#tab2").load("m_chair_Pagination.php?page="+num);
            }, 2000);
        }
    });
	 }, function() {
		   console.log('Cancel');      
	 });
}


//修改
function modify(id) {
	var v = encodeURIComponent(id);
	$("#tab2").load("m_chair_modify.php?id="+v);
}



</script>

