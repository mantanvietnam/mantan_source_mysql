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
				$data->type = 0;
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
				$data->type = 1;
				$data->status = 0;
				$data->created_at = date('Y-m-d H:i:s');

				$modelContact->save($data);
				
				$return = array('code'=>0,'messages'=>array(array('text'=>'Lưu đăng ký thành công')));
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