<?php 
session_start ();

$stuno = $_SESSION ['stuno'];
$papername=$_POST['paper_name'];
$paperselect = $_POST['paper_select'];
$paperkey = $_POST['paper_key'];
$paperabstract = $_POST['paper_abstract'];
// $paperincluded = $_POST['paper_included']==null?$_POST['paper_included']:1;
$paperauthor = $_POST['paper_author'];
$paperteacher = $_POST['paper_teacher'];
$paperunit = $_POST['paper_unit'];
$paperlab = $_POST['paper_lab'];
$paperpublication = $_POST['paper_publication'];
$papertime = $_POST['paper_time'];

// $info_array = array($stuno,$papername,$paperselect,$paperkey,$paperabstract,$paperincluded);
// var_dump($info_array);




?>
