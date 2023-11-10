<?php
global $routesPlugin;
    // Admin
    $routesPlugin['adminDeleteAccountApi']= 'go_draw/view/adminDeleteAccountApi.php';
    $routesPlugin['adminUpdateStaffAccountApi']= 'go_draw/view/adminUpdateStaffAccountApi.php';
    $routesPlugin['getProductDetailAdminApi']= 'go_draw/view/getProductDetailAdminApi.php';
    $routesPlugin['deleteComboProductAdminApi']= 'go_draw/view/deleteComboProductAdminApi.php';
    $routesPlugin['acceptAgencyOrderAdminApi']= 'go_draw/view/acceptAgencyOrderAdminApi.php';

    // agency
    $routesPlugin['login']= 'go_draw/view/agency/agency_accounts/login.php';
    $routesPlugin['logout']= 'go_draw/view/agency/agency_accounts/logout.php';
    $routesPlugin['changePass']= 'go_draw/view/agency/agency_accounts/changePass.php';

    $routesPlugin['listCombo']= 'go_draw/view/agency/combos/listCombo.php';
    $routesPlugin['viewCombo']= 'go_draw/view/agency/combos/viewCombo.php';

	// đơn hàng với hệ thống
	$routesPlugin['addToCart']= 'go_draw/view/agency/agency_orders/addToCart.php';
	$routesPlugin['cart']= 'go_draw/view/agency/agency_orders/cart.php';
	$routesPlugin['createOrder']= 'go_draw/view/agency/agency_orders/createOrder.php';
    $routesPlugin['addComboToStore']= 'go_draw/view/agency/agency_orders/addComboToStore.php';

	$routesPlugin['orderAgencyWait']= 'go_draw/view/agency/agency_orders/orderAgencyWait.php';
    $routesPlugin['orderAgencyProcess']= 'go_draw/view/agency/agency_orders/orderAgencyProcess.php';
	$routesPlugin['orderAgencyDone']= 'go_draw/view/agency/agency_orders/orderAgencyDone.php';

    $routesPlugin['orderAgencyProcess']= 'go_draw/view/agency/agency_orders/orderAgencyProcess.php';
    $routesPlugin['orderAgencyDone']= 'go_draw/view/agency/agency_orders/orderAgencyDone.php';

    // đơn hàng với khách hàng
    $routesPlugin['sellProduct']= 'go_draw/view/agency/user_orders/sellProduct.php';
    $routesPlugin['addToCartUser']= 'go_draw/view/agency/user_orders/addToCartUser.php';
    $routesPlugin['userCart']= 'go_draw/view/agency/user_orders/userCart.php';

	$routesPlugin['orderUserProcess']= 'go_draw/view/agency/user_orders/orderUserProcess.php';
	$routesPlugin['processUserOrder']= 'go_draw/view/agency/user_orders/processUserOrder.php';
	$routesPlugin['checkoutOrderUser']= 'go_draw/view/agency/user_orders/checkoutOrderUser.php';

	$routesPlugin['orderUserDone']= 'go_draw/view/agency/user_orders/orderUserDone.php';

    // đơn hàng combo
    $routesPlugin['sellComboProduct']= 'go_draw/view/agency/user_combo_orders/sellComboProduct.php';
    $routesPlugin['viewOrderCombo']= 'go_draw/view/agency/user_combo_orders/viewOrderCombo.php';
    $routesPlugin['userComboCart']= 'go_draw/view/agency/user_combo_orders/userComboCart.php';
    $routesPlugin['createOrderComboUser']= 'go_draw/view/agency/user_combo_orders/createOrderComboUser.php';
    $routesPlugin['orderUserComboProcess']= 'go_draw/view/agency/user_combo_orders/orderUserComboProcess.php';
    $routesPlugin['processUserComboOrder']= 'go_draw/view/agency/user_combo_orders/processUserComboOrder.php';
    $routesPlugin['orderUserComboDone']= 'go_draw/view/agency/user_combo_orders/orderUserComboDone.php';

    // người dùng lẻ
    $routesPlugin['register']= 'go_draw/view/home/user/register.php';
    $routesPlugin['logoutUser']= 'go_draw/view/home/user/logoutUser.php';
    $routesPlugin['loginUser']= 'go_draw/view/home/user/loginUser.php';

