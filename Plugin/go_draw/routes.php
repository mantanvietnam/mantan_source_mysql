<?php
    global $routesPlugin;
    // Admin
    $routesPlugin['adminDeleteAccountApi']= 'excgo/view/adminDeleteAccountApi.php';
    $routesPlugin['adminUpdateStaffAccountApi']= 'excgo/view/adminUpdateStaffAccountApi.php';

	// agency
	$routesPlugin['login']= 'go_draw/view/agency/agency_accounts/login.php';
	$routesPlugin['logout']= 'go_draw/view/agency/agency_accounts/logout.php';
	$routesPlugin['changePass']= 'go_draw/view/agency/agency_accounts/changePass.php';

	$routesPlugin['listCombo']= 'go_draw/view/agency/combos/listCombo.php';
	$routesPlugin['viewCombo']= 'go_draw/view/agency/combos/viewCombo.php';

	$routesPlugin['addToCart']= 'go_draw/view/agency/agency_orders/addToCart.php';
	$routesPlugin['cart']= 'go_draw/view/agency/agency_orders/cart.php';