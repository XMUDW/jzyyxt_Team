/**
 * 
 */
var curPage = 1; //当前页码
var total,pageSize,totalPage;
//获取数据
function getData(page){
    $.ajax({
        type: 'POST',
        url: 'page.php',
        data: {"pageNum":page-1},
        success:function(json1){
        //    alert(json1);
            $("#tablelist").empty();
            var json = eval("("+json1+")");   //将json数组转换成json对象
            total = json.total; //总记录数
            pageSize = json.pageSize; //每页显示条数
            curPage = page; //当前页
            totalPage = json.totalPage; //总页数
            var table_html = "";
            table_html += "<div><table align=\"center\" class=\"altrowstable\"><tr><th width=\"5%\">审核状态</th><th width=\"30%\">标题</th><th width=\"10%\">作者</th><th width=\"10%\">指导老师</th><th width=\"10%\">实验室</th><th width=\"10%\">发表时间</th><th style=\"width=10% text-align: center\" colspan=\'2\'>操作</th></tr>";
            var list = json.list;
            $.each(list,function(index,array){ //遍历json数据列
                var title_sub = array['p_title']; 
                var p_id = array['p_id'];
                table_html += "<tr><td>"+array['p_verify']+"</td><td><a href='download.php?filename="+array['p_name']+"'>"+title_sub+"</a></td><td>"+array['p_writer']+"</td><td>"+array['p_teacher']+"</td><td>"+array['p_lab']+"</td><td>"+array['p_writetime'] 
                +"</td><td><input class=\"Pagination small regular red\" value='删除' type='button' onclick='delete_chair(this.id)' id= "+'e'+array['p_id']+">"
                +"</td><td><input class=\"Pagination small regular blue\"  value='审核' type='button' onclick='check(this.id)' id= "+'m'+array['p_id']+">"+"</td></tr>";         
            });
            table_html += "</table></div>";
            $("#tablelist").append(table_html);
        },
        complete:function(){ //生成分页条
            getPageBar();
        },
        error:function(result){
            alert(result);
        }
    });
}

//获取分页条
function getPageBar(){
    //页码大于最大页数
 //    pageStr ="<span><input type=\'checkbox\' onclick=\'checkAll(this)\' id=\'allcheck\' /><input class=\"Pagination small regular red\" id=\"delete_all\" value=\"全部删除\"type=\"button\" />"+"</span>"
	var pageStr="";
    if(curPage>totalPage) curPage=totalPage;
    //页码小于1
    if(curPage<1) curPage=1;
    pageStr += "<span class=\"button_span_page gray\">共"+total+"条"+curPage+"/"+totalPage+"</span>";

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

    $("#pagecount").html(pageStr);
}

$(function(){
    getData(1);
    $("#pagecount").on("click","a",function(){
        var rel = $(this).attr("rel");
        if(rel){
            getData(rel);
        }
    });
}); 	

//function checkAll(obj) {
//	var a = document.getElementsByTagName("input");
//	if(obj.checked){
//		for(var i = 0;i<a.length;i++){
//			if(a[i].type == "checkbox") 
//    			{a[i].checked = true;}
//		}
//	}
//	else{
//		for(var i = 0;i<a.length;i++){
//			if(a[i].type == "checkbox") a[i].checked = false;
//		}
//	}
//}

function check(id) {
	var v = encodeURIComponent(id);
	$("#right-content").empty();
	$("#right-content").load("modify_manage_paper.php?id="+v);
}

function delete_chair(id) {	
	//alert(id);
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
        	$("#tablelist").load("m_manage_paper.php"); 
       
        }
    });
	}else{
		return;
	}
}
