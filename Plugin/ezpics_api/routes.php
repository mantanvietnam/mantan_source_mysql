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
	$routesPlugin['fixCertificate']= 'ezpics_api/view/fixCertificate.php';
	$routesPlugin['fixWidthText']= 'ezpics_api/view/fixWidthText.php';
	$routesPlugin['fixAuthor']= 'ezpics_api/view/fixAuthor.php';
	$routesPlugin['fixWarehouseProducts']= 'ezpics_api/view/fixWarehouseProducts.php';
	$routesPlugin['fixPhotoroom']= 'ezpics_api/view/fixPhotoroom.php';

	// nén ảnh
	$routesPlugin['zipThumb']= 'ezpics_api/view/zipThumb.php';
	$routesPlugin['zipFileUpload']= 'ezpics_api/view/zipFileUpload.php';

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
	$routesPlugin['updateWarehouseAPI']= 'ezpics_api/view/updateWarehouseAPI.php';
	$routesPlugin['memberBuyProAPI']= 'ezpics_api/view/memberBuyProAPI.php';
	$routesPlugin['memberExtendProAPI']= 'ezpics_api/view/memberExtendProAPI.php';

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
	$routesPlugin['getSizeProductAPI']= 'ezpics_api/view/getSizeProductAPI.php';
	$routesPlugin['listTrendProductAPI']= 'ezpics_api/view/listTrendProductAPI.php';
	$routesPlugin['updateProductAPI']= 'ezpics_api/view/updateProductAPI.php';
	
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
	$routesPlugin['removeBackgroundFromDesignAPI']= 'ezpics_api/view/home/removeBackgroundFromDesignAPI.php';
	$routesPlugin['upImageThumbnail']= 'ezpics_api/view/home/upImageThumbnail.php';
	$routesPlugin['getListLayer']= 'ezpics_api/view/home/getListLayer.php';
	$routesPlugin['createImageFromTemplate']= 'ezpics_api/view/home/createImageFromTemplate.php';
	$routesPlugin['createThumb']= 'ezpics_api/view/home/createThumb.php';
	$routesPlugin['createLayerVariable']= 'ezpics_api/view/home/createLayerVariable.php';
	$routesPlugin['checkToolExportImage']= 'ezpics_api/view/home/checkToolExportImage.php';
	

	// yêu thích sản phẩm
	$routesPlugin['saveFavoriteProductAPI']= 'ezpics_api/view/saveFavoriteProductAPI.php';
	$routesPlugin['checkFavoriteProductAPI']= 'ezpics_api/view/checkFavoriteProductAPI.php';
	$routesPlugin['deleteFavoriteProductAPI']= 'ezpics_api/view/deleteFavoriteProductAPI.php';
	$routesPlugin['getMyProductFavoriteAPI']= 'ezpics_api/view/getMyProductFavoriteAPI.php';

	// danh mục sản phẩm
	$routesPlugin['getProductByCategoryAPI']= 'ezpics_api/view/getProductByCategoryAPI.php';
	$routesPlugin['getProductAllCategoryAPI']= 'ezpics_api/view/getProductAllCategoryAPI.php';
	$routesPlugin['getProductCategoryAPI']= 'ezpics_api/view/getProductCategoryAPI.php';
	$routesPlugin['detailProductSeriesAPI']= 'ezpics_api/view/detailProductSeriesAPI.php';
	$routesPlugin['createImageSeriesAPI']= 'ezpics_api/view/createImageSeriesAPI.php';

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
	$routesPlugin['updateListLayerAPI']= 'ezpics_api/view/updateListLayerAPI.php';
	$routesPlugin['updateLayerAPI']= 'ezpics_api/view/updateLayerAPI.php';
	$routesPlugin['addLayerImageAPI']= 'ezpics_api/view/addLayerImageAPI.php';
	$routesPlugin['changeLayerImageAPI']= 'ezpics_api/view/changeLayerImageAPI.php';
	$routesPlugin['changeLayerImageNew']= 'ezpics_api/view/changeLayerImageNew.php';
	$routesPlugin['addNotificationProductAPI']= 'ezpics_api/view/addNotificationProductAPI.php';
	$routesPlugin['copyLayerAPI']= 'ezpics_api/view/copyLayerAPI.php';
	$routesPlugin['getInfoUserAPI']= 'ezpics_api/view/getInfoUserAPI.php';
	$routesPlugin['addLayerImageUrlAPI']= 'ezpics_api/view/addLayerImageUrlAPI.php';

	//FollowDesigner
	$routesPlugin['addFollowDesignerAPI']= 'ezpics_api/view/addFollowDesignerAPI.php';
	$routesPlugin['deleteFollowDesignerAPI']= 'ezpics_api/view/deleteFollowDesignerAPI.php';
	$routesPlugin['checkFollowDesignerAPI']= 'ezpics_api/view/checkFollowDesignerAPI.php';
	$routesPlugin['listFollowDesignerAPI']= 'ezpics_api/view/listFollowDesignerAPI.php';
	$routesPlugin['orderCreateContentAPI']= 'ezpics_api/view/orderCreateContentAPI.php';

	// kho
	$routesPlugin['getListWarehousesAPI']= 'ezpics_api/view/getlistWarehousesAPI.php';
	$routesPlugin['getProductsWarehousesAPI']= 'ezpics_api/view/getProductsWarehousesAPI.php';
	$routesPlugin['buyWarehousesAPI']= 'ezpics_api/view/buyWarehousesAPI.php';
	$routesPlugin['getListBuyWarehousesAPI']= 'ezpics_api/view/getListBuyWarehousesAPI.php';
	$routesPlugin['checkBuyWarehousesAPI']= 'ezpics_api/view/checkBuyWarehousesAPI.php';
	$routesPlugin['buyProductWarehousesAPI']= 'ezpics_api/view/buyProductWarehousesAPI.php';
	$routesPlugin['extendWarehousesAPI']= 'ezpics_api/view/extendWarehousesAPI.php';
	$routesPlugin['getInfoWarehouseAPI']= 'ezpics_api/view/getInfoWarehouseAPI.php';
	$routesPlugin['notificationWarehousesAPI']= 'ezpics_api/view/notificationWarehousesAPI.php';
	$routesPlugin['addWarehouseAPI']= 'ezpics_api/view/addWarehouseAPI.php';
	$routesPlugin['getListWarehouseDesignerAPI']= 'ezpics_api/view/getListWarehouseDesignerAPI.php';
	$routesPlugin['addUserWarehouseAPI']= 'ezpics_api/view/addUserWarehouseAPI.php';
	$routesPlugin['addWarehouseLostMoneyAPI']= 'ezpics_api/view/addWarehouseLostMoneyAPI.php';

	// thong ke 
	
	$routesPlugin['statisticalAPI']= 'ezpics_api/view/statisticalAPI.php';
	$routesPlugin['staticNumberUserAPI']= 'ezpics_api/view/staticNumberUserAPI.php';
	
	$routesPlugin['listCategoryQuestionAPI']= 'ezpics_api/view/listCategoryQuestionAPI.php';
	$routesPlugin['listQuestionAPI']= 'ezpics_api/view/listQuestionAPI.php';
	$routesPlugin['getQuestionAPI']= 'ezpics_api/view/getQuestionAPI.php';
	$routesPlugin['addContentAPI']= 'ezpics_api/view/addContentAPI.php';
	$routesPlugin['listContentAPI']= 'ezpics_api/view/listContentAPI.php';
	$routesPlugin['getContentAPI']= 'ezpics_api/view/getContentAPI.php';
	$routesPlugin['searchDesignerAPI']= 'ezpics_api/view/searchDesignerAPI.php';
	$routesPlugin['listDesignerAPI']= 'ezpics_api/view/listDesignerAPI.php';
	$routesPlugin['deleteContentAPI']= 'ezpics_api/view/deleteContentAPI.php';
	$routesPlugin['searchWarehousesAPI']= 'ezpics_api/view/searchWarehousesAPI.php';
	$routesPlugin['updateContentAPI']= 'ezpics_api/view/updateContentAPI.php';
	$routesPlugin['getProductUserAPI']= 'ezpics_api/view/getProductUserAPI.php';
	$routesPlugin['updateInfoProductAPI']= 'ezpics_api/view/updateInfoProductAPI.php';
	$routesPlugin['getPriceAPI']= 'ezpics_api/view/getPriceAPI.php';
	$routesPlugin['memberTrialProAPI']= 'ezpics_api/view/memberTrialProAPI.php';

	$routesPlugin['listIngredientAPI']= 'ezpics_api/view/listIngredientAPI.php';
	$routesPlugin['getIngredientAPI']= 'ezpics_api/view/getIngredientAPI.php';
	$routesPlugin['categoryIngredientAPI']= 'ezpics_api/view/categoryIngredientAPI.php';	
	$routesPlugin['addNotificationDeadlineProAPI']= 'ezpics_api/view/addNotificationDeadlineProAPI.php';	
	$routesPlugin['addNotificationDeadlineTrialProAPI']= 'ezpics_api/view/addNotificationDeadlineTrialProAPI.php';	
	$routesPlugin['checkDeadline']= 'ezpics_api/view/checkDeadline.php';	
	$routesPlugin['checkDeadlineProAllMember']= 'ezpics_api/view/checkDeadlineProAllMember.php';	
	$routesPlugin['showDiscountCodeAPI']= 'ezpics_api/view/showDiscountCodeAPI.php';	
	$routesPlugin['getMainColorAPI']= 'ezpics_api/view/getMainColorAPI.php';	
	$routesPlugin['resendOtpAPI']= 'ezpics_api/view/resendOtpAPI.php';	
	$routesPlugin['memberBuyProMonthAPI']= 'ezpics_api/view/memberBuyProMonthAPI.php';	
	$routesPlugin['memberExtendProMonthAPI']= 'ezpics_api/view/memberExtendProMonthAPI.php';	
	$routesPlugin['buyProductEcoinAPI']= 'ezpics_api/view/buyProductEcoinAPI.php';	
	$routesPlugin['saveImageProductAPI']= 'ezpics_api/view/saveImageProductAPI.php';	
	$routesPlugin['listStyleTextAPI']= 'ezpics_api/view/listStyleTextAPI.php';	
	$routesPlugin['getStyleTextAPI']= 'ezpics_api/view/getStyleTextAPI.php';	
?>