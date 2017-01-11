<?php
$connect = new mysqli("localhost", "root", "", "signupform");
mysqli_set_charset($connect, 'UTF8');

if ($connect->connect_error){
	echo ("Connection Error:" . $connect->connect_error);
}