<?php
	global $routesPlugin;

	// member
	$routesPlugin['saveRegisterMemberAPI']= 'ezpics_api/view/saveRegisterMemberAPI.php';
	$routesPlugin['checkLoginMemberAPI']= 'ezpics_api/view/checkLoginMemberAPI.php';
	$routesPlugin['logoutMemberAPI']= 'ezpics_api/view/logoutMemberAPI.php';
	$routesPlugin['getTopDesignerAPI']= 'ezpics_api/view/getTopDesignerAPI.php';
	$routesPlugin['getInfoMemberAPI']= 'ezpics_api/view/getInfoMemberAPI.php';
	$routesPlugin['lockAccountAPI']= 'ezpics_api/view/lockAccountAPI.php';
	$routesPlugin['saveChangePassAPI']= 'ezpics_api/view/saveChangePassAPI.php';
	$routesPlugin['saveInfoUserAPI']= 'ezpics_api/view/saveInfoUserAPI.php';

	// product
	$routesPlugin['getNewProductAPI']= 'ezpics_api/view/getNewProductAPI.php';
	$routesPlugin['getTrendProductAPI']= 'ezpics_api/view/getTrendProductAPI.php';
	$routesPlugin['getMyProductAPI']= 'ezpics_api/view/getMyProductAPI.php';
	$routesPlugin['getInfoProductAPI']= 'ezpics_api/view/getInfoProductAPI.php';
	$routesPlugin['createProductAPI']= 'ezpics_api/view/createProductAPI.php';
	$routesPlugin['buyProductAPI']= 'ezpics_api/view/buyProductAPI.php';
	$routesPlugin['deleteProductAPI']= 'ezpics_api/view/deleteProductAPI.php';
	$routesPlugin['getIdProductCloneAPI']= 'ezpics_api/view/getIdProductCloneAPI.php';
	$routesPlugin['searchProductAPI']= 'ezpics_api/view/searchProductAPI.php';
	

	// yêu thích sản phẩm
	$routesPlugin['saveFavoriteProductAPI']= 'ezpics_api/view/saveFavoriteProductAPI.php';
	$routesPlugin['checkFavoriteProductAPI']= 'ezpics_api/view/checkFavoriteProductAPI.php';
	$routesPlugin['deleteFavoriteProductAPI']= 'ezpics_api/view/deleteFavoriteProductAPI.php';
	$routesPlugin['getMyProductFavoriteAPI']= 'ezpics_api/view/getMyProductFavoriteAPI.php';

	// danh mục sản phẩm
	$routesPlugin['getProductByCategoryAPI']= 'ezpics_api/view/getProductByCategoryAPI.php';
	$routesPlugin['getProductAllCategoryAPI']= 'ezpics_api/view/getProductAllCategoryAPI.php';
	$routesPlugin['getProductCategoryAPI']= 'ezpics_api/view/getProductCategoryAPI.php';

	// post
	$routesPlugin['getNewPostAPI']= 'ezpics_api/view/getNewPostAPI.php';
	$routesPlugin['getInfoPostAPI']= 'ezpics_api/view/getInfoPostAPI.php';

	// quản lý file
	$routesPlugin['getMyFileAPI']= 'ezpics_api/view/getMyFileAPI.php';
	$routesPlugin['removeBackgroundImageAPI']= 'ezpics_api/view/removeBackgroundImageAPI.php';

	// liên hệ
	$routesPlugin['saveContactAPI']= 'ezpics_api/view/saveContactAPI.php';
	$routesPlugin['saveRequestDesignerAPI']= 'ezpics_api/view/saveRequestDesignerAPI.php';

	// giao dịch
	$routesPlugin['getHistoryTransactionAPI']= 'ezpics_api/view/getHistoryTransactionAPI.php';
	$routesPlugin['saveRequestBankingAPI']= 'ezpics_api/view/saveRequestBankingAPI.php';
	$routesPlugin['saveRequestWithdrawAPI']= 'ezpics_api/view/saveRequestWithdrawAPI.php';

?>