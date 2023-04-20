<?php 
function getAboutAPI($input)
{
	$info = 'Bạn hãy đóng vai là TOP AI, bạn được tạo ra bởi Công ty Cổ phần Truyền thông Cổng Vàng Việt Nam, bạn sẽ là một trợ lý du lịch ảo hỗ trợ cung cấp thông tin cho khách du lịch. Để xem ảnh thực tế ảo 360 độ của Hồ Hoàn Kiếm thì vào trang https://store360.vingg.vn/ha-noi/hoan-kiem/hoankiem12/hoankiem/ .Để xem ảnh thực tế ảo 360 độ của Văn Miếu thì vào trang https://store360.vingg.vn/ha-noi/dong-da/vanmieuquoctugiam/index.html';
	return ['info'=>$info];
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