<?php 

session_start ();
$stuno = $_SESSION ['stuno'];

require_once 'openDB.php';
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$ChairId = substr ( $id, 1 );
	
	$sqlstr= "select * from yq_chair where id ='$ChairId'";

	$rs =  mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );
	
	$row = mysql_fetch_array($rs);
	

	
?>	

<div class='manage_chair-container'>
				<ul>
					<li class="table">
						<b class="title">讲座日期:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentName" id="newstudentName" style="width: 72%;" value=<?php echo $row['chData'];?>>
						</span>
					</li>

					<li class="table">
						<b class="title">主 讲 人:</b>
						<span class="paper_wrapper">
							<input type="text" name="newStuno" id="newStuno" style="width: 72%;" value=<?php echo $row['chAnchor'];?>>
						</span>
					</li>

					<li class="table">
						<b class="title">讲座名称:</b>
						<span class="paper_wrapper">
							<input type="pause: text" name="newstudentMajor" id="newstudentMajor" style="width: 72%;" value="<?php echo $row['chName'];?>">
						</span>
					</li>
					<li class="table">
						<b class="title">学　　期:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentGrade" id="newstudentGrade" style="width: 72%;" value=<?php echo $row['chTerm'];?>>
						</span>
					</li>
						<li class="table">
						<b class="title">可预约数:</b>
						<span class="paper_wrapper">
							<input type="text" name="newstudentGrade" id="newstudentGrade" style="width: 72%;" value=<?php echo $row['chTotalNum'];?>>
						</span>
					</li>
						<li class="table">
						<b class="title">预约时间:</b>
						<span class="paper_wrapper">
							<input type="date" name="newstudentGrade" id="newstudentGrade" style="width: 45%;" value=<?php echo $row['chBookTime'];?>>
							<input type="time" name="newstudentGrade" id="newstudentGrade" style="width: 25%;" value=<?php echo explode(" ", $row['chBookTime'])[1];?>>
						</span>
					</li>
						<li class="table">
						<b class="title">讲座时间:</b>
						<span class="paper_wrapper">
							<input type="date" name="newstudentGrade" id="newstudentGrade" style="width: 45%;" value=<?php echo $row['chBookStartTime'];?>>
							<input type="time" name="newstudentGrade" id="newstudentGrade" style="width: 25%;" value=<?php echo explode(" ", $row['chBookStartTime'])[1];?>>
						</span>
				</ul>
				<input class='add_chair-btn' type="button" id="upload_student" value='确认修改' >
			</div>


<?php
}else {
?>
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
<?php }?>

