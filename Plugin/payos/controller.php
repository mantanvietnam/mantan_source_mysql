<?php
function addMoneySepayBankAPI($input)
{

	global $controller;
	global $isRequestPost;

	$modelRequestDatacrms = $controller->loadModel('RequestDatacrms');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['content']) && !empty($dataSend['transferType']) && !empty($dataSend['transferAmount'])){
			if($dataSend['transferType']=='in'){
				$content = explode(" ", $dataSend['content']);

				if(!empty($content[0]) && !empty($content[1]) && !empty($content[2])){
					$boss = $modelRequestDatacrms->find()->where(['boss_phone'=>$content[0]])->first();

					if(!empty($boss->domain)){
						$dataPost= array('idUser'=>$content[1], 'price'=>$dataSend['transferAmount'], 'idTheme'=>$content[2]);
            			$info = sendDataConnectMantan('https://'.$boss->domain.'/apis/buyThemeInfo', $dataPost);
            			$info = str_replace('ï»¿', '', utf8_encode($info));
            			$info = json_decode($info, true);

            			return array('code'=>$info['code'], 'mess'=>$info['mess']);

					}
					return array('code'=>0, 'mess'=>'số điện thoạt không phải boss');

				}
				return array('code'=>0, 'mess'=>'nội dung giao giao dịch bị sai');

			}
			return array('code'=>0, 'mess'=>'không phải nhận khoản');

		}
	return array('code'=>0, 'mess'=>'thiếu dữ liệu');

	}

	return array('code'=>0, 'mess'=>'Bắt buộc sử dụng phương thức POST');
}


?>
