<?php
	global $routesPlugin;

	// member
	$routesPlugin['login']= 'ezpics_designer/view/home/member/login.php';
	$routesPlugin['logout']= 'ezpics_designer/view/home/member/logout.php';
	$routesPlugin['dashboard']= 'ezpics_designer/view/home/dashboard.php';
	$routesPlugin['changePass']= 'ezpics_designer/view/home/member/changePass.php';
	$routesPlugin['account']= 'ezpics_designer/view/home/member/account.php';

	// product
	$routesPlugin['listProduct']= 'ezpics_designer/view/home/product/listProduct.php';
	$routesPlugin['deleteProduct']= 'ezpics_designer/view/home/product/deleteProduct.php';
	$routesPlugin['addProduct']= 'ezpics_designer/view/home/product/addProduct.php';

	// order
	$routesPlugin['orderProduct']= 'ezpics_designer/view/home/order/orderProduct.php';
	$routesPlugin['detailOrder']= 'ezpics_designer/view/home/order/detailOrder.php';

	// public
	$routesPlugin['detail']= 'ezpics_designer/view/home/product/detailProduct.php';
?>