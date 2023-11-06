<?php

// Admin
include('controller/admin/agenciesController.php');
include('controller/admin/agencyOrdersController.php');
include('controller/admin/combosController.php');
include('controller/admin/productsController.php');
include('controller/admin/categoriesController.php');
include('controller/admin/usersController.php');

// agency
include('controller/agency/agency_accounts_controller.php'); // tài khoản đại lý
include('controller/agency/combos_controller.php'); // combo sản phẩm nhà cung cấp
include('controller/agency/agency_orders_controller.php'); // đơn hàng của đại lý
include('controller/agency/user_orders_controller.php'); // đơn hàng của người dùng tại cửa hàng

// home
include('controller/home/user_controller.php'); // tài khoản người dùng
