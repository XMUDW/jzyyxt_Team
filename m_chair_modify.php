<?php
require_once 'CheckSession.php';

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';
if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
	
	$ChairId = substr ( $id, 1 );
	
	$sqlstr = "select * from yq_chair where id ='$ChairId'";
	
	$rs = mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );
	
	$row = mysql_fetch_array ( $rs );
	
	?>

<div class='manage_chair-container'>
	<form name="modify_chair" id="modify_chair" enctype="multipart/form-data">
		<ul>
			<li class="table">
				<b class="title">讲座日期:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_date" id="modify_date" style="width: 72%;"
						value="<?php echo $row['chData'];?>">
				</span>
			</li>

			<li class="table">
				<b class="title">主 讲 人:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_author" id="modify_author" style="width: 72%;"
						value="<?php echo $row['chAnchor'];?>">
				</span>
			</li>

			<li class="table">
				<b class="title">讲座名称:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_title" id="modify_title" style="width: 72%;"
						value="<?php echo $row['chName'];?>">
				</span>
			</li>
			<li class="table">
				<b class="title">学 期:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_term" id="modify_term" style="width: 72%;"
						value="<?php echo $row['chTerm'];?>">
				</span>
			</li>
			<li class="table">
				<b class="title">可预约数:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_total" id="modify_total" style="width: 72%;"
						value="<?php echo $row['chTotalNum'];?>">
				</span>
			</li>
			<li class="table">
				<b class="title">讲座地点:</b>
				<span class="paper_wrapper">
					<input type="text" name="modify_place" id="modify_place" style="width: 72%;"
						value="<?php echo $row['chAddress'];?>">
				</span>
			</li>
			<li class="table">
				<b class="title">讲座时间:</b>
				<span class="paper_wrapper">
					<input type="date" name="modify_bookdate1" id="modify_bookdate1" style="width: 45%;"
						value=<?php echo $row['chBookTime'];?>>
					<input type="time" name="modify_bookdate2" id="modify_bookdate2" style="width: 25%;"
						value=<?php echo explode(" ", $row['chBookTime'])[1];?>>
				</span>
			</li>
			<li class="table">
				<b class="title">预约时间:</b>
				<span class="paper_wrapper">
					<input type="date" name="modify_startdate1" id="modify_startdate1" style="width: 45%;"
						value=<?php echo $row['chBookStartTime'];?>>
					<input type="time" name="modify_startdate2" id="modify_startdate2" style="width: 25%;"
						value=<?php echo explode(" ", $row['chBookStartTime'])[1];?>>
				</span>
		
		</ul>
		<input class="manage_chair-btn" style="margin-top: 20%;" type="button" id="modify_chairBtn"
			 value='确认修改' />
		<input type="hidden" id="modify_type" name="modify_type" value='<?php echo $ChairId;?>' />
	</form>
</div>


<?php
} else {
	?>
<div class='manage_chair-container'>
	<form name="add_chair" id="add_chair" enctype="multipart/form-data">
		<ul>
			<li class="table">
				<b class="title">讲座日期:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_date" id="add_date" style="width: 72%;" />
				</span>
			</li>

			<li class="table">
				<b class="title">主 讲 人:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_author" id="add_author" style="width: 72%;" />
				</span>
			</li>

			<li class="table">
				<b class="title">讲座名称:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_title" id="add_title" style="width: 72%;" />
				</span>
			</li>
			<li class="table">
				<b class="title">学 期:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_term" id="add_term" style="width: 72%;" />
				</span>
			</li>
			<li class="table">
				<b class="title">可预约数:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_total" id="add_total" style="width: 72%;" />
				</span>
			</li>
			<li class="table">
				<b class="title">讲座地点:</b>
				<span class="paper_wrapper">
					<input type="text" name="add_place" id="add_place" style="width: 72%;" />
				</span>
			</li>
			<li class="table">
				<b class="title">讲座时间:</b>
				<span class="paper_wrapper">
					<input type="date" name="add_bookdate1" id="add_bookdate1" style="width: 45%;" />
					<input type="time" name="add_bookdate2" id="add_bookdate2" style="width: 25%;" />
				</span>
			</li>
			<li class="table">
				<b class="title">预约时间:</b>
				<span class="paper_wrapper">
					<input type="date" name="add_startdate1" id="add_startdate1" style="width: 45%;" />
					<input type="time" name="add_startdate2" id="add_startdate2" style="width: 25%;" />
				</span>
		
		</ul>
		<input class="manage_chair-btn" style="margin-top: 20%;" type="button" id="upload_chair"
			value='确认添加' onclick="upload_chairBtn()" />
	</form>
</div>
<?php }?>

<script type="text/javascript">

$('#modify_chairBtn').on('click', function() {
	 $.alertable.confirm('Are You Sure?').then(function() {
   
	var modify_date = $('#modify_date').val();
	var modify_author = $('#modify_author').val();
	var modify_title = $('#modify_title').val();
	var modify_term = $('#modify_term').val();
	var modify_total = $('#modify_total').val();
	var modify_bookdate1 = $('#modify_bookdate1').val();
	var modify_bookdate2 = $('#modify_bookdate2').val();
	var modify_startdate1 = $('#modify_startdate1').val();
	var modify_startdate2 = $('#modify_startdate2').val();

	if(modify_date =="") {
		prompt("讲座日期不能为空");
		return false;
	}
	else if (modify_author=="") {
		prompt("主讲人不能为空");
		return false;
	}
	else if (modify_title=="") {
		prompt("讲座名称不能为空");
		return false;
	}
	else if (modify_term=="") {
		prompt("学期不能为空");
		return false;
	}
	else if (modify_total=="") {
		prompt("预约总人数不能为空");
		return false;
	}
	else if (modify_bookdate1==""||modify_bookdate2=="") {
		prompt("请选择预约时间");
		return false;
	}
	else if (modify_startdate1==""||modify_startdate2=="") {
		prompt("请选择开始时间");
		return false;
	}
	else {
		var options = {
               url: 'm_chair_modifySuccess.php',
               type: 'post',
               dataType: 'text',
               async:false,
               data: $("#modify_chair").serialize(),
               success: function (data) {
               	prompt(data);
               }
           };
           $.ajax(options);
          return false;
   }
   
 }, function() {
   console.log('Cancel');      
 });
  });

    
//上传
function upload_chairBtn() {
	var add_date = $('#add_date').val();
	var add_author = $('#add_author').val();
	var add_title = $('#add_title').val();
	var add_term = $('#add_term').val();
	var add_total = $('#add_total').val();
	var add_bookdate1 = $('#add_bookdate1').val();
	var add_bookdate2 = $('#add_bookdate2').val();
	var add_startdate1 = $('#add_startdate1').val();
	var add_startdate2 = $('#add_startdate2').val();

	if(add_date =="") {
		prompt("讲座日期不能为空");
		return false;
	}
	else if (add_author=="") {
		prompt("主讲人不能为空");
		return false;
	}
	else if (add_title=="") {
		prompt("讲座名称不能为空");
		return false;
	}
	else if (add_term=="") {
		prompt("学期不能为空");
		return false;
	}
	else if (add_total=="") {
		prompt("预约总人数不能为空");
		return false;
	}
	else if (add_bookdate1==""||add_bookdate2=="") {
		prompt("请选择预约时间");
		return false;
	}
	else if (add_startdate1==""||add_startdate2=="") {
		prompt("请选择开始时间");
		return false;
	}
	else {
		var options = {
                url: 'm_chair_modifySuccess.php',
                type: 'post',
                dataType: 'text',
                async:false,
                data: $("#add_chair").serialize(),
                success: function (data) {
                    prompt(data);
                }
            };
            $.ajax(options);
           return false;
    }
}

</script>