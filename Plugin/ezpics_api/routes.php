<?php
	global $routesPlugin;

	// fix lỗi database
	// $routesPlugin['fixCategoryProduct']= 'ezpics_api/view/fixCategoryProduct.php';
	$routesPlugin['fixPass']= 'ezpics_api/view/fixPass.php';
	$routesPlugin['fixUrlImage']= 'ezpics_api/view/fixUrlImage.php';
	$routesPlugin['fixResponsiveProduct']= 'ezpics_api/view/fixResponsiveProduct.php';
	$routesPlugin['fixJsonProductDetail']= 'ezpics_api/view/fixJsonProductDetail.php';
	$routesPlugin['fixDeepLink']= 'ezpics_api/view/fixDeepLink.php';
	$routesPlugin['fixPrice']= 'ezpics_api/view/fixPrice.php';
	$routesPlugin['fixSize']= 'ezpics_api/view/fixSize.php';

	// nén ảnh
	$routesPlugin['zipThumb']= 'ezpics_api/view/zipThumb.php';

	// member
	$routesPlugin['saveRegisterMemberAPI']= 'ezpics_api/view/saveRegisterMemberAPI.php';
	$routesPlugin['checkLoginMemberAPI']= 'ezpics_api/view/checkLoginMemberAPI.php';
	$routesPlugin['logoutMemberAPI']= 'ezpics_api/view/logoutMemberAPI.php';
	$routesPlugin['getTopDesignerAPI']= 'ezpics_api/view/getTopDesignerAPI.php';
	$routesPlugin['getInfoMemberAPI']= 'ezpics_api/view/getInfoMemberAPI.php';
	$routesPlugin['lockAccountAPI']= 'ezpics_api/view/lockAccountAPI.php';
	$routesPlugin['saveChangePassAPI']= 'ezpics_api/view/saveChangePassAPI.php';
	$routesPlugin['saveInfoUserAPI']= 'ezpics_api/view/saveInfoUserAPI.php';
	$routesPlugin['checkLoginFacebookAPI']= 'ezpics_api/view/checkLoginFacebookAPI.php';
	$routesPlugin['checkLoginGoogleAPI']= 'ezpics_api/view/checkLoginGoogleAPI.php';
	$routesPlugin['checkLoginAppleAPI']= 'ezpics_api/view/checkLoginAppleAPI.php';
	$routesPlugin['checkCodeAffiliateAPI']= 'ezpics_api/view/checkCodeAffiliateAPI.php';

	// quên mật khẩu
	$routesPlugin['requestCodeForgotPasswordAPI']= 'ezpics_api/view/requestCodeForgotPasswordAPI.php';
	$routesPlugin['saveNewPassAPI']= 'ezpics_api/view/saveNewPassAPI.php';

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
	
	// sửa thiết kế
	$routesPlugin['edit-design']= 'ezpics_api/view/home/editDesign.php';
	$routesPlugin['dataEditThemeUser']= 'ezpics_api/view/home/dataEditThemeUser.php';
	$routesPlugin['updateInfoProduct']= 'ezpics_api/view/home/updateInfoProduct.php';
	$routesPlugin['savelayer']= 'ezpics_api/view/home/savelayer.php';
	$routesPlugin['copyLayer']= 'ezpics_api/view/home/copyLayer.php';
	$routesPlugin['deleteLayer']= 'ezpics_api/view/home/deleteLayer.php';
	$routesPlugin['addLayer']= 'ezpics_api/view/home/addLayer.php';
	$routesPlugin['sortLayer']= 'ezpics_api/view/home/sortLayer.php';
	$routesPlugin['imagelist']= 'ezpics_api/view/home/imagelist.php';
	$routesPlugin['upImage']= 'ezpics_api/view/home/upImage.php';
	$routesPlugin['replace']= 'ezpics_api/view/home/replace.php';
	$routesPlugin['capImg']= 'ezpics_api/view/home/capImg.php';
	$routesPlugin['updateLayer']= 'ezpics_api/view/home/updateLayer.php';
	$routesPlugin['removeBackgroundLayer']= 'ezpics_api/view/home/removeBackgroundLayer.php';
	$routesPlugin['upImageThumbnail']= 'ezpics_api/view/home/upImageThumbnail.php';
	$routesPlugin['getListLayer']= 'ezpics_api/view/home/getListLayer.php';
	$routesPlugin['createImageFromTemplate']= 'ezpics_api/view/home/createImageFromTemplate.php';
	$routesPlugin['createThumb']= 'ezpics_api/view/home/createThumb.php';
	$routesPlugin['createLayerVariable']= 'ezpics_api/view/home/createLayerVariable.php';
	

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
	$routesPlugin['saveReportAPI']= 'ezpics_api/view/saveReportAPI.php';

	// giao dịch
	$routesPlugin['getHistoryTransactionAPI']= 'ezpics_api/view/getHistoryTransactionAPI.php';
	$routesPlugin['saveRequestBankingAPI']= 'ezpics_api/view/saveRequestBankingAPI.php';
	$routesPlugin['saveRequestWithdrawAPI']= 'ezpics_api/view/saveRequestWithdrawAPI.php';
	$routesPlugin['getNameBankAPI']= 'ezpics_api/view/getNameBankAPI.php';

	// thiết kế ảnh hàng loạt
	$routesPlugin['getMyProductSeriesAPI']= 'ezpics_api/view/getMyProductSeriesAPI.php';

	// slide
	$routesPlugin['getSlideHomeAPI']= 'ezpics_api/view/getSlideHomeAPI.php';


	//Layer
	$routesPlugin['deleteLayerAPI']= 'ezpics_api/view/deleteLayerAPI.php';
	$routesPlugin['listImage']= 'ezpics_api/view/listImage.php';
	$routesPlugin['listFont']= 'ezpics_api/view/listFont.php';
	$routesPlugin['listLayerAPI']= 'ezpics_api/view/listLayerAPI.php';
	$routesPlugin['saveLayerAPI']= 'ezpics_api/view/saveLayerAPI.php';
	$routesPlugin['updateLayerAPI']= 'ezpics_api/view/updateLayerAPI.php';
	$routesPlugin['addLayerImageAPI']= 'ezpics_api/view/addLayerImageAPI.php';
	$routesPlugin['changeLayerImageAPI']= 'ezpics_api/view/changeLayerImageAPI.php';
	$routesPlugin['changeLayerImageNew']= 'ezpics_api/view/changeLayerImageNew.php';
	$routesPlugin['addNotificationProductAPI']= 'ezpics_api/view/addNotificationProductAPI.php';
	$routesPlugin['copyLayerAPI']= 'ezpics_api/view/copyLayerAPI.php';
	$routesPlugin['infoMemberAPI']= 'ezpics_api/view/infoMemberAPI.php';
	
?>