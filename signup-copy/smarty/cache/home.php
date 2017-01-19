<?php
require ("libs/smarty/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->error_reporting = error_reporting() &~E_NOTICE;

$smarty->display("home.html");