<?php 
function addlikeApi($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_user'=>(int)$user->id])->first();
            	if(empty($data)) {
            		$data = $modelLike->newEmptyEntity();
            	}
		        $data->created_at = time();
		        $data->id_object =(int) $dataSend['id_object'];
		        $data->keyword = $dataSend['keyword'];
		        $data->type = 'like';
		        $data->id_user = $user->id;
        		$modelLike->save($data);

        		   if($data->type=='like'){
                        return array('code'=>1,'messages'=>'bạn đã like  thành công ');
                    }elseif($data->type=='dislike'){
                        return array('code'=>4,'messages'=>'bạn đã dislike  thành công ');
                    }
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function delelelikeApi($input){

	global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
             $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_user'=>(int)$user->id])->first();
            	if(!empty($data)) {
            		$modelLike->delete($data);
            		return array('code'=>1,'messages'=>'bạn xóa like thành công');
            	}
		        
            	 return array('code'=>4,'messages'=>'bạn xóa like thành công');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function checklikeApi ($input){

	global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_user'=>(int)$user->id])->first();
            	if(!empty($data)) {
            			return array('code'=>1,'messages'=>'bạn đã like ');
            	}
		        
            	 return array('code'=>5,'messages'=>'bạn chưa likes');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}


function listFoodlikeApi ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelbreakfast = $controller->loadModel('breakfast');
    $modellunch = $controller->loadModel('lunch');
    $modeldinner = $controller->loadModel('dinner');
    $modelsnacks = $controller->loadModel('snacks');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            $user = getUserByToken($dataSend['token']);

            if (!empty($user)) {

                $listData = $modelLike->find()->where([ 'id_user'=>(int)$user->id])->all()->tolist();
                if(!empty($listData)) {
                    foreach ($listData as $key => $value){
                        if($value->keyword=='breakfast'){
                            $listData[$key]->infoFood = $modelbreakfast->find()->where([ 'id'=>(int)$value->id_object])->first();
                        }elseif($value->keyword=='lunch'){
                            $listData[$key]->infoFood = $modellunch->find()->where([ 'id'=>(int)$value->id_object])->first();
                        }elseif($value->keyword=='dinner'){
                            $listData[$key]->infoFood = $modeldinner->find()->where([ 'id'=>(int)$value->id_object])->first();
                        }elseif($value->keyword=='snacks'){
                            $listData[$key]->infoFood = $modelsnacks->find()->where([ 'id'=>(int)$value->id_object])->first();
                        }
                        
                    }

                        return array('code'=>1,'messages'=>'Bạn lấy giữ liệu thành công', 'data'=>$listData);
                }
                
                 return array('code'=>5,'messages'=>'bạn chưa likes');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}



/*function addCommentApi($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['comment'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

        	$data = $modelComment->newEmptyEntity();
            $data->created_at = time();
            $data->id_object=(int)@$dataSend['id_object'];
            $data->keyword=@$dataSend['keyword'];
            $data->id_father=(int)@$dataSend['id_father'];
            $data->id_customer=$user->id;
            $data->comment=$dataSend['comment'];

            $modelComment->save($data);
              return array('code'=>1,'messages'=>'bạn thêm bình luận thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function deleleCommentApi($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {
                    $data = $modelComment->find()->where(['id'=>$dataSend['id'], 'id_customer'=>(int)$user->id])->first();
                if(!empty($user)){    
                    $modelComment->delete($data);
                    return array('code'=>1,'messages'=>'bạn xóa bình luận thành công');
                }
                
                 return array('code'=>4,'messages'=>'bạn xóa like thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function listCommentAPI($input){
    global $controller;
    global $urlCurrent;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Danh sách bình luận';

    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');
     if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['keyword']) && !empty($dataSend['id_object'])){
            $listData = $modelComment->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_father'=>0])->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $listData[$key]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
                    $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();
                }
            
            }
              return array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData); 
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}*/

 ?>