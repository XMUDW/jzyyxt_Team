<?php
if(empty($_COOKIE['PHPSESSID'])) {
   echo "<script>alert('登陆超时，请重新登陆！');</script>";
   echo "<meta http-equiv = 'Refresh' content='0; url = index.php'>";
}
session_id($_COOKIE['PHPSESSID']);
?>