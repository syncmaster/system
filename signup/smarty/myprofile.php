<?php
require ("libs/Smarty.class.php");
include 'boot.php';
require_once '/mail_smarty.php';
$smarty = new Smarty();

$smarty->error_reporting = error_reporting() &~E_NOTICE;

$user = array();

if(isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$smarty->assign('user', $user);
	$smarty->assign('utcdiff', $_SESSION['utcdiff']);
} 

if (empty($user)) {
	header("refresh: 5,url=login.php");
}




$smarty->display("myprofile.html");
