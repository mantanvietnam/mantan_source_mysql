<?php 
function listStaff($input)
{
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhân viên';
    
    setVariable('page_view', 'listStaff');
    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	
	if(!empty(checkLoginManager('listStaff', 'staff'))){
		$infoUser = $session->read('infoUser');
		$conditions = array('id_member'=>$infoUser->id_member);
		$limit = 20;
		$order = ['status'=>'desc','id' => 'DESC'];

		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = (int) $_GET['status'];
			}
		}

		if(isset($_GET['id_group'])){
			if($_GET['id_group']!=''){
				$conditions['id_group'] = (int) $_GET['id_group'];
			}
		}
	    
	    $listData = $modelMember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelMember->find()->where($conditions)->all()->toList();
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
	    
	    $conditionsCategories = array('type' => 'category_member', 'id_member' => $infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategories)->order($order)->all()->toList();

        if(empty($listCategory)){
        	return $controller->redirect('/listGroupStaff/?error=requestGroupStaff');
        }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('totalData', $totalData);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    
	    setVariable('listCategory', $listCategory);
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/');
	}
}

function addStaff($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin nhân viên';

    setVariable('page_view', 'addStaff');
    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	
	if(!empty(checkLoginManager('addStaff', 'staff'))){
		$infoUser = $session->read('infoUser');

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelMembers->get( (int) $_GET['id']);
	        
	    }else{
	        $data = $modelMembers->newEmptyEntity();
	        $data->created_at = time();
	    }

	    $listPermissionMenu = getListPermission();

	    $mess ='';

		if($isRequestPost){
	        $dataSend = $input['request']->getData();

	        

	        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
	        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', @$dataSend['phone']));
	        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	        	$conditions = ['phone'=>$dataSend['phone']];
	        	$checkPhone = $modelMembers->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        if(empty($_GET['id'])){
			        	$data->phone = $dataSend['phone'];
			        	$data->created_at = time();
			        	$data->id_member = $infoUser->id_member;
			        	$data->type = 0; // 0: nhân viên, 1: chủ spa
			        	$data->number_spa = 0;

			        	if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
						$data->password = md5($dataSend['password']);
			        }

			        $data->name = $dataSend['name'];
			        $data->id_group =(int) @$dataSend['id_group'];
			        $data->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:'https://spa.databot.vn/plugins/databot_spa/view/home/assets/img/avatar-default.png';
					$data->email = $dataSend['email'];
					$data->permission = json_encode(@$dataSend['check_list_permission']);
					$data->address = $dataSend['address'];
					$data->birthday = $dataSend['birthday'];
					$data->status = (int) $dataSend['status']; //1: kích hoạt, 0: khóa
					$data->updated_at = time();
					$data->code_otp = rand(100000, 999999);

			        $modelMembers->save($data);

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	    $conditionsCategorie = array('type' => 'category_member', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategorie)->order($order)->all()->toList();

        if(empty($listCategory)){
        	return $controller->redirect('/listGroupStaff/?error=requestGroupStaff');
        }
        if(!empty($data->permission)){
        	$data->permission = json_decode($data->permission, true);
        }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listPermissionMenu', $listPermissionMenu);
        setVariable('listCategory', $listCategory);

	}else{
		return $controller->redirect('/');
	}
}

function lockStaff($input){
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhóm nhân viên';

    $modelMember = $controller->loadModel('Members');
	
	if(!empty(checkLoginManager('lockStaff', 'staff'))){
		$infoUser = $session->read('infoUser');

		if(!empty($_GET['id'])){
		$data = $modelMember->get($_GET['id']);
		
			if($data){
				if(isset($_GET['status'])){
					$data->status = $_GET['status'];
				
	         	$modelMember->save($data);
	         	return $controller->redirect('/listStaff');
	        	}
			}
		}
	}else{
		return $controller->redirect('/login');
	}
}

function changePassStaff($input){
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhóm nhân viên';

    setVariable('page_view', 'changePassStaff');
    $modelMember = $controller->loadModel('Members');
	
	$mess = '';
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		if(!empty($_GET['id'])){
		$data = $modelMember->get($_GET['id']);
		
		if($isRequestPost){
			$dataSend = $input['request']->getData();

			$data->password= md5($dataSend['passNew']);
         	$modelMember->save($data);
         	return $controller->redirect('/listStaff');
        }

        setVariable('data', $data);
	    setVariable('mess', $mess);
	}

	}else{
		return $controller->redirect('/');
	}
}

function listGroupStaff(){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhóm nhân viên';
    
    setVariable('page_view', 'listGroupStaff');
    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	
	if(!empty(checkLoginManager('listGroupStaff', 'staff'))){
		$mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestGroupStaff':
                    $mess= '<p class="text-danger">Bạn cần tạo nhóm nhân viên trước</p>';
                    break;
                    case 'requestDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa nhóm nhân viên này</p>';
                    break;
                	case 'requestDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

		$infoUser = $session->read('infoUser');

		$conditions = array('id_member'=>$infoUser->id_member);
		$limit = 20;
		$order = ['id' => 'DESC'];

		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;

		$conditions = array('type' => 'category_member', 'id_member'=>$infoUser->id_member);
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}
	    
	    $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelCategories->find()->where($conditions)->all()->toList();
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
	}else{
		return $controller->redirect('/');
	}
}

function addGroupStaff($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';

    setVariable('page_view', 'addGroupStaff');
    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	
	if(!empty(checkLoginManager('addGroupStaff', 'staff'))){
		$infoUser = $session->read('infoUser');

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelCategories->get( (int) $_GET['id']);
	    }else{
	        $data = $modelCategories->newEmptyEntity();
	        $data->created_at = time();
	    }

	    $mess ='';

		if($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
	        	// tạo dữ liệu save
			    $data->name = @$dataSend['name'];
			    $data->type = 'category_member';
			    $data->slug = createSlugMantan($data->name).'-'.time();
			    $data->id_member = $infoUser->id_member;

			    
			    $modelCategories->save($data);

			    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);

	}else{
		return $controller->redirect('/');
	}
}

function deteleGroupStaff($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';
	
	if(!empty(checkLoginManager('deteleGroupStaff', 'staff'))){
        $infoUser = $session->read('infoUser');
        $modelMembers = $controller->loadModel('Members');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelCategories->find()->where($conditions)->first();
            $checkMember = $modelMembers->find()->where(array('id_group'=>$data->id))->all()->toList();

            if(!empty($checkMember)){
                return $controller->redirect('/listGroupStaff?error=requestDelete');

            }

            if(!empty($data)){
                $modelCategories->delete($data);
                return $controller->redirect('/listGroupStaff?error=requestDeleteSuccess');
            }
        }
    }else{
        return $controller->redirect('/');
    }
}

function listStaffBonus($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhân viên';
    
   
    $modelMember = $controller->loadModel('Members');
	$modelStaffBonu = $controller->loadModel('StaffBonus');
	
	if(!empty(checkLoginManager('listStaffBonus', 'staff'))){

		$infoUser = $session->read('infoUser');
		$conditions = array('id_member'=>$infoUser->id_member);
		$url= explode('?', $urlCurrent);
		if($url[0]=='/listStaffPunish'){
	    	 setVariable('page_view', 'listStaffPunish');
	    	$conditions['type']= 'punish';
	    	$title = 'Phạt';
	    	$slug = 'Punish';
	    	$type ='phạt';
	    }else{
	    	 setVariable('page_view', 'listStaffBonus');
	    	$conditions['type']= 'bonus';
	    	$title = 'Thưởng';
	    	$slug = 'Bonus';
	    	$type ='thưởng';
	    }
		
		
		$limit = 20;
		$order = ['status'=>'desc','id' => 'DESC'];

		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = $_GET['id_staff'];
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = (int) $_GET['status'];
			}
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time >='] = $date_start;
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time <='] = $date_end;
		}
	    
	    $listData = $modelStaffBonu->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	    	foreach($listData as $key => $item){
	    		$listData[$key]->infoStaff = $modelMember->find()->where(['id'=>$item->id_staff])->first();
	    	}
	    }

	    $totalData = $modelStaffBonu->find()->where($conditions)->all()->toList();
	    
	    $totalMoney = 0;
	     if(!empty($totalData)){
			foreach($totalData as $key =>$item){
				$totalMoney += $item->money;
			}
		}
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
	    
	    $conditionsCategories = array('type' => 'category_member', 'id_member' => $infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategories)->order($order)->all()->toList();

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('totalData', $totalData);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('totalMoney', $totalMoney);
	    setVariable('urlPage', $urlPage);
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);
	    
	    setVariable('listCategory', $listCategory);
	    setVariable('listData', $listData);
	    setVariable('listStaffs', $listStaffs);
	}else{
		return $controller->redirect('/');
	}
}

function addStaffBonus($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';

   
    $modelMember = $controller->loadModel('Members');
	$modelStaffBonu = $controller->loadModel('StaffBonus');
	
	if(!empty(checkLoginManager('addGroupStaff', 'staff'))){
		$infoUser = $session->read('infoUser');

		$url= explode('?', $urlCurrent);
		if($url[0]=='/addStaffPunish'){
	    	 setVariable('page_view', 'addStaffPunish');
	    	$datatype= 'punish';
	    	$title = 'Phạt';
	    	$slug = 'Punish';
	    	$type ='phạt';
	    }else{
	    	 setVariable('page_view', 'addStaffBonus');
	    	$datatype= 'bonus';
	    	$title = 'Thưởng';
	    	$slug = 'Bonus';
	    	$type ='thưởng';
	    }

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelStaffBonu->get( (int) $_GET['id']);
	    }else{
	        $data = $modelStaffBonu->newEmptyEntity();
	        $data->created_at = time();
			$data->status = 'new';
	    }

	    $mess ='';

		if($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['money'])){
	        	// tạo dữ liệu save
	        	$data->id_staff =(int)@$dataSend['id_staff'];
	        	$data->id_member = @$infoUser->id_member;
	        	$data->note = @$dataSend['note'];
	        	$data->type = @$datatype;
	        	$data->updated_at =time();
	        	$data->money = (int)@$dataSend['money'];
	        	$data->id_spa = @$infoUser->id_spa;
	        	

			    $modelStaffBonu->save($data);

			    $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	     $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

	    setVariable('data', $data);
	    setVariable('listStaffs', $listStaffs);
	    setVariable('mess', $mess);
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);

	}else{
		return $controller->redirect('/');
	}
}
?>