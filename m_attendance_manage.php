

<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="添加考勤信息">
	
		</section>
		


		<section id='tab2' title="查询考勤信息">
		
<?php 
require_once 'CheckSession.php';
session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';

$sqlstr1 = "select DISTINCT chTerm from yq_chair";
$result1 = mysql_query ( $sqlstr1 ) or die ( "sqlstr1数据库请求失败！");
?>


<br>
年级:&nbsp;
<select name="grade" id="grade">
	<option value="">请选择</option>
<?php 
$year = date("Y");
for($i=0;$i<=6;$i++){
?>
	<option value="<?php echo $year-$i;?>"><?php echo $year-$i;?></option>

<?php 
}

?>

</select> &nbsp;
学期:&nbsp;
<select name="term" id="term">
		<option value="">全部</option>
<?php 
while ($row1=mysql_fetch_array($result1)){
?>
	<option value="<?php echo $row1['chTerm'];?>"><?php echo $row1['chTerm'];?></option>

<?php 
}

?>

</select> &nbsp;
条件:&nbsp;
<select name="operation" id="operation">
	<option value=""></option>
	<option value="大于">大于</option>
	<option value="小于">小于</option>
	<option value="等于">等于</option>

</select> &nbsp;
次数:&nbsp;
<select name="times" id="times">
	<option value=""></option>
<?php 
for ($i = 0;$i<=20;$i++) {
?>
	<option value="<?php echo $i;?>"><?php echo $i;?></option>

<?php 
}

?>

</select> &nbsp;
<input class="Pagination smaller regular orange" type="button" id="searchAttendance-btn" value="查询" onclick="operation_query()">
<input class="Pagination smaller regular orange" type="button" id="export-btn" value="导出">
		
		<div  id="data_tab"></div>
		
		</section>

	</div>
</div>

<script type="text/javascript" src="jsq/jquery-tab.js"></script>
<script type="text/javascript" src="jsq/prefixfree.min.js"></script>
<script type="text/javascript">

		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();
			$("#tab1").load("m_attendance_add.php");
			$("#data_tab").load("m_attendance_query.php");
		    });
	 

	  
</script>