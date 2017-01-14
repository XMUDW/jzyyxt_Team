<html>
<head>
<meta  http-equiv="Content-Type" content="text/html" charset="gb2312">
<link rel="stylesheet" href="css/index.css" type="text/css" media="screen">
<h>论文查询</h>
</head>
<body>
<script type="text/javascript" src="jsq/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="jsq/page.js"> </script> 
<script type="text/javascript">
$("#checked").click(function(){
	//alert(search_input);
	//alert(selectValue);
	var curPage = 1; //当前页码
	var total,pageSize,totalPage;
	//获取数据
	function getData1(page){
		var search_input=$("#search_input").val();
		var selectValue=$("#select_type").val();
	    $.ajax({
	        type: 'POST',
	        url: 'pageselect.php',
	        data: {pageNum:page-1,searchInput:search_input,selectValue:selectValue},
	        success:function(json1){
	   //     	alert(json1);
	        	$("#tablelist").css("display","none");
	            $("#tablelist1").empty();
	            var json = eval("("+json1+")");   //将json数组转换成json对象
	            total = json.total; //总记录数
	            pageSize = json.pageSize; //每页显示条数
	            curPage = page; //当前页
	            totalPage = json.totalPage; //总页数
	            var table_html = "";
	            table_html += "<table align=\"center\" class=\"altrowstable\"><tr><th width=\"*\">审核状态</th><th width=\"*\">标题</th><th width=\"100\">作者</th><th width=\"100\">指导老师</th><th width=\"100\">实验室</th><th width=\"100\">发表时间</th><th style=\"width: 20% text-align: center\" colspan=\"2\" >操作</th></tr>";
		            
	            var list = json.list;
	            $.each(list,function(index,array){ //遍历json数据列
	                var title_sub = array['p_title']; 
	                table_html += "<tr><td>"+array['p_verify']+"</td><td><a href='download.php?filename="+array['p_name']+"'>"+title_sub+"</a></td><td>"+array['p_writer']+"</td><td>"+array['p_teacher']+"</td><td>"+array['p_lab']+"</td><td>"+array['p_writetime'] 
	                +"</td><td><input class=\"Pagination small regular red\" value='删除' type='button' onclick='delete_chair1(this.id)' id= "+'p'+array['p_id']+">"
	                +"</td><td><input class=\"Pagination small regular blue\"  value='审核' type='button' onclick='check1(this.id)' id= "+'q'+array['p_id']+">"+"</td></tr>";       
	            });
	            table_html += "</table>";
	           
	            $("#tablelist1").append(table_html);
	        },
	        complete:function(){ //生成分页条	        	
	            getPageBar1();
	        },
	        error:function(result){
	              alert(result);
	        }
	    });
	}
	//获取分页条
	function getPageBar1(){
		var pageStr="";
	//	pageStr ="<span><input type=\'checkbox\' onclick=\'checkAll(this)\' id=\'allcheck\' /><input class=\"Pagination small regular red\" id=\"delete_all\" value=\"全部删除\"type=\"button\" />"+"</span>"
	    //页码大于最大页数
	    if(curPage>totalPage) curPage=totalPage;
	    //页码小于1
	    if(curPage<1) curPage=1;
	    pageStr = "<span class=\"button_span_page gray\">共"+total+"条"+curPage+"/"+totalPage+"</span>";

	    //如果是第一页
	    if(curPage==1){
	        pageStr += "<span class=\"button_span blue\">首页</span>&nbsp;&nbsp;<span class=\"button_span blue\">上一页</span>";
	    }else{
	        pageStr += "<span class=\"button_span green\"><a href='javascript:void(0)' rel='1'>首页</a>&nbsp;&nbsp;</span><span class=\"button_span green\"><a href='javascript:void(0)' rel='"+(curPage-1)+"'>上一页</a></span>";
	    }

	    //如果是最后页
	    if(curPage>=totalPage){
	        pageStr += "<span class=\"button_span blue\">下一页</span>&nbsp;&nbsp;<span class=\"button_span blue\">尾页</span>";
	    }else{
	        pageStr += "<span class=\"button_span green\"><a href='javascript:void(0)' rel='"+(parseInt(curPage)+1)+"'>下一页</a>&nbsp;&nbsp;</span><span class=\"button_span green\"><a href='javascript:void(0)' rel='"+totalPage+"'>尾页</a></span>";
	    }
	    $("#pagecount").css("display","none");
	    $("#pagecount1").html(pageStr);
	}

	$(function(){
	    getData1(1);
	    $("#pagecount1").on("click","a",function(){
	        var rel = $(this).attr("rel");
	        if(rel){
	            getData1(rel);
	        }
	    });
	}); 	
});		

function check1(id) {
	var v = encodeURIComponent(id);
	$("#right-content").load("modify_manage_paper.php?id="+v);
}

function delete_chair1(id) {	
	
	if(confirm("您确认删除数据吗？")){
	jQuery.ajax({
        url: "m_deletePaper_success.php",  
        type: "POST",
        data:{id:id},
        dataType: "text",
        error: function(){  
            alert('Error loading XML document');  
        },  
        success: function(data,status){//如果调用php成功         
        	alert("删除成功");
        	var curPage = 1; //当前页码
        	var total,pageSize,totalPage;
        	//获取数据
        	function getData1(page){
        		var search_input=$("#search_input").val();
        		var selectValue=$("#select_type").val();
        	    $.ajax({
        	        type: 'POST',
        	        url: 'pageselect.php',
        	        data: {pageNum:page-1,searchInput:search_input,selectValue:selectValue},
        	        success:function(json1){
        	   //     	alert(json1);
        	        	$("#tablelist").css("display","none");
        	            $("#tablelist1").empty();
        	            var json = eval("("+json1+")");   //将json数组转换成json对象
        	            total = json.total; //总记录数
        	            pageSize = json.pageSize; //每页显示条数
        	            curPage = page; //当前页
        	            totalPage = json.totalPage; //总页数
        	            var table_html = "";
        	            table_html += "<table align=\"center\" class=\"altrowstable\"><tr><th width=\"*\"></th><th width=\"*\">审核状态</th><th width=\"*\">标题</th><th width=\"100\">作者</th><th width=\"100\">指导老师</th><th width=\"100\">实验室</th><th width=\"100\">发表时间</th><th style=\"width: 20% text-align: center\" colspan=\"2\" >操作</th></tr>";
        		            
        	            var list = json.list;
        	            $.each(list,function(index,array){ //遍历json数据列
        	                var title_sub = array['p_title']; 
        	                table_html += "<tr><td><input type=\'checkbox\'/>"+ "</td><td>"+array['p_verify']+"</td><td>"+title_sub+"</td><td>"+array['p_writer']+"</td><td>"+array['p_teacher']+"</td><td>"+array['p_lab']+"</td><td>"+array['p_writetime'] 
        	                +"</td><td><input class=\"Pagination small regular red\" value='删除' type='button' onclick='delete_chair1(this.id)' id= "+'p'+array['p_id']+">"
        	                +"</td><td><input class=\"Pagination small regular blue\"  value='审核' type='button' onclick='check1(this.id)' id= "+'q'+array['p_id']+">"+"</td></tr>";       
        	            });
        	            table_html += "</table>";
        	           
        	            $("#tablelist1").append(table_html);
        	        },
        	        complete:function(){ //生成分页条	        	
        	            getPageBar1();
        	        },
        	        error:function(result){
        	              alert(result);
        	        }
        	    });
        	}
        	//获取分页条
        	function getPageBar1(){
        		var pageStr="";
        	//	pageStr ="<span><input type=\'checkbox\' onclick=\'checkAll(this)\' id=\'allcheck\' /><input class=\"Pagination small regular red\" id=\"delete_all\" value=\"全部删除\"type=\"button\" />"+"</span>"
        	    //页码大于最大页数
        	    if(curPage>totalPage) curPage=totalPage;
        	    //页码小于1
        	    if(curPage<1) curPage=1;
        	    pageStr = "<span class=\"button_span_page gray\">共"+total+"条"+curPage+"/"+totalPage+"</span>";

        	    //如果是第一页
        	    if(curPage==1){
        	        pageStr += "<span class=\"button_span blue\">首页</span>&nbsp;&nbsp;<span class=\"button_span blue\">上一页</span>";
        	    }else{
        	        pageStr += "<span class=\"button_span green\"><a href='javascript:void(0)' rel='1'>首页</a>&nbsp;&nbsp;</span><span class=\"button_span green\"><a href='javascript:void(0)' rel='"+(curPage-1)+"'>上一页</a></span>";
        	    }

        	    //如果是最后页
        	    if(curPage>=totalPage){
        	        pageStr += "<span class=\"button_span blue\">下一页</span>&nbsp;&nbsp;<span class=\"button_span blue\">尾页</span>";
        	    }else{
        	        pageStr += "<span class=\"button_span green\"><a href='javascript:void(0)' rel='"+(parseInt(curPage)+1)+"'>下一页</a>&nbsp;&nbsp;</span><span class=\"button_span green\"><a href='javascript:void(0)' rel='"+totalPage+"'>尾页</a></span>";
        	    }
        	    $("#pagecount").css("display","none");
        	    $("#pagecount1").html(pageStr);
        	}

        	$(function(){
        	    getData1(1);
        	    $("#pagecount1").on("click","a",function(){
        	        var rel = $(this).attr("rel");
        	        if(rel){
        	            getData1(rel);
        	        }
        	    });
        	}); 
        }
    });
	}else{
		return;
	}
}
</script>
<div id="All">
<table align="center" id="searchonce">
<tr>
<td>搜索内容：&nbsp;&nbsp;<input type="text" name="search_input" id="search_input"/></td>
<td>
<form id="demo_paper">&nbsp;&nbsp;&nbsp;&nbsp;
搜索类型：
<select name="select_type" size="1" id="select_type">                  
<option value="所有" selected>所有</option>
<option value="年级">年级</option>
<option value="作者">作者</option>
<option value="标题">标题</option>
<option value="关键词">关键词</option>
<option value="实验室">实验室</option>
<option value="指导老师">指导老师</option>
</select>&nbsp;&nbsp;&nbsp;&nbsp;
<input name="Submit" type="button" value="查询" id="checked"/>
</form>
</td>
</tr>
</table>
<div id="tableAll">
    <div id="tablelist">
    </div>
	<div id="tablelist1">
	</div> 
	<div id="pagecount">
	</div> 
	<div id="pagecount1">
	</div> 
</div>
</div>
</body>
</html>
