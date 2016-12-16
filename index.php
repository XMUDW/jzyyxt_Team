<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta  http-equiv="Content-Type" content="text/html"; charset="gb2312">
<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
</head>

<body>
<div class="index_contanier">

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
		    <input class="login-btn" type="submit" value="登录" onclick="jcud()"/>

			
		</form>
	</div>
</div>
</body>

<script language="javascript">

function jcud() {
	var username = window.form_login.username.value;
	var password = window.form_login.password.value;
	if(username =="账号") {
		window.alert("账号不能为空");
		window.form_login.username.focus;
		}
	else if (password=="") {
		window.alert("密码不能为空");
		window.form_login.username.focus;
		}
}

</script>
</html>