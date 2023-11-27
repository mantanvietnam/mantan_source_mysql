<?php
    global $routesPlugin;

    // Admin
    $routesPlugin['adminDeleteAccountApi']= 'go_draw/view/adminDeleteAccountApi.php';
    $routesPlugin['adminUpdateStaffAccountApi']= 'go_draw/view/adminUpdateStaffAccountApi.php';
    $routesPlugin['getProductDetailAdminApi']= 'go_draw/view/getProductDetailAdminApi.php';
    $routesPlugin['deleteComboProductAdminApi']= 'go_draw/view/deleteComboProductAdminApi.php';
    $routesPlugin['acceptAgencyOrderAdminApi']= 'go_draw/view/acceptAgencyOrderAdminApi.php';
    $routesPlugin['acceptAgencyOrderProductAdminApi']= 'go_draw/view/acceptAgencyOrderProductAdminApi.php';

    // agency
    $routesPlugin['login']= 'go_draw/view/agency/agency_accounts/login.php';
    $routesPlugin['logout']= 'go_draw/view/agency/agency_accounts/logout.php';
    $routesPlugin['changePass']= 'go_draw/view/agency/agency_accounts/changePass.php';
    $routesPlugin['profile']= 'go_draw/view/agency/agency_accounts/profile.php';
    $routesPlugin['checkBoos']= 'go_draw/view/agency/agency_accounts/checkBoos.php';
    

    $routesPlugin['listCombo']= 'go_draw/view/agency/combos/listCombo.php';
    $routesPlugin['viewCombo']= 'go_draw/view/agency/combos/viewCombo.php';

	// đơn hàng mua combo với hệ thống
	$routesPlugin['addToCart']= 'go_draw/view/agency/agency_orders/addToCart.php';
	$routesPlugin['cart']= 'go_draw/view/agency/agency_orders/cart.php';
	$routesPlugin['createOrder']= 'go_draw/view/agency/agency_orders/createOrder.php';
    $routesPlugin['addComboToStore']= 'go_draw/view/agency/agency_orders/addComboToStore.php';

	$routesPlugin['orderAgencyWait']= 'go_draw/view/agency/agency_orders/orderAgencyWait.php';
    $routesPlugin['orderAgencyProcess']= 'go_draw/view/agency/agency_orders/orderAgencyProcess.php';
	$routesPlugin['orderAgencyDone']= 'go_draw/view/agency/agency_orders/orderAgencyDone.php';

    $routesPlugin['orderAgencyProcess']= 'go_draw/view/agency/agency_orders/orderAgencyProcess.php';
    $routesPlugin['orderAgencyDone']= 'go_draw/view/agency/agency_orders/orderAgencyDone.php';

    // kiểm tra combo
    $routesPlugin['checkCombo']= 'go_draw/view/agency/user_orders/checkCombo.php';
    $routesPlugin['viewComboAgency']= 'go_draw/view/agency/user_orders/viewComboAgency.php';
    $routesPlugin['addCartComboUser']= 'go_draw/view/agency/user_orders/addCartComboUser.php';

    // đơn hàng mua sản phẩm với hệ thống listProduct
    $routesPlugin['listProduct']= 'go_draw/view/agency/products/listProduct.php';
    $routesPlugin['viewProduct']= 'go_draw/view/agency/products/viewProduct.php';
    
    $routesPlugin['addToCartProduct']= 'go_draw/view/agency/agency_order_products/addToCartProduct.php';
    $routesPlugin['cartAgencyProduct']= 'go_draw/view/agency/agency_order_products/cartAgencyProduct.php';
    $routesPlugin['createOrderAgencyProduct']= 'go_draw/view/agency/agency_order_products/createOrderAgencyProduct.php';
    
    $routesPlugin['orderProductWait']= 'go_draw/view/agency/agency_order_products/orderProductWait.php';
    $routesPlugin['orderProductProcess']= 'go_draw/view/agency/agency_order_products/orderProductProcess.php';
    $routesPlugin['orderProductDone']= 'go_draw/view/agency/agency_order_products/orderProductDone.php';
    $routesPlugin['addProductToStore']= 'go_draw/view/agency/agency_order_products/addProductToStore.php';

    // kho hàng
    $routesPlugin['warehouse']= 'go_draw/view/agency/agency_products/warehouse.php';

    // yêu cầu trả hàng
    $routesPlugin['addToCartBackStore']= 'go_draw/view/agency/agency_order_back_stores/addToCartBackStore.php';
    $routesPlugin['agencyCartBackStore']= 'go_draw/view/agency/agency_order_back_stores/agencyCartBackStore.php';
    $routesPlugin['createOrderBackStore']= 'go_draw/view/agency/agency_order_back_stores/createOrderBackStore.php';
    
    $routesPlugin['orderBackStore']= 'go_draw/view/agency/agency_order_back_stores/orderBackStore.php';
    $routesPlugin['orderBackStoreDone']= 'go_draw/view/agency/agency_order_back_stores/orderBackStoreDone.php';

    // đơn hàng với khách hàng
    $routesPlugin['sellProduct']= 'go_draw/view/agency/user_orders/sellProduct.php';
    $routesPlugin['addToCartUser']= 'go_draw/view/agency/user_orders/addToCartUser.php';
    $routesPlugin['userCart']= 'go_draw/view/agency/user_orders/userCart.php';

	$routesPlugin['orderUserProcess']= 'go_draw/view/agency/user_orders/orderUserProcess.php';
	$routesPlugin['processUserOrder']= 'go_draw/view/agency/user_orders/processUserOrder.php';
	$routesPlugin['checkoutOrderUser']= 'go_draw/view/agency/user_orders/checkoutOrderUser.php';
    $routesPlugin['orderUserPrintBill']= 'go_draw/view/agency/user_orders/orderUserPrintBill.php';

	$routesPlugin['orderUserDone']= 'go_draw/view/agency/user_orders/orderUserDone.php';
    $routesPlugin['staticAgency']= 'go_draw/view/agency/user_orders/staticAgency.php';

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
    $routesPlugin['changePassUser']= 'go_draw/view/home/user/changePassUser.php';
    $routesPlugin['verified']= 'go_draw/view/home/user/verified.php';
    

    $routesPlugin['search-agency']= 'go_draw/view/home/agencies/searchAgency.php';
    $routesPlugin['myOrder']= 'go_draw/view/home/user_orders/myOrder.php';
    
    $routesPlugin['myGallery']= 'go_draw/view/home/user_pictures/myGallery.php';
    $routesPlugin['addImage']= 'go_draw/view/home/user_pictures/addImage.php';
    $routesPlugin['topImage']= 'go_draw/view/home/user_pictures/topImage.php';
    $routesPlugin['detailImage']= 'go_draw/view/home/user_pictures/detailImage.php';
    $routesPlugin['deleteImage']= 'go_draw/view/home/user_pictures/deleteImage.php';
    $routesPlugin['addLike']= 'go_draw/view/home/user_pictures/addLike.php';

