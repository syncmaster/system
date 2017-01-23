<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/exercises/signup/libs/phpmail/PHPMailerAutoload.php';
//database info
$database = "signupform";
$user_db = "root";
$password_db = "";
$host_db = "localhost";


$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'plamenp6@gmail.com';
$mail->Password = '0899068628paco';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->From = 'support@domain.com';
$mail->FromName = 'Admin';
$mail->addReplyTo('reply@domain.com', 'Admin');
$mail->IsHTML(true);
$mail->CharSet="utf-8";	

