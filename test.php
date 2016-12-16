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