<h class="headline">论文搜索 </h>
<div class="Split_line"></div>
<?php
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

// $sqlstr1 = "select chData,chAnchor,chName,chTerm from yq_chair a,yq_clickcard b where a.id = b.yqChair and b.yqNum ='$stuno'";
// $result = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！" );

?>
<br>
<div class="query_form">
	搜索内容:&nbsp; &nbsp;
	<input type="text" id="search_content" name="search_content" >
	&nbsp; &nbsp;
	<br id ="hidden">
	搜索类型:&nbsp; &nbsp;
	<select name="chairName" id="search_type" >
		<option value="">请选择</option>
<!-- 	<option value="grade">年级</option>
		<option value="p_teacher">指导老师</option> -->	
		<option value="p_writer">作者</option>
		<option value="p_title">标题</option>
		<option value="p_keyword">关键字</option>
		<option value="p_lab">实验室</option>
		
	</select>
	&nbsp; &nbsp;
	<input class="Pagination small regular orange" type="button" id="searchPaper-btn" value="查询"
		onclick="query_paper()">
</div>
<div id="pagination"></div>
<script type="text/javascript">
$(function(){
	 $("#pagination").load("search_paper_pagination.php");
    });

//查询
function query_paper() {
	var a = $('#search_type').val();
	var b = $('#search_content').val();

	if(a =="") {
		prompt("请选择搜索类型");
		return false;
	}

	else if(b =="") {
		prompt("请输入搜索内容");
		return false;
	}else {
		var aa = encodeURIComponent(a);
		var bb = encodeURIComponent(b);
		$("#pagination").load("search_paper_pagination.php?search_type="+aa+"&search_content="+bb);
	}
}
</script>

