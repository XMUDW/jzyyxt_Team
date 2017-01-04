<?php
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl;charset=UTF-8");
header("Content-Type:application/octet-stream;charset=UTF-8");
header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=csat.xls");
header("Content-Transfer-Encoding:binary");

require_once 'openDB.php';
require_once dirname(__FILE__).'/'.'Classes\PHPExcel.php';
require_once dirname(__FILE__).'\\Classes\\'.'PHPExcel\IOFactory.php';

$objPHPExcel=new PHPExcel();

if(isset($_GET['grade'])) {
	$strGrade = ($_GET['grade']=='')?"2016":$_GET['grade'];
} else {
	$strGrade = "";
}

if(isset($_GET['term'])) {
	$strTerm = ($_GET['term']=='')?"":"and chTerm =".$_GET['term'];
	$term = ($_GET['term']=='')?"全部":$_GET['term'];
} else {
	$strTerm = "";
	$term = "全部";
}

if(isset($_GET['operation'])) {
	$strBuilder = '';
	$times = $_GET['times'];
	switch ($_GET['operation']) {
		case '大于':
			$oper = ">";
			$strBuilder = "having total".$oper.$times;
			break;
		case '小于':
			$oper = "<";
			$strBuilder = "having total".$oper.$times;
			break;
		case '等于':
			$oper = "=";
			$strBuilder = "having total".$oper.$times;
			break;
		case '':
			$strBuilder = '';
			break;
	}
} else {
	$strBuilder = '';
}



$sqlstr="select stuno, stuname, grade,chTerm,count(*) as total from yq_bookchair,yq_info,yq_chair where yq_bookchair.yqBookNum=yq_info.stuno and yq_bookchair.yqBookChair=yq_chair.id and grade='$strGrade'  GROUP BY stuno  $strBuilder ";

$rs =  mysql_query ( $sqlstr ) or die ( "sqlstr数据库请求失败！" );

//   $data=array(
//   0=>array('id'=>2013,'name'=>'张某某','age'=>21),
//   1=>array('id'=>201,'name'=>'EVA','age'=>21)
//   );
//设置excel列名
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','学号');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','姓名');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','年级');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','学期');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','次数');
//把数据循环写入excel中
//   foreach($data as $key => $value){
//        $key+=2;
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key,$value['id']);
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key,$value['name']);
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key,$value['age']);
//   }
$i='2';
while($myrow = mysql_fetch_array($rs)) {
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,$myrow['stuno']);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i,$myrow['stuname']);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$myrow['grade']);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i,$term);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i,$myrow['total']);
	$i++;
}


//excel保存在根目录下  如要导出文件，以下改为注释代码
//   $objPHPExcel->getActiveSheet() -> setTitle('SetExcelName');
//   $objPHPExcel-> setActiveSheetIndex(0);
//   $objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
//   $objWriter -> save('SetExcelName.xlsx');
//导出代码
$objPHPExcel->getActiveSheet() -> setTitle('考勤信息');
$objPHPExcel-> setActiveSheetIndex(0);
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$objWriter->save("php://output");

//   $objPHPExcel->getActiveSheet() -> setTitle('考勤信息');
//   $objPHPExcel-> setActiveSheetIndex(0);
//   $objWriter = PHPExcel_IOFactory :: createWriter($objPHPExcel, 'Excel2007');
//   $filename = '考勤信息'.'xlsx';
//   ob_end_clean();//清除缓冲区,避免乱码
//   $filename=iconv("utf-8","gb2312",$filename);
//   header('Content-Type: application/vnd.ms-excel;charset=UTF-8');
//   header('Content-Type: application/octet-stream;charset=UTF-8');
//   header('Content-Disposition: attachment; filename="' . $filename . '"');
//   header('Cache-Control: max-age=0');
//   $objWriter -> save('php://output');
exit;
?>