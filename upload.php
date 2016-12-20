<?php
session_start();

$_SESSION ['uploaded'] = false;
$_SESSION ['filename'] = '';
$res = ""; // 错误信息
$upfile = $_FILES ["fileToUpload"];
// 获取数组里面的值
// 此处用iconv转换编码方式就可以解决warning
$name = iconv ( "UTF-8", "gb2312", $_FILES ["fileToUpload"] ['name'] ); // 上传文件的文件名
$type = $upfile ["type"]; // 上传文件的类型
$size = $upfile ["size"]; // 上传文件的大小
$tmp_name = $upfile ["tmp_name"]; // 上传文件的临时存放路径
$error = $upfile ["error"];
$destination = dirname ( __FILE__ ) . '\\files\\' . $name;
$docx = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";

if (is_uploaded_file ( $_FILES ['fileToUpload'] ['tmp_name'] )) {
	
	/**
	 * 0:文件上传成功<br/>
	 * 1：超过了文件大小，在php.ini文件中设置<br/>
	 * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
	 * 3：文件只有部分被上传<br/>
	 * 4：没有文件被上传<br/>
	 * 5：上传文件大小为0
	 * application/vnd.openxmlformats-officedocument.wordprocessingml.document  docx類型
	 */
	if ($error == '0') {
		if ($type == "application/pdf"||$type==$docx||$type == "application/msword") {
			move_uploaded_file ( $tmp_name, $destination );
			$_SESSION ['uploaded'] = true;
			$_SESSION ['filename'] = $name;
			$res = "ok";
		} else {
			$res = "errorType";
		}
	}
	
	// 在php.ini修改upload_max_filesize = 2M ，上载文件的最大许可大小 ，修改为：upload_max_filesize = 10M
} elseif ($error == '1') {
	$res = "errorSize";
}
echo $res;
?>
