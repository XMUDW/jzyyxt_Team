<h class="headline"> 我的论文集</h>
<?php
require_once 'CheckSession.php';
session_start ();
$stuno = $_SESSION ['stuno'];
require_once 'openDB.php';

$sqlstr = "select * from paper_list where p_stuno =  '$stuno'  order by p_id desc";
$result = mysql_query ( $sqlstr ) or die ( "数据库请求失败！" );

if(mysql_num_rows($result)==0) {
	?>
	<div class="myPaper-wrapper">
		<ul >
			<li class="table">
				目前还没收录你的论文，请继续努力！
			</li>
		
		</ul>
		<div class="Split_line"></div>
	</div>
<?php 
}else {
while ( $row = mysql_fetch_array ( $result ) ) {
// 	var_dump($rows);
		
?>

<div class="myPaper-wrapper">
	<ul >
		<li class="table">
			<span class="title">论文题目</span><aside><?php echo  $row['p_title']?></aside>
		</li>
		<li class="table">
			<span class="title">论文类型</span><?php echo  $row['p_type']?>
		</li>
		<li class="table">
			<span class="title">指导老师</span><?php echo  $row['p_teacher']?>
		</li>
		<li class="table">
			<span class="title">收录期刊</span><?php echo  $row['p_place']?>
		</li>
		<li class="table">
			<span class="title">实验室</span><?php echo  $row['p_lab']?>
		</li>
		<li class="table">
			<span class="title">审核状态</span><?php echo  $row['p_verify']?>
		</li>
	
	</ul>
	<div class="Split_line"></div>
</div>

<?php 
}}
?>