<?php
include 'boot.php';
require ("settings.php");


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
	} /*else if ($response['success'] === false) {
		$emailErr['captcha'] = "Please fill the captcha";
		$smarty->assign("emailErr", $emailErr['captcha']);
	} */else {
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
		`tokens` = '" .$connect->real_escape_string($random). "',
		`expire_date` = NOW()
		WHERE
		`email` = '" .$connect->real_escape_string($email). "' ";
		if ($connect->query($sql)) {
			$reset = "Check your e-mail for your unique link to renew password";
			$smarty->assign("reset", $reset);
			$token = $random;
			$url = 'http://'. $_SERVER['HTTP_HOST'] . '/exercises/signup/smarty/renew.php?token='.$token ;
			$smarty->assign("url", $url);
			$smarty->assign("email", $email);
			$title = "Welcome to our website |www.domain.com|";
			$messege = "Hello";
			$headtext = "We send you e-mail with unique link</br>Where you can renew your password;";
			$secmsg = "Please click link and you will be redirect to a page";
			$smarty->assign('title', $title);
			$smarty->assign('messege', $messege);
			$smarty->assign('headtext', $headtext);
			$smarty->assign('secmsg', $secmsg);
			$mail->Subject = 'Reset Your Password';
			$mail->addAddress($email);
			$message = $smarty->fetch('templates/mail_password.html');
			$mail->MsgHTML($message);
			$mail->send();
		}

	}
$smarty->assign('emailErr', $emailErr);
}
$smarty->display("forgot.html");
