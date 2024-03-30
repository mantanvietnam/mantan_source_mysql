<?php
	global $routesPlugin;

	// apis
	$routesPlugin['getListPositionAPI']= 'hethongdaily/view/api/getListPositionAPI.php';

	$routesPlugin['checkLoginMemberAPI']= 'hethongdaily/view/api/checkLoginMemberAPI.php';
	$routesPlugin['getInfoMemberAPI']= 'hethongdaily/view/api/getInfoMemberAPI.php';
	$routesPlugin['logoutMemberAPI']= 'hethongdaily/view/api/logoutMemberAPI.php';
	$routesPlugin['lockMemberAPI']= 'hethongdaily/view/api/lockMemberAPI.php';
	$routesPlugin['saveChangePassMemberAPI']= 'hethongdaily/view/api/saveChangePassMemberAPI.php';
	$routesPlugin['saveInfoMemberAPI']= 'hethongdaily/view/api/saveInfoMemberAPI.php';
	$routesPlugin['requestCodeForgotPasswordAPI']= 'hethongdaily/view/api/requestCodeForgotPasswordAPI.php';
	$routesPlugin['saveNewPassAPI']= 'hethongdaily/view/api/saveNewPassAPI.php';
	$routesPlugin['updateLastLoginAPI']= 'hethongdaily/view/api/updateLastLoginAPI.php';
	
	$routesPlugin['getListMemberDownAPI']= 'hethongdaily/view/api/getListMemberDownAPI.php';
	$routesPlugin['addMemberDownAPI']= 'hethongdaily/view/api/addMemberDownAPI.php';
	$routesPlugin['searchMemberAPI']= 'hethongdaily/view/api/searchMemberAPI.php';
	
	$routesPlugin['getListCustomerAPI']= 'hethongdaily/view/api/getListCustomerAPI.php';
	$routesPlugin['getInfoCustomerAPI']= 'hethongdaily/view/api/getInfoCustomerAPI.php';
	$routesPlugin['searchCustomerAPI']= 'hethongdaily/view/api/searchCustomerAPI.php';
	
	$routesPlugin['getListCustomerHistoriesAPI']= 'hethongdaily/view/api/getListCustomerHistoriesAPI.php';
	$routesPlugin['saveCustomerHistoryAPI']= 'hethongdaily/view/api/saveCustomerHistoryAPI.php';
	$routesPlugin['updateStatusCustomerHistoryAPI']= 'hethongdaily/view/api/updateStatusCustomerHistoryAPI.php';

	$routesPlugin['resendOTPAPI']= 'hethongdaily/view/api/resendOTPAPI.php';


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
	//$routesPlugin['listPosition']= 'hethongdaily/view/home/position/listPosition.php';

	// thông tin đại lý
	$routesPlugin['info']= 'hethongdaily/view/home/member/info.php';

	// đơn hàng lẻ đại lý
	$routesPlugin['orderCustomerAgency']= 'hethongdaily/view/home/product/orderCustomerAgency.php';
	$routesPlugin['viewOrderCustomerAgency']= 'hethongdaily/view/home/product/viewOrderCustomerAgency.php';
	$routesPlugin['deleteOrderCustomerAgency']= 'hethongdaily/view/home/product/deleteOrderCustomerAgency.php';
	$routesPlugin['updateStatusOrderAgency']= 'hethongdaily/view/home/product/updateStatusOrderAgency.php';
	$routesPlugin['addOrderCustomer']= 'hethongdaily/view/home/product/addOrderCustomer.php';
	$routesPlugin['printBillOrderCustomerAgency']= 'hethongdaily/view/home/product/printBillOrderCustomerAgency.php';

	// yêu cầu mua hàng
	$routesPlugin['requestProductAgency']= 'hethongdaily/view/home/order/requestProductAgency.php';
	$routesPlugin['addRequestProductAgency']= 'hethongdaily/view/home/order/addRequestProductAgency.php';
	$routesPlugin['orderMemberAgency']= 'hethongdaily/view/home/order/orderMemberAgency.php';
	$routesPlugin['printBillOrderMemberAgency']= 'hethongdaily/view/home/order/printBillOrderMemberAgency.php';

	// tạo đơn hàng cho đại lý tuyến dưới 
	$routesPlugin['addOrderAgency']= 'hethongdaily/view/home/order/addOrderAgency.php';
	
	// kho hàng đại lý
	$routesPlugin['warehouseProductAgency']= 'hethongdaily/view/home/warehouse/warehouseProductAgency.php';
	$routesPlugin['historyWarehouseProductAgency']= 'hethongdaily/view/home/warehouse/historyWarehouseProductAgency.php';
	$routesPlugin['viewWarehouseProductAgency']= 'hethongdaily/view/home/warehouse/viewWarehouseProductAgency.php';

	// khách hàng
	$routesPlugin['listCustomerAgency']= 'hethongdaily/view/home/customer/listCustomerAgency.php';
	$routesPlugin['editCustomerAgency']= 'hethongdaily/view/home/customer/editCustomerAgency.php';
	$routesPlugin['guideAddCustomerAPIAgency']= 'hethongdaily/view/home/customer/guideAddCustomerAPIAgency.php';
	
	// nhóm khách hàng
	$routesPlugin['groupCustomerAgency']= 'hethongdaily/view/home/customer/groupCustomerAgency.php';
	
	// lịch sử chăm sóc khách hàng
	$routesPlugin['listCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/listCustomerHistoriesAgency.php';
	$routesPlugin['addCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/addCustomerHistoriesAgency.php';