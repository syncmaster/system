<?php

include 'boot.php';
$page = isset($_GET['page']) ? trim($_GET['page'], '/') : '';

$routes = array(
	'' => 'Home@index', // default route
	'myprofile' => 'Home@myProfile', //vzema imeto na klasa i posle na methoda
	'auth/register' => 'AuthUser@register',
	'auth/login' => 'AuthUser@login',
	'auth/forgot' => 'AuthUser@forgotPassword',
	'auth/reset' => 'AuthUser@renewPassword',
	'auth/logout' => 'AuthUser@logOut'
);

/*
proverqva dali e setnata promenlivata routes s index get page 
i ako e listva klasovete i gi razdelq na klas i metod 
ako ne e go dobavq
*/
if (isset($routes[$page])) {
	list($class, $method) = explode('@', $routes[$page]);
}

if (!class_exists($class)) {
	include(ROOT . '/app/' . $class . '.php');
}

$controller = new $class($smarty, $connect, $mail);
$content = $controller->{$method}();

$smarty->assign('PAGE', $content);
$smarty->display('index.html');