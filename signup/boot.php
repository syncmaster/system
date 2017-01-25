<?php

define('APPLICATON', 1);
define('ROOT', __DIR__);
define('URL', dirname($_SERVER['SCRIPT_NAME']));
include(ROOT . '/config/settings.php');
require(ROOT . '/libs/phpmail/PHPMailerAutoload.php');
require(ROOT . '/libs/smarty/Smarty.class.php');
require(ROOT . '/app/BaseController.php');
require(ROOT . '/libs/browser.func.php');


@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6);
session_start();

$smarty = new Smarty();
$smarty->setCompileDir(ROOT . '/cache');
$smarty->setTemplateDir(ROOT . '/templates');
$smarty->error_reporting = error_reporting() &~E_NOTICE;
$smarty->assign('URL', URL);

$connect = new mysqli($host_db, $user_db, $password_db, $database);
mysqli_set_charset($connect, 'UTF8');
if ($connect->connect_error) {
	echo ("Connection Error:" . $connect->connect_error);
}

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = $cfg['mail']['hostname'];
$mail->Username = $cfg['mail']['username'];
$mail->Password = $cfg['mail']['password'];
$mail->SMTPSecure = $cfg['mail']['type'];
$mail->Port = $cfg['mail']['port'];
$mail->From = $cfg['mail']['from_mail'];
$mail->FromName = $cfg['mail']['from_name'];
$mail->addReplyTo = $cfg['mail']['reply'];
$mail->IsHTML(true);
$mail->CharSet = $cfg['mail']['charset'];


$secret_captcha = $captcha['secret'];
$public_key_captcha = $captcha['public'];
$smarty->assign("OPENCAPTCHA", $public_key_captcha);
