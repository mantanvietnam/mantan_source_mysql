<?php 
function listDonateCharityCRM($input)
{
	global $controller;
	global $urlCurrent;

	$modelDonate = $controller->loadModel('Donates');
	$modelCharity = $controller->loadModel('Charities');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id_charity'])){
		$conditions['id_charity'] = $_GET['id_charity'];
	}

	if(!empty($_GET['order_by_coin'])){
		$order['coin'] = $_GET['order_by_coin'];
	}

    $listData = $modelDonate->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $listCharities= array();
    if(!empty($listData)){
    	foreach ($listData as $key => $item) {
    		if(empty($listCharities[$item->id_charity])){
    			$listCharities[$item->id_charity] = $modelCharity->get($item->id_charity);
    		}
    	}
    }

    $totalData = $modelDonate->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0)
        $totalPage+=1;

    $back = $page - 1;
    $next = $page + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
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
	        $data->image = $dataSend['image'];
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
		    }else{
		    	calculateMoney((int) $dataSend['id_charity']);
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
	$modelCharity = $controller->loadModel('Charities');
	
	if(!empty($_GET['id'])){
		$data = $modelDonate->get($_GET['id']);
		
		if($data){
			// xóa lịch sử đóng góp
         	$modelDonate->delete($data);

         	// cập nhập lại số tiền của chương trình từ thiện
			calculateMoney((int) $data->id_charity);
        }
	}

	return $controller->redirect('/plugins/admin/2top_crm_donate-view-admin-donate-listDonateCharityCRM.php');
}

function listDonateCharity($input)
{
	global $controller;
    global $isRequestPost;
    global $modelOptions;

    $modelDonate = $controller->loadModel('Donates');
	$modelCharity = $controller->loadModel('Charities');

	if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
		if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }
        
        $data = $modelCharity->find()->where($conditions)->order(['id' => 'DESC'])->first();

        if(!empty($data)){
        	$conditions = array('id_charity'=>$data->id);
        	$donates = $modelDonate->find()->where($conditions)->all()->toList();

        	// lấy cài đặt
        	$conditionsSetting = array('key_word' => 'settingCharity2TOPCRM');
            $settingCharity2TOPCRM = $modelOptions->find()->where($conditionsSetting)->first();
            if(empty($settingCharity2TOPCRM)){
                $settingCharity2TOPCRM = $modelOptions->newEmptyEntity();
            }

            $setting_value = array();
            if(!empty($settingCharity2TOPCRM->value)){
                $setting_value = json_decode($settingCharity2TOPCRM->value, true);
            }
           
        	setVariable('donates', $donates);
        	setVariable('data', $data);
        	setVariable('setting_value', $setting_value);
        }else{
            return $controller->redirect('/?error=emptyDataCharity');
        }
	}else{
        return $controller->redirect('/?error=emptySlugCharity');
    }
}
?>