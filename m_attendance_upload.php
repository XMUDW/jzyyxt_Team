<?php 
require_once 'CheckSession.php';

$id = $_GET['id'];
require_once 'openDB.php';

$sqlstr= "select * from yq_chair where id ='$id'";

$rs =  mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );

$row = mysql_fetch_array($rs);

?>


<div class='add_student-container'>
	<ul>
		<li class="table">
			<b class="title">讲座日期:</b>
						<aside><?php echo $row['chData'];?></aside>
		</li>
		<li class="table">
			<b class="title">讲座名称:</b>
						<aside style="margin-left: 32px;"><?php echo $row['chName'];?></aside>
		</li>
		<li class="table">
			<b class="title">上传文件:</b>
			<span class="paper_wrapper">
				<input id="excelUpload" type="file" size="20" name="excelUpload" class="input">
			</span>
		</li>
		<li class="table">
			<b class="title">note:</b>
			<aside style="margin-left: 32px;">导入的文件包含两列，第一列为有签到的学生的学号，第二列为是否缺席，到场为0，缺席为1</aside>
		</li>
		
	</ul>
	<input class='add_student-btn' type="button" id="upload_attendanceFile" value='确认导入' style="margin-top: 50px;"/>
</div>


<script type="text/javascript">
		//click方法不能写在ready()里面，否则success方法被执行了很多次
		 $("#upload_attendanceFile").click(function(){    
			 var id = <?php echo $id?>; 
		        //上传文件
		     var options = {
		          url:'m_attendance_uploadExcel.php?id='+id,//处理图片脚本
		          secureuri :false,
		          fileElementId :'excelUpload',//file控件id
		          dataType : 'text',
		          success : function (data){
	                	  prompt(data);
		              }
		          };
		       $.ajaxFileUpload(options);
			  return false;
		    });

		
</script>