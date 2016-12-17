<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta  http-equiv="Content-Type" content="text/html"; charset="gb2312">
<script src="jsq/jquery-3.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jsq/jquery.blockUI.js"></script>
<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">

</head>

<body>
<div class="index_container">

	<div class="up_background">
		<img src="images/logo.png"  class="logo"></div>
	</div>
	<div class="login-wrapper">
		<img src="images/login.jpg" class= "login_img"/>
		<form name="form_login" id="form_login" action="login.php" method="post">
			<input type="text" value="账号"
				onfocus="if(this.value=='账号') {this.value=''}"
				onblur="if(this.value=='') this.value='账号'" placeholder="账号"
				data-errortxt="请输入帐号" class="text-input" name="username"
				id="username" /> 
		    <input type="text" value="密码"
				onfocus="if(this.value=='密码') {this.value=''}"
				onblur="if(this.value=='') this.value='密码'" placeholder="密码"
				data-errortxt="请输入密码" class="text-input" name="password"
				id="password" />
				
		    <input class="login-btn" type="submit" id="login-btn" value="登录" />

		</form>
	</div>
</div>
</body>

<script language="javascript">

$(document).ready(function() { 
    $('#login-btn').click(function() { 
    	var username = window.form_login.username.value;
    	var password = window.form_login.password.value;
    	if(username =="账号") {
    		   $.blockUI({ 
    	            message: '<h1 style ="font-size:18;">账号不能为空</h1>', 
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
    	                right: '10px', 
    	                border: 'none', 
    	                padding: '5px', 
    	                backgroundColor: '#000', 
    	                '-webkit-border-radius': '10px', 
    	                '-moz-border-radius': '10px', 
    	                opacity: .6, 
    	                color: '#fff' 
    	            } 
    	        }); 
    		return false;
    	}
    	else if (password=="密码") {
    		 $.blockUI({ 
 	            message: '<h1 style ="font-size:18;">密码不能为空</h1>', 
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
    		return false;
    		}
    }); 
}); 
     



</script>
</html>