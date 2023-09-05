<?php
	global $routesPlugin;

	// User
	$routesPlugin['registerUserApi']= 'excgo/view/registerUserApi.php';
	$routesPlugin['loginUserApi']= 'excgo/view/loginUserApi.php';
	$routesPlugin['logoutUserApi']= 'excgo/view/logoutUserApi.php';

	// Province
    $routesPlugin['getListProvinceApi'] = 'excgo/view/getListProvinceApi.php';

    // Pinned Province
    $routesPlugin['addPinnedProvinceApi'] = 'excgo/view/addPinnedProvinceApi.php';
    $routesPlugin['removePinnedProvinceApi'] = 'excgo/view/removePinnedProvinceApi.php';

    // Booking
    $routesPlugin['createBookingApi'] = 'excgo/view/createBookingApi.php';
    $routesPlugin['getBookingListApi'] = 'excgo/view/getBookingListApi.php';
