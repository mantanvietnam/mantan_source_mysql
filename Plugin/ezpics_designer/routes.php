<?php
	global $routesPlugin;

	// member
	$routesPlugin['login']= 'ezpics_designer/view/home/member/login.php';
	$routesPlugin['logout']= 'ezpics_designer/view/home/member/logout.php';
	$routesPlugin['dashboard']= 'ezpics_designer/view/home/dashboard.php';

	// product
	$routesPlugin['listProduct']= 'ezpics_designer/view/home/product/listProduct.php';
	$routesPlugin['deleteProduct']= 'ezpics_designer/view/home/product/deleteProduct.php';
	$routesPlugin['addProduct']= 'ezpics_designer/view/home/product/addProduct.php';
?>