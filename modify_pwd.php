<h class="headline">修改密码 </h>
<div class="Split_line"></div>
<div class='add_admin-container' >
	<ul>
		<li class="table">
			<b class="title">重置密码:</b>
			<span class="paper_wrapper">
				<input type="password" name="modify_student_pwd" id="modify_student_pwd" style="width: 65%;" />
			</span>
		</li>

		<li class="table">
			<b class="title">确认密码:</b>
			<span class="paper_wrapper">
				<input type="password" name="confirm_student_pwd" id="confirm_student_pwd" style="width: 65%;" />
			</span>
		</li>
	</ul>
	<input class='add_admin-btn' type="button" id="modify_student_confirm" value='确认修改' />
</div>
<div class="Split_line"></div>


<script type="text/javascript">
	$('#modify_student_confirm').click(function() {
		
		var modify_student_pwd = $('#modify_student_pwd').val();
		var confirm_student_pwd = $('#confirm_student_pwd').val();
		
		if (modify_student_pwd=="") {
			prompt("密码不能为空");
			return false;
			}
		else if (modify_student_pwd<6) {
			prompt("密码强度太弱");
			return false;
			}
		else if (modify_student_pwd !=confirm_student_pwd) {
			prompt("密码不一致");
			return false;
			}
		else{
		 $.alertable.confirm('确定要修改么？').then(function() {

		var options = {
                url: 'modify_pwdSuccess.php',
                type: 'post',
                dataType: 'text',
                async:false,
                data:{modify_student_pwd:modify_student_pwd,confirm_student_pwd:confirm_student_pwd},
                success: function (data) {
                	prompt(data);
                	$('#modify_student_pwd').val("");
                	$('#confirm_student_pwd').val("");
                }
            };
            $.ajax(options);
           return false;
    	
		 }, function() {
			   console.log('Cancel');      
		 });}
});
</script>