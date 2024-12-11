<?php 
function listMemberAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách người dùng';
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
     

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('totalData', $totalData);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('mess', $mess);
    
    setVariable('listData', $listData);
}

function addMemberAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;
	global $modelCategories;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin người dùng hệ thống';

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

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelMembers->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
        		if(empty($dataSend['avatar'])){
                    $dataSend['avatar'] = $urlHomes.'/plugins/thuvien/view/home/assets/img/avatar-default-crm.png';
                }

		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
                $data->phone = $dataSend['phone'];
                $data->email = $dataSend['email'];
                $data->address = $dataSend['address'];
                $data->status =  $dataSend['status'];
                $data->facebook =  $dataSend['facebook'];
                $data->avatar = $dataSend['avatar'];

                if(empty($_GET['id'])){
                    $data->pass = md5($dataSend['password']);

                    $data->created_at = time();
                }else{
                    if(!empty($dataSend['password'])){
                        $data->pass = md5($dataSend['password']);
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

    setVariable('data', $data);
    setVariable('mess', $mess);
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

    return $controller->redirect('/plugins/admin/thuvien-view-admin-member-listMemberAdmin');
}
?>