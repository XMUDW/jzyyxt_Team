<?php
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl;charset=UTF-8");
header("Content-Type:application/octet-stream;charset=UTF-8");
header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=NameList.xls");
header("Content-Transfer-Encoding:binary");

require_once 'openDB.php';
require_once dirname(__FILE__).'/'.'Classes\PHPExcel.php';
require_once dirname(__FILE__).'\\Classes\\'.'PHPExcel\IOFactory.php';

$objPHPExcel=new PHPExcel();

$id = $_GET['id'];

$sqlstr1="select stuno,stuname,grade from yq_info,yq_bookchair where yq_info.stuno=yq_bookchair.yqBooKNum and yqBookChair='$id' ";

$rs1 =  mysql_query ( $sqlstr1 ) or die ( "sqlstrA数据库请求失败！" );

//   $data=array(
//   0=>array('id'=>2013,'name'=>'张某某','age'=>21),
//   1=>array('id'=>201,'name'=>'EVA','age'=>21)
//   );
//设置excel列名
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','学号');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','姓名');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','年级');
//把数据循环写入excel中
//   foreach($data as $key => $value){
//        $key+=2;
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key,$value['id']);
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key,$value['name']);
//      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key,$value['age']);
//   }
$i='2';
while($myrow = mysql_fetch_array($rs1)) {
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,$myrow['stuno']);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i,$myrow['stuname']);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$myrow['grade']);
	$i++;
}


//excel保存在根目录下  如要导出文件，以下改为注释代码
//   $objPHPExcel->getActiveSheet() -> setTitle('SetExcelName');
//   $objPHPExcel-> setActiveSheetIndex(0);
//   $objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
//   $objWriter -> save('SetExcelName.xlsx');
//导出代码
$objPHPExcel->getActiveSheet() -> setTitle('预约名单');
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