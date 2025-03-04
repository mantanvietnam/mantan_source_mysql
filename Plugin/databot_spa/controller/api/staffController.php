<?php 
function searchStaffApi($input)
{
	global $controller;
	global $session;

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelMember = $controller->loadModel('Members');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member);
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['phone LIKE' => '%'.$_GET['key'].'%'], ['email LIKE' => '%'.$_GET['key'].'%']];
          
            $order = array('name' => 'asc');

            $listData = $modelMember->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->phone,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'phone'=>$data->phone,
                    				'email'=>$data->email,
                    				
                    			);
                }
            }
        }
	}

	return $return;
}


function listGroupStaffAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listGroupStaff','staff');
			if(!empty($infoUser)){ 
				$limit = 20;
				$order = ['id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;

				$conditions = array('type' => 'category_member', 'id_member'=>$infoUser->id_member);
			    $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			    $totalData = $modelCategories->find()->where($conditions)->count();
		    	return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function addGroupStaffAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addGroupStaff','staff');
			if(!empty($infoUser)){

		// lấy data edit
	    if(!empty($dataSend['id'])){
	        $data = $modelCategories->get( (int) $dataSend['id']);
	    }else{
	        $data = $modelCategories->newEmptyEntity();
	        $data->created_at = time();
	    }
	        	// tạo dữ liệu save
			    $data->name = @$dataSend['name'];
			    $data->type = 'category_member';
			    $data->slug = createSlugMantan($data->name).'-'.time();
			    $data->id_member = $infoUser->id_member;
			    $modelCategories->save($data);

			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}


function detailGroupStaffAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addGroupStaff','staff');
			if(!empty($infoUser)){

	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id']])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deteleGroupStaffAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';
	
        $infoUser = $session->read('infoUser');
        $modelMembers = $controller->loadModel('Members');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deteleGroupStaff','staff');
			if(!empty($infoUser)){
            $conditions = array('id'=> $dataSend['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelCategories->find()->where($conditions)->first();
            $checkMember = $modelMembers->find()->where(array('id_group'=>$data->id))->all()->toList();

            if(!empty($checkMember)){
                return apiResponse(4,'Dữ liệu không xóa được' );
            }

            if(!empty($data)){
                $modelCategories->delete($data);
                return apiResponse(1,'Xóa dữ liệu thành công');
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listStaffAPI($input)
{
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhân viên';
    

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');


	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listStaff','staff');
			if(!empty($infoUser)){ 
				$conditions = array('id_member'=>$infoUser->id_member);
				$limit = 20;
				$order = ['status'=>'desc','id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				
				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['phone'])){
					$conditions['phone'] = $dataSend['phone'];
				}

				if(!empty($dataSend['email'])){
					$conditions['email'] = $dataSend['email'];
				}

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}

				if(isset($dataSend['status'])){
					if($dataSend['status']!=''){
						$conditions['status'] = (int) $dataSend['status'];
					}
				}

				if(isset($dataSend['id_group'])){
					if($dataSend['id_group']!=''){
						$conditions['id_group'] = (int) $dataSend['id_group'];
					}
				}
			    
			    $listData = $modelMember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelMember->find()->where($conditions)->count();
	
				return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailStaffAPI($input)
{
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhân viên';
    

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');


	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listStaff','staff');
			if(!empty($infoUser)){ 
				$conditions = array('id_member'=>$infoUser->id_member);

				$conditions['id'] = (int) $dataSend['id'];
				
			    $listData = $modelMember->find()->where($conditions)->first();

				
				if(!empty($listData->permission)){
        			$listData->permission = json_decode($listData->permission, true);
        		}else{
        			$listData->permission =array();
        		}

        		if(!empty($listData->module)){
        			$listData->module = json_decode($listData->module, true);
        		}else{
        			$listData->module =array();
        		}
	
				return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function addStaffAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;


    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name']) && !empty($dataSend['phone'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addStaff','staff');
			if(!empty($infoUser)){ 

				// lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelMembers->get( (int) $dataSend['id']);
			        
			    }else{
			        $data = $modelMembers->newEmptyEntity();
			        $data->created_at = time();
			    }

			    $listPermissionMenu = getListPermission();

		        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', @$dataSend['phone']));
		        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		        	$conditions = ['phone'=>$dataSend['phone']];
		        	$checkPhone = $modelMembers->find()->where($conditions)->first();

		        	if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){
				        // tạo dữ liệu save
				        if(empty($dataSend['id'])){
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
				        $data->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:'https://spa.databot.vn';

				        if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
							$avatar = uploadImage($data->phone, 'avatar', 'avatar'.$data->phone);
						}

						if(!empty($avatar['linkOnline'])){

							$data->image = $avatar['linkOnline'].'?time='.time();
			    		}

			    		if(empty($data->image)){
			    			$data->image = $urlHomes.'/plugins/databot_spa/view/home/assets/img/avatar-default.png';
			    		}
						$data->email = $dataSend['email'];
						$data->permission = json_encode(@$dataSend['check_list_permission']);
						$data->address = $dataSend['address'];
						$data->birthday = $dataSend['birthday'];
						$data->status = (int) $dataSend['status']; //1: kích hoạt, 0: khóa
						$data->updated_at = time();
						$data->code_otp = rand(100000, 999999);

				        $modelMembers->save($data);

				        if(!empty($data->permission)){
		        			$data->permission = json_decode($data->permission, true);
		        		}else{
		        			$data->permission = array();
		        		}

		        		if(!empty($data->module)){
		        			$data->module = json_decode($data->module, true);
		        		}else{
		        			$data->module =array();
		        		}

				      return apiResponse(1,'Lưu dữ liệu thành công',$data);
				  	}
				  	return apiResponse(3,'Lỗi hệ thống' );
				}
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
			return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function getListPermissionAPI($input){
	global $isRequestPost;
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addStaff','staff');
			if(!empty($infoUser)){ 
				$data = getListPermission($infoUser->id_member);
				return apiResponse(1,'Lấy dữ liệu thành công',$data);
				  	
				}
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
			return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function lockStaffAPI($input){
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

function changePassStaffAPI($input){
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
 ?>