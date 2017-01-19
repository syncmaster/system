<?php
require_once 'phpmail/PHPMailerAutoload.php';

$mail = new PHPMailer;
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;

$title = "Welcome to our website |www.domain.com|";
$smarty->assign('title', $title);

$messege = "Hello";
$headtext = "We send you e-mail with unique link</br>Where you can renew your password;";
$secmsg = "Please click link and you will be redirect to a page";


$smarty->assign('messege', $messege);
$smarty->assign('headtext', $headtext);
$smarty->assign('secmsg', $secmsg);

$message = $smarty->fetch('templates/mail_password.html');

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = 'smtp.gmail.com';
$mail->Username = 'plamenp6@gmail.com';
$mail->Password = '159357paco';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->From = 'support@domain.com';
$mail->FromName = 'Admin';
$mail->addReplyTo('reply@domain.com', 'Admin');
$mail->addAddress($email, 'Plamen Penchev');
$mail->MsgHTML($message);
$mail->IsHTML(true);
$mail->CharSet="utf-8";

$mail->Subject = 'Thank you for registration';
$mail->Body = ($message,);
$mail->AltBody = "Have a nice day";


