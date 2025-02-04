<?php 
function addImageUserAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelUser = $controller->loadModel('Users');
    $modelImageUser = $controller->loadModel('ImageUsers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($_FILES['image'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
            
            if (!empty($user)) {

            	if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                $image = uploadImage($user->phone, 'image', 'image_'.time().rand(0,1000000));
            }
            if(!empty($image['linkOnline'])){
                $image = $image['linkOnline'];
            }

            	$data = $modelImageUser->newEmptyEntity();
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


function listImageUserAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;

	$modelUser = $controller->loadModel('Users');
    $modelImageUser = $controller->loadModel('ImageUsers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
	   		$modelTransactionHistory = $controller->loadModel('TransactionHistorys');

			if(!empty($user)){

				$conditions = array('id_user'=>$user->id);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($_GET['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($_GET['type'])){
					$conditions['type'] = (int) $dataSend['type'];
				}

			    $listData = $modelImageUser->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelImageUser->find()->where($conditions)->count();
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData);		   
			}
            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');
    	}
        return apiResponse(2,'Gửi thiếu dữ liệu');
    }
    return apiResponse(0,'Gửi sai kiểu POST');
}
function detailImageUserAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;

	$modelUser = $controller->loadModel('Users');
    $modelImageUser = $controller->loadModel('ImageUsers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($dataSend['id'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
	   		$modelTransactionHistory = $controller->loadModel('TransactionHistorys');
	   		 
			if(!empty($user)){
				
			    $listData = $modelImageUser->find()->where(['id'=> (int) $dataSend['id']])->first();
			    
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData);		   
			}
            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');
    	}
        return apiResponse(2,'Gửi thiếu dữ liệu');
    }
    return apiResponse(0,'Gửi sai kiểu POST');
}
 ?>

