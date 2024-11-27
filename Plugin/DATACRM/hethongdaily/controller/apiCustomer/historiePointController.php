<?php 
function listHistoriePointCustomerAPI($input)
{
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMember = $controller->loadModel('Members');
    $modelHistoriePointCustomers = $controller->loadModel('HistoriePointCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
        	$member = $modelMember->find()->where(['id_father'=>0])->first();
            
            if (!empty($user)) {
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
               	$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
               	$listData = $modelHistoriePointCustomers->find()->limit($limit)->page($page)->where(['id_customer'=>$user->id,'id_member'=>$member->id])->order(['id'=>'desc'])->all()->toList();
               	$totalData = $modelHistoriePointCustomers->find()->where(['id_customer'=>$user->id,'id_member'=>$member->id])->order(['id'=>'desc'])->count();


              return array('code'=>1,'messages'=>'Bạn lấy dữ liệu thành công', 'listData'=>$listData,'totalData'=>$totalData);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}


?>