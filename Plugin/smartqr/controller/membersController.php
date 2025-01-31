<?php 
function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

    $metaTitleMantan = 'Đăng nhập phần mềm quản lý mã QR';

    $modelMembers = $controller->loadModel('Members');

    if(empty($session->read('infoUser'))){
    	$mess = '';

	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if($info_customer){
	    			$info_customer->last_login = time();
	    			$modelMembers->save($info_customer);

	    			$session->write('infoUser', $info_customer);
	    			
					return $controller->redirect('/mySmartQR');
	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/mySmartQR');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();

	return $controller->redirect('/login');
}

function changePass($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi mật khẩu';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
				if($dataSend['passNew'] == $dataSend['passAgain']){
					$user = $modelMembers->get($session->read('infoUser')->id);

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

						$modelMembers->save($user);

						$mess= '<p class="text-success">Đổi mật khẩu thành công</p>';
					}else{
						$mess= '<p class="text-danger">Sai mật khẩu cũ</p>';
					}
				}else{
					$mess= '<p class="text-danger">Mật khẩu nhập lại chưa đúng</p>';
				}
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		setVariable('mess', $mess);
	}else{
		return $controller->redirect('/login');
	}
}

function account($input)
{
	global $session;
	global $controller;
	global $metaTitleMantan;
	global $isRequestPost;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->get($session->read('infoUser')->id);

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['avatar']) && !empty($dataSend['email'])){
				$user->name = $dataSend['name'];
				$user->avatar = $dataSend['avatar'];
				$user->email = $dataSend['email'];

				$modelMembers->save($user);

				$session->write('infoUser', $user);

				$mess= '<p class="text-success">Đổi thông tin thành công</p>';
			}else{
				$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
			}
		}

		setVariable('mess', $mess);
		setVariable('user', $user);
	}else{
		return $controller->redirect('/login');
	}
}

function listMember($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelMembers = $controller->loadModel('Members');
    
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
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
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addMember($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin khách hàng';

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

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
	        $data->name = $dataSend['name'];
            $data->avatar = $dataSend['avatar'];
            $data->phone = $dataSend['phone'];
            $data->email = $dataSend['email'];
            $data->status = $dataSend['status'];
            

            if(empty($_GET['id'])){
            	$data->password = md5($dataSend['password']);
            	$data->created_at = time();
            	$data->last_login = time();
            }

	        $modelMembers->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên khách hàng</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteMember($input){
	global $controller;

	$modelMembers = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelMembers->get($_GET['id']);
		
		if($data){
         	$modelMembers->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/smartqr-view-admin-member-listMember');
}
?>