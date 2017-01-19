<?php
require ("libs/Smarty.class.php");
include 'boot.php';
//require_once '/mail_password.php';

$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;
$reset = "";
$emailErr = array();

if (isset($_POST['submit'])) {
	$email = isset($_POST['email']) ? trim($_POST['email']) : '' ;
	$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);

	$smarty->assign("email", $email);

	If (empty($email)) {
		$emailErr['empty'] = "Please fill your E-mail Address";
		$smarty->assign("emailErr", $emailErr['empty']);
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$emailErr['valid'] = "Please enter Valid Email-Address";
		$smarty->assign("emailErr", $emailErr['valid']);
	} else if ($response['success'] === false) {
		$emailErr['captcha'] = "Please fill the captcha";
		$smarty->assign("emailErr", $emailErr['captcha']);
	} else {
		$sql = "SELECT `email`
			FROM users
			WHERE
			`email` = '" .$connect->real_escape_string($email). "'
			";
		$emailresult = $connect->query($sql);

		if (!$emailresult->num_rows) {
			$emailErr['email'] = "Your e-mail address is not in our database";
			$smarty->assign("emailErr", $emailErr['email']);
		}
	}

	if (!count($emailErr)) {
		$random = substr(md5(microtime()),rand(0,26));
		$sql = "UPDATE users SET
		tokens = '" .$connect->real_escape_string($random). "',
		date = NOW()
		WHERE
		`email` = '" .$connect->real_escape_string($email). "' ";
		if ($connect->query($sql)) {
			$reset = "Check your e-mail for your unique link to renew password";
			$smarty->assign("reset", $reset);
			$_SESSION['user'] = $email;
			$_SESSION['token'] = $random;
			$_SESSION['timeout'] = time();
			$smarty->assign("reset", $reset);
			$url = '/smarty/renew.php?token='.$_SESSION['token'] ;
			$smarty->assign("url", $url);
			echo $_SESSION['timeout'];
			//$mail->send();
		}

	}
$smarty->assign('emailErr', $emailErr);
}
$smarty->display("forgot.html");
