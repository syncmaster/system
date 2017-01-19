<?php
$connect = new mysqli("localhost", "root", "", "signupform");
mysqli_set_charset($connect, 'UTF8');
if ($connect->connect_error){
	echo ("Connection Error:" . $connect->connect_error);
}
@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6);
session_start();

function GetPHPMail($subject, $message, $toEmail, $toName = '') {
	$mail = new PHPMailer;	

	$mail->isSMTP();
	$mail->SMTPAuth = true;

	$mail->Host = 'smtp.gmail.com';
	$mail->Username = 'plamenp6@gmail.com';
	$mail->Password = '159357paco';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;

	$mail->From = $toFrom;
	$mail->FromName = $toName;
	$mail->addReplyTo('plamen.penchew@abv.bg', 'Plamen Penchev');
	$mail->addAddress('plamen.penchew@abv.bg', 'Plamen Penchev');
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
	$mail->CharSet="utf-8";

	$mail->Subject = 'Thank you for registration';
	$mail->Body = ($message);
	$mail->AltBody = "Have a nice day";
	return $mail;
}


$mail = GetPHPMail();