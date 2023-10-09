<?php
	global $routesPlugin;

	// User
	$routesPlugin['registerUserApi']= 'excgo/view/registerUserApi.php';
	$routesPlugin['loginUserApi']= 'excgo/view/loginUserApi.php';
	$routesPlugin['logoutUserApi']= 'excgo/view/logoutUserApi.php';
	$routesPlugin['changePasswordApi']= 'excgo/view/changePasswordApi.php';
	$routesPlugin['forgotPasswordApi']= 'excgo/view/forgotPasswordApi.php';
	$routesPlugin['resetPasswordApi']= 'excgo/view/resetPasswordApi.php';
	$routesPlugin['upgradeToDriverApi']= 'excgo/view/upgradeToDriverApi.php';
	$routesPlugin['addMoneyTPBankApi']= 'excgo/view/addMoneyTPBankApi.php';
	$routesPlugin['generateQRCodeApi']= 'excgo/view/generateQRCodeApi.php';
	$routesPlugin['createWithdrawRequestApi']= 'excgo/view/createWithdrawRequestApi.php';

	// Province
    $routesPlugin['getListProvinceApi'] = 'excgo/view/getListProvinceApi.php';

    // Pinned Province
    $routesPlugin['addPinnedProvinceApi'] = 'excgo/view/addPinnedProvinceApi.php';
    $routesPlugin['removePinnedProvinceApi'] = 'excgo/view/removePinnedProvinceApi.php';

    // Booking
    $routesPlugin['createBookingApi'] = 'excgo/view/createBookingApi.php';
    $routesPlugin['getBookingListApi'] = 'excgo/view/getBookingListApi.php';
    $routesPlugin['receiveBookingApi'] = 'excgo/view/receiveBookingApi.php';
    $routesPlugin['cancelReceiveBookingApi'] = 'excgo/view/cancelReceiveBookingApi.php';
    $routesPlugin['completeBookingApi'] = 'excgo/view/completeBookingApi.php';
    $routesPlugin['checkFinishedBookingApi'] = 'excgo/view/checkFinishedBookingApi.php';
    $routesPlugin['getMyBookingListApi'] = 'excgo/view/getMyBookingListApi.php';
    $routesPlugin['viewBookingDetailApi'] = 'excgo/view/viewBookingDetailApi.php';
    $routesPlugin['updateBookingApi'] = 'excgo/view/updateBookingApi.php';

    // Transaction
    $routesPlugin['getListTransactionApi'] = 'excgo/view/getListTransactionApi.php';

    // Complaint
    $routesPlugin['createComplaintApi'] = 'excgo/view/createComplaintApi.php';
    $routesPlugin['getComplaintListApi'] = 'excgo/view/getComplaintListApi.php';
