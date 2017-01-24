<?php

define ('ROOT', __DIR__);
include(ROOT . '/config/settings.php');
require(ROOT . '/libs/phpmail/PHPMailerAutoload.php');
require(ROOT . '/libs/smarty/Smarty.class.php');

@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6);
session_start();

$smarty = new Smarty();
$smarty->setCompileDir(ROOT . '/cache');
$smarty->setTemplateDir(ROOT . '/templates');
$smarty->error_reporting = error_reporting() &~E_NOTICE;

$connect = new mysqli($host_db, $user_db, $password_db, $database);
mysqli_set_charset($connect, 'UTF8');
if ($connect->connect_error){
	echo ("Connection Error:" . $connect->connect_error);
}


$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = $cfg['mail']['hostname'];
$mail->Username = 'plamenp6@gmail.com';
$mail->Password = '0899068628paco';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->From = 'support@domain.com';
$mail->FromName = 'Admin';
$mail->addReplyTo('reply@domain.com', 'Admin');
$mail->IsHTML(true);
$mail->CharSet="utf-8";	
