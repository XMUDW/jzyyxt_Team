<?php
require_once 'CheckSession.php';
?>
<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="添加管理员">
			<div class='add_admin-container'>
				<ul>
					<li class="table">
						<b class="title">管理员名称:</b>
						<span class="paper_wrapper">
							<input type="text" name="newadmin" id="newadmin" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">密 码:</b>
						<span class="paper_wrapper">
							<input type="password" name="pwd" id="pwd" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">确认密码:</b>
						<span class="paper_wrapper">
							<input type="password" name="pwd_confirm" id="pwd_confirm" style="width: 65%;" />
						</span>
					</li>
				</ul>
				<input class='add_admin-btn' type="button" id="add_admin_confirm" value='确认提交' />
			</div>
		</section>
		<section id="tab2" title="更改密码">
			<div class='add_admin-container'>
				<ul>
					<li class="table">
						<b class="title">重置密码:</b>
						<span class="paper_wrapper">
							<input type="password" name="modify_admin_pwd" id="modify_admin_pwd" style="width: 65%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">确认密码:</b>
						<span class="paper_wrapper">
							<input type="password" name="confirm_admin_pwd" id="confirm_admin_pwd" style="width: 65%;" />
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
$(document).ready(function() {
			// Calling the plugin
			$('.tab-group').tabify();

		});
		
$('#add_admin_confirm').click(function() {
	
	var newadmin = $('#newadmin').val();
	var pwd = $('#pwd').val();
	var pwd_confirm = $('#pwd_confirm').val();
	
	if(newadmin=="") {
		prompt("管理员名称不能为空");
		return false;
		}
	else if (pwd=="") {
		prompt("密码不能为空");
		return false;
		}
	else if (pwd.length<6) {
		prompt("密码强度太弱");
		return false;
		}
	else if (pwd_confirm !=pwd) {
		prompt("密码不一致");
		return false;
		}
	else{
		var options = {
                url: 'm_admin_control.php',
                type: 'post',
                dataType: 'text',
                async:false,
                data:{newadmin:newadmin,pwd:pwd},
                success: function (data) {
                	prompt(data);
                	$('#newadmin').val('');
    				$('#pwd').val('');
    				$('#pwd_confirm').val('');
                }
            };
            $.ajax(options);
           return false;
    	}
});


	$('#modify_admin_confirm').click(function() {
		
		var modify_admin_pwd = $('#modify_admin_pwd').val();
		var confirm_admin_pwd = $('#confirm_admin_pwd').val();
		
		if (modify_admin_pwd=="") {
			prompt("密码不能为空");
			return false;
			}
		else if (modify_admin_pwd<6) {
			prompt("密码强度太弱");
			return false;
			}
		else if (modify_admin_pwd !=confirm_admin_pwd) {
			prompt("密码不一致");
			return false;
			}
		else{
		 $.alertable.confirm('确定要修改么？',{
		 		show: function() {
				        $(this.overlay).velocity('transition.fadeIn');        
				        $(this.modal).velocity('transition.flipBounceYIn');
				      },
				      hide: function() {
				        $(this.overlay).velocity('transition.fadeOut');
				        $(this.modal).velocity('transition.perspectiveUpOut');
				      } 	
		 }
		 ).then(function() {

		var options = {
                url: 'm_admin_control.php',
                type: 'post',
                dataType: 'text',
                async:false,
                data:{modify_admin_pwd:modify_admin_pwd,confirm_admin_pwd:confirm_admin_pwd},
                success: function (data) {
                	prompt(data);
                	$('#modify_admin_pwd').val("");
                	$('#confirm_admin_pwd').val("");
                }
            };
            $.ajax(options);
           return false;
    	
		 }, function() {
			   console.log('Cancel');      
		 });}
});
</script>

