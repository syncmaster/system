<?php

include $_SERVER['DOCUMENT_ROOT'].'/exercises/signup/app/boot.php';

$title = "Welcome Smarty";

$firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
$age = isset($_POST['age']) ? trim($_POST['age']) : '';
$country = isset($_POST['country']) ? trim($_POST['country']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';
$signup = "";
$validateErr = array();


//Variables for signup form
$smarty->assign('firstname', $firstname);
$smarty->assign('lastname', $lastname);
$smarty->assign('age', $age);
$smarty->assign('country', $country);
$smarty->assign('city', $city);
$smarty->assign('address', $address);
$smarty->assign('email', $email);
$smarty->assign('password', $password);
$smarty->assign('repassword', $repassword);

if (isset($_POST['signup'])) {
	if (empty($firstname)) {
		$validateErr['firstname'] = "Please <b>Enter</b> your <b>FirstName</b> " ;
		$smarty->assign('firstnameErr', $validateErr['firstname']);
	} else if ((mb_strlen($firstname)) < 6 || (mb_strlen($firstname) > 20)){
		$validateErr['firstname'] = "Please <b>Enter</b> your Firstname between 6 and 20 symbols ";
		$smarty->assign('firstnameErr', $validateErr['firstname']);
	}

	if (empty($lastname)) {
		$validateErr['lastname'] = "Please <b>Enter</b> your <b>Lastname</b> ";
		$smarty->assign('lastnameErr', $validateErr['lastname']);
	} else if ((mb_strlen($lastname)) < 6 || (mb_strlen($lastname) > 20)) {
		$validateErr['lastname'] = "Please <b>Enter</b> your <b>Lastname</b> between 6 and 20 symbols ";
		$smarty->assign('lastnameErr', $validateErr['lastname']);
	}

	if (empty($age)) {
		$validateErr['age'] = "Please <b>Enter</b> your <b>Ages</b>! ";
		$smarty->assign('ageErr', $validateErr['age']);
	} else if (($age <= 13) || ($age > 99)) {
		$validateErr['age'] = "Please <b>Enter</b> ages between <b>13 and 99</b>! ";
		$smarty->assign('ageErr', $validateErr['age']);
	}

	if (empty($country)) {
		$validateErr['country'] = "Please choose your <b>Country</b>!";
		$smarty->assign('countryErr', $validateErr['country']);
	}

	if (empty($city)) {
		$validateErr['city'] = "Please <b>Enter</b> your <b>City</b>! ";
		$smarty->assign('cityErr', $validateErr['city']);
	} else if (mb_strlen($city)> 30) {
		$validateErr['city'] = "Please <b>Enter</b> <b>city</b> less than <b>30 symbols</b>!";
		$smarty->assign('cityErr', $validateErr['city']);
	}

	if (empty($address)) {
		$validateErr['address'] = "Please <b><b>Enter</b></b> your <b>Address</b>! ";
		$smarty->assign('addressErr', $validateErr['address']);
	}

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$validateErr['email'] = "Your <b>E-mail</b> is <b>not valid</b>! ";
		$smarty->assign('emailErr', $validateErr['email']);
	} else if (empty($email)) {
		$validateErr['email'] = "Please <b>Enter</b> your <b>E-mail Address</b>! ";
		$smarty->assign('emailErr', $validateErr['email']);
	} else {
		$sql = "SELECT `email`
			FROM users
			WHERE
			`email` = '" . $connect->real_escape_string($email) . "' ";
		$emailresult = $connect->query($sql);
		if ($emailresult->num_rows) {
			$validateErr['email'] = "E-mail address is already registered";
			$smarty->assign('emailErr', $validateErr['email']);
		}
	}

	$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	if ($response["success"] === false){
		$validateErr['captcha'] = "Please complete reCaptcha";
		$smarty->assign('captcha', $validateErr['captcha']);
	}

	if (empty($password) || empty($repassword)) {
		$validateErr['password'] = "Please <b>Enter</b> your <b>Password</b>! ";
		$smarty->assign('passwordErr', $validateErr['password']);
	} else if ($password !== $repassword) {
		$validateErr['password'] =  "Your <b>password</b> did <b>not match</b>! ";
		$smarty->assign('passwordErr', $validateErr['password']);
	} else if (strlen($password) < 8 ) {
		$validateErr['password']  = "Your Password must contain a <b>8 characters</b>! ";
		$smarty->assign('passwordErr', $validateErr['password']);
	}

	if (!count($validateErr)) {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "
			INSERT INTO users (
				`firstname`,
				`lastname`,
				`age`,
				`country`,
				`city`,
				`address`,
				`email`,
				`password`
			) VALUES (
				'" .$connect->real_escape_string($firstname). "',
				'" .$connect->real_escape_string($lastname). "',
				'" .$connect->real_escape_string($age). "',
				'" .$connect->real_escape_string($country). "',
				'" .$connect->real_escape_string($city). "',
				'" .$connect->real_escape_string($address). "',
				'" .$connect->real_escape_string($email). "',
				'" .$connect->real_escape_string($password). "'
			)
		";
		if ($connect->query($sql)) {
			$signup = "Your account had been created..!";
			
			$title = "Welcome to our website |www.domain.com|";
			$messege = "Thank you for sign up in our website";
			$headtext = "We apreciate your account and we are here to help you wuth what we can</br>Feel Free to contact with us whn u have any question about your profile or some suggestions?";
			$secmsg = "Have a nice day";
			$smarty->assign('title', $title);
			$smarty->assign("email", $email);
			$smarty->assign('messege', $messege);
			$smarty->assign('headtext', $headtext);
			$smarty->assign('secmsg', $secmsg);
			$mail->Subject = 'Thank you for your sign up';
			$mail->addAddress($email);
			$message = $smarty->fetch('templates/mail.html');
			$mail->MsgHTML($message);
			$mail->Send();
			$smarty->assign('signup', $signup);
			header("refresh: 10 ;url=login.php");
		} else {
			$signupErr = "something went wrong";
		}
	}
$smarty->assign('validateErr', $validateErr);
}
$smarty->display("index.html");
