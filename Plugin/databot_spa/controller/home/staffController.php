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
    global $listBank;
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
					$data->fixed_salary = @$dataSend['fixed_salary'];
					$data->insurance = @$dataSend['insurance'];
					$data->allowance = @$dataSend['allowance'];
					$data->account_bank = @$dataSend['account_bank'];
					$data->code_bank = @$dataSend['code_bank'];
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
	    setVariable('listBank', $listBank);
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

function timesheetStaff($input){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty(checkLoginManager('timesheetStaff', 'staff'))){
        
        $metaTitleMantan = 'Bảng chấm công nhân viên';
        $user = $session->read('infoUser');

        $modelMember = $controller->loadModel('Members');
		$modelSpas = $controller->loadModel('Spas');
        
        $order = array('id'=>'desc');

        $conditions = array('id_member'=>$user->id_member);

        // phân trang
        $listStaff = $modelMember->find()->where($conditions)->all()->toList();
        // Thiết lập tháng và năm

        if(!empty($_GET['month'])){
            $thang = (int) $_GET['month'];
        }else{
            $thang = date('m');
        }

        if(!empty($_GET['year'])){
            $nam = (int) $_GET['year'];
        }else{
            $nam = date('Y');
        }

        // Lấy số ngày trong tháng
        $so_ngay_trong_thang = cal_days_in_month(CAL_GREGORIAN, $thang, $nam);

        $date = array();

        // Lặp qua các ngày trong tháng
        for ($ngay = 1; $ngay <= $so_ngay_trong_thang; $ngay++) {
            // Tạo chuỗi ngày định dạng Y-m-d
            $ngay_dang = sprintf("%04d-%02d-%02d", $nam, $thang, $ngay);
            
            // Lấy tên thứ bằng tiếng Anh và chuyển sang tiếng Việt
            $thu = thu_tieng_viet(date('l', strtotime($ngay_dang)));
            
            // In ra ngày và thứ
          //  echo $ngay_dang . " - " . $thu . "<br>";
            $date[$ngay] = array('thu'=>$thu, 'ngay'=>$ngay.'/'.$thang.'/'.$nam);

        }

 
    setVariable('date', $date);
    setVariable('thang', $thang);
    setVariable('nam', $nam);
    setVariable('listStaff', $listStaff);

    }else{
       return $controller->redirect('/listStaff');
    }
}

function checktimesheet($input){
     global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     if(!empty(checkLoginManager('checktimesheet', 'staff'))){
        
        $metaTitleMantan = 'Bảng chấm công nhân viên';
        $user = $session->read('infoUser');
       
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelMember = $controller->loadModel('Members');
        $modelStaffTimekeepers = $controller->loadModel('StaffTimekeepers');

        $conditions = array('id_member'=>$user->id_member, 'id'=>(int)$_GET['id_staff']);
        $staff = $modelMember->find()->where($conditions)->first();
        // Thiết lập tháng và năm

        $date = explode('/', $_GET['date']);
        $date = mktime(0,0,0,$date[1],$date[0],$date[2]);
        
        $checkdate = $modelStaffTimekeepers->find()->where(['created_at'=>$date,'id_staff'=>$staff->id])->first();
        if(!empty($_GET['shift'])){
            if(empty($checkdate)){
                $checkdate = $modelStaffTimekeepers->newEmptyEntity();
                $checkdate->created_at = $date;
                 $checkdate->check_in = $date;
                $checkdate->id_staff = $staff->id;
            }

            $checkdate->shift = implode(', ', $_GET['shift']);
            

            $modelStaffTimekeepers->save($checkdate);
        }elseif(!empty($checkdate)){
            $modelStaffTimekeepers->delete($checkdate);
        }

        

        return $controller->redirect('/timesheetStaff');
        

    }else{
        return $controller->redirect('/timesheetStaff');
    }
}

function payrollstaff($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if(!empty(checkLoginManager('payrollstaff', 'staff'))){
        
        $metaTitleMantan = 'Bảng chấm công nhân viên';
        $user = $session->read('infoUser');
       
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelMember = $controller->loadModel('Members');
        $modelStaffTimekeepers = $controller->loadModel('StaffTimekeepers');
		$modelStaffBonu = $controller->loadModel('StaffBonus');
        $modelAgency = $controller->loadModel('Agencys');

        $conditions = array('id_member'=>$user->id_member );

        if(!empty($_GET['id_staff'])){
        	$conditions['id']= $_GET['id_staff'];
        }

        // phân trang
        $dataStaff = $modelMember->find()->where($conditions)->first();
        // Thiết lập tháng và năm

        if(!empty($_GET['month'])){
            $thang = (int) $_GET['month'];
        }else{
            $thang = date('m');
        }

        if(!empty($_GET['year'])){
            $nam = (int) $_GET['year'];
        }else{
            $nam = date('Y');
        }

        // Lấy số ngày trong tháng
        $so_ngay_trong_thang = cal_days_in_month(CAL_GREGORIAN, $thang, $nam);

        $date = array();

        // Lặp qua các ngày trong tháng
        for ($ngay = 1; $ngay <= $so_ngay_trong_thang; $ngay++) {
            // Tạo chuỗi ngày định dạng Y-m-d
            $ngay_dang = sprintf("%04d-%02d-%02d", $nam, $thang, $ngay);
            
            // Lấy tên thứ bằng tiếng Anh và chuyển sang tiếng Việt
            $thu = thu_tieng_viet(date('l', strtotime($ngay_dang)));
            
            // In ra ngày và thứ
          //  echo $ngay_dang . " - " . $thu . "<br>";
            $date[$ngay] = array('thu'=>$thu, 'ngay'=>$ngay.'/'.$thang.'/'.$nam);

        }

        $working_day = 0;
        if(!empty($dataStaff)){
            foreach($date as $key => $value){
                $checkdate = checkStaffTimekeepers($value['ngay'],$dataStaff->id);
                if(!empty($checkdate)){
                	$shift = count(explode(",", $checkdate->shift));
                    if($shift==1){
                      $working_day += 0.5;
                    }else{
                      $working_day += 1;
                    }
                }
            } 
        }


		$date = getMonthStartEnd($nam, $thang);
		$conditions = array('id_member'=>$user->id_member,'id_staff'=>$dataStaff->id);
		$conditions['created_at >='] = (int) strtotime($date['start']);
		$conditions['created_at <='] = (int) strtotime($date['end']);
		$conditions['type'] = 'punish';
	    $listDatapunish = $modelStaffBonu->find()->where($conditions)->all()->toList();

	    $conditions['type'] = 'bonus';
	    $listDatabonus = $modelStaffBonu->find()->where($conditions)->all()->toList();
	    $punish= 0;
	    if(!empty($listDatapunish)){
            foreach($listDatapunish as $key => $value){
                $punish +=  $value->money;
            } 
        }

        $bonus= 0;
	    if(!empty($listDatabonus)){
            foreach($listDatabonus as $key => $value){
                $bonus +=  $value->money;
            } 
        }

        $conditions = array('id_member'=>$user->id_member,'id_staff'=>$dataStaff->id);
		$conditions['created_at >='] = (int) strtotime($date['start']);
		$conditions['created_at <='] = (int) strtotime($date['end']);
	    $listDatacommission= $modelAgency->find()->where($conditions)->all()->toList();

	     $commission= 0;
	    if(!empty($listDatacommission)){
            foreach($listDatacommission as $key => $value){
                $commission +=  $value->money;
            } 
        }

        setVariable('date', $date);
    	setVariable('thang', $thang);
    	setVariable('nam', $nam);
    	setVariable('dataStaff', $dataStaff);
    	setVariable('working_day', $working_day);
    	setVariable('punish', $punish);
    	setVariable('bonus', $bonus);
    	setVariable('commission', $commission);

    }else{
        return $controller->redirect('/timesheetStaff');
    }
}
?>