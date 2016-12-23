

<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="添加讲座信息">
			<div class='manage_chair-container'>
				<ul>
					<li class="table">
						<b class="title">讲座日期:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentName" id="newstudentName" style="width: 72%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">主 讲 人:</b>
						<span class="paper_wrapper">
							<input type="text" name="newStuno" id="newStuno" style="width: 72%;" />
						</span>
					</li>

					<li class="table">
						<b class="title">讲座名称:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentMajor" id="newstudentMajor" style="width: 72%;" />
						</span>
					</li>
					<li class="table">
						<b class="title">学　　期:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentGrade" id="newstudentGrade" style="width: 72%;" />
						</span>
					</li>
						<li class="table">
						<b class="title">可预约数:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentGrade" id="newstudentGrade" style="width: 72%;" />
						</span>
					</li>
						<li class="table">
						<b class="title">预约时间:</b>
						<span class="paper_wrapper">
							<input type="date" name="newstudentGrade" id="newstudentGrade" style="width: 45%;" />
							<input type="time" name="newstudentGrade" id="newstudentGrade" style="width: 25%;" />
						</span>
					</li>
						<li class="table">
						<b class="title">讲座时间:</b>
						<span class="paper_wrapper">
							<input type="date" name="newstudentGrade" id="newstudentGrade" style="width: 45%;" />
							<input type="time" name="newstudentGrade" id="newstudentGrade" style="width: 25%;" />
						</span>
				</ul>
				<input class='add_chair-btn' type="button" id="upload_student" value='确认上传' />
			</div>
		</section>
		


		<section id="tab2" title="修改讲座信息">
			<div class='manage_chair-container'>
				
				<table class = "manage_chair_table" id = "datasource">
				
					<tbody id ="datasource">
					<tr >
						<th width="10%;"></th>
						<th width="20%;">讲座日期</th>
						<th width="50%;">讲座名称</th>
						<th colspan="2" style="width: 20%;text-align: center;" >操作</th>
					</tr>
<?php 

session_start ();
$stuno = $_SESSION ['stuno'];
require_once 'openDB.php';

$pagesize=8; //设置每一页显示的记录数
$numrows=50;//只能修改最新的50个讲座信息

$pages=intval($numrows/$pagesize)+1;


if (isset($_GET['page'])){
	$page=intval($_GET['page']);
}
else{
	$page=1; //否则，设置为第一页
}


//计算记录偏移量
$offset=$pagesize*($page - 1);
//读取指定记录数
$sqlstr="select * from yq_chair order by id desc limit $offset,$pagesize";

$rs =  mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );
while($myrow = mysql_fetch_array($rs)) {
?>		
					<tr >
						<td width="10%;"><input type="checkbox" id="<?php echo 'select'.$myrow['id']?>"/></td>
						<td width="20%;"><?php echo $myrow['chData'];?></td>
						<td width="50%;"><?php echo $myrow['chName'];?></td>
						<td width="10%;">删除</td>
						<td width="10%;">修改</td>
					</tr>
<?php }?>	
					<tr >
						<td width="10%;"><input type="checkbox" onclick="checkAll(this)" id="allcheck"/></td>
						<td width="20%;"> 删除</td>
						<td width="50%;">
						<input class= "Pagination" id = "prePage" value="上一页" type="button"/>
						<input class= "Pagination" id = "nextPage" value="下一页" type="button"/>
						</td>
						<td width="10%;"></td>
						<td width="10%;"></td>
					</tr>
					
				</tbody>
				</table>
				 
			</div>
		</section>

	</div>
</div>

<script type="text/javascript" src="jsq/jquery-tab.js"></script>
<script type="text/javascript" src="jsq/prefixfree.min.js"></script>
<script type="text/javascript">
		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();

			 $("#nextPage").click(function(){   
				 $("#tab2").load("Pagination_manage_chair.php?page=2");
				 })
		    
		    });
	    function checkAll(obj) {
	    	var a = document.getElementsByTagName("input");
	    	if(obj.checked){
	    		for(var i = 0;i<a.length;i++){
	    			if(a[i].type == "checkbox") 
		    			{a[i].checked = true;}
	    		}
	    	}
	    	else{
	    		for(var i = 0;i<a.length;i++){
	    			if(a[i].type == "checkbox") a[i].checked = false;
	    		}
	    	}
	    }
		    
</script>

