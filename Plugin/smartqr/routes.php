<?php
	global $routesPlugin;

	// for home
	$routesPlugin['r']= 'smartqr/view/home/redirectSmartQR.php';
	$routesPlugin['qrcode']= 'smartqr/view/home/createQRCode.php';

	// fix bug url old
	$routesPlugin['9ApgGX4JnaFs']= 'smartqr/view/home/fixRedirectSmartQR.php';
	$routesPlugin['sn6owryjpdt5']= 'smartqr/view/home/fixRedirectSmartQR.php';
	$routesPlugin['gjib5dhkl79y']= 'smartqr/view/home/fixRedirectSmartQR.php';
?>