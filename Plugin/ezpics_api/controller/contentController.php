<?php 
function addContentAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelContent = $controller->loadModel('ProductContents');

	$return = array('code'=>0);
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['content']) && !empty($dataSend['idProduct'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$checkProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct']))->first();
				if(!empty($checkProduct)){
					$data = $modelContent->newEmptyEntity();
					$data->user_id = $checkPhone->id;
					$data->product_id = $dataSend['idProduct'];
					$data->content = $dataSend['content'];
					$data->created_at = date('Y-m-d H:i:s');

					$modelContent->save($data);
				
				$return = array('code'=>1,'mess'=>'Lưu đăng ký thành công');


				}else{
					$return = array('code'=>0,
								'mess'=>'Sản phẩm không tồn tại'
				);
				}
			}else{
				$return = array('code'=>0,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>0,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}

function listContentAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelContent = $controller->loadModel('ProductContents');

	$return = array('code'=>0);
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$data = $modelContent->find()->where(array('user_id'=>$checkPhone->id))->all()->toList();
				if(!empty($data)){
				
					$return = array('code'=>1,
							'data' => $data,
							'mess'=>'Lấy data thành công'
						);
				}else{
					$return = array('code'=>0,
								'mess'=>'không có data'
					);
				}
			}else{
				$return = array('code'=>0,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>0,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}

function getContentAPI($input){
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelContent = $controller->loadModel('ProductContents');

	$return = array('code'=>0);
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$data = $modelContent->find()->where(array('user_id'=>$checkPhone->id, 'id'=>$dataSend['id']))->first();
				if(!empty($data)){
				
					$return = array('code'=>1,
							'data' => $data,
							'mess'=>'Lấy data thành công'
						);
				}else{
					$return = array('code'=>0,
								'mess'=>'không có data'
					);
				}
			}else{
				$return = array('code'=>0,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>0,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}
 ?>