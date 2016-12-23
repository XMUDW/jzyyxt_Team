


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
						<aside>若某列内容未知则放空，但是该列一定要存在。另第一行不被操作</aside>
					</li>
				</ul>
				<input class='add_student-btn' type="button" id="upload_studentFile" value='确认上传' />
			</div>
		</section>
		<section id="tab2" title="单个导入数据">
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

		</section>

	</div>
</div>

<script type="text/javascript" src="jsq/jquery-tab.js"></script>
<script type="text/javascript" src="jsq/prefixfree.min.js"></script>
<script type="text/javascript">
		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();
		})
</script>