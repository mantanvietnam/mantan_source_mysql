<?php 
function addlikeApi($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object']) && !empty($dataSend['type'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(empty($data)) {
            		$data = $modelLike->newEmptyEntity();
            	}
		        $data->created_at = time();
		        $data->id_object =(int) $dataSend['id_object'];
		        $data->keyword = $dataSend['keyword'];
		        $data->type = $dataSend['type'];
		        $data->id_customer = $user->id;
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
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
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
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['keyword']) && !empty($dataSend['id_object'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token'],'status'=>'active'])->first();

            if (!empty($user)) {

            	$data = $modelLike->find()->where(['keyword'=>$dataSend['keyword'], 'id_object'=>(int)$dataSend['id_object'], 'id_customer'=>(int)$user->id])->first();
            	if(!empty($data)) {
            		if($data->type=='like'){
            			return array('code'=>1,'messages'=>'bạn đã like ');
            		}elseif($data->type=='dislike'){
            			return array('code'=>4,'messages'=>'bạn đã dislike ');
            		}
            		
            	}
		        
            	 return array('code'=>5,'messages'=>'bạn chưa likes');
    		}

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
        
}

function addCommentApi($input){

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
        
}

 ?>