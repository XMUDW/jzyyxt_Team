<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta  http-equiv="Content-Type" content="text/html"; charset="gb2312">
<script src="jsq/jquery-3.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jsq/jquery.blockUI.js"></script>

<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">

</head>

<body >
<div class="index_container">

	<div class="up_background">
		<img src="images/logo.png"  class="logo" ></div>
	
	<div class="login-wrapper">
		<img src="images/login.jpg" class= "login_img"/>
		<form name="form_login" id="form_login" action="login.php" method="post">
			<input type="text" autocomplete="off" placeholder="账号" class="text-input" name="username" id="username" /><br>
		    <input type="password"  
		    placeholder="密码                初始密码为123456" data-errortxt="请输入密码" class="text-input" name="password" id="password" /><br>
		  
			  用户类型:<select name="userType" id="userType" style="width: 50%;margin-left:%;">
					<option value="student">学生</option>
					
					<option value="manager">管理员</option>
					
			</select><br>
			<input class="login-btn" type="submit" id="login-btn" value="登录" />

		</form>
	</div>
	<img src="images/xmu.png" class= "xmu_img"/>
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
                        if (data.indexOf("error") > 0){
                        	prompt("账号或者密码错误");
                        }else if (data.indexOf("studentsuccess")>0) {
							location.href = "main.php";
                        }else if (data.indexOf("managersuccess")>0) {
							location.href = "m_main.php";
                        }else if (data.indexOf("null")>0) {
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
	 $.blockUI({ 
           message: '<h1 style ="font-size:18;">'+alertStr+'</h1>', 
           fadeIn: 700, 
           fadeOut: 700, 
           timeout: 2000, 
           showOverlay: false, 
           centerY: false, 
           css: { 
               width: '250px', 
               hight: '350px',
               top: '41%', 
               left: '41%',
               border: 'none', 
               padding: '5px', 
               backgroundColor: '#000', 
               '-webkit-border-radius': '10px', 
               '-moz-border-radius': '10px', 
               opacity: .6, 
               color: '#fff' 
           } 
       }); 
}


</script>
</html>