<?php
session_start ();
setcookie('PHPSESSID', session_id(), time()+10,'/');
$_SESSION ['stuno'] = $_POST ["username"];
$stuno = $_POST ["username"];
$stupassword = strtoupper ( md5 ( $_POST ["password"] ) );
$_SESSION['userType'] = $_POST['userType'];
$userType = $_POST['userType'];
require_once 'openDB.php';

$msg = "";
// 在这添加权限认证
if($userType=="student") {
	$query = "select * from yq_info where stuno='$stuno'";
	$result = @mysql_query ( $query, $connection ) or die ( "数据库请求失败！" );
	$password = "stupassword";
	
	if ($row = mysql_fetch_array ( $result )) {
		if ($row [$password] == $stupassword) {
			
						$date = date("Y-m-d");
						$countFile = "countSum.json";
						if(!file_exists($countFile)) {
							$data = Array();
							$data[0]=array($date,1);
							$json_string = json_encode($data);
							file_put_contents($countFile, $json_string);
						} else {
							$json_string = file_get_contents($countFile);
							$data = json_decode($json_string, true);
							if($date==end($data)[0]) {
								$data[count($data)-1][1]+=1;
							}else {
								$data[count($data)]=array($date,1);
							}
							$json_string = json_encode($data);
							file_put_contents($countFile, $json_string);
						}
			$msg = "studentsuccess";
		} else {
	
			$msg ="error";
		}
	}else {
		$msg = "null";
	}
}elseif ($userType=="manager") {
	$query = "select * from yq_adminuser where yq_username='$stuno'";
	$result = @mysql_query ( $query, $connection ) or die ( "数据库请求失败！" );
	if ($row = mysql_fetch_array ( $result )) {
		if ($row ["yq_password"] == $stupassword) {
			$msg ="managersuccess";
		} else {
	
			$msg ="error";
		}
	}else {
		$msg = "null";
	}
}
echo $msg;

// function start_session($expire = 0)
// {
// 	if ($expire == 0) {
// 		$expire = ini_get('session.gc_maxlifetime');
// 	} else {
// 		ini_set('session.gc_maxlifetime', $expire);
// 	}
		
	
// }
?>