<?php
//session_start();
//$studentNum =  $_SESSION['stuno'];
require_once 'openDB.php';
$page = intval($_POST['pageNum']);
$sqlpaper = "select p_id from paper_list";
$result = mysql_query($sqlpaper) or die("数据库请求失败！");
$total = mysql_num_rows($result);
//echo $total ;
$pageSize = 8; //每页显示数
$totalPage = ceil($total/$pageSize); //总页数
$startPage = $page*$pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;
$query = mysql_query("select * from paper_list order by p_writetime asc limit $startPage,$pageSize");
while($row=mysql_fetch_array($query)){
	$arr['list'][] = array(
			'p_verify' => urlencode($row['p_verify']),
			'p_title' => urlencode($row['p_title']),
			'p_writer' => urlencode($row['p_writer']),
			'p_teacher' =>urlencode($row['p_teacher']),
			'p_lab' => urlencode($row['p_lab']),
			'p_writetime' => urlencode($row['p_writetime']),
			'p_id' => urlencode($row['p_id']),
			'p_name' => urlencode($row['p_name'])
	);
}
//print_r($arr);
echo urldecode(json_encode($arr));
?>
