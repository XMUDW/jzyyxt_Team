<?php
if(!isset($_COOKIE['PHPSESSID'])) {
   echo "<script>prompt('登陆超时，请重新登陆！');</script>";
   echo "<meta http-equiv = 'Refresh' content='0; url = index.php'>";
}
session_id($_COOKIE['PHPSESSID']);
?>