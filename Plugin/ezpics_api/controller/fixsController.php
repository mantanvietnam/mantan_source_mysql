<?php 
function fixPass($input)
{	
	/*
	global $controller;

	$modelMember = $controller->loadModel('Members');

	$listData = $modelMember->find()->all()->toList();

	foreach ($listData as $key => $value) {
		$value->password = md5('123456');
		$value->token = null;
		$modelMember->save($value);
	}
	*/
}

function fixUrlImage($input)
{	
	
	global $controller;

	$modelMember = $controller->loadModel('Members');
	$modelFont = $controller->loadModel('Font');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelProducts = $controller->loadModel('Products');
	$modelProductDetails = $controller->loadModel('ProductDetails');

	/*
	$listData = $modelMember->find()->all()->toList();

	foreach ($listData as $key => $value) {
		$value->avatar = str_replace('https://mobile.ezpics.vn/public/data/', 'https://apis.ezpics.vn/upload/admin/images/data/', $value->avatar);

		$modelMember->save($value);
	}
	*/
	
	/*
	$listData = $modelFont->find()->all()->toList();

	foreach ($listData as $key => $value) {
		$value->font = str_replace('https://admin.ezpics.vn/', 'https://apis.ezpics.vn/', $value->font);

		$value->font_woff2 = str_replace('https://admin.ezpics.vn/', 'https://apis.ezpics.vn/', $value->font_woff2);

		$modelFont->save($value);
	}
	*/
	
	/*
	$listData = $modelManagerFile->find()->all()->toList();

	foreach ($listData as $key => $value) {
		if(!empty($value->link)){
			$value->link = str_replace('https://mobile.ezpics.vn/public/remove/', 'https://apis.ezpics.vn/upload/admin/images/data/remove/', $value->link);
		}

		$modelManagerFile->save($value);
	}
	*/
	
	/*
	$listData = $modelProductDetails->find()->all()->toList();

	foreach ($listData as $key => $value) {
		$value->content = str_replace('https:\/\/mobile.ezpics.vn\/public', 'https://apis.ezpics.vn/upload/admin/images', $value->content);

		$modelProductDetails->save($value);
	}
	*/
	
	/*
	$listData = $modelProducts->find()->all()->toList();

	foreach ($listData as $key => $value) {
		$value->image = str_replace('https://mobile.ezpics.vn/public/data/', 'https://apis.ezpics.vn/upload/admin/images/data/', $value->image);
		$value->thumn = str_replace('https://mobile.ezpics.vn/public/data/', 'https://apis.ezpics.vn/upload/admin/images/data/', $value->thumn);

		$modelProducts->save($value);
	}
	*/
}

function fixResponsiveProduct($input)
{
	/*
	global $controller;

	$modelProductDetails = $controller->loadModel('ProductDetails');

	$allLayer = $modelProductDetails->find()->all()->toList();

	foreach($allLayer as $k => $item){
        $item->content = str_replace('\\\\\"', '', $item->content);
        $item->content = str_replace('\"', '"', $item->content);
        $layer = json_decode(trim($item->content,'"')); 
        $wight = empty($item->wight) ? 50 : $item->wight;
        $height = empty($item->height) ? 50 : $item->height;

        $fixtopleft = false;
        if(!isset($layer->postion_left)){
        	if(isset($layer->postion_x)){
	            $layer->postion_left = $layer->postion_x*100/$wight;
	            $fixtopleft = true;
	        }else{
	        	debug('x: '.$item->id);
	        	debug(trim($item->content,'"'));
	        }
        }

        if(!isset($layer->postion_top)){
        	if(isset($layer->postion_y)){
	            $layer->postion_top = $layer->postion_y*100/$height;
	            $fixtopleft = true;
	        }else{
	        	debug('y: '.$item->id);
	        	debug($layer);
	        }
        }

        if($fixtopleft){
            $item->content = json_encode($layer);
            $modelProductDetails->save($item);
        }
    }
    */
}

function fixJsonProductDetail($input)
{
	/*
	global $controller;

	$modelProductDetails = $controller->loadModel('ProductDetails');

	$allLayer = $modelProductDetails->find()->all()->toList();

	foreach($allLayer as $k => $item){
        $item->content = str_replace('\\\\\\/', '/', $item->content);
        $modelProductDetails->save($item);
    }
	*/

    
}

function fixDeepLink($input)
{
	/*
	global $controller;

	$modelProducts = $controller->loadModel('Products');

	$allLayer = $modelProducts->find()->all(['type'=>'user_create'])->toList();

	foreach($allLayer as $k => $item){
		if(empty($item->link_open_app)){
	        $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		    $data_deep = ['dynamicLinkInfo'=>[	'domainUriPrefix'=>'https://ezpics.page.link',
		    									'link'=>'https://ezpics.page.link/detailProduct?id='.$item->id,
		    									'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		    									'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
										]
						];
			$header_deep = ['Content-Type: application/json'];
			$typeData='raw';
			$deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
			$deep_link = json_decode($deep_link);

	        $item->link_open_app = @$deep_link->shortLink;

	        $modelProducts->save($item);
	    }
    }
    */
}

function fixPrice($input)
{	
	/*
	global $controller;

	$modelProducts = $controller->loadModel('Products');

	$all = $modelProducts->find()->where(['type'=>'user_create'])->all()->toList();

	foreach($all as $k => $item){
		$item->sale_price = 0;
		$item->price = 99000;

		$modelProducts->save($item);
	}
	*/
	
	/*
	$all = $modelProducts->find()->where(['type'=>'user_edit'])->all()->toList();

	foreach($all as $k => $item){
		$item->sale_price = 0;
		$item->price = 0;

		$modelProducts->save($item);
	}
	*/
	
	echo 'done';
}