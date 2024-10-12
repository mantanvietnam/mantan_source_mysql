<?php 
function addWallPostAPI($input){
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelWallPost = $controller->loadModel('WallPosts');
    $modelImageCustomer = $controller->loadModel('ImageCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            if (!empty($user)) {
            	$data = $modelWallPost->newEmptyEntity();

            	$data->id_customer = $user->id;
            	$data->connent = $dataSend['connent'];
            	$data->created_at = time();
            	$data->public = $dataSend['public'];

            	$modelWallPost->save($data);

            	if(!empty($_FILES['listImage']['name'][0])){
                    foreach($_FILES['listImage']['name'] as $key => $value){
                        $_FILES['listImages'.$key]['name'] = $value;
                        $_FILES['listImages'.$key]['type'] = $_FILES['listImage']['type'][$key];
                        $_FILES['listImages'.$key]['tmp_name'] = $_FILES['listImage']['tmp_name'][$key];
                        $_FILES['listImages'.$key]['error'] = $_FILES['listImage']['error'][$key];
                        $_FILES['listImages'.$key]['size'] = $_FILES['listImage']['size'][$key];
                    }
                }

                $total = count($_FILES['listImage']['name']);
                
                for($i=0;$i<=$total;$i++){
                    if(isset($_FILES['listImages'.$i]) && empty($_FILES['listImages'.$i]["error"])){
                        if(!empty($data->id)){
                            $fileName = 'image'.$i.'_wallpost_'.$user->id.'_'.$data->id;
                        }else{
                            $fileName = 'image'.$i.'_wallpost_'.time().rand(0,1000000);
                        }
                        $image = uploadImage($user->id, 'listImages'.$i, $fileName);
                        if(!empty($image['linkOnline'])){
                            $save = $modelImageCustomer->newEmptyEntity();

            				$save->id_customer = $user->id;
            				$save->id_post = $data->id;
            				$save->image = $image['linkOnline'].'?time='.time();;
            				$save->public = $dataSend['public'];
            				$save->created_at = time();
            				$modelImageCustomer->save($save);
                        }
                    }
                }

                $data->listImage = @$modelImageCustomer->find()->where(['id_post'=>$data->id])->all()->toList();
               
                return array('code'=>3, 'messages'=>'Bạn đang bài thành công ', 'data'=>$data);
              
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}
 ?>