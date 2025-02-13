<?php 
function listMemberAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách đại lý hệ thống';
    $mess = '';

	$modelMembers = $controller->loadModel('Members');
	
	$conditions = array();
	$limit = 20;


	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditions['phone'] = $_GET['phone'];
	}

	if(!empty($_GET['email'])){
		$conditions['email'] = $_GET['email'];
	}

	if(!empty($_GET['status'])){
		$conditions['status'] = $_GET['status'];
	}

	if(!empty($_GET['id_system'])){
		$conditions['id_system'] = (int) $_GET['id_system'];
	}

	if(!empty($_GET['name'])){
		$conditions['name LIKE'] = '%'.$_GET['name'].'%';
	}

    $listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->father = $modelMembers->find()->where(['id'=>$value->id_father])->first();
        }
    }
    

    $totalData = $modelMembers->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'system_sales');
    $listSystem = $modelCategories->find()->where($conditions)->all()->toList();
     

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
    setVariable('listSystem', $listSystem);
}

function addMemberAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
	global $modelCategories;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đại lý hệ thống';

	$modelMembers = $controller->loadModel('Members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelMembers->find()->where(['id'=>(int) $_GET['id']])->first();
    }else{
        $data = $modelMembers->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['id_system'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelMembers->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
        		if(empty($dataSend['avatar'])){
        			$system = $modelCategories->find()->where(['id'=>(int) $dataSend['id_system']])->first();

        			if(!empty($system->image)){
        				$dataSend['avatar'] = $system->image;
        			}

        			if(empty($dataSend['avatar'])){
        				$dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-ezpics.png';
        			}
        		}

		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->address = $dataSend['address'];
		        $data->avatar = $dataSend['avatar'];
                $data->img_logo = $dataSend['img_logo'];
		        $data->phone = $dataSend['phone'];
				$data->id_father = (int) $dataSend['id_father'];
				$data->id_system = (int) $dataSend['id_system'];
                $data->id_position = (int) $dataSend['id_position'];
				$data->email = $dataSend['email'];
				$data->status =  $dataSend['status'];
				$data->birthday =  $dataSend['birthday'];
				$data->facebook =  $dataSend['facebook'];
				$data->verify =  $dataSend['verify'];
                $data->linkedin = $dataSend['linkedin'];
                $data->web = $dataSend['web'];
                $data->instagram = $dataSend['instagram'];
                $data->zalo = $dataSend['zalo'];
                $data->twitter = $dataSend['twitter'];
                $data->tiktok = $dataSend['tiktok'];
                $data->youtube = $dataSend['youtube'];
                $data->description = $dataSend['description'];
                $data->portrait = $dataSend['portrait'];
                $data->create_agency = $dataSend['create_agency'];
                $data->create_order_agency = (int) $dataSend['create_order_agency'];
                $data->token_device = '';
                $data->token = '';

				if(empty($_GET['id'])){
					if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
					$data->password = md5($dataSend['password']);

					$data->created_at = time();
					$data->deadline = time() + 63072000; // 2 năm
				}else{
					if(!empty($dataSend['password'])){
			        	$data->password = md5($dataSend['password']);
			        }
				}

		        $modelMembers->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
		    }
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }

    $conditions = array('type' => 'system_sales');
    $listSystem = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listSystem', $listSystem);
}

function deleteMemberAdmin($input){
    global $controller;

    $modelMembers = $controller->loadModel('Members');
    
    if(!empty($_GET['id'])){
        $data = $modelMembers->find()->where(['id'=>(int) $_GET['id']])->first();
        
        if($data){
            $modelMembers->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin');
}

function activateThemeMemberAdmin($input){
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
	global $modelCategories;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đại lý hệ thống';

	$modelMembers = $controller->loadModel('Members');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id_member'])){
        $data = $modelMembers->find()->where(['id'=>(int) $_GET['id_member']])->first();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $data->list_theme_info = implode(',', $dataSend['list_theme_info']);
        
        $modelMembers->save($data);
        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $conditions = array('type' => 'system_sales');
    $listSystem = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listSystem', $listSystem);
}


function listThemeInfoAdmin(){
	InstallistThemeInfo();
	 global $modelOptions;
    $conditions = array('key_word' => 'themeinfo');

    $data = $modelOptions->find()->where($conditions)->first();
    $value = [];
    if(!empty($data->value)){
        $value = json_decode($data->value,true);
    }

    setVariable('data', $value);



}

function editPriceAdmin(){
	global $controller;
	global $modelOptions;
    $conditions = array('key_word' => 'themeinfo');

    $data = $modelOptions->find()->where($conditions)->first();
    $value = [];
    if(!empty($data->value)){
        $value = json_decode($data->value,true);
        foreach ($value as $key => $item) {
        	if($item['id']==(int)$_GET['id']){
        		$item['price']= (int)$_GET['price'];
        		$value[$key]=$item;
        	}
        }
        $data->value = json_encode($value);

        $modelOptions->save($data);
    }

    return $controller->redirect('/plugins/admin/hethongdaily-view-admin-member-listThemeInfoAdmin');																
}
?>