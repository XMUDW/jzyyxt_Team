<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta  http-equiv="Content-Type" content="text/html"; charset="gb2312">
<meta name="viewpoint" content="width=device-width,initial-scale=1"/>
<script src="jsq/jquery-3.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jsq/jquery.blockUI.js"></script>

<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
<!--提示框  -->
<script type="text/javascript" src="jsq/jquery.alertable.js"></script>
<script type="text/javascript" src="jsq/velocity.min.js"></script>
<script type="text/javascript" src="jsq/velocity.ui.min.js"></script>
<link rel="stylesheet" href="css/jquery.alertable.css" type="text/css" media="screen">
</head>

<body >
<div class="index_container">

	<div class="up_background">
		<img src="images/logo.png"  class="logo" >
	</div>
	
	<div class="login-wrapper">
		<img src="images/login.jpg" class= "login_img"/>
		<form name="form_login" id="form_login" action="login.php" method="post">
			<input type="text" autocomplete="off" placeholder="账号" class="text-input" name="username" id="username" /><br>
		    <input type="password"  
		    placeholder="初始密码为123456" data-errortxt="请输入密码" class="text-input" name="password" id="password" /><br>
		  
			  用户类型:<select name="userType" id="userType" style="width: 50%;margin-left:%;">
					<option value="student">学生</option>
					
					<option value="manager">管理员</option>
					
			</select><br>
			<input class="login-btn" type="submit" id="login-btn" value="登录" />

		</form>
	</div>
	<div class="xmu_img" >
	<br>
		©2006-2017         厦门大学信息科学与技术学院 <br> 
		@copyright by 信息科学与技术学院网络部
	</div>
</div>

</body>

<script language="javascript">

$(document).ready(function() { 
    $('#login-btn').click(function() { 
    	var username = window.form_login.username.value;
    	var password = window.form_login.password.value;
    	if(username =="") {
    		prompt("账号不能为空");
    		return false;
    	}
    	else if (password=="") {
    		prompt("密码不能为空");
    		return false;
    	}
    	else {
    		var options = {
                    url: 'login.php',
                    type: 'post',
                    dataType: 'text',
                    async:false,
                    data: $("#form_login").serialize(),
                    success: function (data) {
                        if (data=="error"){
                        	prompt("账号或者密码错误");
                        }else if (data=="studentsuccess") {
							location.href = "main.php";
                        }else if (data=="managersuccess") {
							location.href = "m_main.php";
                        }else if (data=="null") {
                        	prompt("用户不存在");
                        }
                    }
                };
                $.ajax(options);
               return false;
        	}
    	
    }); 


}); 
     
function prompt(alertStr) {
	 $.alertable.alert(alertStr);
}


</script>
</html>