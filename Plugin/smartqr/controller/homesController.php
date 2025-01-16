<?php 
function redirectSmartQR($input)
{
	global $controller;

	$code = @$input['request']->getAttribute('params')['pass'][1];

	$link_redirect = '/';

	if(!empty($code)){
		$modelSmartqr = $controller->loadModel('Smartqrs');
		$modelHistoryscanqr = $controller->loadModel('Historyscanqrs');

		$conditions = array('code'=>$code);

		$data = $modelSmartqr->find()->where($conditions)->first();

		if(!empty($data->link_web)){
			include(__DIR__.'/../lib/mobile-detect/MobileDetect.php');

			$detect = new \Detection\MobileDetect;
			
			$device_type = 'Computer';
			if($detect->isMobile()){
				$device_type = 'Mobile';
			}elseif($detect->isTablet()){
				$device_type = 'Tablet';
			}elseif($detect->isTV()){
				$device_type = 'TV';
			}elseif($detect->isWatch()){
				$device_type = 'Watch';
			}

			$device_name = 'Other';
			if($detect->isiPhone()){
				$device_name = 'iPhone';
			}elseif($detect->isBlackBerry()){
				$device_name = 'Black Berry';
			}elseif($detect->isPixel()){
				$device_name = 'Pixel';
			}elseif($detect->isHTC()){
				$device_name = 'HTC';
			}elseif($detect->isNexus()){
				$device_name = 'Nexus';
			}elseif($detect->isDell()){
				$device_name = 'Dell';
			}elseif($detect->isMotorola()){
				$device_name = 'Motorola';
			}elseif($detect->isSamsung()){
				$device_name = 'Samsung';
			}elseif($detect->isLG()){
				$device_name = 'LG';
			}elseif($detect->isSony()){
				$device_name = 'Sony';
			}elseif($detect->isAsus()){
				$device_name = 'Asus';
			}elseif($detect->isXiaomi()){
				$device_name = 'Xiaomi';
			}elseif($detect->isNokiaLumia()){
				$device_name = 'Nokia Lumia';
			}elseif($detect->isMicromax()){
				$device_name = 'Micromax';
			}elseif($detect->isPalm()){
				$device_name = 'Palm';
			}elseif($detect->isVertu()){
				$device_name = 'Vertu';
			}elseif($detect->isPantech()){
				$device_name = 'Pantech';
			}elseif($detect->isFly()){
				$device_name = 'Fly';
			}elseif($detect->isWiko()){
				$device_name = 'Wiko';
			}elseif($detect->isSimValley()){
				$device_name = 'Sim Valley';
			}elseif($detect->isWolfgang()){
				$device_name = 'Wolfgang';
			}elseif($detect->isAlcatel()){
				$device_name = 'Alcatel';
			}elseif($detect->isNintendo()){
				$device_name = 'Nintendo';
			}elseif($detect->isAmoi()){
				$device_name = 'Amoi';
			}elseif($detect->isINQ()){
				$device_name = 'INQ';
			}elseif($detect->isOnePlus()){
				$device_name = 'One Plus';
			}elseif($detect->isGenericPhone()){
				$device_name = 'Generic Phone';
			}elseif($detect->isiPad()){
				$device_name = 'iPad';
			}elseif($detect->isNexusTablet()){
				$device_name = 'Nexus Tablet';
			}elseif($detect->isGoogleTablet()){
				$device_name = 'Google Tablet';
			}elseif($detect->isSamsungTablet()){
				$device_name = 'Samsung Tablet';
			}elseif($detect->isKindle()){
				$device_name = 'Kindle';
			}elseif($detect->isSurfaceTablet()){
				$device_name = 'Surface Tablet';
			}elseif($detect->isHPTablet()){
				$device_name = 'HP Tablet';
			}elseif($detect->isAsusTablet()){
				$device_name = 'Asus Tablet';
			}elseif($detect->isBlackBerryTablet()){
				$device_name = 'Black Berry Tablet';
			}elseif($detect->isHTCtablet()){
				$device_name = 'HTC tablet';
			}elseif($detect->isMotorolaTablet()){
				$device_name = 'Motorola Tablet';
			}elseif($detect->isNookTablet()){
				$device_name = 'Nook Tablet';
			}elseif($detect->isAcerTablet()){
				$device_name = 'Acer Tablet';
			}elseif($detect->isToshibaTablet()){
				$device_name = 'Toshiba Tablet';
			}elseif($detect->isLGTablet()){
				$device_name = 'LG Tablet';
			}elseif($detect->isFujitsuTablet()){
				$device_name = 'Fujitsu Tablet';
			}elseif($detect->isPrestigioTablet()){
				$device_name = 'Prestigio Tablet';
			}elseif($detect->isLenovoTablet()){
				$device_name = 'Lenovo Tablet';
			}elseif($detect->isDellTablet()){
				$device_name = 'Dell Tablet';
			}elseif($detect->isYarvikTablet()){
				$device_name = 'Yarvik Tablet';
			}elseif($detect->isMedionTablet()){
				$device_name = 'Medion Tablet';
			}


			$system = 'Other';
			if($detect->isAndroidOS()){
				$system = 'Android OS';
			}elseif($detect->isBlackBerryOS()){
				$system = 'BlackBerry OS';
			}elseif($detect->isPalmOS()){
				$system = 'Palm OS';
			}elseif($detect->isSymbianOS()){
				$system = 'Symbian OS';
			}elseif($detect->isWindowsMobileOS()){
				$system = 'Windows Mobile OS';
			}elseif($detect->isWindowsPhoneOS()){
				$system = 'Windows Phone OS';
			}elseif($detect->isiOS()){
				$system = 'iOS';
			}elseif($detect->isiPadOS()){
				$system = 'iPad OS';
			}elseif($detect->isSailfishOS()){
				$system = 'Sailfish OS';
			}elseif($detect->isMeeGoOS()){
				$system = 'Mee Go OS';
			}elseif($detect->isMaemoOS()){
				$system = 'Maemo OS';
			}elseif($detect->isJavaOS()){
				$system = 'Java OS';
			}elseif($detect->iswebOS()){
				$system = 'web OS';
			}elseif($detect->isbadaOS()){
				$system = 'bada OS';
			}elseif($detect->isBREWOS()){
				$system = 'BREW OS';
			}

			$browser = 'Other';
			if($detect->isChrome()){
				$browser = 'Chrome';
			}elseif($detect->isOpera()){
				$browser = 'Opera';
			}elseif($detect->isSkyfire()){
				$browser = 'Skyfire';
			}elseif($detect->isEdge()){
				$browser = 'Edge';
			}elseif($detect->isIE()){
				$browser = 'IE';
			}elseif($detect->isFirefox()){
				$browser = 'Firefox';
			}elseif($detect->isBolt()){
				$browser = 'Bolt';
			}elseif($detect->isTeaShark()){
				$browser = 'TeaShark';
			}elseif($detect->isBlazer()){
				$browser = 'Blazer';
			}elseif($detect->isDolfin()){
				$browser = 'Dolfin';
			}elseif($detect->isSafari()){
				$browser = 'Safari';
			}elseif($detect->isWeChat()){
				$browser = 'WeChat';
			}elseif($detect->isUCBrowser()){
				$browser = 'UCBrowser';
			}elseif($detect->isbaiduboxapp()){
				$browser = 'baidu boxapp';
			}elseif($detect->isbaidubrowser()){
				$browser = 'baidu';
			}elseif($detect->isDiigoBrowser()){
				$browser = 'Diigo';
			}elseif($detect->isObigoBrowser()){
				$browser = 'Obigo';
			}elseif($detect->isGenericBrowser()){
				$browser = 'Generic';
			}

			$history = $modelHistoryscanqr->newEmptyEntity();

			$history->id_qr = $data->id;
			$history->time_scan = time();
			$history->device_type = $device_type;
			$history->device_name = $device_name;
			$history->system = $system;
			$history->browser = $browser;

			$modelHistoryscanqr->save($history);

			if($detect->isAndroidOS()){
				//return $controller->redirect($data->link_android);
				$link_redirect = $data->link_android;
			}elseif($detect->isiOS() || $detect->isiPadOS()){
				//return $controller->redirect($data->link_ios);
				$link_redirect = $data->link_ios;
			}else{
				//return $controller->redirect($data->link_web);
				$link_redirect = $data->link_web;
			}
		}
	}

	setVariable('link_redirect', $link_redirect);
	//return $controller->redirect('/');
}

function createQRCode($input)
{
	global $controller;

	$code = @$input['request']->getAttribute('params')['pass'][1];

	if(!empty($code)){
		$modelSmartqr = $controller->loadModel('Smartqrs');

		$conditions = array('code'=>$code);

		$data = $modelSmartqr->find()->where($conditions)->first();
		
		if(!empty($data)){
			setVariable('data', $data);
		}
	}
}

function fixRedirectSmartQR($input)
{
	global $controller;

	$code = @$input['request']->getAttribute('params')['pass'][0];
	if(!empty($code)){
		return $controller->redirect('/r/'.$code);
	}else{
		return $controller->redirect('/');
	}
	
}
?>