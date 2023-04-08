<?php 
function addNotificationAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo cho người dùng';

	$modelMembers = $controller->loadModel('Members');
	$mess= '';

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title']) && !empty($dataSend['mess'])){
        	$conditions = ['token_device IS NOT'=>null];
        	$listMembers = $modelMembers->find()->where($conditions)->all()->toList();

        	if(!empty($listMembers)){
        		$dataSendNotification= array('title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['mess'],'action'=>'adminSendNotification');
        		$number = 0;

		        foreach ($listMembers as $key => $value) {
		        	
                    if(!empty($value->token_device)){
                        $return = sendNotification($dataSendNotification, $value->token_device);
                        $number++;
                    }
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