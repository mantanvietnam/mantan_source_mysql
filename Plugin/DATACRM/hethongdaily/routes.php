<?php
	global $routesPlugin;

	// fix bug
	$routesPlugin['fixBug']= 'hethongdaily/view/api/fixBug.php';
	$routesPlugin['fixPhoneCustomer']= 'hethongdaily/view/api/fixPhoneCustomer.php';

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
	$routesPlugin['lockAccountAPI']= 'hethongdaily/view/api/lockAccountAPI.php';
	
	$routesPlugin['getListMemberDownAPI']= 'hethongdaily/view/api/getListMemberDownAPI.php';
	$routesPlugin['addMemberDownAPI']= 'hethongdaily/view/api/addMemberDownAPI.php';
	$routesPlugin['searchMemberAPI']= 'hethongdaily/view/api/searchMemberAPI.php';
	
	$routesPlugin['getListCustomerAPI']= 'hethongdaily/view/api/getListCustomerAPI.php';
	$routesPlugin['getInfoCustomerAPI']= 'hethongdaily/view/api/getInfoCustomerAPI.php';
	$routesPlugin['searchCustomerAPI']= 'hethongdaily/view/api/searchCustomerAPI.php';
	
	$routesPlugin['getListCustomerHistoriesAPI']= 'hethongdaily/view/api/getListCustomerHistoriesAPI.php';
	$routesPlugin['saveCustomerHistoryAPI']= 'hethongdaily/view/api/saveCustomerHistoryAPI.php';
	$routesPlugin['updateStatusCustomerHistoryAPI']= 'hethongdaily/view/api/updateStatusCustomerHistoryAPI.php';

	$routesPlugin['addGroupCustomerAPI']= 'hethongdaily/view/api/addGroupCustomerAPI.php';
	$routesPlugin['deleteGroupCustomerAPI']= 'hethongdaily/view/api/deleteGroupCustomerAPI.php';
	$routesPlugin['listGroupCustomerAPI']= 'hethongdaily/view/api/listGroupCustomerAPI.php';
	$routesPlugin['saveInfoCustomerAjax']= 'hethongdaily/view/api/saveInfoCustomerAjax.php';

	$routesPlugin['resendOTPAPI']= 'hethongdaily/view/api/resendOTPAPI.php';

	// cài đặt hệ thống
	$routesPlugin['listPosition']= 'hethongdaily/view/home/system/listPosition.php';
	$routesPlugin['settingSystem']= 'hethongdaily/view/home/system/settingSystem.php';

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
	$routesPlugin['sendMessZaloFollow']= 'hethongdaily/view/home/zalo/sendMessZaloFollow.php';
	$routesPlugin['sendMessZaloZNS']= 'hethongdaily/view/home/zalo/sendMessZaloZNS.php';

	$routesPlugin['templateZaloZNS']= 'hethongdaily/view/home/zalo_templates/templateZaloZNS.php';
	$routesPlugin['addTemplateZaloZNS']= 'hethongdaily/view/home/zalo_templates/addTemplateZaloZNS.php';
	$routesPlugin['deleteTemplateZaloZNS']= 'hethongdaily/view/home/zalo_templates/deleteTemplateZaloZNS.php';

	$routesPlugin['sendNotificationMobile']= 'hethongdaily/view/home/zalo/sendNotificationMobile.php';

	// sms
	$routesPlugin['sendSMS']= 'hethongdaily/view/home/sms/sendSMS.php';
	
	// thông tin đại lý
	$routesPlugin['info']= 'hethongdaily/view/home/member/info.php';

	// đơn hàng lẻ đại lý 
	$routesPlugin['orderCustomerAgency']= 'hethongdaily/view/home/product/orderCustomerAgency.php';
	$routesPlugin['viewOrderCustomerAgency']= 'hethongdaily/view/home/product/viewOrderCustomerAgency.php';
	$routesPlugin['deleteOrderCustomerAgency']= 'hethongdaily/view/home/product/deleteOrderCustomerAgency.php';
	$routesPlugin['updateStatusOrderAgency']= 'hethongdaily/view/home/product/updateStatusOrderAgency.php';
	$routesPlugin['addOrderCustomer']= 'hethongdaily/view/home/product/addOrderCustomer.php';
	$routesPlugin['printBillOrderCustomerAgency']= 'hethongdaily/view/home/product/printBillOrderCustomerAgency.php';
	$routesPlugin['listProductAgency']= 'hethongdaily/view/home/product/listProductAgency.php';
	$routesPlugin['addProductAgency']= 'hethongdaily/view/home/product/addProductAgency.php';
	$routesPlugin['deleteProductAgency']= 'hethongdaily/view/home/product/deleteProductAgency.php';
	$routesPlugin['listCategoryProductAgency']= 'hethongdaily/view/home/product/listCategoryProductAgency.php';
	$routesPlugin['addDataProductAgency']= 'hethongdaily/view/home/product/addDataProductAgency.php';
	$routesPlugin['editOrderCustomerAgency']= 'hethongdaily/view/home/product/editOrderCustomerAgency.php';
	$routesPlugin['listCostsIncurred']= 'hethongdaily/view/home/product/listCostsIncurred.php';

	// yêu cầu mua hàng 
	$routesPlugin['requestProductAgency']= 'hethongdaily/view/home/order/requestProductAgency.php';
	$routesPlugin['addRequestProductAgency']= 'hethongdaily/view/home/order/addRequestProductAgency.php';
	$routesPlugin['orderMemberAgency']= 'hethongdaily/view/home/order/orderMemberAgency.php';
	$routesPlugin['printBillOrderMemberAgency']= 'hethongdaily/view/home/order/printBillOrderMemberAgency.php';
	$routesPlugin['listTransactionAgencyHistorie']= 'hethongdaily/view/home/order/listTransactionAgencyHistorie.php';

	// tạo đơn hàng cho đại lý tuyến dưới 
	$routesPlugin['addOrderAgency']= 'hethongdaily/view/home/order/addOrderAgency.php';
	$routesPlugin['editOrderMemberAgency']= 'hethongdaily/view/home/order/editOrderMemberAgency.php';
	
	// kho hàng đại lý
	$routesPlugin['warehouseProductAgency']= 'hethongdaily/view/home/warehouse/warehouseProductAgency.php';
	$routesPlugin['historyWarehouseProductAgency']= 'hethongdaily/view/home/warehouse/historyWarehouseProductAgency.php';
	$routesPlugin['viewWarehouseProductAgency']= 'hethongdaily/view/home/warehouse/viewWarehouseProductAgency.php';
	$routesPlugin['editProductWarehouse']= 'hethongdaily/view/home/warehouse/editProductWarehouse.php';

	// khách hàng
	$routesPlugin['listCustomerAgency']= 'hethongdaily/view/home/customer/listCustomerAgency.php';
	$routesPlugin['editCustomerAgency']= 'hethongdaily/view/home/customer/editCustomerAgency.php';
	$routesPlugin['addDataCustomerAgency']= 'hethongdaily/view/home/customer/addDataCustomerAgency.php';
	$routesPlugin['guideAddCustomerAPIAgency']= 'hethongdaily/view/home/customer/guideAddCustomerAPIAgency.php';
	$routesPlugin['downloadMMTC']= 'hethongdaily/view/home/customer/downloadMMTC.php';
	$routesPlugin['lockCustomerAgency']= 'hethongdaily/view/home/customer/lockCustomerAgency.php';
	$routesPlugin['listPointCustomer']= 'hethongdaily/view/home/customer/listPointCustomer.php';
	
	// nhóm khách hàng
	$routesPlugin['groupCustomerAgency']= 'hethongdaily/view/home/customer/groupCustomerAgency.php';
	$routesPlugin['deleteGroupCustomerAgency']= 'hethongdaily/view/home/customer/deleteGroupCustomerAgency.php';

	// Lịch hẹn
	$routesPlugin['listAppointmentAgency']= 'hethongdaily/view/home/appointment/listAppointmentAgency.php';
	$routesPlugin['addAppointmentAgency']= 'hethongdaily/view/home/appointment/addAppointmentAgency.php';
	$routesPlugin['calendarAppointmentAgency']= 'hethongdaily/view/home/appointment/calendarAppointmentAgency.php';

	// lịch sử chăm sóc khách hàng 
	$routesPlugin['listCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/listCustomerHistoriesAgency.php';
	$routesPlugin['addCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/addCustomerHistoriesAgency.php';
	$routesPlugin['calendarCustomerHistoriesAgency']= 'hethongdaily/view/home/customer_histories/calendarCustomerHistoriesAgency.php';

	// báo cáo kinh doanh
	$routesPlugin['businessReport']= 'hethongdaily/view/home/static/businessReport.php';
	$routesPlugin['statisticAgency']= 'hethongdaily/view/home/static/statisticAgency.php';

	// lịch sử giao dịch tiền
	$routesPlugin['listTransactionHistories']= 'hethongdaily/view/home/transaction_histories/listTransactionHistories.php';
	$routesPlugin['addMoney']= 'hethongdaily/view/home/transaction_histories/addMoney.php';

	// thư viện 
	$routesPlugin['listAlbum']= 'hethongdaily/view/home/document/listDocument.php';
	$routesPlugin['addAlbum']= 'hethongdaily/view/home/document/addDocument.php';
	$routesPlugin['listAlbuminfo']= 'hethongdaily/view/home/document/listDocumentinfo.php';
	$routesPlugin['addAlbuminfo']= 'hethongdaily/view/home/document/addDocumentinfo.php';

	$routesPlugin['listVideo']= 'hethongdaily/view/home/document/listDocument.php';
	$routesPlugin['addVideo']= 'hethongdaily/view/home/document/addDocument.php';
	$routesPlugin['listVideoinfo']= 'hethongdaily/view/home/document/listDocumentinfo.php';
	$routesPlugin['addVideoinfo']= 'hethongdaily/view/home/document/addDocumentinfo.php';

	$routesPlugin['listDocument']= 'hethongdaily/view/home/document/listDocument.php';
	$routesPlugin['addDocument']= 'hethongdaily/view/home/document/addDocument.php';
	$routesPlugin['listDocumentinfo']= 'hethongdaily/view/home/document/listDocumentinfo.php';
	$routesPlugin['addDocumentinfo']= 'hethongdaily/view/home/document/addDocumentinfo.php';

	// bill phiếu thu chi 
	$routesPlugin['listBill']= 'hethongdaily/view/home/bill/listBill.php';
	$routesPlugin['listCollectionBill']= 'hethongdaily/view/home/bill/listCollectionBill.php';
	$routesPlugin['printCollectionBill']= 'hethongdaily/view/home/bill/printCollectionBill.php';
	$routesPlugin['printBill']= 'hethongdaily/view/home/bill/printBill.php';

	$routesPlugin['listCollectionDebt']= 'hethongdaily/view/home/debt/listCollectionDebt.php';
	$routesPlugin['listPayableDebt']= 'hethongdaily/view/home/debt/listPayableDebt.php';

	// mã giảm giá 
	$routesPlugin['addDiscountCodeAgency']= 'hethongdaily/view/home/discountcode/addDiscountCodeAgency.php';
	$routesPlugin['listDiscountCodeAgency']= 'hethongdaily/view/home/discountcode/listDiscountCodeAgency.php';

	// Affiliater 
	$routesPlugin['listAffiliaterAgency']= 'hethongdaily/view/home/affiliater/listAffiliaterAgency.php';
	$routesPlugin['addAffiliaterAgency']= 'hethongdaily/view/home/affiliater/addAffiliaterAgency.php';
	$routesPlugin['listTransactionAffiliaterAgency']= 'hethongdaily/view/home/affiliater/listTransactionAffiliaterAgency.php';
	$routesPlugin['settingAffiliateAgency']= 'hethongdaily/view/home/affiliater/settingAffiliateAgency.php';

	// xếp hạn thanh viên
	$routesPlugin['listRatingPoint']= 'hethongdaily/view/home/ratingPoint/listRatingPoint.php';

	// quà tặng
	$routesPlugin['listCustomerGiftAgency']= 'hethongdaily/view/home/customer_gift/listCustomerGiftAgency.php';
	$routesPlugin['addCustomerGiftAgency']= 'hethongdaily/view/home/customer_gift/addCustomerGiftAgency.php';
	$routesPlugin['listHistorieCustomerGiftAgency']= 'hethongdaily/view/home/customer_gift/listHistorieCustomerGiftAgency.php';
	

	// nhân viên
	$routesPlugin['listStaff']= 'hethongdaily/view/home/staff/listStaff.php';
	$routesPlugin['addStaff']= 'hethongdaily/view/home/staff/addStaff.php';
	$routesPlugin['timesheetStaff']= 'hethongdaily/view/home/staff/timesheetStaff.php';
	$routesPlugin['staff']= 'hethongdaily/view/home/staff/staff.php';
	$routesPlugin['accountStaff']= 'hethongdaily/view/home/staff/accountStaff.php';
	$routesPlugin['changePassStaff']= 'hethongdaily/view/home/staff/changePassStaff.php';


	// cài đặt đào tạo 
	$routesPlugin['listCourseAgency']= 'hethongdaily/view/home/training/seting/course/listCourseAgency.php';
	$routesPlugin['addCourseAgency']= 'hethongdaily/view/home/training/seting/course/addCourseAgency.php';
	$routesPlugin['deleteCourseAgency']= 'hethongdaily/view/home/training/seting/course/deleteCourseAgency.php';
	$routesPlugin['listCategoryLessonAgency']= 'hethongdaily/view/home/training/seting/course/listCategoryLessonAgency.php';
	$routesPlugin['listLessonAgency']= 'hethongdaily/view/home/training/seting/lesson/listLessonAgency.php';
	$routesPlugin['addLessonAgency']= 'hethongdaily/view/home/training/seting/lesson/addLessonAgency.php';
	$routesPlugin['listTestAgency']= 'hethongdaily/view/home/training/seting/test/listTestAgency.php';
	$routesPlugin['addTestAgency']= 'hethongdaily/view/home/training/seting/test/addTestAgency.php';
	$routesPlugin['listQuestionAgency']= 'hethongdaily/view/home/training/seting/question/listQuestionAgency.php';	
	$routesPlugin['addQuestionAgency']= 'hethongdaily/view/home/training/seting/question/addQuestionAgency.php';	


	// api khách hàng 

	$routesPlugin['saveRegisterCustomerAPI']= 'hethongdaily/view/saveRegisterCustomerAPI.php';
	$routesPlugin['checkLoginCustomerAPI']= 'hethongdaily/view/checkLoginCustomerAPI.php';
	$routesPlugin['forgotPasswordCustomerApi']= 'hethongdaily/view/forgotPasswordCustomerApi.php';
	$routesPlugin['resetPasswordCustomerApi']= 'hethongdaily/view/resetPasswordCustomerApi.php';
	$routesPlugin['logoutCustomerApi']= 'hethongdaily/view/logoutCustomerApi.php';
	$routesPlugin['editInfoCustomerApi']= 'hethongdaily/view/editInfoCustomerApi.php';
	$routesPlugin['editPassCustomerApi']= 'hethongdaily/view/editPassCustomerApi.php';
	$routesPlugin['getInfoUserCustomerAPI']= 'hethongdaily/view/getInfoUserCustomerAPI.php';