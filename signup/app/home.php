<?php
require $_SERVER['DOCUMENT_ROOT'].'/exercises/signup/libs/smarty/Smarty.class.php';
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;

$smarty->display("../templates/home.html");