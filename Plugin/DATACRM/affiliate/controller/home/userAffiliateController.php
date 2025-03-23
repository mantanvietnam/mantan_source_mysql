<?php 
function affiliaterLogin($input)
{
	global $metaTitleMantan;
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

    $metaTitleMantan = 'Đăng nhập phần mềm quản lý đại lý';

    $modelMembers = $controller->loadModel('Members');
    $modelAffiliaters = $controller->loadModel('Affiliaters');

    if(empty($session->read('infoAff'))){
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

	    		$conditions = array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']));
	    		$info_aff = $modelAffiliaters->find()->where($conditions)->first();

	    		if(!empty($info_aff)){
	    			if($info_aff->status == 'active'){
	    				$members = $modelMembers->find()->where(array('id'=>$info_aff->id_member))->first();
    					if($members->deadline > time()){
    						$info_aff->last_login = time();
							$modelAffiliaters->save($info_aff);
			    			$session->write('CheckAuthentication', true);
		                    $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');
                            $info_aff->info_system = $modelCategories->find()->where(['id'=>(int) $info_aff->id_system])->first();

			    			$session->write('infoAff', $info_aff);
			    			

			    				setcookie('id_aff',$info_aff->id,time()+365*24*60*60, "/");
								
								return $controller->redirect('/listOrderAffiliater/?statusLogin=loginAccount');
							
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}

	    		}else{
	    			$mess= '<p class="text-danger">Sai số điện thoại hoặc mật khẩu</p>';
	    		}
	    	}else{
	    		$mess= '<p class="text-danger">Bạn gửi thiếu thông tin</p>';
	    	}
	    }elseif(!empty($_COOKIE['id_aff'])){
    		$conditions = array('id'=>(int) $_COOKIE['id_aff'], 'status'=>'active');
    		$info_aff = $modelAffiliaters->find()->where($conditions)->first();

    		if(!empty($info_aff)){
    			$members = $modelMembers->find()->where(array('id'=>$info_aff->id_member))->first();
    			if($members->deadline > time()){
					// nếu tài khoản không bị khóa
					if($members->status == 'active'){
						if($members->deadline > time()){
							$info_aff->last_login = time();
							$modelAffiliaters->save($info_aff);
							$session->write('CheckAuthentication', true);
			                $session->write('urlBaseUpload', '/upload/admin/images/'.$members->id.'/');

				    		$session->write('infoAff', $info_aff);
				    			
				    		setcookie('id_aff',$info_aff->id,time()+365*24*60*60, "/");
									
							return $controller->redirect('/listOrderAffiliater/?statusLogin=loginAccount');
						
						}else{
							$mess= '<p class="text-danger">Tài khoản của bạn đã hết hạn sử dụng. Liên hệ Zalo số 081.656.0000 để được hỗ trợ</p>';
						}
					}else{
						$mess= '<p class="text-danger">Tài khoản của bạn đã bị khóa</p>';
					}
				}
    		}
    	}


	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/listOrderAffiliater/?statusLogin=loginDone');
	}
}

function affiliaterLogout($input)
{	
	global $session;
	global $controller;

	$session->destroy();
	setcookie('id_member','',time()+365*24*60*60, "/");
	setcookie('id_staff','',time()+365*24*60*60, "/");
	setcookie('id_aff','',time()+365*24*60*60, "/");

	return $controller->redirect('/affiliaterLogin');
}


function affiliaterAccount($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    if(!empty($session->read('infoAff'))){
        $metaTitleMantan = 'Thông tin Tài khoản';  
        $modelAffiliaters = $controller->loadModel('Affiliaters');

        $mess= '';

        $infoUser = $session->read('infoAff');

        // lấy data edit
            $data = $modelAffiliaters->find()->where(['id'=> $infoUser->id])->first();
        

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                
                  

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($data->id)){
                            $fileName = 'avatar_aff_'.$data->id;
                        }else{
                            $fileName = 'avatar_aff_'.time().rand(0,1000000);
                        }

                        $avatar = uploadImage($infoUser->id_member, 'avatar', $fileName);
                    }

                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->avatar)){
                            if(!empty($system->image)){
                                $data->avatar = $system->image;
                            }

                            if(empty($data->avatar)){
                                $data->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
                            }
                        }
                    }
                    
                    $data->name = $dataSend['name'];
                    $data->address = $dataSend['address'];
                    $data->email = $dataSend['email'];
                    $data->linkedin = $dataSend['linkedin'];
                    $data->web = $dataSend['web'];
                    $data->instagram = $dataSend['instagram'];
                    $data->zalo = $dataSend['zalo'];
                    $data->twitter = $dataSend['twitter'];
                    $data->tiktok = $dataSend['tiktok'];
                    $data->youtube = $dataSend['youtube'];
                    $data->facebook = $dataSend['facebook'];
                    $data->description = $dataSend['description']; 
                    $data->bank_number = $dataSend['bank_number']; 
                    $data->bank_code = $dataSend['bank_code']; 
            
                    $modelAffiliaters->save($data);

                    $data->info_system = $modelCategories->find()->where(['id'=>(int) $data->id_system])->first();

                    $session->write('infoAff', $data);
                     $mess= '<p class="text-success">Đổi thông tin thành công</p>';
            }else{
                $mess= '<p class="text-danger">Bạn nhập thiếu dữ liệu bắt buộc</p>';
            }
        }
        
        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function affiliaterChangePass($input)
{
    global $session;
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Đổi mật khẩu';

     if(!empty($session->read('infoAff'))){
        $modelAffiliaters = $controller->loadModel('Affiliaters');
        $mess = '';
        $user = $session->read('infoAff');
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['passOld']) && !empty($dataSend['passNew']) && !empty($dataSend['passAgain'])){
                if($dataSend['passNew'] == $dataSend['passAgain']){
                    $data = $modelAffiliaters->find()->where(['id'=>(int) $user->id])->first();

                    if($data->password == md5($dataSend['passOld'])){
                        $data->password = md5($dataSend['passNew']);

                        $modelAffiliaters->save($data);
                        
                        $session->write('infoStaff', $data);

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

function affiliaterForgotPass($input)
{
    global $metaTitleMantan;
    global $isRequestPost;
    global $controller;
    global $session;
    $metaTitleMantan = 'Quên mật khẩu';

    $modelAffiliaters = $controller->loadModel('Affiliaters');

    setVariable('page_view', 'forgotPass');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $conditions = array();
        $conditions['phone'] = $dataSend['phone'];
        $checkMember = $modelAffiliaters->find()->where($conditions)->first();
        if(!empty($checkMember)){
            $pass = rand(100000,999999);
            $checkMember->code_otp = $pass;
            $modelAffiliaters->save($checkMember);
            sendEmailnewpassword($checkMember->email, $checkMember->name, $pass);
            $session->write('phone', $checkMember->phone);
            return $controller->redirect('/affiliaterConfirm');
        }else{
            $mess= '<p class="text-danger">Số điện thoại không đúng!</p>';
        }
        setVariable('mess', $mess);
    }
}

function affiliaterConfirm($input)
{

    global $metaTitleMantan;
    global $isRequestPost;
    global $controller;
    global $session;

    $phone = $session->read('phone');

    setVariable('page_view', 'confirm');
    $modelMembers = $controller->loadModel('Members');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $conditions = array();
        $conditions = array('phone'=>@$phone, 'code_otp'=>$dataSend['code']);
        $data = $modelMembers->find()->where($conditions)->first();
        if(!empty($data)){
            if($dataSend['pass'] == $dataSend['passAgain']){
                $data->password = md5($dataSend['pass']);
                $data->code_otp = rand(100000, 999999);
                $modelMembers->save($data);
                $session->destroy();
                return $controller->redirect('/affiliaterLogin');     
            }else{
                $mess= '<p class="text-danger">Mật khẩu nhập lại không đúng</p>';
            }
        }else{
            $mess= '<p class="text-danger">Mã xác thực của bạn không đúng</p>';
        }
        setVariable('mess', $mess);
    }
}

 ?>