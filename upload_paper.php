<!-- 
paper_name :
paper_select
paper_key
paper_abstract
paper_included
paper_author
paper_teacher
paper_unit
paper_lab
paper_publication
paper_time
-->
<h class="headline"> 上传论文</h>
<div class="Split_line"></div>
<?php require_once 'CheckSession.php';?>
 <form name="upload_form" id="upload_form" action="upload_success.php" method="post" enctype="multipart/form-data" >
	<div class='paper-container'>
		<ul>
			<li class="table">
				<b class="title"> 论文标题</b>
				<span class="paper_wrapper">
					<input type="text" name="paper_name" id="paper_name" style="width: 40%;"/>
					<span  class="note">*必填</span>
				</span>
			</li>
			<li class="table">
				<b class="title">论文类型</b>
				<span class="paper_wrapper">
					<select name="paper_select" id="paper_select" style="width: 40%;">
						<option value="国内会议论文">国内会议论文</option>
						<option value="国际会议论文">国际会议论文</option>
						<option value="国内期刊论文">国内期刊论文</option>
						<option value="国际期刊论文">国际期刊论文</option>
						<option value="其他">其他</option>
					</select>
				</span>
			</li>
			<li class="table">
				<b class="title">关键字</b>
				<span class="paper_wrapper"> 
					<input type="text" name="paper_key" id="paper_key" style="width: 40%;" />
					<span  class="note">*请以空格隔开每个关键字</span>
				</span>
			</li>
			<li class="table">
				<b class="title">摘要</b>
					<textarea rows="8" cols="61" name="paper_abstract" id="paper_abstract"></textarea>
			</li>
			<li class="table">
				<b class="title">收录情况</b>
				<span class="paper_wrapper"> 
					<input type="checkbox" name="paper_included[]" id="paper_included" value="SCI">SCI</input>
					<input type="checkbox" name="paper_included[]" id="paper_included" value="EI">EI</input>
					<input type="checkbox" name="paper_included[]" id="paper_included" value="ISTP">ISTP</input>
					<input type="checkbox" name="paper_included[]" id="paper_included" value="JCR ">JCR </input>
				</span>
			</li>
			<li class="table">
				<b class="title">作者</b>
				<span class="paper_wrapper">
					<input type="text" name="paper_author" id="paper_author" style="width: 65%;"/>
					<span  class="note">*多个作者以空格隔开</span>
				</span>
			</li>
			<li class="table">
				<b class="title">指导老师</b>
				<span class="paper_wrapper">
					<input type="text" name="paper_teacher" id="paper_teacher" style="width: 40%;"/>
				</span>
			</li>
			<li class="table">
				<b class="title">第一署名单位</b>
				<span class="paper_wrapper">
					<input type="text" name="paper_unit" id="paper_unit" style="width: 40%;"/>
				</span>
			</li>
			<li class="table">
				<b class="title">实验室</b>
				<span class="paper_wrapper"> 
					<input type="text" name="paper_lab" id="paper_lab" style="width: 40%;" />
					<span  class="note">*例如科研2_501</span>
				</span>
			</li>
			<li class="table">
				<b class="title">刊物名称</b>
				<span class="paper_wrapper"> 
					<input type="text" name="paper_publication" id="paper_publication" style="width: 40%;" />
					<span  class="note">*</span>
				</span>
			</li>
			<li class="table">
				<b class="title">发表时间</b>
				<span class="paper_wrapper"> 
					<input name="paper_time" id="paper_time" type="date"  style="width: 40%;"/>
					<span  class="note">*</span>
				</span>
			</li>
			<li class="table">
				<b class="title">上传文件</b>
				
				<span class="paper_wrapper">
					<input id="fileToUpload" type="file" size="20" name="fileToUpload" class="input">
					<button id="buttonUpload">上传</button>
				</span>
			</li>
	
		</ul>
		<input class='book-btn' type="button" id = "paper-submit"  value='确认提交' "/>
	</div>
	
</form>

<script type="text/javascript">

$(document).ready(function() { 
	
	 $("#buttonUpload").click(function(){     
	       //加载图标   
	       /* $("#loading").ajaxStart(function(){
	          $(this).show();
	       }).ajaxComplete(function(){
	          $(this).hide();
	       });*/
	        //上传文件
	        
	     var options = {
	          url:'upload.php',//处理图片脚本
	          secureuri :false,
	          fileElementId :'fileToUpload',//file控件id
	          dataType : 'text',
	          success : function (data, status){
	                  if(data=='ok'){
	                	  prompt("上传成功");
	                  }else if(data=='errorType'){
	                	  prompt("只能上传PDF、doc格式的文件");
	                  }else if(data=='errorTransfer'){
	                	  prompt("上传失败");
	                  }else if(data=='errorSize'){
	                	  prompt("上传文件过大");
	                  }
	              }
	          };
	       $.ajaxFileUpload(options);
		  return false;
	    });

	
	
}); 

$('#paper-submit').click(function() {
	
	var papername = window.upload_form.paper_name.value;
	var paperselect = window.upload_form.paper_select.value;
	var paperkey = window.upload_form.paper_key.value;
	var paperabstract = window.upload_form.paper_abstract.value;
	var paperincluded = window.upload_form.paper_included.value;
	var paperauthor = window.upload_form.paper_author.value;
	var paperteacher = window.upload_form.paper_teacher.value;
	var paperunit = window.upload_form.paper_unit.value;
	var paperlab = window.upload_form.paper_lab.value;
	var paperpublication = window.upload_form.paper_publication.value;
	var papertime = window.upload_form.paper_time.value;

	
	if(papername =="") {
		prompt("论文标题不能为空");
		return false;
		}
	else if (paperkey=="") {
		prompt("关键字不能为空");
		return false;
		}
	else if (paperauthor=="") {
		prompt("作者不能为空");
		return false;
		}
	else if (paperlab=="") {
		prompt("实验室不能为空");
		return false;
		}
	else if (paperpublication=="") {
		prompt("刊物名称不能为空");
		return false;
		}
	else if (papertime=="") {
		prompt("发表时间不能为空");
		return false;
		}
	else {
	    //这里编码方式不一样，导致下面用==而不是indexof（）
	    //直接给出提示信息不实更好？
		var options = {
                url: 'upload_success.php',
                type: 'post',
                dataType: 'text',
                async:false,
                data:decodeURIComponent($("#upload_form").serialize(),true),
                success: function (data) {
                	prompt(data);
                	$('#upload_form')[0].reset();
                }
            };
            $.ajax(options);
           return false;
    	}
});

</script>
