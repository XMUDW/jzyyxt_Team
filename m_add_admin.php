

<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="添加管理员">
			<form name="add_admin" id="add_admin" action="upload_success.php" method="post"
				enctype="multipart/form-data">
				<div class='add_admin-container'>
					<ul>
						<li class="table">
							<b class="title">管理员名称:</b>
							<span class="paper_wrapper">
								<input type="text" name="newadmin" id="newadmin" style="width: 65%;" />
							</span>
						</li>

						<li class="table">
							<b class="title">密　　码:</b>
							<span class="paper_wrapper">
								<input type="text" name="pwd" id="pwd" style="width: 65%;" />
							</span>
						</li>

						<li class="table">
							<b class="title">确认密码:</b>
							<span class="paper_wrapper">
								<input type="text" name="pwd_confirm" id="pwd_confirm" style="width: 65%;" />
							</span>
						</li>
					</ul>
					<input class='add_admin-btn' type="button" id="add_admin_confirm" value='确认提交' />
				</div>
			</form>
		</section>
		<section id="tab2" title="更改密码">
			<div class='add_admin-container'>
					<ul>
						<li class="table">
							<b class="title">重置密码:</b>
							<span class="paper_wrapper">
								<input type="text" name="modify_admin_pwd" id="modify_admin_pwd" style="width: 65%;" />
							</span>
						</li>

						<li class="table">
							<b class="title">确认密码:</b>
							<span class="paper_wrapper">
								<input type="text" name="confirm_admin_pwd" id="confirm_admin_pwd" style="width: 65%;" />
							</span>
						</li>
					</ul>
					<input class='add_admin-btn' type="button" id="modify_admin_confirm" value='确认修改' />
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

