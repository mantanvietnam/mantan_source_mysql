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

	// chức danh
	$routesPlugin['listPosition']= 'hethongdaily/view/home/position/listPosition.php';
	

	$routesPlugin['getInfoMemberAPI']= 'hethongdaily/view/api/getInfoMemberAPI.php';
	$routesPlugin['resendOTPAPI']= 'hethongdaily/view/api/resendOTPAPI.php';