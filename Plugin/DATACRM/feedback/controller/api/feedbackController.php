<?php 
function addFeedbackApi($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Feedback';

    $modelFeedback = $controller->loadModel('Feedbacks');
    $mess= '';
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['feedback'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token']])->first();

            if (!empty($user)) {
            	// tạo dữ liệu save
            	$data = $modelFeedback->newEmptyEntity();
            	$data->feedback = @$dataSend['feedback'];
                $data->id_customer = $user->id;
                $data->star = (int) @$dataSend['star'];
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($user->id)){
                        $fileName = 'image_feedback'.$user->id.'_'.time().rand(0,1000000);
                    }else{
                        $fileName = 'image_feedback'.time().rand(0,1000000);
                    }
                    $image = uploadImage($user->id, 'image', $fileName);
                    if(!empty($image['linkOnline'])){
                        $data->image = $image['linkOnline'].'?time='.time();
                    }
                }
            	$data->created_at = time();
            	$data->status = 'active';
            	$modelFeedback->save($data);

             	return array('code'=>1,'messages'=>'Bạn gửi phản hồi của bạn thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function listFeedbackApi($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách Feedback';

    $modelFeedback = $controller->loadModel('Feedbacks');
    
    $modelCustomer = $controller->loadModel('Customers');
    $conditions = array('status'=>'active');
   
    $limit = 20;
    $page = (!empty($_POST['page']))?(int)$_POST['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    
    $listData = $modelFeedback->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();	
        }
    }
	
    return array('code'=>1,'messages'=>'Bạn lấy dữ liệu thành công', 'listData'=>$listData);
}

function listFeedbackMyApi($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách Feedback';

    $modelFeedback = $controller->loadModel('Feedbacks');
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token']])->first();

            if (!empty($user)) {
                $conditions = array('id_customer'=>$user->id);
                if(!empty($_POST['name'])){
                    $key=createSlugMantan($_POST['name']);

                    $conditions['urlSlug LIKE']= '%'.$key.'%';
                }

                $limit = 20;
                $page = (!empty($_POST['page']))?(int)$_POST['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                
                $listData = $modelFeedback->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first(); 
                    }
                }
                    return array('code'=>1,'messages'=>'Bạn lấy dữ liệu thành công', 'listData'=>$listData);
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

 ?>