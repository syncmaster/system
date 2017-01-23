<?php
include './app/boot.php';



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
