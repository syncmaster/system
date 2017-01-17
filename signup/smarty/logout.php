<?php
require ("libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;
session_start();
session_destroy();
header ("Location:home.php");


$smarty->display("logout.html");