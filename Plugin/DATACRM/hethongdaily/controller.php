<?php 
include_once('controller/home/membersController.php'); // đại lý hệ thống
include_once('controller/home/zalosController.php'); // cài đặt Zalo OA
include_once('controller/home/zalo_templates_controller.php'); // cài đặt mẫu tin Zalo ZNS
include_once('controller/home/categoriesController.php'); // chức danh
include_once('controller/home/productsController.php'); // sản phẩm
include_once('controller/home/customersController.php'); // khách hàng
include_once('controller/home/customerHistoriesController.php'); // lịch sử chăm sóc khách hàng
include_once('controller/home/order_membersController.php'); // đơn hàng đại lý
include_once('controller/home/warehousesController.php'); // kho hàng đại lý
include_once('controller/home/staticsController.php'); // thống kê
include_once('controller/home/documentController.php'); // thống kê
include_once('controller/home/billController.php'); // phieu thu chi
include_once('controller/home/debtController.php'); // công nợ
include_once('controller/home/discountCodeController.php'); // Mã giảm giá
include_once('controller/home/affiliaterController.php'); // affiliater


include_once('controller/admin/membersController.php'); // đại lý hệ thống
include_once('controller/admin/categoriesController.php'); // hệ thống
include_once('controller/admin/customersController.php'); // khách hàng
include_once('controller/admin/ordersController.php'); // đơn hàng
include_once('controller/admin/warehousesController.php'); // kho hàng
include_once('controller/admin/optionsController.php'); // cài đặt module

include_once('controller/api/membersController.php'); // đại lý
include_once('controller/api/categoriesController.php'); // cài đặt
include_once('controller/api/customersController.php'); // khách hàng
include_once('controller/api/customerHistoriesController.php'); // chăm sóc khách hàng
include_once('controller/api/warehousesController.php'); // kho hàng
include_once('controller/api/order_membersController.php'); // đơn hàng hệ thống
include_once('controller/api/orderController.php'); // đơn hàng khách lẻ 
include_once('controller/api/token_devicesController.php'); // mã thiết bị
include_once('controller/api/discountCodeController.php'); // mã thiết bị
include_once('controller/api/billController.php'); // phiếu thu và phieu chi 

include_once('controller/home/transaction_histories_controller.php'); // lịch sử giao dịch nạp tiền

include_once('controller/home/smsController.php'); // gửi tin sms 

include_once('controller/fix_controller.php'); // vá lỗi


// API Khách hàng 	
include_once('controller/apiCustomer/customerController.php'); // tài khoản của khách hàng
include_once('controller/apiCustomer/orderController.php'); // tài khoản của khách hàng
include_once('controller/apiCustomer/documentController.php'); // tài khoản của khách hàng

?>