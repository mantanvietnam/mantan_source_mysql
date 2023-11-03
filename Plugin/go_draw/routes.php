<?php
global $routesPlugin;
    // Admin
    $routesPlugin['adminDeleteAccountApi']= 'go_draw/view/adminDeleteAccountApi.php';
    $routesPlugin['adminUpdateStaffAccountApi']= 'go_draw/view/adminUpdateStaffAccountApi.php';
    $routesPlugin['getProductDetailAdminApi']= 'go_draw/view/getProductDetailAdminApi.php';
    $routesPlugin['deleteComboProductAdminApi']= 'go_draw/view/deleteComboProductAdminApi.php';
    $routesPlugin['updateComboAdminApi']= 'go_draw/view/updateComboAdminApi.php';
    $routesPlugin['acceptAgencyOrderAdminApi']= 'go_draw/view/acceptAgencyOrderAdminApi.php';
    $routesPlugin['payAgencyOrderAdminApi']= 'go_draw/view/payAgencyOrderAdminApi.php';

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