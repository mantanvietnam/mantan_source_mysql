<?php 
function saveRegisterMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		
		if(empty($dataSend['status'])) $dataSend['status']=1;
		if(empty($dataSend['password'])) $dataSend['password']= $dataSend['phone'];
		if(empty($dataSend['aff'])) $dataSend['aff']= $dataSend['phone'];
		if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';
		if(empty($dataSend['type'])) $dataSend['type']= 0;

		if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['password']) && !empty($dataSend['password_again'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(empty($checkPhone)){
				if($dataSend['password'] == $dataSend['password_again']){
					$data = $modelMember->newEmptyEntity();

					$data->name = $dataSend['name'];
					$data->avatar = $dataSend['avatar'];
					$data->phone = $dataSend['phone'];
					$data->aff = $dataSend['aff'];
					$data->affsource = @$dataSend['affsource'];
					$data->email = @$dataSend['email'];
					$data->password = md5($dataSend['password']);
					$data->account_balance = 10000; // tặng 10k cho tài khoản mới
					$data->status = (int) $dataSend['status']; //1: kích hoạt, 0: khóa
					$data->type = (int) $dataSend['type']; // 0: người dùng, 1: designer
					$data->token = createToken();
					$data->created_at = date('Y-m-d H:i:s');
					$data->last_login = date('Y-m-d H:i:s');
					$data->token_device = @$dataSend['token_device'];


					$modelMember->save($data);

					$return = array(	'code'=>0, 
			    						'set_attributes'=>array('id_member'=>$data->id),
			    						'messages'=>array(array('text'=>'Lưu thông tin thành công')),
			    						'info_member'=>$data
			    					);
				}else{
					$return = array('code'=>4,
										'set_attributes'=>array('id_customer'=>0),
										'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
									);
				}
			}else{
				$return = array('code'=>3,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>'Số điện thoại đã tồn tại'))
				);

			}
		}else{
			$return = array('code'=>2,
					'set_attributes'=>array('id_customer'=>0),
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkLoginMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone']) && !empty($dataSend['password'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'], 'password'=>md5($dataSend['password']), 'status'=>1 ))->first();

			if(!empty($checkPhone)){
				if(!empty($dataSend['token_device']) && $checkPhone->token_device != $dataSend['token_device']){
					// gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $checkPhone->token_device);
				}

				$checkPhone->token = createToken();
				$checkPhone->last_login = date('Y-m-d H:i:s');
				$checkPhone->token_device = @$dataSend['token_device'];
				$modelMember->save($checkPhone);

				$return = array(	'code'=>0, 
		    						'info_member'=>$checkPhone
		    					);
			}else{
				$return = array('code'=>3,
					'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai mật khẩu'))
				);

			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkLoginFacebookAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_facebook'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'FB'.$dataSend['id_facebook'];

			$checkPhone = $modelMember->find()->where(array('id_facebook'=>$dataSend['id_facebook'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_facebook = @$dataSend['id_facebook'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 10000; // tặng 10k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_facebook = $dataSend['id_facebook'];


				$modelMember->save($data);

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
			    					);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkLoginGoogleAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_google'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'GG'.$dataSend['id_google'];

			$checkPhone = $modelMember->find()->where(array('id_google'=>$dataSend['id_google'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_google = @$dataSend['id_google'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 10000; // tặng 10k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_google = $dataSend['id_google'];


				$modelMember->save($data);

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
			    					);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkLoginAppleAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['id_apple'])){
			if(empty($dataSend['phone'])) $dataSend['phone'] = 'A'.$dataSend['id_apple'];

			$checkPhone = $modelMember->find()->where(array('id_apple'=>$dataSend['id_apple'] ))->first();

			if(empty($checkPhone) && !empty($dataSend['phone'])){
				$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
				$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

				$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone'] ))->first();
			}

			if(empty($checkPhone) && !empty($dataSend['email'])){
				$checkPhone = $modelMember->find()->where(array('email'=>$dataSend['email'] ))->first();
			}

			if(!empty($checkPhone)){
				if($checkPhone->status == 1){
					$checkPhone->token = createToken();
					$checkPhone->last_login = date('Y-m-d H:i:s');
					$checkPhone->token_device = @$dataSend['token_device'];
					$checkPhone->id_apple = @$dataSend['id_apple'];
					$modelMember->save($checkPhone);

					$return = array(	'code'=>0, 
			    						'info_member'=>$checkPhone
			    					);
				}else{
					$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản đã bị khóa hoặc không tồn tại'))
								);
				}
			}else{
				// tạo mới tài khoản
				$data = $modelMember->newEmptyEntity();

				if(empty($dataSend['avatar'])) $dataSend['avatar']= 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

				$data->name = $dataSend['name'];
				$data->avatar = $dataSend['avatar'];
				$data->phone = @$dataSend['phone'];
				$data->aff = @$dataSend['phone'];
				$data->affsource = '';
				$data->email = @$dataSend['email'];
				$data->password = md5(@$dataSend['phone']);
				$data->account_balance = 10000; // tặng 10k cho tài khoản mới
				$data->status = 1; //1: kích hoạt, 0: khóa
				$data->type = 0; // 0: người dùng, 1: designer
				$data->token = createToken();
				$data->created_at = date('Y-m-d H:i:s');
				$data->last_login = date('Y-m-d H:i:s');
				$data->token_device = @$dataSend['token_device'];
				$data->id_apple = $dataSend['id_apple'];


				$modelMember->save($data);

				$return = array(	'code'=>0, 
			    						'info_member'=>$data
			    					);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function logoutMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->token = '';
				$checkPhone->token_device = null;
				$modelMember->save($checkPhone);

				$return = array('code'=>0);
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function getTopDesignerAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelOrder = $controller->loadModel('Orders');
	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $input['request']->getData();
	$listDesign = [];

	if(empty($dataSend['orderBy'])) $dataSend['orderBy'] = 'bestSeller';

	if($dataSend['orderBy'] == 'bestSeller' || $dataSend['orderBy'] == 'bestMoney'){
		// bán được nhiều mẫu hoặc doanh thu cao trong tuần
		$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")));
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->member_id])){
					$listDesignStatic[$value->member_id] = 0;
				}

				if($dataSend['orderBy'] == 'bestSeller'){
					$listDesignStatic[$value->member_id] ++;
				}else{
					$listDesignStatic[$value->member_id] += $value->total;
				}
			}

			arsort($listDesignStatic);

			foreach ($listDesignStatic as $key => $value) {
				$member = $modelMember->find()->where(['id'=>(int) $key])->first();
				if(!empty($member)){
					$member->sold = $value;
					unset($member->password);
					unset($member->token);

					$listDesign[] = $member;
				}
			}
		}
	}elseif($dataSend['orderBy'] == 'bestCreate'){
		// tạo nhiều mẫu bán trong tuần
		$conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-7 day")), 'status'=>1);
		$limit = (!empty($dataSend['limit']))?(int) $dataSend['limit']:12;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		$order = array();

		$listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		$listDesignStatic = [];

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				if(empty($listDesignStatic[$value->user_id ])){
					$listDesignStatic[$value->user_id ] = 0;
				}

				$listDesignStatic[$value->user_id] ++;
			}

			arsort($listDesignStatic);

			foreach ($listDesignStatic as $key => $value) {
				$member = $modelMember->find()->where(['id'=>(int) $key])->first();
				if(!empty($member)){
					$member->sold = $value;
					unset($member->password);
					unset($member->token);

					$listDesign[] = $member;
				}
			}
		}
	}

	return 	array('listData'=>$listDesign);
}

function getInfoMemberAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$name_slug = createSlugMantan($checkPhone->name);
				$checkPhone->link_share = 'https://designer.ezpics.vn/designer/'.$name_slug.'-'.$checkPhone->id.'.html';
				
				$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'messages'=>array(array('text'=>'bạn lấy dữ liệu thành công'))
								);
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
								);
			}
		}else{
			$return = array('code'=>2,
									'messages'=>array(array('text'=>'Bạn thiếu dữ liệu'))
								);
		}
	
	}

	return $return;
}

function getInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelProduct = $controller->loadModel('Products');
	$modelOrder = $controller->loadModel('Orders');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();


		if(!empty($dataSend['idUser'])){
			$checkPhone = $modelMember->find()->where(array('id'=>$dataSend['idUser'] , 'type'=> 1))->first();
		

			if(!empty($checkPhone)){
				unset($checkPhone->password);
				unset($checkPhone->token);
				unset($checkPhone->token_device);
				unset($checkPhone->id_facebook);
				unset($checkPhone->last_login);
				unset($checkPhone->account_balance);
				
				if($checkPhone->type==1){

					$product = $modelProduct->find()->where(array('user_id' => $checkPhone->id, 'type'=>'user_create','status'=>2))->all()->toList();
					$checkPhone->listProduct = @$product;
					$checkPhone->quantityProduct = count(@$product);

					$Order = $modelOrder->find()->where(array('member_id' => $checkPhone->id, 'type'=>3))->all()->toList();
					$checkPhone->quantitySell  = count(@$Order);

					$Follow = $modelFollowDesigner->find()->where(array('designer_id' => $checkPhone->id))->all()->toList();
					$checkPhone->quantityFollow  = count(@$Follow);

					$name_slug = createSlugMantan($checkPhone->name);
					$checkPhone->link_share = 'https://designer.ezpics.vn/designer/'.$name_slug.'-'.$checkPhone->id.'.html';

					$return = array('code'=>0,
								 'data'=>$checkPhone,
								 'messages'=>array(array('text'=>'Bạn lấy dữ liệu thành công'))
								);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Tài khoản chưa phải là designer'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
								);
			}
		}else{
			$return = array('code'=>2,
									'messages'=>array(array('text'=>'Bạn thiếu dữ liệu'))
								);
		}
	
	}

	return $return;
}

function lockAccountAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkPhone->status = 0;
				$checkPhone->token = '';
				$modelMember->save($checkPhone);
				
				$return = array('code'=>0);
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function saveChangePassAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) 
			&& !empty($dataSend['passOld'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				if($checkPhone->password == md5($dataSend['passOld']) ){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->token = '';

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>5,
									'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
								);
					}
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Mật khẩu cũ nhập không đúng'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function saveInfoUserAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) 
			&& !empty($dataSend['name'])
			&& !empty($dataSend['email'])

		){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
					$avatar = uploadImage($checkPhone->id, 'avatar', 'avatar_'.$checkPhone->id);
				}

				if(!empty($avatar['linkOnline'])){
					$checkPhone->avatar = $avatar['linkOnline'];
				}

				$checkPhone->name = $dataSend['name'];
				$checkPhone->email = $dataSend['email'];

				if(isset($dataSend['description'])){
					$checkPhone->description = $dataSend['description'];
				}

				if(isset($_FILES['file_cv']) && empty($_FILES['file_cv']["error"])){
					$file_cv = uploadImage($checkPhone->id, 'file_cv', 'file_cv_'.$checkPhone->id);

					if(!empty($file_cv['linkOnline'])){
						$checkPhone->file_cv = $file_cv['linkOnline'].'?time='.time();
					}
				}

				if(!empty($dataSend['phone'])){
					$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
					$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

					$checkMember = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

					if(empty($checkMember) || $checkMember->id == $checkPhone->id){
						$checkPhone->phone = $dataSend['phone'];

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>4,
									'messages'=>array(array('text'=>'Số điện thoại đã tồn tại'))
								);
					}
				}else{
					$modelMember->save($checkPhone);

					$return = array('code'=>0);
				}

				
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function requestCodeForgotPasswordAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1,
					'messages'=>array(array('text'=>''))
				);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone'])){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone->email)){
				$code = rand(1000,9999);

				$checkPhone->token = $code;
				$modelMember->save($checkPhone);

				sendEmailCodeForgotPassword($checkPhone->email, $checkPhone->name, $code);

				$return = array('code'=>0,
								'codeForgotPassword' => $code,
								'messages'=>array(array('text'=>''))
							);
			}else{
				$return = array('code'=>3,
					'messages'=>array(array('text'=>'Tài khoản chưa cài email'))
				);
			}
		}else{
			$return = array('code'=>2,
							'messages'=>array(array('text'=>'Gửi thiếu dữ liệu hoặc sai định dạng số điện thoại'))
						);
		}
	}

	return $return;
}

function saveNewPassAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
		$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

		if(!empty($dataSend['phone']) 
			&& !empty($dataSend['code'])
			&& !empty($dataSend['passNew'])
			&& !empty($dataSend['passAgain'])

		){
			$checkPhone = $modelMember->find()->where(array('phone'=>$dataSend['phone']))->first();

			if(!empty($checkPhone)){
				if($checkPhone->token == $dataSend['code'] ){
					if($dataSend['passNew'] == $dataSend['passAgain']){
						$checkPhone->password = md5($dataSend['passNew']);
						$checkPhone->token = '';

						$modelMember->save($checkPhone);

						$return = array('code'=>0);
					}else{
						$return = array('code'=>5,
									'messages'=>array(array('text'=>'Mật khẩu nhập lại không đúng'))
								);
					}
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Mã xác thực nhập không đúng'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai số điện thoại'))
								);
			}
		}else{
			$return = array('code'=>2,
					'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
				);
		}
	}

	return $return;
}

function checkCodeAffiliateAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['aff'])){
			$checkPhone = $modelMember->find()->where(array('aff'=>$dataSend['aff']))->first();

			if(!empty($checkPhone)){
				$return = array('code'=>0);
			}else{
				$return = array('code'=>3);
			}
		}else{
			$return = array('code'=>2);
		}
	}

	return $return;
}

?>