<?php
require_once 'CheckSession.php';

session_start();

$res = ""; // 错误信息
$upfile = $_FILES ["excelUpload"];
$id = $_GET['id'];

// 获取数组里面的值
// 此处用iconv转换编码方式就可以解决warning
//如果excel文件后缀名为.xls，导入这个类
//import("Org.Util.PHPExcel.Reader.Excel5");
//如果excel文件后缀名为.xlsx，导入这下类
//require_once(dirname(__FILE__).'/'.'phpExcel/Excel2007.php');
//xlsx = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
//xls =  application/vnd.ms-excel
$name = date('Y-m-d-H-i-s',time())."考勤信息"; // 上传文件的文件名

$Rname = $_FILES ["excelUpload"] ['name'];
$extend=strrchr($Rname,'.');
$name = $name.$extend;

$type = $upfile ["type"]; // 上传文件的类型
$size = $upfile ["size"]; // 上传文件的大小
$tmp_name = $upfile ["tmp_name"]; // 上传文件的临时存放路径
$error = $upfile ["error"];

$xlsx = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

$destination = dirname ( __FILE__ ) . '\\files\\' . $name;
if (is_uploaded_file ($tmp_name)) {
	
	/**
	 * 0:文件上传成功<br/>
	 * 1：超过了文件大小，在php.ini文件中设置<br/>
	 * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
	 * 3：文件只有部分被上传<br/>
	 * 4：没有文件被上传<br/>
	 * 5：上传文件大小为0
	 */
	if ($error == '0') {
		if ($type == "application/vnd.ms-excel"||$type==$xlsx) {
			
			
			if(move_uploaded_file ( $tmp_name, $destination )){
				
				require_once'openDB.php';
				require_once dirname(__FILE__).'/'.'Classes\PHPExcel.php';
				require_once dirname(__FILE__).'/'.'Classes\PHPExcel\IOFactory.php';
				require_once dirname(__FILE__).'/'.'Classes\PHPExcel\Reader\Excel5.php';
				require_once dirname(__FILE__).'/'.'Classes\PHPExcel\Reader\Excel2007.php';
				$extend=strrchr($Rname,'.');
				$reader_type=($extend==".xlsx")?"Excel2007":"Excel5";
				$objReader=PHPExcel_IOFactory::createReader($reader_type);
				$objPHPExcel=$objReader->load($destination);
				
				$objWorksheet=$objPHPExcel->getActiveSheet();
				
				$sheet=$objPHPExcel->getSheet(0);
				//取得总行数
				$highestRow=$sheet->getHighestRow();
				//取得总列数
				$highestColumn=$sheet->getHighestColumn();
				$highestColumnIndex=PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
				for($row=2;$row<=$highestRow;$row++){
					$strs=array();
					//注意highestColumnIndex的列数索引从0开始
					for($col=0;$col<$highestColumnIndex;$col++){
						$strs[$col]=$objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
					}
// 					$sql="INSERT INTO te(a,b,c) VALUES ('{$strs[0]}','{$strs[1]}','{$strs[2]}')";
					$sqlstr =  "insert into yq_clickcard(yqChair,yqNum,absent) values('$id','{$strs[0]}','{$strs[1]}')";
					mysql_query ( $sqlstr ) or die ( "插入数据库请求失败！" );
					$res="导入成功";
				}
				
			}

			
		
		} else {
			$res = "只能上传xls、xlsx格式的文件";
		}
	}
	
	// 在php.ini修改upload_max_filesize = 2M ，上载文件的最大许可大小 ，修改为：upload_max_filesize = 10M
} elseif ($error == '1') {
	$res = "上传文件过大";
} else {
	$res = "请先选择文件";
}
echo $res;

?>
