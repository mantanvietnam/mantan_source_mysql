<?php
	global $routesPlugin;

	// frontend
	$routesPlugin['login']= 'zoomcheap/view/home/manager/login.php';
	$routesPlugin['register']= 'zoomcheap/view/home/manager/register.php';
	$routesPlugin['logout']= 'zoomcheap/view/home/manager/logout.php';
	$routesPlugin['account']= 'zoomcheap/view/home/manager/account.php';
	$routesPlugin['changePass']= 'zoomcheap/view/home/manager/changePass.php';
	$routesPlugin['confirm']= 'zoomcheap/view/home/manager/confirm.php';
	$routesPlugin['forgotPass']= 'zoomcheap/view/home/manager/forgotPass.php';
	$routesPlugin['dashboard']= 'zoomcheap/view/home/manager/dashboard.php';

	$routesPlugin['listOrder']= 'zoomcheap/view/home/order/listOrder.php';
	$routesPlugin['addOrder']= 'zoomcheap/view/home/order/addOrder.php';

	$routesPlugin['createRoom']= 'zoomcheap/view/home/room/createRoom.php';
	$routesPlugin['room']= 'zoomcheap/view/home/room/room.php';

	$routesPlugin['listHistories']= 'zoomcheap/view/home/histories/listHistories.php';
	$routesPlugin['addMoney']= 'zoomcheap/view/home/histories/addMoney.php';

	$routesPlugin['listLink']= 'zoomcheap/view/home/link/listLink.php';
	$routesPlugin['addLink']= 'zoomcheap/view/home/link/addLink.php';


	$routesPlugin['checkDeadlineOrderAPI']= 'zoomcheap/view/home/checkDeadlineOrderAPI.php';
	$routesPlugin['addMoneyTPBankAPI']= 'zoomcheap/view/home/addMoneyTPBankAPI.php';
	$routesPlugin['updateInfoRoomAPI']= 'zoomcheap/view/home/updateInfoRoomAPI.php';
?>