<?php 
function setttingZaloOA($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Cài đặt Zalo OA';

		$modelZalos = $controller->loadModel('Zalos');

		$mess= '';

		$infoUser = $session->read('infoUser');

		// lấy data edit
		$data = $modelZalos->find()->where(['id_system'=>$infoUser->id_system])->first();

		if(empty($data)){
			$data = $modelZalos->newEmptyEntity();
		}

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['id_oa']) && !empty($dataSend['id_app']) && !empty($dataSend['secret_key']) && !empty($dataSend['template_otp'])){
	        	$data->id_oa = trim($dataSend['id_oa']);
		        $data->id_app = trim($dataSend['id_app']);
		        $data->secret_key = trim($dataSend['secret_key']);
		        $data->template_otp = (int) $dataSend['template_otp'];
		        $data->id_system = $infoUser->id_system;

		        $modelZalos->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    
		    }else{
		    	$mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function callbackZalo($input)
{
	global $controller;

	if(!empty($_GET['code']) && !empty($_GET['oa_id'])){
		$modelZalos = $controller->loadModel('Zalos');

		$zalooa = $modelZalos->find()->where(['id_oa'=>$_GET['oa_id']])->first();

		if(!empty($zalooa)){
			$zalooa->oauth_code = $_GET['code'];

			$modelZalos->save($zalooa);

			$return = getAccessTokenZaloOA($zalooa->id_oa, $zalooa->id_app);
		}
	}

	return $controller->redirect('/setttingZaloOA');
}
?>