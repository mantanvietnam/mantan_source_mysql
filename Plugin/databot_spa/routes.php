<?php
	global $routesPlugin;

	// api
	$routesPlugin['searchCustomerApi']= 'databot_spa/view/api/customer/searchCustomerApi.php'; 
	$routesPlugin['searchPartnerApi']= 'databot_spa/view/api/customer/searchPartnerApi.php'; 
	$routesPlugin['searchProductApi']= 'databot_spa/view/api/customer/searchProductApi.php'; 
	$routesPlugin['searchServicesApi']= 'databot_spa/view/api/customer/searchServicesApi.php'; 
	$routesPlugin['searchComboApi']= 'databot_spa/view/api/customer/searchComboApi.php'; 
	$routesPlugin['searchStaffApi']= 'databot_spa/view/api/customer/searchStaffApi.php'; 
	$routesPlugin['addPartnerAjax']= 'databot_spa/view/api/customer/addPartnerAjax.php'; 

	// member 
	$routesPlugin['login']= 'databot_spa/view/home/member/login.php';
	$routesPlugin['logout']= 'databot_spa/view/home/member/logout.php';
	$routesPlugin['dashboard']= 'databot_spa/view/home/dashboard.php';
	$routesPlugin['changePass']= 'databot_spa/view/home/member/changePass.php';
	$routesPlugin['account']= 'databot_spa/view/home/member/account.php';
	$routesPlugin['forgotPass']= 'databot_spa/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'databot_spa/view/home/member/confirm.php';
	$routesPlugin['register']= 'databot_spa/view/home/member/register.php';
	$routesPlugin['managerSelectSpa']= 'databot_spa/view/home/member/managerSelectSpa.php';
	$routesPlugin['error_permission']= 'databot_spa/view/home/member/error_permission.php';

	$routesPlugin['listProduct']= 'databot_spa/view/home/product/listProduct.php';
	$routesPlugin['listCategoryProduct']= 'databot_spa/view/home/product/listCategoryProduct.php';
	$routesPlugin['deleteCategoryProduct']= 'databot_spa/view/home/product/deleteCategoryProduct.php';
	$routesPlugin['listTrademarkProduct']= 'databot_spa/view/home/product/listTrademarkProduct.php';
	$routesPlugin['deleteTrademarkProduct']= 'databot_spa/view/home/product/deleteTrademarkProduct.php';
	$routesPlugin['addProduct']= 'databot_spa/view/home/product/addProduct.php';
	$routesPlugin['deleteProduct']= 'databot_spa/view/home/product/deleteProduct.php';
	$routesPlugin['addProductWarehouse']= 'databot_spa/view/home/product/addProductWarehouse.php';
	$routesPlugin['importHistorytWarehouse']= 'databot_spa/view/home/product/importHistorytWarehouse.php';

	//spa
	$routesPlugin['listSpa']= 'databot_spa/view/home/spa/listSpa.php';
	$routesPlugin['addSpa']= 'databot_spa/view/home/spa/addSpa.php';
	$routesPlugin['deleteSpa']= 'databot_spa/view/home/spa/deleteSpa.php';
	$routesPlugin['listWarehouse']= 'databot_spa/view/home/warehouse/listWarehouse.php';
	$routesPlugin['addWarehouse']= 'databot_spa/view/home/warehouse/addWarehouse.php';
	$routesPlugin['deteleWarehouse']= 'databot_spa/view/home/warehouse/deteleWarehouse.php';

	$routesPlugin['listCustomer']= 'databot_spa/view/home/customer/listCustomer.php';
	$routesPlugin['addCustomer']= 'databot_spa/view/home/customer/addCustomer.php';
	$routesPlugin['deleteCustomer']= 'databot_spa/view/home/customer/deleteCustomer.php';
	$routesPlugin['listCategoryCustomer']= 'databot_spa/view/home/customer/listCategoryCustomer.php';
	$routesPlugin['deleteCategoryCustomer']= 'databot_spa/view/home/customer/deleteCategoryCustomer.php';
	$routesPlugin['listSourceCustomer']= 'databot_spa/view/home/customer/listSourceCustomer.php';
	$routesPlugin['addDataCustomer']= 'databot_spa/view/home/customer/addDataCustomer.php';
	$routesPlugin['listMedicalHistories']= 'databot_spa/view/home/customer/listMedicalHistories.php';
	$routesPlugin['addMedicalHistories']= 'databot_spa/view/home/customer/addMedicalHistories.php';
	
	$routesPlugin['listStaff']= 'databot_spa/view/home/staff/listStaff.php';
	$routesPlugin['addStaff']= 'databot_spa/view/home/staff/addStaff.php';
	$routesPlugin['lockStaff']= 'databot_spa/view/home/staff/lockStaff.php';
	$routesPlugin['listGroupStaff']= 'databot_spa/view/home/staff/listGroupStaff.php';
	$routesPlugin['addGroupStaff']= 'databot_spa/view/home/staff/addGroupStaff.php';
	$routesPlugin['changePassStaff']= 'databot_spa/view/home/staff/changePassStaff.php';

	$routesPlugin['listService']= 'databot_spa/view/home/service/listService.php';
	$routesPlugin['addService']= 'databot_spa/view/home/service/addService.php';
	$routesPlugin['deleteService']= 'databot_spa/view/home/service/deleteService.php';
	$routesPlugin['listCategoryService']= 'databot_spa/view/home/service/listCategoryService.php';
	$routesPlugin['deleteCategoryService']= 'databot_spa/view/home/service/deleteCategoryService.php';
	$routesPlugin['listRoom']= 'databot_spa/view/home/room/listRoom.php';
	$routesPlugin['deleteRoom']= 'databot_spa/view/home/room/deleteRoom.php';
	$routesPlugin['listBed']= 'databot_spa/view/home/bed/listBed.php';
	$routesPlugin['deleteBed']= 'databot_spa/view/home/bed/deleteBed.php';
	$routesPlugin['listRoomBed']= 'databot_spa/view/home/bed/listRoomBed.php';
	$routesPlugin['infoRoomBed']= 'databot_spa/view/home/bed/infoRoomBed.php';
	$routesPlugin['cancelBed']= 'databot_spa/view/home/bed/cancelBed.php';
	$routesPlugin['checkoutBed']= 'databot_spa/view/home/bed/checkoutBed.php';

	$routesPlugin['listCombo']= 'databot_spa/view/home/combo/listCombo.php';
	$routesPlugin['addCombo']= 'databot_spa/view/home/combo/addCombo.php';
	$routesPlugin['deleteCombo']= 'databot_spa/view/home/combo/deleteCombo.php';

	$routesPlugin['listBook']= 'databot_spa/view/home/book/listBook.php';
	$routesPlugin['listBookCalendar']= 'databot_spa/view/home/book/listBookCalendar.php';
	$routesPlugin['addBook']= 'databot_spa/view/home/book/addBook.php';
	$routesPlugin['deleteBook']= 'databot_spa/view/home/book/deleteBook.php';

	$routesPlugin['listPrepayCard']= 'databot_spa/view/home/prepayCard/listPrepayCard.php';
	$routesPlugin['addPrepayCard']= 'databot_spa/view/home/prepayCard/addPrepayCard.php';
	$routesPlugin['deletePrepayCard']= 'databot_spa/view/home/prepayCard/deletePrepayCard.php';
	$routesPlugin['buyPrepayCard']= 'databot_spa/view/home/prepayCard/buyPrepayCard.php';
	$routesPlugin['printInfoBillCard']= 'databot_spa/view/home/prepayCard/printInfoBillCard.php';
	$routesPlugin['listCustomerPrepayCard']= 'databot_spa/view/home/prepayCard/listCustomerPrepayCard.php';
	$routesPlugin['listCustomerPrepayCardAPI']= 'databot_spa/view/home/prepayCard/listCustomerPrepayCardAPI.php';

	//bill 
	$routesPlugin['listCollectionBill']= 'databot_spa/view/home/bill/listCollectionBill.php';
	$routesPlugin['addCollectionBill']= 'databot_spa/view/home/bill/addCollectionBill.php';
	$routesPlugin['listBill']= 'databot_spa/view/home/bill/listBill.php';
	$routesPlugin['addBill']= 'databot_spa/view/home/bill/addBill.php';
	$routesPlugin['deleteBill']= 'databot_spa/view/home/bill/deleteBill.php';
	$routesPlugin['printCollectionBill']= 'databot_spa/view/home/bill/printCollectionBill.php';
	$routesPlugin['printBill']= 'databot_spa/view/home/bill/printBill.php';
	$routesPlugin['detailCollectionBill']= 'databot_spa/view/home/bill/detailCollectionBill.php';

	// debt 
	$routesPlugin['listCollectionDebt']= 'databot_spa/view/home/debt/listCollectionDebt.php';
	$routesPlugin['addCollectionDebt']= 'databot_spa/view/home/debt/addCollectionDebt.php';
	$routesPlugin['paymentCollectionBill']= 'databot_spa/view/home/debt/paymentCollectionBill.php';
	$routesPlugin['listPayableDebt']= 'databot_spa/view/home/debt/listPayableDebt.php';
	$routesPlugin['addPayableDebt']= 'databot_spa/view/home/debt/addPayableDebt.php';
	$routesPlugin['paymentBill']= 'databot_spa/view/home/debt/paymentBill.php';

	$routesPlugin['listPartner']= 'databot_spa/view/home/partner/listPartner.php';
	$routesPlugin['addPartner']= 'databot_spa/view/home/partner/addPartner.php';
	$routesPlugin['deletePartner']= 'databot_spa/view/home/partner/deletePartner.php';

	// khách hàng 
	$routesPlugin['orderProduct']= 'databot_spa/view/home/order/orderProduct.php';
	$routesPlugin['orderCombo']= 'databot_spa/view/home/order/orderCombo.php';
	$routesPlugin['orderService']= 'databot_spa/view/home/order/orderService.php';
	$routesPlugin['listOrder']= 'databot_spa/view/home/order/listOrder.php';
	$routesPlugin['printInfoOrder']= 'databot_spa/view/home/order/printInfoOrder.php';
	$routesPlugin['listOrderProduct']= 'databot_spa/view/home/order/listOrderProduct.php';
	$routesPlugin['listOrderCombo']= 'databot_spa/view/home/order/listOrderCombo.php';
	$routesPlugin['listOrderService']= 'databot_spa/view/home/order/listOrderService.php';
	$routesPlugin['listUserserviceHistories']= 'databot_spa/view/home/order/listUserserviceHistories.php';

	
	
	// chiến dịch 
	$routesPlugin['listCampain']= 'databot_spa/view/home/campain/listCampain.php';
	$routesPlugin['addCampain']= 'databot_spa/view/home/campain/addCampain.php';
	$routesPlugin['deleteCampain']= 'databot_spa/view/home/campain/deleteCampain.php';

	$routesPlugin['listCustomerCampaign']= 'databot_spa/view/home/campain_customer/listCustomerCampaign.php';
	$routesPlugin['deleteCustomerCampain']= 'databot_spa/view/home/campain_customer/deleteCustomerCampain.php';

	// hướng dẫn tích hợp api
	$routesPlugin['guideAddCustomerCampainApi']= 'databot_spa/view/home/guide/guideAddCustomerCampainApi.php';

	// thống kê 
	$routesPlugin['revenueStatistical']= 'databot_spa/view/home/statistical/revenueStatistical.php';

	// giao dịch
	$routesPlugin['transactionHistories']= 'databot_spa/view/home/transaction/transactionHistories.php';
	$routesPlugin['createRequestAddMoney']= 'databot_spa/view/home/transaction/createRequestAddMoney.php';
	$routesPlugin['updateBankingAPI']= 'databot_spa/view/home/transaction/updateBankingAPI.php';


	// chiết khấu 
	$routesPlugin['listAgency']= 'databot_spa/view/home/agency/listAgency.php';

	// zalo
	$routesPlugin['settingZaloMarketing']= 'databot_spa/view/home/zalo/settingZaloMarketing.php';
	$routesPlugin['callbackZalo']= 'databot_spa/view/home/zalo/callbackZalo.php';
	$routesPlugin['callbackZaloOA']= 'databot_spa/view/home/zalo/callbackZaloOA.php';
	$routesPlugin['addFriendZaloMarketing']= 'databot_spa/view/home/zalo/addFriendZaloMarketing.php';
	$routesPlugin['sendMessZaloOA']= 'databot_spa/view/home/zalo/sendMessZaloOA.php';

	$routesPlugin['listTemplateZNSZalo']= 'databot_spa/view/home/zalo_templates/listTemplateZNSZalo.php';
	

?>