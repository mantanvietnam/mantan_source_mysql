<?php
	global $routesPlugin;

	// tài khoản cá nhân
	$routesPlugin['login']= 'hethongdaily/view/home/member/login.php';
	$routesPlugin['forgotPass']= 'hethongdaily/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'hethongdaily/view/home/member/confirm.php';
	$routesPlugin['verify']= 'hethongdaily/view/home/member/verify.php';
	
	$routesPlugin['changePass']= 'hethongdaily/view/home/member/changePass.php';
	$routesPlugin['account']= 'hethongdaily/view/home/member/account.php';
	
	// đại lý tuyến dưới
	$routesPlugin['listMember']= 'hethongdaily/view/home/member/listMember.php';
	$routesPlugin['addMember']= 'hethongdaily/view/home/member/addMember.php';
	$routesPlugin['updateStatusMember']= 'hethongdaily/view/home/member/updateStatusMember.php';
	$routesPlugin['verifyMember']= 'hethongdaily/view/home/member/verifyMember.php';

	// zalo oa
	$routesPlugin['setttingZaloOA']= 'hethongdaily/view/home/zalo/setttingZaloOA.php';
	$routesPlugin['callbackZalo']= 'hethongdaily/view/home/zalo/callbackZalo.php';
	$routesPlugin['sendMessZaloOA']= 'hethongdaily/view/home/zalo/sendMessZaloOA.php';

	// chức danh
	$routesPlugin['listPosition']= 'hethongdaily/view/home/position/listPosition.php';
	

	$routesPlugin['getInfoMemberAPI']= 'hethongdaily/view/api/getInfoMemberAPI.php';
	$routesPlugin['resendOTPAPI']= 'hethongdaily/view/api/resendOTPAPI.php';

	// thông tin đại lý
	$routesPlugin['info']= 'hethongdaily/view/home/member/info.php';

	// đơn hàng đại lý
	$routesPlugin['orderCustomerAgency']= 'hethongdaily/view/home/product/orderCustomerAgency.php';
	$routesPlugin['viewOrderCustomerAgency']= 'hethongdaily/view/home/product/viewOrderCustomerAgency.php';
	$routesPlugin['deleteOrderCustomerAgency']= 'hethongdaily/view/home/product/deleteOrderCustomerAgency.php';
	$routesPlugin['updateStatusOrderAgency']= 'hethongdaily/view/home/product/updateStatusOrderAgency.php';

	// khách hàng
	$routesPlugin['listCustomerAgency']= 'hethongdaily/view/home/customer/listCustomerAgency.php';
	$routesPlugin['listCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/listCustomerHistoriesAgency.php';
	$routesPlugin['addCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/addCustomerHistoriesAgency.php';