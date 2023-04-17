<?php
	global $routesPlugin;

	// for api
	$routesPlugin['saveCustomerAPI']= '2top_crm/saveCustomerAPI.php';
	$routesPlugin['searchCustomerAPI']= '2top_crm/searchCustomerAPI.php';

	// for home
	$routesPlugin['login']= '2top_crm/view/home/login.php';
	$routesPlugin['register']= '2top_crm/view/home/register.php';
	$routesPlugin['infoUser']= '2top_crm/view/home/infoUser.php';
	$routesPlugin['pourpassword']= '2top_crm/view/home/pourpassword.php';
	$routesPlugin['editInfoUser']= '2top_crm/view/home/editInfoUser.php';
	$routesPlugin['forgotpassword']= '2top_crm/view/home/forgotpassword.php';
	$routesPlugin['newpassword']= '2top_crm/view/home/newpassword.php';
	$routesPlugin['confirm']= '2top_crm/view/home/confirm.php';
?>