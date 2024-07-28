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
	$routesPlugin['loginAdmin']= 'ezpics_designer/view/home/member/loginAdmin.php';

	// product
	$routesPlugin['listProduct']= 'ezpics_designer/view/home/product/listProduct.php';
	$routesPlugin['listProductbuy']= 'ezpics_designer/view/home/product/listProductbuy.php';
	$routesPlugin['listProductSeries']= 'ezpics_designer/view/home/product/listProductSeries.php';
	$routesPlugin['deleteProduct']= 'ezpics_designer/view/home/product/deleteProduct.php';
	$routesPlugin['addProduct']= 'ezpics_designer/view/home/product/addProduct.php';
	$routesPlugin['addDataSeries']= 'ezpics_designer/view/home/product/addDataSeries.php';
	$routesPlugin['exportFormDataSeries']= 'ezpics_designer/view/home/product/exportFormDataSeries.php';

	// order
	$routesPlugin['orderProduct']= 'ezpics_designer/view/home/order/orderProduct.php';
	$routesPlugin['recharge']= 'ezpics_designer/view/home/order/recharge.php';
	$routesPlugin['detailOrder']= 'ezpics_designer/view/home/order/detailOrder.php';
	$routesPlugin['sellproduct']= 'ezpics_designer/view/home/order/sellproduct.php';
	$routesPlugin['withdrawmoney']= 'ezpics_designer/view/home/order/withdrawmoney.php';
	$routesPlugin['removeimage']= 'ezpics_designer/view/home/order/removeimage.php';
	$routesPlugin['orderWarehouse']= 'ezpics_designer/view/home/order/orderWarehouse.php';
	$routesPlugin['sellWarehouse']= 'ezpics_designer/view/home/order/sellWarehouse.php';

	// public
	$routesPlugin['detail']= 'ezpics_designer/view/home/product/detailProduct.php';
	$routesPlugin['detail-series']= 'ezpics_designer/view/home/product/detailSeries.php';
	$routesPlugin['create-image-series']= 'ezpics_designer/view/home/product/createImageSeries.php';
	$routesPlugin['renderImageFromRabbitMQ']= 'ezpics_designer/view/home/product/renderImageFromRabbitMQ.php';

	$routesPlugin['designer']= 'ezpics_designer/view/home/designer/detailDesigner.php';

	// khách hàng
	$routesPlugin['listCustomer']= 'ezpics_designer/view/home/customer/listCustomer.php';
	$routesPlugin['listFollow']= 'ezpics_designer/view/home/customer/listFollow.php';

	//thống Kê
	$routesPlugin['chartFollow']= 'ezpics_designer/view/home/chart/chartFollow.php';
	$routesPlugin['chartSellProduct']= 'ezpics_designer/view/home/chart/chartSellProduct.php';

	// kho mẫu thiết kế
	$routesPlugin['listWarehouse']= 'ezpics_designer/view/home/warehouse/listWarehouse.php';
	$routesPlugin['addWarehouse']= 'ezpics_designer/view/home/warehouse/addWarehouse.php';
	$routesPlugin['deleteWarehouse']= 'ezpics_designer/view/home/warehouse/deleteWarehouse.php';
	$routesPlugin['detailWarehouse']= 'ezpics_designer/view/home/warehouse/detailWarehouse.php';

	$routesPlugin['listWarehouseUser']= 'ezpics_designer/view/home/warehouse_user/listWarehouseUser.php';
	$routesPlugin['addWarehouseUser']= 'ezpics_designer/view/home/warehouse_user/addWarehouseUser.php';
	$routesPlugin['deleteWarehouseUser']= 'ezpics_designer/view/home/warehouse_user/deleteWarehouseUser.php';
	$routesPlugin['lockWarehouse']= 'ezpics_designer/view/home/warehouse_user/lockWarehouse.php';

	//user 
	$routesPlugin['allProduct']= 'ezpics_designer/view/user/listAllProduct.php';
	$routesPlugin['allWarehouse']= 'ezpics_designer/view/user/listAllWarehouses.php';


?>