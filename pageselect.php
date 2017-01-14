<?php
require_once 'openDB.php';
$page1 = intval($_POST['pageNum']);
$searchText = $_POST['searchInput'];
$selectValue = $_POST['selectValue'];
//$searchText =preg_replace("/\s|　/","",$search);  //去掉空格
$sqlstr = "select * from paper_list ";
switch ($selectValue)
{
	case "所有":
		// alert("请选择类型");
		//return;
		break;
	case "年级":
		$p_grade = str_replace(' ', '', $searchText);
		$sqlstr = "SELECT * FROM paper_list INNER JOIN yq_info ON paper_list.p_stuno = yq_info.stuno WHERE (((yq_info.grade)='p_grade'))";
		break;
	case "作者":
		$p_writer = str_replace(' ', '', $searchText);
		$sqlstr = $sqlstr . " where p_writer like '%$p_writer%'";
		break;
	case "标题":
		$p_title = $searchText;
		$sqlstr =$sqlstr . " where p_title like '%$p_title%'";
		break;
	case "实验室":
		$p_lab = str_replace(' ', '', $searchText);
		$sqlstr = $sqlstr." where p_lab like '%$p_lab%'";
		break;
	case "指导老师":
		$p_teacher = str_replace(' ', '', $searchText);
		$sqlstr = $sqlstr . " where p_teacher like '%$p_teacher%'";
		break;
	case "关键词":
		$p_keyword = $searchText;
		$sqlstr = $sqlstr . "where p_keyword like '%$p_keyword%'";
		break;
	default: break;
}
//echo $sqlstr;
$result = mysql_query($sqlstr) or die("数据库请求失败！");
$total1 = mysql_num_rows($result);
//echo $total ;
$pageSize1 = 8; //每页显示数
$totalPage1 = ceil($total1/$pageSize1); //总页数
$startPage1 = $page1*$pageSize1;
$arr['total'] = $total1;
$arr['pageSize'] = $pageSize1;
$arr['totalPage'] = $totalPage1;
$sqlpaperpape = $sqlstr . "order by p_writetime asc limit $startPage1,$pageSize1";
$query = mysql_query($sqlpaperpape);
while($row=mysql_fetch_array($query)){
	$arr['list'][] = array(
			'p_verify' => urlencode($row['p_verify']),
			'p_title' => urlencode($row['p_title']),
			'p_writer' => urlencode($row['p_writer']),
			'p_teacher' =>urlencode($row['p_teacher']),
			'p_lab' => urlencode($row['p_lab']),
			'p_writetime' => urlencode($row['p_writetime']),
			'p_id' => urlencode($row['p_id']),
			'p_name' => urlencode($row['p_name']),
	);
}
echo urldecode(json_encode($arr));
?>

