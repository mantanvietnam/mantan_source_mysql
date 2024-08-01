<?php 	
function addNotificationAdmin($input)
{
	global $controller;
	 global $modelPosts;
	global $isRequestPost;
	global $metaTitleMantan;

	$metaTitleMantan = 'Gửi thông báo cho người dùng';

	$modelUser = $controller->loadModel('Users');
	$modelNotification = $controller->loadModel('Notifications');
	$mess= '';

	if ($isRequestPost) {
		$dataSend = $input['request']->getData();

		if(!empty($dataSend['title']) && !empty($dataSend['mess'])){
			$conditions = array();

			if($dataSend['type']==1){
				$conditions['type'] = 1;
			}elseif($dataSend['type']==0){
				$conditions['type'] = 0;
			}

			if(!empty($dataSend['idUser'])){
				$conditions['id IN'] = array_map('intval', explode(',', $dataSend['idUser']));
			}

			$conditions['device_token IS NOT'] = null;
			$listUser = $modelUser->find()->where($conditions)->all()->toList();


			if(!empty($dataSend['id_post'])){
        		$dataPost = $modelPosts->find()->where(['id'=>(int) $dataSend['id_post']])->first();
        	}	
			
			if(!empty($listUser)){
				$title = $dataSend['title'];
				$content = $dataSend['mess'];
				$number = 0;
				$device_token = [];

				foreach ($listUser as $key => $value) {
					if(!empty($value->device_token)){
						$device_token[] = $value->device_token;
						$number++;
						$notification = $modelNotification->newEmptyEntity();
						$notification->user_id = $value->id;
						$notification->title = $title;
						$notification->content = $content;
						$notification->id_post = $dataPost->id;
						$notification->created_at = date('Y-m-d H:i:s');
						$notification->updated_at = date('Y-m-d H:i:s');
						$modelNotification->save($notification);
					}
				}

				$dataSendNotification= array(
					'title' => $title,
					'time' => date('H:i d/m/Y'),
					'content' => $content,
					'id_post' => @$dataPost->id,
					'action' => 'adminSendNotification'
				);

				if(!empty($device_token)){
					$return = sendNotification($dataSendNotification, $device_token);
				}

				$mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format($number).' người dùng</p>';
			}else{
				$mess= '<p class="text-danger">Không có thiết bị nào nhận được tin nhắn</p>';
			}
		}else{
			$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		}
	}

	setVariable('mess', $mess);
}
?>