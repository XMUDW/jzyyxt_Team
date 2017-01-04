<?php
unset($_SESSION);
@session_destroy();
setcookie('PHPSESSID', session_id(), time()-1,'/');
echo "<meta http-equiv = 'Refresh' content='0; url = index.php'>";
?>