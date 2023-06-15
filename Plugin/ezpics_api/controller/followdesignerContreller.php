<?php 
function addFollowDesignerAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['idDesigner'])){
			$checkUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();


			if(!empty($checkUser)){
				$checkDesigner = $modelMember->find()->where(array('id'=>$dataSend['idDesigner'], 'type'=>1))->first();

				if(!empty($checkDesigner)){
					$checkFollowDesigne = $modelFollowDesigner->find()->where(array('designer_id'=>$checkDesigner->id, 'user_id'=>$checkUser->id))->first();
					if(empty($checkFollowDesigne) && $checkDesigner->id!=$checkUser->id){
						$save = $modelFollowDesigner->newEmptyEntity();
						$save->designer_id = $checkDesigner->id;
						$save->user_id = $checkUser->id;
						$save->created_at = date('Y-m-d H:i:s');
						$save->status = 1;

						$modelFollowDesigner->save($save);

							$return = array(	'code'=>0, 
				    						'messages'=>array(array('text'=>'Lưu thông tin thành công')),
				    						);
					}else{
						$return = array('code'=>5,
									'messages'=>array(array('text'=>'Bạn đã theo dõi Designer này rồi'))
								);
					}	
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Designer này không tồn tại'))
								);
				}
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
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

function deleteFollowDesignerAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['idDesigner'])){
			$checkUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();


			if(!empty($checkUser)){
				$checkFollowDesigne = $modelFollowDesigner->find()->where(array('designer_id'=>$dataSend['idDesigner'], 'user_id'=>$checkUser->id))->first();
				if(!empty($checkFollowDesigne)){
					$modelFollowDesigner->delete($checkFollowDesigne);
					
					$return = array('code'=>0, 
				    				'messages'=>array(array('text'=>'Xóa thông tin thành công')),
				    			);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Bạn chưa theo dõi Designer này'))
								);
				}	
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
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

function checkFollowDesignerAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['idDesigner'])){
			$checkUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();


			if(!empty($checkUser)){
				$checkFollowDesigne = $modelFollowDesigner->find()->where(array('designer_id'=>$dataSend['idDesigner'], 'user_id'=>$checkUser->id))->first();
				if(!empty($checkFollowDesigne)){
					
					$return = array('code'=>0, 
				    				'messages'=>array(array('text'=>'Bạn đã theo dõi Designer này')),
				    			);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Bạn chưa theo dõi Designer này'))
								);
				}	
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
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

function listFollowDesignerAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modelFollowDesigner = $controller->loadModel('FollowDesigners');
	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>1);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkUser = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();


			if(!empty($checkUser)){
				$checkFollowDesigne = $modelFollowDesigner->find()->where(array( 'user_id'=>$checkUser->id))->all();
				if(!empty($checkFollowDesigne)){
					$data = array();
					foreach($checkFollowDesigne as $key => $item){
						
						$checkDesigner = $modelMember->find()->where(array('id'=>$item->designer_id))->first();

						unset($checkDesigner->password);
						unset($checkDesigner->token);
						unset($checkDesigner->token_device);
						unset($checkDesigner->id_facebook);
						unset($checkDesigner->last_login);
						unset($checkDesigner->account_balance);
						$item->info = $checkDesigner;

						$data[] = $item;
					}
					
					
					$return = array('code'=>0, 
									'data'=> @$data,
				    				'messages'=>array(array('text'=>'Bạn lấy data thành công')),
				    			);
				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Bạn chưa theo dõi Designer này'))
								);
				}	
			}else{
				$return = array('code'=>3,
									'messages'=>array(array('text'=>'Tài khoản không tồn tại'))
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
 ?>

