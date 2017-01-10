<?php
$connect = mysqli_connect("localhost", "root", "", "signupform");
mysqli_set_charset($connect, 'UTF8');
if (!$connect) {
	echo ("Connection error" . $connect->connect_error);
}
