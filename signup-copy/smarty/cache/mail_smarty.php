<?php
require_once 'libs/phpmail/PHPMailerAutoload.php';

$mail = new PHPMailer;
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;

$title = "Welcome to our website |www.domain.com|";
$smarty->assign('title', $title);

$messege = "Thank you for sign up in our website";
$headtext = "We apreciate your account and we are here to help you wuth what we can?</br>Feel Free to contact with us whn u have any question about your profile or some suggestions?";
$secmsg = "Have a nice day";

$smarty->assign('messege', $messege);
$smarty->assign('headtext', $headtext);
$smarty->assign('secmsg', $secmsg);

$message = $smarty->fetch('templates/mail.html');

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = 'smtp.gmail.com';
$mail->Username = 'plamenp6@gmail.com';
$mail->Password = '159357paco';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->From = 'plamen.penchew@abv.bg';
$mail->FromName = 'Plamen Penchev';
$mail->addReplyTo('plamen.penchew@abv.bg', 'Plamen Penchev');
$mail->addAddress('plamen.penchew@abv.bg', 'Plamen Penchev');
$mail->MsgHTML($message);
$mail->IsHTML(true);
$mail->CharSet="utf-8";

$mail->Subject = 'Thank you for registration';
$mail->Body = ($message);
$mail->AltBody = "Have a nice day";


