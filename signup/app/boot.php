<?php
include("settings.php");
require("./libs/smarty/Smarty.class.php");
@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6);
session_start();

$smarty = new Smarty();

$smarty->error_reporting = error_reporting() &~E_NOTICE;


$connect = new mysqli($host_db, $user_db, $password_db, $database);
mysqli_set_charset($connect, 'UTF8');
if ($connect->connect_error){
	echo ("Connection Error:" . $connect->connect_error);
}
