<?php
	global $routesPlugin;

	// member
	$routesPlugin['login']= 'ezpics_designer/view/home/member/login.php';
	$routesPlugin['logout']= 'ezpics_designer/view/home/member/logout.php';
	$routesPlugin['dashboard']= 'ezpics_designer/view/home/dashboard.php';
	$routesPlugin['changePass']= 'ezpics_designer/view/home/member/changePass.php';
	$routesPlugin['account']= 'ezpics_designer/view/home/member/account.php';
	$routesPlugin['forgotPass']= 'ezpics_designer/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'ezpics_designer/view/home/member/confirm.php';
	$routesPlugin['register']= 'ezpics_designer/view/home/member/register.php';

	// product
	$routesPlugin['listProduct']= 'ezpics_designer/view/home/product/listProduct.php';
	$routesPlugin['listProductbuy']= 'ezpics_designer/view/home/product/listProductbuy.php';
	$routesPlugin['listProductSeries']= 'ezpics_designer/view/home/product/listProductSeries.php';
	$routesPlugin['deleteProduct']= 'ezpics_designer/view/home/product/deleteProduct.php';
	$routesPlugin['addProduct']= 'ezpics_designer/view/home/product/addProduct.php';

	// order
	$routesPlugin['orderProduct']= 'ezpics_designer/view/home/order/orderProduct.php';
	$routesPlugin['recharge']= 'ezpics_designer/view/home/order/recharge.php';
	$routesPlugin['detailOrder']= 'ezpics_designer/view/home/order/detailOrder.php';
	$routesPlugin['sellproduct']= 'ezpics_designer/view/home/order/sellproduct.php';
	$routesPlugin['withdrawmoney']= 'ezpics_designer/view/home/order/withdrawmoney.php';
	$routesPlugin['removeimage']= 'ezpics_designer/view/home/order/removeimage.php';

	// public
	$routesPlugin['detail']= 'ezpics_designer/view/home/product/detailProduct.php';
	$routesPlugin['detail-series']= 'ezpics_designer/view/home/product/detailSeries.php';
	$routesPlugin['create-image-series']= 'ezpics_designer/view/home/product/createImageSeries.php';

	// khách hàng
	$routesPlugin['listCustomer']= 'ezpics_designer/view/home/customer/listCustomer.php';
?>