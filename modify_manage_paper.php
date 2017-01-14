
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
<?php 

// session_start ();
// $stuno = $_SESSION ['stuno'];
require_once 'openDB.php';
	$id = $_GET['id'];
	$ChairId = substr ( $id, 1 );
	$sqlstr= "select * from paper_list where p_id ='$ChairId'";

	$rs =  mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );
	
	$row = mysql_fetch_array($rs);
	$p_type=$row['p_type'];
	$p_indexed=$row['p_indexed'];
	$p_name=$row['p_name'];
	$p_title=$row['p_title'];
	
?>	
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<div class='paper-container'>
<ul>
<li class="table" style="height:40px;" >
<b class="title"> 论文标题</b>
<span class="paper_wrapper" >
<?php echo $row['p_title']?>
</span>
</li>
<li class="table">
<b class="title">论文类型</b>
<span class="paper_wrapper">
<!-- <select name="paper_select" id="paper_select" style="width: 40%;">
<option value="国内会议论文"<?php if("国内会议论文"==$p_type){?>selected="selected"<?php }?>>国内会议论文</option>
<option value="国际会议论文"<?php if("国际会议论文"==$p_type){?>selected="selected"<?php }?>>国际会议论文</option>
<option value="国内期刊论文"<?php if("国内期刊论文"==$p_type){?>selected="selected"<?php }?>>国内期刊论文</option>
<option value="国际期刊论文"<?php if("国际期刊论文"==$p_type){?>selected="selected"<?php }?>>国际期刊论文</option>
<option value="其他"<?php if("其他"==$p_type){?>selected="selected"<?php }?>>其他</option> 
</select>-->
<?php echo $p_type;?>
</span>
</li>
<li class="table" style="height:40px;">
<b class="title">关键字</b>
<span class="paper_wrapper">
<?php echo $row['p_keyword']?>
</span>
</li>
<li class="table" style="height:280px;">
<b class="title" >摘要</b>
<span class="paper_wrapper" style="font-size: 10;">
<?php echo $row['p_summary']?>
</span>
</li>
<li class="table">
<b class="title">收录情况</b>
<span class="paper_wrapper">
<!-- <input type="checkbox" name="paper_included[]" id="paper_included" value="SCI"  <?php if("sci"==$p_indexed) echo("checked");?>>SCI
<input type="checkbox" name="paper_included[]" id="paper_included" value="EI" <?php if("ei"==$p_indexed) echo("checked");?>>EI
<input type="checkbox" name="paper_included[]" id="paper_included" value="ISTP" <?php if("istp"==$p_indexed) echo("checked");?>>ISTP
<input type="checkbox" name="paper_included[]" id="paper_included" value="JCR " <?php if("jcr"==$p_indexed) echo("checked");?>>JCR  -->
<?php  echo strtoupper($p_indexed);?>
</span>
</li>
<li class="table">
<b class="title">作者</b>
<span class="paper_wrapper">
<?php echo $row['p_writer']?>
</span>
</li>
<li class="table">
<b class="title">指导老师</b>
<span class="paper_wrapper">
<?php echo $row['p_teacher']?>
</span>
</li>
<li class="table">
<b class="title">第一署名单位</b>
<span class="paper_wrapper">
<?php echo $row['p_first_addr']?>
</span>
</li>
<li class="table">
<b class="title">实验室</b>
<span class="paper_wrapper">
<?php echo $row['p_lab']?>
</span>
</li>
<li class="table" style="height:40px;">
<b class="title">刊物名称</b>
<span class="paper_wrapper">
<?php echo $row['p_place']?>
</span>
</li>
<li class="table">
<b class="title">发表时间</b>
<span class="paper_wrapper">
<?php echo $row['p_writetime']?>
</span>
</li>
<li class="table">
<b class="title">下载文件</b>

<span class="paper_wrapper" style="height:70px;font-size: 12;">
<a href="download.php?filename=<?php echo $p_name?>"><?php echo ($p_title)?></a>
</span>
</li>

</ul>

<span><input class='book-btn1' type="button" id = "paperpass"  value='合格' onclick='paperpass(this.id,<?php echo $ChairId?>)'/></span>&nbsp;&nbsp;&nbsp;&nbsp;
<span><input class='book-btn2' type="button" id = "paperunpass"  value='不合格'  onclick='paperpass(this.id,<?php echo $ChairId?>)'/></span>&nbsp;&nbsp;&nbsp;&nbsp;
<span><input class='book-btn3' type="button" id = "paperrestart"  value='重置'  onclick='paperpass(this.id,<?php echo $ChairId?>)'/></span>
</div>

<script type="text/javascript">

function download_file(url)
{
    if (typeof (download_file.iframe) == "undefined")
    {
        var iframe = document.createElement("iframe");
        download_file.iframe = iframe;
        document.body.appendChild(download_file.iframe);
    }
    //alert(download_file.iframe);
    download_file.iframe.src = url;
    download_file.iframe.style.display = "none";
}

function paperpass(type,id){
	if(confirm("确认继续吗？")){
		jQuery.ajax({
	        url: "m_paperpass.php",
	        type: "POST",
	        data:{type:type,id:id},
	        dataType: "text",
	        error: function(){  
	            alert('Error loading XML document');  
	        },  
	        success: function(data,status){//如果调用php成功         
	        	if(data=='pass'){
					prompt("审核通过");
				}else if(data=='unpass'){
					prompt("审核不通过");
				}else if(data=='restart'){
					prompt("已重置为未审核");
				}
				return false;
	
	        }
	    });
		
	}else{
          return; 
		}

}

	</script>

</body>
</html>