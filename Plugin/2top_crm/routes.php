<?php
	global $routesPlugin;

	// for api
	$routesPlugin['saveCustomerAPI']= '2top_crm/saveCustomerAPI.php';
	$routesPlugin['searchCustomerAPI']= '2top_crm/searchCustomerAPI.php';

	// for home
	$routesPlugin['login']= '2top_crm/view/home/login.php';
	$routesPlugin['register']= '2top_crm/view/home/register.php';
	$routesPlugin['infoUser']= '2top_crm/view/home/infoUser.php';
	$routesPlugin['changepassword']= '2top_crm/view/home/changepassword.php';
	$routesPlugin['editInfoUser']= '2top_crm/view/home/editInfoUser.php';
	$routesPlugin['forgotpassword']= '2top_crm/view/home/forgotpassword.php';
	$routesPlugin['newpassword']= '2top_crm/view/home/newpassword.php';
	$routesPlugin['confirmAPI']= '2top_crm/view/home/confirmAPI.php';
	$routesPlugin['newpasswordAPI']= '2top_crm/view/home/newpasswordAPI.php';
	$routesPlugin['confirm']= '2top_crm/view/home/confirm.php';

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
	$routesPlugin['gettokenInfoUserAPI']= 'ezpics_api/view/gettokenInfoUserAPI.php';
	$routesPlugin['gettokeneviceInfoUserAPI']= 'ezpics_api/view/gettokeneviceInfoUserAPI.php';

	// quên mật khẩu
	$routesPlugin['requestCodeForgotPasswordAPI']= 'ezpics_api/view/requestCodeForgotPasswordAPI.php';
	$routesPlugin['saveNewPassAPI']= 'ezpics_api/view/saveNewPassAPI.php';
?>