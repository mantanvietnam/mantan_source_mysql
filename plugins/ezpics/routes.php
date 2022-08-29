<?php
	global $routesPlugin;

	$routesPlugin['login']= 'ezpics/view/home/user/login.php';
	$routesPlugin['account']= 'ezpics/view/home/user/account.php';
	$routesPlugin['logout']= 'ezpics/view/home/user/logout.php';
	$routesPlugin['createTemplate']= 'ezpics/view/home/template/createTemplate.php';

	// for api
	$routesPlugin['saveUserRegisterAPI']= 'ezpics/saveUserRegisterAPI.php';
	$routesPlugin['saveTemplateAPI']= 'ezpics/saveTemplateAPI.php';
?>