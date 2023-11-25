<?php

// Admin
include('controller/admin/agenciesController.php');
include('controller/admin/agencyOrdersController.php');
include('controller/admin/combosController.php');
include('controller/admin/productsController.php');
include('controller/admin/categoriesController.php');
include('controller/admin/usersController.php');
include('controller/admin/orderHistoriesController.php');
include('controller/admin/agencyOrderProductsController.php');
include('controller/admin/warehouseHistoriesController.php');
include('controller/admin/agencyOrderBackStoresController.php');
include('controller/admin/userOrdersController.php');

// agency
include('controller/agency/agency_accounts_controller.php'); // tài khoản đại lý
include('controller/agency/combos_controller.php'); // combo sản phẩm nhà cung cấp
include('controller/agency/agency_orders_controller.php'); // đơn hàng của đại lý
include('controller/agency/user_orders_controller.php'); // đơn hàng của người dùng tại cửa hàng mua sản phẩm
include('controller/agency/user_combo_orders_controller.php'); // đơn hàng của người dùng tại cửa hàng mua combo
include('controller/agency/agency_products_controller.php'); // kho sản phẩm của đại lý
include('controller/agency/agency_order_back_stores_controller.php'); // yêu cầu trả hàng
include('controller/agency/products_controller.php'); // sản phẩm
include('controller/agency/agency_order_products_controller.php'); // đơn hàng mua sản phẩm

// home
include('controller/home/user_controller.php'); // tài khoản người dùng
include('controller/home/agencies_controller.php'); // đại lý
include('controller/home/user_orders_controller.php'); // đơn hàng của người dùng
include('controller/home/user_pictures_controller.php'); // ảnh người dùng
