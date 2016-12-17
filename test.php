<?php
// echo strtoupper(md5("123456"));

function timediff( $begin_time, $end_time )
{
// 	if ( $begin_time < $end_time ) {
// 		$starttime = $begin_time;
// 		$endtime = $end_time;
// 	} else {
// 		$starttime = $end_time;
// 		$endtime = $begin_time;
// 	}
	$timediff = $end_time - $begin_time;
	$days = intval( $timediff / 86400 );
	$remain = $timediff % 86400;
	$hours = intval( $remain / 3600 );
	$remain = $remain % 3600;
	$mins = intval( $remain / 60 );
	$secs = $remain % 60;
	$res = array( "day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs );
	return $res;
}
//======== 实例使用 ========
$timediff = timediff( strtotime( "2016-11-19 08:40:04" ), strtotime( "2016-11-19 07:50:07" ) );
echo $timediff['hour'];

if("2016-11-19 08:40:04">"2016-11-19 07:50:07"  ) {
	echo "true";
}
?>

<div class="upload_box">
	<div class="upload_main">
		<div class="upload_choose">
			<input id="fileImage" type="file" size="30" name="fileselect[]" multiple="">
			<span id="fileDragArea" class="upload_drag_area">或者将图片拖到此处</span>
		</div>
		<div id="preview" class="upload_preview">
			<div id="uploadList_0" class="upload_append_list" style="display: none;">
				<p>
					<strong>logo.png</strong>
					<a href="javascript:" class="upload_delete" title="删除" data-index="0">删除</a>
					<br>
					<img id="uploadImage_0" src="" class="upload_image">
				</p>
				<span id="uploadProgress_0" class="upload_progress" style="display: inline;">100.00%</span>
			</div>
		</div>
	</div>
	<div class="upload_submit">
		<button type="button" id="fileSubmit" class="upload_submit_btn" style="display: none;">确认上传图片</button>
	</div>

</div>