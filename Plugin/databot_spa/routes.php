<?php
	global $routesPlugin;

	// member
	$routesPlugin['login']= 'databot_spa/view/home/member/login.php';
	$routesPlugin['logout']= 'databot_spa/view/home/member/logout.php';
	$routesPlugin['dashboard']= 'databot_spa/view/home/dashboard.php';
	$routesPlugin['changePass']= 'databot_spa/view/home/member/changePass.php';
	$routesPlugin['account']= 'databot_spa/view/home/member/account.php';
	$routesPlugin['forgotPass']= 'databot_spa/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'databot_spa/view/home/member/confirm.php';
	$routesPlugin['register']= 'databot_spa/view/home/member/register.php';
	$routesPlugin['managerSelectSpa']= 'databot_spa/view/home/member/managerSelectSpa.php';

	$routesPlugin['listProduct']= 'databot_spa/view/home/product/listProduct.php';
	$routesPlugin['listCategoryProduct']= 'databot_spa/view/home/product/listCategoryProduct.php';
	$routesPlugin['deleteCategoryProduct']= 'databot_spa/view/home/product/deleteCategoryProduct.php';
	$routesPlugin['listTrademarkProduct']= 'databot_spa/view/home/product/listTrademarkProduct.php';
	$routesPlugin['deleteTrademarkProduct']= 'databot_spa/view/home/product/deleteTrademarkProduct.php';

	//spa
	$routesPlugin['listSpa']= 'databot_spa/view/home/spa/listSpa.php';
	$routesPlugin['addSpa']= 'databot_spa/view/home/spa/addSpa.php';
	$routesPlugin['deleteSpa']= 'databot_spa/view/home/spa/deleteSpa.php';
?>