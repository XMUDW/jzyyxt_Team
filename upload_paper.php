
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
 <form id="upload_form"  method="post" action="upload_success.php"  >
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
	<!--  		 <input type="file" name="image_file" id="image_file" onchange="fileSelected();" />
				 <input type="button" value="Upload" onclick="startUploading()" />-->
			</li>
	
		</ul>
		<input class='book-btn' type="submit" id = "paper_submit"  value='确认提交' onclick="return checkPaperInfo();" />
	</div>
	
</form>

<?php
?>