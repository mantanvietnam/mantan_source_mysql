<?php 
function addImageUserAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelUser = $controller->loadModel('Users');
    $modelImageUser = $controller->loadModel('ImageUsers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($dataSend['money'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
            
            if (!empty($user)) {

            	$data = $modelImageUser->newEmptyEntity()
               	$data->name = $dataSend['name'];
               	$data->status = 'active';
               	$data->image = $image;
               	$data->id_user = $user->id;
               	$data->created_at = time();
               	$data->type = 'upload';

               	$modelImageUser->save($data);

              	return apiResponse(1,'lưu dữ liệu thành công',$data);

            }

            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');

        }

        return apiResponse(2,'Gửi thiếu dữ liệu');

    }

    return apiResponse(0,'Gửi sai kiểu POST');

}


function listHistories($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	$modelUser = $controller->loadModel('UserOrders');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($dataSend['money'])){
            if(function_exists('getCustomerByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
	   		$modelTransactionHistory = $controller->loadModel('TransactionHistorys');

			if(!empty($user)){

				$conditions = array('id_user'=>$user->id);
				$limit = 20;
				$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($_GET['id'])){
					$conditions['id'] = (int) $_GET['id'];
				}

				if(!empty($_GET['type'])){
					$conditions['type'] = (int) $_GET['type'];
				}

			    $listData = $modelTransactionHistory->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelTransactionHistory->find()->where($conditions)->count();
			    return apiResponse(3,'Bạn lấy dữ liệu thành công',$listData, $totalData);		   
			}
            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');
    	}
        return apiResponse(2,'Gửi thiếu dữ liệu');
    }
    return apiResponse(0,'Gửi sai kiểu POST');
}
 ?>

