<?php 
function listDonateCharityCRM($input)
{
	global $controller;

	$modelDonate = $controller->loadModel('Donates');
	$modelCharity = $controller->loadModel('Charities');

	$conditions = array();

	if(!empty($_GET['id_charity'])){
		$conditions['id_charity'] = $_GET['id_charity'];
	}

    $listData = $modelDonate->find()->where($conditions)->all()->toList();

    $listCharities= array();
    if(!empty($listData)){
    	foreach ($listData as $key => $item) {
    		if(empty($listCharities[$item->id_charity])){
    			$listCharities[$item->id_charity] = $modelCharity->get($item->id_charity);
    		}
    	}
    }

    setVariable('listData', $listData);
    setVariable('listCharities', $listCharities);
}

function addDonateCharityCRM($input)
{
	global $controller;
	global $isRequestPost;

	$modelDonate = $controller->loadModel('Donates');
	$modelCustomer = $controller->loadModel('Customers');
	$modelCharity = $controller->loadModel('Charities');

	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelDonate->get( (int) $_GET['id']);
    }else{
        $data = $modelDonate->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['full_name']) && !empty($dataSend['id_charity']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	if(empty($dataSend['avatar'])) $dataSend['avatar']='https://quayso.xyz/app/Plugin/quayso/view/manager/img/avtar-default.png';

	        // tạo dữ liệu save
	        $data->id_charity = $dataSend['id_charity'];
	        $data->coin = (int) $dataSend['coin'];
	        $data->note = $dataSend['note'];
	        
	        $data->full_name = $dataSend['full_name'];
	        $data->phone = $dataSend['phone'];
	        $data->email = $dataSend['email'];
	        $data->avatar = $dataSend['avatar'];
	        $data->id_customer = 0;

	        if(!empty($dataSend['phone'])){
	        	$conditions = array();
	        	$conditions['phone'] = $dataSend['phone'];
	        	$checkCustomer = $modelCustomer->find()->where($conditions)->all()->toList();
	        	if(!empty($checkCustomer)){
	        		$data->id_customer = $checkCustomer[0]->id;
	        	}else{
	        		$dataCustomer = array(	'full_name'=>$dataSend['full_name'],
	        								'phone'=>$dataSend['phone'],
	        								'email'=>$dataSend['email'],
	        								'address'=>'',
	        								'sex'=>1,
	        								'id_city'=>0,
	        								'id_messenger'=>'',
	        								'avatar'=>$dataSend['avatar'],
	        								'status'=>'active',
	        						);
	        		$data->id_customer = addCustomer($dataCustomer);
	        	}
	        }

	        $modelDonate->save($data);

	        // cập nhập lại số tiền của chương trình từ thiện
	        if(empty($_GET['id'])){
		        $infoCharity = $modelCharity->get( (int) $dataSend['id_charity']);
		        if(!empty($infoCharity)){
		        	$infoCharity->person_donate ++;
		        	$infoCharity->money_donate += $dataSend['coin'];

		        	$modelCharity->save($infoCharity);
		        }
		    }

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đủ dữ liệu bắt buộc</p>';
	    }
    }

    $listCharities = $modelCharity->find()->where()->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listCharities', $listCharities);
}

function deleteDonateCharityCRM($input){
	global $controller;

	$modelDonate = $controller->loadModel('Donates');
	
	if(!empty($_GET['id'])){
		$data = $modelDonate->get($_GET['id']);
		
		if($data){
         	$modelDonate->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_donate-view-admin-donate-listDonateCharityCRM.php');
}
?>