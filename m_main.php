<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta http-equiv="Content-Type" content="text/html" ; charset="utf-8">
<script src="jsq/jquery-3.1.1.min.js" type="text/javascript"></script>

<!-- <script type="text/javascript" src="jsq/jquery.blockUI.js"></script> -->

<script type="text/javascript" src="jsq/clock-1.1.0.min.js"></script>
<script type="text/javascript" src="jsq/ajaxfileupload.js"></script>
<script type="text/javascript" src="jsq/Filescript.js"></script>
<script type="text/javascript" src="jsq/echarts.min.js"></script>

<!--提示框  -->
<script type="text/javascript" src="jsq/jquery.alertable.js"></script>
<script type="text/javascript" src="jsq/velocity.min.js"></script>
<script type="text/javascript" src="jsq/velocity.ui.min.js"></script>

<script type="text/javascript" src="jsq/pagination.js"></script>
<link href="css/pagination.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery.alertable.css" type="text/css" media="screen">
</head>
<?php 
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];
require_once 'openDB.php';
?>

<body>
	<div class="jzyyxt-toolbar jzyyxt-toolbar-skin-blue">
		<div class="container">
			<div class="pull-left">讲座预约系统</div>
			<div class="pull-right">
			<?php $sqlstr = "select * from yq_adminuser where yq_username ='$stuno'";  
				  $result = mysql_query ( $sqlstr ) or die ( "数据库请求失败！" ); 
				  $rows = mysql_fetch_array ( $result );
				  $stuname = $rows ['yq_username'];
				  
				  $h=date('G');
				  $msg = '';
				  if ($h<11) $msg ='早上好';
				  else if ($h<13) $msg ='中午好';
				  else if ($h<17) $msg ='下午好';
				  else $msg ='晚上好';
				  
				  echo $msg.', '.$stuname;?>管理员</div>
		</div>
	</div>


	<div class="main-content clearfix">
		<div class="content_l fl">
			<div class="categ">
				<div class="mod_title">
					<div class="border_b"></div>
					<h4 class="mod_title_t">
						<label style="font-weight: bold;">信息管理系统</label>
					</h4>
				</div>
				<div class="blog_category">
					<ul class="category_list">
						<li>
							<a href="#0" data-type="modal-trigger" id="add_admin">管理管理员</a><a href="#1" data-type="modal-trigger" id="add_student">管理学生信息</a>
						</li>
						<li>
							<a href="#0" data-type="modal-trigger" id="manage_paper">论文管理</a><a href="#1" data-type="modal-trigger" id="search_info">网站流量</a>
						</li>
						
					</ul>
				</div>

				<div class="mod_title">
					<div class="border_b"></div>
					<h4 class="mod_title_t">
						<label style="font-weight: bold;">讲座管理系统</label>
					</h4>
				</div>
				
				<div class="blog_category">
					<ul class="category_list">
						<li>
							<a href="#0" data-type="modal-trigger" id="manage_chair">管理讲座信息</a><a href="#1" data-type="modal-trigger" id="manage_attendance">管理考勤信息</a>
						</li>
						<li>
							<a href="#1" data-type="modal-trigger" id="book_info">讲座预约情况</a><a href="#0" data-type="modal-trigger" id="exit">退出管理系統</a>
						</li>
						

					</ul>
				</div>
				
				
				
			</div>
		</div>


		<div class="content_r fr">
		<img  src="images/xmu3.jpg" class="imglogo"/>
			<div id="right-content" class="main-home">
 				
			</div>
		</div>
	</div>
</body>
 
<script type="text/javascript">


$(document).ready(function() {
	$("#right-content").load("index.html");
});

function prompt(alertStr) {
	$.alertable.alert(alertStr);
}


$(function(){
	$("#add_admin").click(function(){
		$("#right-content").load("m_admin_manage.php");
	});
	$("#add_student").click(function(){
		$("#right-content").load("m_student_manage.php");
	});
	$("#manage_chair").click(function(){
		$("#right-content").load("m_chair_manage.php");
	});
	$("#manage_attendance").click(function(){
		$("#right-content").load("m_attendance_manage.php");
	});
	$("#book_info").click(function(){
		$("#right-content").load("m_chair_bookList.php");
	});
	$("#search_info").click(function(){
		$("#right-content").load("m_echart_info.php");
	});
	$("#exit").click(function(){
		$("#right-content").load("logout.php");
	});
});





</script>

</html>