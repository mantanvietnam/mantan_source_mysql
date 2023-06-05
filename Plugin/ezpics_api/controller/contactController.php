<?php 
function saveContactAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelContact = $controller->loadModel('Contact');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['content'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$data = $modelContact->newEmptyEntity();

				$data->customer_id = $checkPhone->id;
				$data->content = $dataSend['content'];
				$data->title = 'Liên hệ hỗ trợ';
				$data->type = 0; // 0: order mẫu thiết kế, 1: đăng ký designer, 2: báo xấu mẫu thiết kế
				$data->status = 0;
				$data->created_at = date('Y-m-d H:i:s');

				$modelContact->save($data);
				
				$return = array('code'=>0,'messages'=>array(array('text'=>'Lưu liên hệ thành công')));
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

function saveRequestDesignerAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelContact = $controller->loadModel('Contact');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['content'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$data = $modelContact->newEmptyEntity();

				if(isset($_FILES['file_cv']) && empty($_FILES['file_cv']["error"])){
					$file_cv = uploadImage($checkPhone->id, 'file_cv', 'file_cv_'.$checkPhone->id);
				}

				if(!empty($file_cv['linkOnline'])){
					$data->meta = $file_cv['linkOnline'];
				}

				$data->customer_id = $checkPhone->id;
				$data->content = $dataSend['content'];
				$data->title = 'Đăng ký làm Designer';
				$data->type = 1; // 0: order mẫu thiết kế, 1: đăng ký designer, 2: báo xấu mẫu thiết kế
				$data->status = 0; // 0: chưa xử lý, 1: đã xử lý
				$data->created_at = date('Y-m-d H:i:s');

				$modelContact->save($data);
				
				$return = array('code'=>0,'messages'=>array(array('text'=>'Lưu đăng ký thành công')));
				 sendNotificationAdmin('6479b759179eba65139297da');
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

function saveReportAPI($input)
{
	global $isRequestPost;
	global $controller;
	global $session;

	$modelMember = $controller->loadModel('Members');
	$modelContact = $controller->loadModel('Contact');
	$modelProduct = $controller->loadModel('Products');

	$return = array('code'=>1);
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['token']) && !empty($dataSend['content'])){
			$checkPhone = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

			if(!empty($checkPhone)){
				$data = $modelContact->newEmptyEntity();

				if(!empty($dataSend['product_id'])){
					$product = $modelProduct->find()->where(['id'=>(int) $dataSend['product_id']])->first();
				}

				if(!empty($product)){
					$data->customer_id = $checkPhone->id;
					$data->content = $dataSend['content'];
					$data->title = 'Báo xấu mẫu thiết kế ID '.$dataSend['product_id'];
					$data->type = 2; // 0: order mẫu thiết kế, 1: đăng ký designer, 2: báo xấu mẫu thiết kế
					$data->status = 0; // 0: chưa xử lý, 1: đã xử lý
					$data->meta = $dataSend['product_id'];
					$data->created_at = date('Y-m-d H:i:s');

					$modelContact->save($data);
					
					$return = array('code'=>0,'messages'=>array(array('text'=>'Lưu báo cáo thành công')));

					sendNotificationAdmin('6479b759179eba65139297da');

				}else{
					$return = array('code'=>4,
									'messages'=>array(array('text'=>'Mẫu thiết kế không còn tồn tại'))
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
?>