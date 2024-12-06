<?php 


function login($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập tài khoản';

    $modelMembers = $controller->loadModel('Members');

    if(empty($session->read('infoUser'))){
    	$mess = '';

    	if(!empty($_GET['error'])){
    		switch ($_GET['error']) {
    			case 'account_lock':
    				$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
    				break;
    		}
    	}
    	
	    if($isRequestPost){
	    	$dataSend = $input['request']->getData();
	    	
	    	if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
	    		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	    		$conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['password']));
	    		$info_customer = $modelMembers->find()->where($conditions)->first();

	    		if(!empty($info_customer)){
    				// nếu tài khoản không bị khóa
    				if($info_customer->status == 'active'){
    					
						$info_customer->last_login = time();
						$modelMembers->save($info_customer);

						$session->write('CheckAuthentication', true);
		                $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');
						
    					$session->write('infoUser', $info_customer);
		    			
	    				setcookie('id_member',$info_customer->id,time()+365*24*60*60, "/");
						
						return $controller->redirect('/dashboard/?statusLogin=loginAccount');
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }elseif(!empty($_COOKIE['id_member'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_member']);
    		$info_customer = $modelMembers->find()->where($conditions)->first();

    		if(!empty($info_customer)){
				// nếu tài khoản không bị khóa
				if($info_customer->status == 'active'){
					$info_customer->last_login = time();
					$modelMembers->save($info_customer);

					$session->write('CheckAuthentication', true);
		            $session->write('urlBaseUpload', '/upload/admin/images/'.$info_customer->id.'/');
					
	    			$session->write('infoUser', $info_customer);
	    			
	    			return $controller->redirect('/ai-virtual-assistant/?statusLogin=loginCookie');
				}else{
					$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
				}
    		}
    	}

	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/dashboard');
	}
}

function logout($input)
{	
	global $session;
	global $controller;

	$session->destroy();
	setcookie('id_member','',time()+365*24*60*60, "/");

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
					$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

					if($user->password == md5($dataSend['passOld'])){
						$user->password = md5($dataSend['passNew']);

						$modelMembers->save($user);

						$session->write('infoUser', $user);

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
	global $modelCategories;
	global $urlHomes;
	global $displayInfo;

	$metaTitleMantan = 'Đổi thông tin tài khoản';

	$modelMembers = $controller->loadModel('Members');

	if(!empty($session->read('infoUser'))){
		$mess = '';

		$user = $modelMembers->find()->where(['id'=>(int) $session->read('infoUser')->id])->first();

		if($isRequestPost){
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name'])){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($user->id, 'avatar', 'avatar_'.$user->id);
				}

				if(!empty($avatar['linkOnline'])){
					$user->avatar = $avatar['linkOnline'].'?time='.time();
				}else{
					if(empty($user->avatar)){
						$user->avatar = $urlHomes.'/plugins/vemoi/view/home/assets/img/avatar-default-crm.png';
					}
				}

				$user->name = $dataSend['name'];
				$user->email = $dataSend['email'];
				$user->address = $dataSend['address'];

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

function forgotPass($input){
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;

	$metaTitleMantan = 'Số điện thoại xác thực';

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions['phone'] = $dataSend['phone'];
		$checkMember = $modelMembers->find()->where($conditions)->first();

		if(!empty($checkMember)){
			$checkMember->otp = rand(1000,9999);
			
			$modelMembers->save($checkMember);
			sendEmailnewpassword($checkMember->email, $checkMember->name, $checkMember->otp);
			
			$session->write('phone', $checkMember->phone);
			
			return $controller->redirect('/confirm');


		}else{
			$mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
		}
		setVariable('mess', $mess);
	}
}

function confirm($input)
{

	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	$phone = $session->read('phone');

	$modelMembers = $controller->loadModel('Members');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		$conditions = array();
		$conditions = array('phone'=>@$phone, 'otp'=>(int)$dataSend['code']);
		$data = $modelMembers->find()->where($conditions)->first();
		if(!empty($data)){
			if($dataSend['pass'] == $dataSend['passAgain']){
				$data->pass = md5($dataSend['pass']);

				$modelMembers->save($data);
				$session->destroy();
	    			
				return $controller->redirect('/login');		

			}else{
				$mess= '<p class="text-danger">Mật khẩu xác nhận của bạn không đúng</p>';
			}
		}else{
			$mess= '<p class="text-danger">Mã xác thực bạn không đúng</p>';
		}

	    setVariable('mess', $mess);
	}

}

function listPermission(){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
     
    $metaTitleMantan = 'Danh sách nhóm phân quyền ';

    $modelMember = $controller->loadModel('Members');
    
    $modelPermission = $controller->loadModel('Permissions');
    
    $user = checklogin('listPermission');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestPermission':
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

        $listPermissionMenu = getListPermission();
        $limit = 20;
        $order = ['id' => 'DESC'];
        $conditions  =[];
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }
        
        $listData = $modelPermission->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


        if($listData){
            foreach($listData as $key => $item){
                if(!empty($item->permission)){
                    $listData[$key]->permission = json_decode($item->permission, true);
                }
            }
        }

        $totalData = $modelPermission->find()->where($conditions)->all()->toList();
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

        setVariable('listPermissionMenu', $listPermissionMenu);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/');
    }
}

function addPermission($input){ 
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';

    $modelMembers = $controller->loadModel('Members');
    $modelPermission = $controller->loadModel('Permissions');
    
    $user = checklogin('addPermission');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelPermission->get( (int) $_GET['id']);
        }else{
            $data = $modelPermission->newEmptyEntity();
            $data->created_at = time();
        }
        $mess ='';
        if($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->permission = json_encode(@$dataSend['check_list_permission']);
                $modelPermission->save($data);

                if(!empty($_GET['id'])){
                    $note = $user->name.' sửa thông tin nhóm nhân viên '.$data->name.' có id đơn là:'.$data->id;
                }else{
                    $note = $user->name.' tạo mới nhóm nhân viên '.$data->name.' có id đơn là:'.$data->id;
                }
               addActivityHistory($user,$note,'addPermission',$data->id);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
            }
        }

        if(!empty($data->permission)){
            $data->permission = json_decode($data->permission, true);
        }

        $listPermissionMenu = getListPermission();

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listPermissionMenu', $listPermissionMenu);

    }else{
        return $controller->redirect('/');
    }
}

function detelePermission($input){  
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin Nhóm nhân viên';
    
    $user = checklogin('detelePermission');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
       
       $modelPermission = $controller->loadModel('Permissions');
        $modelMembers = $controller->loadModel('Members');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id']);
            
            $data = $modelPermission->find()->where($conditions)->first();
            $checkMembers = $modelMembers->find()->where(array('id_group'=>$data->id))->all()->toList();

            if(!empty($checkMembers)){
                return $controller->redirect('/listPermission?error=requestDelete');

            }

            if(!empty($data)){
                 $note =  $user->name.' xóa thông tin nhóm phân quyền '.$data->name.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'detelePermission',$data->id);
                $modelCategories->delete($data);
                return $controller->redirect('/listPermission?error=requestDeleteSuccess');
            }
        }
    }else{
        return $controller->redirect('/');
    }
}

function listActivityHistory(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listActivityHistory');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách lịch sử hàng động nhân viên';

        $modelMembers = $controller->loadModel('Members');
        $modelActivityHistory = $controller->loadModel('ActivityHistorys');
        
        $order = array('id'=>'desc');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;

        if(!empty($_GET['id_member'])){
            $conditions['id_member'] = (int) $_GET['id_member'];
        }


        $listData = $modelActivityHistory->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id_member)){
                   
                    $item->infoStaff = $modelMembers->find()->where(array('id'=>$item->id_member))->first();
                }
            }
        }
        
        

        // phân trang
        $totalData = $modelActivityHistory->find()->where($conditions)->all()->toList();
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
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
    global $session;
    global $modelCategoryConnects;

     $user = checklogin('listMember');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Danh sách nhân viên';

        $modelMember = $controller->loadModel('Members');
        
        $order = array('id'=>'desc');

        $conditions = array('type'=>'staff');
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }


        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone'] = $_GET['phone'];
        }

       

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['email'])){
            $conditions['email'] = $_GET['email'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelMember->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $birthday = '';
                    if(!empty($value->birthday)){
                        $birthday = date('d/m/Y',$value->birthday);
                    }

                    $dataExcel[] = [
                        $value->full,   
                        $value->phone,   
                        $value->address,   
                        $value->email,  
                        $status,
                        $birthday
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }else{
            $listData = $modelMember->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        // phân trang
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('mess', $mess);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
       // / setVariable('listGroup', $listGroup);
    }else{
        return $controller->redirect('/login');
    }
}

function addMember($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

     $user = checklogin('addMember');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/addMember');
        }
        $mess = '';

        $metaTitleMantan = 'Thông tin nhân viên';
        $modelMember = $controller->loadModel('Members');
        $modelPermission = $controller->loadModel('Permissions');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelMember->find()->where(['id'=>(int) $_GET['id']])->first();

            if(empty($data)){
                return $controller->redirect('/listMember');
            }
        }else{
            $data = $modelMember->newEmptyEntity();
            $data->created_at = time();
            $data->type = 'staff';
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone']];
                $checkPhone = $modelMember->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
                  

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'avatar_staff_'.$data->id;
                        }else{
                            $fileName = 'avatar_staff_'.time().rand(0,1000000);
                        }

                        $avatar = uploadImage($user->id, 'avatar', $fileName);
                    }

                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->avatar)){
                            if(!empty($system->image)){
                                $data->avatar = $system->image;
                            }

                            if(empty($data->avatar)){
                                $data->avatar = $urlHomes.'/plugins/thuvien/view/home/assets/img/avatar-default-crm.png';
                            }
                        }
                    }
                    
                    $data->name = $dataSend['name'];
                    $data->address = $dataSend['address'];
                    $data->phone = $dataSend['phone'];
                    $data->email = $dataSend['email'];
                    $data->id_permission = (int) $dataSend['id_permission'];
                    $data->id_position = (int) @$dataSend['id_position'];

                    if(!empty($dataSend['check_list_permission'])){
                        $data->permission = json_encode(@$dataSend['check_list_permission']);
                    }else{
                        if(!empty($data->id_permission)){ 
                            $data->permission = $modelPermission->find()->where(['id'=>$data->id_permission])->first()->permission;
                        }else{
                             $data->permission = json_encode(array());
                        }
                    }
                    

                    if(!empty($dataSend['birthday'])){
                        $birthday = explode('/', $dataSend['birthday']);
                         $data->birthday  = mktime(0,0,0,$birthday[1],$birthday[0],$birthday[2]);
                    }
                    $data->status = $dataSend['status']; 
                    $data->description = $dataSend['description']; 

                    if(empty($_GET['id'])){
                        if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                        $data->pass = md5($dataSend['password']);

                        $data->created_at = time();
                       $data->deadline = $user->deadline; 
                         
                    }else{
                        if(!empty($dataSend['password'])){
                            $data->pass = md5($dataSend['password']);
                        }
                    }

                    $modelMember->save($data);

                    if(!empty($_GET['id'])){
                        $note = $user->name.' sửa thông tin người dùng là '.$data->name.'('.$data->phone.') có id đơn là:'.$data->id;
                    }else{
                        $note = $user->name.' tạo người dùng là '.$data->name.'('.$data->phone.') có id đơn là:'.$data->id;
                    }


                    addActivityHistory($user,$note,'addOrderCustomer',$data->id);

                     return $controller->redirect('/listMember?mess=saveSuccess');
                }else{
                    $mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
                }
            
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }

        if(!empty($data->permission)){
            $data->permission = json_decode($data->permission, true);
        }


        $listPermissionMenu = getListPermission();
        $dataGroupStaff = $modelPermission->find()->where([])->all()->toList();
        setVariable('data', $data);
        setVariable('listPermissionMenu', $listPermissionMenu);
        setVariable('dataGroupStaff', $dataGroupStaff);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteMember($input){
      global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $user = checklogin('deleteStaff');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listStaff');
        }
         $modelMember = $controller->loadModel('Members');
        if(!empty($_GET['id'])){
            $data = $modelMember->find()->where([ 'id'=>(int) $_GET['id']])->first();
            
            if($data){
                $data->status = 'delete';
                $modelMember->save($data);

                $note = $user->name.' xóa thông tin người dùng là '.$data->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteMember',$data->id);
                 return $controller->redirect('/listMember?mess=deleteSuccess');
            }
        }
         return $controller->redirect('/listMember?mess=deleteError');
    }else{
        return $controller->redirect('/login');
    }
}

?>
