<?php 
function getAboutAPI($input)
{
	global $modelOptions;
	global $controller;

	$modelLocations = $controller->loadModel('Locations');

	$conditions = array('key_word' => 'generalDescriptionAI');
    $data = $modelOptions->find()->where($conditions)->first();
    $info = '';

    if(!empty($data->value)){
    	$info = $data->value;
    }
    $info .= ' . Đây là các thông tin tôi cung cấp sẵn cho bạn, bạn hãy ghi nhớ lại nhé.';
    $allLocation = $modelLocations->find()->all()->toList();

    if(!empty($allLocation)){
    	foreach ($allLocation as $item) {
    		$info .= ' . Để xem ảnh thực tế ảo 360 độ của '.$item->name.' (có địa chỉ là '.$item->address.') thì vào trang web '.$item->link360;
    	}
    }

	return ['info'=>$info.'.'];
}

function getKeyChatGPTAPI($input)
{
	$key = '';
	
	if(function_exists('getKey')){
		$key = getKey(2);
	}

	return ['key'=>$key];
}

function lockKeyChatGPTAPI($input)
{
	$dataSend = $input['request']->getData();

	if(!empty($dataSend['key'])){
		if(function_exists('lockKey')){
			lockKey($dataSend['key']);
		}
	}

	return ['code'=>1];
}
?>