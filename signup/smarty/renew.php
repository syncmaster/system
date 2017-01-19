<?php

require ("libs/Smarty.class.php");
include 'boot.php';

define('TIMEOUT', 1*60);
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;
$success = "";
$passErr = array();

if (isset($_POST['submit'])) {
	
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';
	$repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';
	$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);

	$smarty->assign("password", $password);
	
	if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout']) < TIMEOUT) {
		$passErr['loginerr'] = "Your time has expired please go back and renew your token before renew password";
	} else if (empty($password) || empty($repassword)) {
		$passErr['empty'] = "Please fill the fileds";
		$smarty->assign("passErr", $passErr['empty']);
	} else if ($password !== $repassword) {
		$passErr['match'] = "Your password did not match!!!";
		$smarty->assign("passErr", $passErr['match']);
	} else if (mb_strlen($password) < 8 ) {
		$passErr['length'] = "your password need to be a more than 8 symbols";
		$smarty->assign("passErr", $passErr['length']);
	} else if ($response['success'] === false ) {
		$passErr['captcha'] = "Please complete Captcha";
		$smarty->assign("passErr", $passErr['captcha']);
	} else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE users SET
		`password` = '" .$connect->real_escape_string($password). "'
		WHERE
		`email` = '" .$connect->real_escape_string($_SESSION['user']). "'
		AND
		`tokens` = '" .$connect->real_escape_string($_SESSION['token']). "'
		";
		if($connect->query($sql)) {
			$success = "We changed your password succesfully !!!";
			$smarty->assign("success", $success);
		} else {
			$fail = "We not change your password please back after few hours.";
			$smarty->assign("fail", $fail);
		}


	}


$smarty->assign("passErr", $passErr);
}


$smarty->display("renew.html");


