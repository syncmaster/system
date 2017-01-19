<?php

$page = isset($_GET['page']) ? $_GET['page'] : '';

switch (trim($page, '/')) {
	case 'auth/login':
		include('login.php');
		break;
	case 'auth/register':
		include('signup.php');
		break;
	case 'auth':
		header("Location: /exercises/signup/");
		exit;
		break;
	default:
		echo 'home';
}