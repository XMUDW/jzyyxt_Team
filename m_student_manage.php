<?php require_once 'CheckSession.php';?>
<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="批量导入数据">
			<div class='add_student-container'>
				<ul>
					<li class="table">
						<b class="title">上传文件:</b>
						<span class="paper_wrapper">
							<input id="excelUpload" type="file" size="20" name="excelUpload" class="input">
						</span>
					</li>
					<li class="table">
						<b class="title">note:</b>
						<aside>添加的xls文档格式如下：第一列为学号，第二列为姓名，第三列为性别，第四列为年级，第五列为专业。</aside>
					</li>
					<li class="table">
						<b class="title">PS:</b>
						<aside>若某列内容未知则放空，但是该列一定要存在。<br>另:第一行不被操作</aside>
					</li>
				</ul>
				<input class='add_student-btn' type="button" id="upload_studentFile" value='确认上传' />
			</div>
		</section>
		<section id="tab2" title="单个导入数据">
			<form name="add_stuSingleData" id="add_stuSingleData" action="" method="post">
			<div class='add_student-container'>
				<ul>
					<li class="table">
						<b class="title">姓名:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentName" id="newstudentName" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">学号:</b>
						<span class="paper_wrapper">
							<input type="text" name="newStuno" id="newStuno" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">性别:</b>
						<span class="paper_wrapper">
							<input type="text" name="newStusex" id="newStusex" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">专业:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentMajor" id="newstudentMajor" style="width: 65%;" />
						</span>
					</li>
					<li class="table">
						<b class="title">年级:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentGrade" id="newstudentGrade" style="width: 65%;" />
						</span>
					</li>
				</ul>
				<input class='add_student-btn' type="button" id="upload_student" value='确认上传' />
			</div>
			</form>
		</section>

	</div>
</div>

<script type="text/javascript" src="jsq/jquery-tab.js"></script>
<script type="text/javascript" src="jsq/prefixfree.min.js"></script>
<script type="text/javascript">
		$(document).ready(function() { 
			// Calling the plugin
			$('.tab-group').tabify();
		});
		//click方法不能写在ready()里面，否则success方法被执行了很多次
		 $("#upload_studentFile").click(function(){     
		        //上传文件
		     var options = {
		          url:'m_student_uploadExcel.php',//处理图片脚本
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

		 $('#upload_student').click(function() {
				
				var newstudentName = $('#newstudentName').val();
				var newStuno = $('#newStuno').val();
				var newStusex = $('#newStusex').val();
				var newstudentMajor = $('#newstudentMajor').val();
				var newstudentGrade = $('#newstudentGrade').val();
				
			    if (newstudentName=="") {
					prompt("姓名不能为空");
					return false;
					}
			    else if (newStuno=="") {
					prompt("学号不能为空");
					return false;
					}
				else if (newStusex=="") {
					prompt("学号不能为空");
					return false;
					}
				else if (newstudentMajor=="") {
					prompt("专业不能为空");
					return false;
					}
				else if (newstudentGrade=="") {
					prompt("年级不能为空");
					return false;
					}
				else{
					var options = {
			                url: 'm_student_add.php',
			                type: 'post',
			                dataType: 'text',
			                async:false,
			                data:$("#add_stuSingleData").serialize(),
			                success: function (data) {
			                	prompt(data);
			                	$('#add_stuSingleData')[0].reset();
			                }
			            };
			            $.ajax(options);
			           return false;
			    	}
			});
		
</script>