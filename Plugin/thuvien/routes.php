	<?php
	global $routesPlugin;

	// tài khoản cá nhân
	$routesPlugin['login']= 'thuvien/view/home/member/login.php';
	$routesPlugin['register']= 'thuvien/view/home/member/register.php';
	$routesPlugin['logout']= 'thuvien/view/home/member/logout.php';
	$routesPlugin['forgotPass']= 'thuvien/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'thuvien/view/home/member/confirm.php';
	$routesPlugin['changePass']= 'thuvien/view/home/member/changePass.php';
	$routesPlugin['account']= 'thuvien/view/home/member/account.php';
	$routesPlugin['dashboard']= 'thuvien/view/home/dashboard.php';
	$routesPlugin['listPermission']= 'thuvien/view/home/member/listPermission.php';
	$routesPlugin['addPermission']= 'thuvien/view/home/member/addPermission.php';
	$routesPlugin['listMember']= 'thuvien/view/home/member/listMember.php';
	$routesPlugin['addMember']= 'thuvien/view/home/member/addMember.php';
	$routesPlugin['listActivityHistory']= 'thuvien/view/home/member/listActivityHistory.php';
	$routesPlugin['managerSelectBuilding']= 'thuvien/view/home/member/managerSelectBuilding.php';


	// quan ly sach 
	$routesPlugin['listbook']= 'thuvien/view/home/book/listbook.php';
	$routesPlugin['addbook']= 'thuvien/view/home/book/addbook.php';
	$routesPlugin['statisticalnumberbook']= 'thuvien/view/home/statistical/statisticalnumberbook.php';
	$routesPlugin['statisticalorderbookborrow']= 'thuvien/view/home/statistical/statisticalorderbookborrow.php';
	$routesPlugin['statisticalorderbookpay']= 'thuvien/view/home/statistical/statisticalorderbookpay.php';
	$routesPlugin['statisticalorderbookborrowten']= 'thuvien/view/home/statistical/statisticalorderbookborrowten.php';


	$routesPlugin['categorybook']= 'thuvien/view/home/book/categorybook.php';
	$routesPlugin['documenteditor']= 'thuvien/view/home/book/documenteditor.php';
	$routesPlugin['historybook']= 'thuvien/view/home/book/historybook.php';
	$routesPlugin['addDatabook']= 'thuvien/view/home/book/addDatabook.php';
	$routesPlugin['serchBook']= 'thuvien/view/home/book/serchBook.php';
	$routesPlugin['detailBook']= 'thuvien/view/home/book/detailBook.php';
	$routesPlugin['changequanlitybook']= 'thuvien/view/home/book/changequanlitybook.php';
	//quản lý chức vụ
	$routesPlugin['listCategory']= 'thuvien/view/home/category/listCategory.php';

	$routesPlugin['listBuilding']= 'thuvien/view/home/building/listBuilding.php';
	$routesPlugin['addBuilding']= 'thuvien/view/home/building/addBuilding.php';

	$routesPlugin['listFloor']= 'thuvien/view/home/floor/listFloor.php';
	$routesPlugin['addFloor']= 'thuvien/view/home/floor/addFloor.php';

	$routesPlugin['listRoom']= 'thuvien/view/home/room/listRoom.php';
	$routesPlugin['addRoom']= 'thuvien/view/home/room/addRoom.php';

	$routesPlugin['listShelf']= 'thuvien/view/home/shelf/listShelf.php';
	$routesPlugin['addShelf']= 'thuvien/view/home/shelf/addShelf.php';
	$routesPlugin['listWarehouse']= 'thuvien/view/home/warehouse/listWarehouse.php';
	$routesPlugin['addWarehouse']= 'thuvien/view/home/warehouse/addWarehouse.php';
	$routesPlugin['listWarehouseHistory']= 'thuvien/view/home/warehouse/listWarehouseHistory.php';
	
	//quản lý nhà xuất bản list
	$routesPlugin['listPublisher']= 'thuvien/view/home/publisher/listPublisher.php';
	$routesPlugin['addPublisher']= 'thuvien/view/home/publisher/addPublisher.php';

	//Quản lý người mượn sách
	$routesPlugin['listCustomer']= 'thuvien/view/home/customer/listCustomer.php';
	$routesPlugin['addCustomer']= 'thuvien/view/home/customer/addCustomer.php';

	//Quản lý mượn sách
	$routesPlugin['listOrder']= 'thuvien/view/home/order/listOrder.php';
	$routesPlugin['addOrder']= 'thuvien/view/home/order/addOrder.php';
	$routesPlugin['listOrderDetail']= 'thuvien/view/home/order/listOrderDetail.php';
