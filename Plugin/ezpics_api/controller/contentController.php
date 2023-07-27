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
					$data->keyword = $dataSend['keyword'];
					$data->product_id = $dataSend['idProduct'];
					$data->content = $dataSend['content'];
					$data->created_at = date('Y-m-d H:i:s');

					$modelContent->save($data);
				
				$return = array('code'=>1,'mess'=>'Lưu content thành công');


				}else{
					$return = array('code'=>4,
								'mess'=>'Sản phẩm không tồn tại'
				);
				}
			}else{
				$return = array('code'=>3,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>2,
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
				$dataContent = $modelContent->find()->where(array('user_id'=>$checkPhone->id))->all()->toList();
				if(!empty($dataContent)){
					$data = array();
					foreach($dataContent as $key => $item){
						$checkProduct = $modelProduct->find()->where(array('id'=>$item->product_id))->first();
						if(!empty($checkProduct)){
							$item->nameProduct = $checkProduct->name;
							$item->imageProduct = $checkProduct->image;
						}

						$data[] = $item; 
					}

					$return = array('code'=>1,
							'data' => $data,
							'mess'=>'Lấy data thành công'
						);
				}else{
					$return = array('code'=>4,
								'mess'=>'không có data'
					);
				}
			}else{
				$return = array('code'=>3,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>2,
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

					$checkProduct = $modelProduct->find()->where(array('id'=>$item->product_id))->first();
					$data->nameProduct = $checkProduct->name;
					$data->imageProduct = $checkProduct->image;
				
					$return = array('code'=>1,
							'data' => $data,
							'mess'=>'Lấy data thành công'
						);
				}else{
					$return = array('code'=>4,
								'mess'=>'không có data'
					);
				}
			}else{
				$return = array('code'=>3,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>2,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}

function  deleteContentAPI($input){
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

					$modelContent->delete($data);
				
					$return = array('code'=>1,
							'mess'=>'Xóa content thành công'
						);
				}else{
					$return = array('code'=>4,
								'mess'=>'không Xóa được'
					);
				}
			}else{
				$return = array('code'=>3,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>2,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}

function  updateContentAPI($input){
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
					$data->keyword = $dataSend['keyword'];
					$data->content = $dataSend['content'];
					$modelContent->save($data);
				
					$return = array('code'=>1,
							'mess'=>'Sửa content thành công'
						);
				}else{
					$return = array('code'=>4,
								'mess'=>'sai id không sửa được'
					);
				}
			}else{
				$return = array('code'=>3,
							'mess'=>'Tài khoản không tồn tại hoặc sai token'
				);
			}
		}else{
			$return = array('code'=>2,
				'mess'=>'Gửi thiếu dữ liệu'
			);
		}
	}

	return $return;
}
 ?>