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
        $data = $modelMembers->get( (int) $_GET['id']);
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
		        $data->phone = $dataSend['phone'];
				$data->id_father = (int) $dataSend['id_father'];
				$data->id_system = (int) $dataSend['id_system'];
				$data->email = $dataSend['email'];
				$data->status =  $dataSend['status'];
				$data->birthday =  $dataSend['birthday'];
				$data->facebook =  $dataSend['facebook'];
				

				if(empty($_GET['id'])){
					if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
					$data->password = md5($dataSend['password']);

					$data->created_at = time();
					$data->deadline = time() + 63072000; // 2 năm
					$data->verify =  'active';
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