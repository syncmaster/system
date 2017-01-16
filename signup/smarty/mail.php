<?php
require ("libs/Smarty.class.php");
include 'boot.php';
$smarty = new Smarty();

$smarty->error_reporting = error_reporting() &~E_NOTICE;

$title = "Thanks for your sign up";
$smarty->assign ('title', $title);


$smarty->display("mail.html");