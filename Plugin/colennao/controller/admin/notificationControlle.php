<?php 	
function addNotificationAdmin($input)
{
	global $controller;
	 global $modelPosts;
	global $isRequestPost;
	global $metaTitleMantan;
	global $keyFirebase;
    global $projectId;

	$metaTitleMantan = 'Gửi thông báo cho người dùng';

	$modelUser = $controller->loadModel('Users');
	$modelNotification = $controller->loadModel('Notifications');
	$mess= '';
	$dataSend  = array();
	$conditions = ['device_token IS NOT'=> null];
	$totalData = $modelUser->find()->where($conditions)->all()->toList();
	$paginationMeta = createPaginationMetaData(count($totalData),1000,0);

	if ($isRequestPost) {


		$dataSend = $input['request']->getData();

		if(!empty($dataSend['title']) && !empty($dataSend['mess'])){
			$conditions = array();

			if(!empty($dataSend['idUser'])){
				$conditions['id IN'] = array_map('intval', explode(',', $dataSend['idUser']));
			}

			$conditions['device_token IS NOT'] = null;
			$totalData = $modelUser->find()->where($conditions)->all()->toList();
			$page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

			
			$paginationMeta = createPaginationMetaData(count($totalData),1000,$page);

			

			if($page<=$paginationMeta['totalPage']){
			

				if(!empty($dataSend['id_post'])){
	        		$dataPost = $modelPosts->find()->where(['id'=>(int) $dataSend['id_post']])->first();
	        	}	

	        	$listUser = $modelUser->find()->limit(1000)->page($page)->where($conditions)->all()->toList();
	      
			
	       
				
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
							$notification->id_user = $value->id;
							$notification->title = $title;
							$notification->content = $content;
							$notification->action = 'adminSendNotification';
							$notification->created_at = time();
							//$modelNotification->save($notification);
						}
					}
				
					$dataSendNotification= array(
						'title' => $title,
						'time' => date('H:i d/m/Y'),
						'content' => $content,
						'action' => 'adminSendNotification'
					);

					if(!empty($device_token)){

                			// $return = sendNotification($dataSendNotification, $device_token);
                		
						$mess = sendNotificationnew($dataSendNotification, $device_token);
						
						
					}

					$mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format($number).' người dùng</p>';
				}else{
					$mess= '<p class="text-danger">Không có thiết bị nào nhận được tin nhắn</p>';
				}

				if($page==$paginationMeta['totalPage']){
					$paginationMeta['next'] +=1;
				}
			}else{
				$mess= '<p class="text-success">Đã gửi thông báo xong</p>';
			}
		}else{
			$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		}
		
	}

	setVariable('next', $paginationMeta['next']);
		setVariable('totalPage', $paginationMeta['totalPage']);
		setVariable('dataSend', $dataSend);

	setVariable('mess', $mess);
	
	setVariable('dataSend', $dataSend);
}
?>