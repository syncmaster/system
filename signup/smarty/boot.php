<?php
$connect = new mysqli("localhost", "root", "", "signupform");
mysqli_set_charset($connect, 'UTF8');
if ($connect->connect_error){
	echo ("Connection Error:" . $connect->connect_error);
}
@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6);
session_start();