<!doctype>
<html>
<head>
<title>信息科学与技术学院</title>
<meta http-equiv="Content-Type" content="text/html" ; charset="gb2312">
<script src="jsq/jquery-3.1.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/index.css" type="text/css"
	media="screen">
</head>

<body>
	<div class="jzyyxt-toolbar jzyyxt-toolbar-skin-blue">
		<div class="container">
			<div class="pull-left">讲座预约系统</div>
			<div class="pull-right">登陆|注册</div>
		</div>
	</div>



	<div class="main-content clearfix">
		<div class="content_l fl">
			<div class="categ">
				<div class="mod_title">
					<div class="border_b"></div>
					<h4 class="mod_title_t">
						<label style="font-weight:bold;">我的系统</label>
					</h4>
				</div>
				<div class="blog_category">
					<ul class="category_list">
						<li><a href="#0" data-type="modal-trigger" id="search_chair">查询讲座</a><a href="#1" data-type="modal-trigger" id="book_chair">预约讲座</a></li>
						<li><a href="#0" data-type="modal-trigger" id="upload_paper">论文上传</a><a href="#1" data-type="modal-trigger" id="my_paper">我的论文</a></li>
						<li><a href="#0" data-type="modal-trigger" id="search_paper">论文搜索</a><a href="#1" data-type="modal-trigger" id="operation_guide">操作手册</a></li>
						<li><a href="#0" data-type="modal-trigger" id="change_password">修改密码</a><a href="#1" data-type="modal-trigger" id="exit">退出系统</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="content_r fr">
			<div id="right-content" class="main-home">请在左侧菜单选择具体操作</div>
		
		</div>
	</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
	
});

$(function(){
	$("#search_chair").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#book_chair").click(function(){
		$("#right-content").load("book_chair.php");
	});
	$("#upload_paper").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#my_paper").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#search_paper").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#operation_guide").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#change_password").click(function(){
		$("#right-content").load("search_chair.php");
	});
	$("#exit").click(function(){
		$("#right-content").load("search_chair.php");
	});
	
});

//预约讲座按钮
function book(id) {
	x=document.getElementById("heihei");  // 找到元素
	
	var v = $('#'+id).val();
	var method = id.substr(0,3);
// 	x.innerHTML=method;    // 改变内容
// 	if(v=="预约此讲座") {
// 		$('#'+id).val("取消预约");
		
// 	}else {
// 		$('#'+id).val("预约此讲座");
// 	}
	jQuery.ajax({
        url: "book_success.php",  
        type: "POST",
        data:{myMethod:method,id:id},
        dataType: "text",
        error: function(){  
            alert('Error loading XML document');  
        },  
        success: function(data,status){//如果调用php成功          
//         	var str = data.toJSONString(); 
//         	var obj = eval("("+data+")"); 
//         	alert(data);
//			var str = JSON.stringify(data);  
// 			var str1 = JSON.parse(data); 
//          x.innerHTML=data;  
//          data  = data.trim();
//          var content=$.trim(data)+"";
//          var ok = $.trim("ok")+"";
            if(data.indexOf("sav_ok")>0) {
            	$('#'+id).val("取消预约");
            	//改变元素的id值
            	document.getElementById(id).setAttribute("id", id.replace(/sav/,"del"));
          	    alert("恭喜你，预约成功~");
            }else if (data.indexOf("del_ok")>0){
            	$('#'+id).val("预约此讲座");
            	document.getElementById(id).setAttribute("id", id.replace(/del/,"sav"));
                alert("成功取消预约~");

            }else if (data.indexOf("full")>0) {
            	alert("由于页面延时，您刚才看到的数据已过期！现讲座预约名额已满，谢谢您对研会工作的支持！");
                }
            
        }
    });
	
}
</script>
</html>