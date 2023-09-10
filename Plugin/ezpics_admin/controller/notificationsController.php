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
        	$conditions = array();
        	if($dataSend['type']==1){
        		$conditions['type'] = 1;
        	}elseif($dataSend['type']==0){
        		$conditions['type'] = 0;
        	}
        	if(!empty($dataSend['idUser'])){
        		$conditions['id'] = $dataSend['idUser'];
        	}
        	if(isset($dataSend['pro'])){
        		if($dataSend['pro']==1){
        		$conditions['member_pro'] = 1;
        		$conditions['deadline_pro >'] = date('Y-m-d H:i:s');

        		}elseif($dataSend['pro']==0){
        		$conditions['member_pro'] = 0;
        		$conditions['deadline_pro <'] = date('Y-m-d H:i:s');
        		}
        	}

        	$conditions['token_device IS NOT'] = null;
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

function addNotificationPostNewAdmin($input){

	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo tin tức mới cho người dùng';

	$modelMembers = $controller->loadModel('Members');
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
        		$conditions['id'] = $dataSend['idUser'];
        	}

        	if(isset($dataSend['pro'])){
        		if($dataSend['pro']==1){
        		$conditions['member_pro'] = 1;
        		$conditions['deadline_pro >'] = date('Y-m-d H:i:s');

        		}elseif($dataSend['pro']==0){
        		$conditions['member_pro'] = 0;
        		$conditions['deadline_pro <'] = date('Y-m-d H:i:s');
        		}
        	}

        	$conditions['token_device IS NOT'] = null;
        	$listMembers = $modelMembers->find()->where($conditions)->all()->toList();

        	if(!empty($listMembers)){
        		$dataSendNotification= array('id'=>$dataSend['id'],'title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['mess'],'action'=>'postNew');
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

function addNotificationProductNewAdmin($input){

	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo sản phẩm mới cho người dùng';

	$modelMembers = $controller->loadModel('Members');
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
        		$conditions['id'] = $dataSend['idUser'];
        	}

        	if(isset($dataSend['pro'])){
        		if($dataSend['pro']==1){
        		$conditions['member_pro'] = 1;
        		$conditions['deadline_pro >'] = date('Y-m-d H:i:s');

        		}elseif($dataSend['pro']==0){
        		$conditions['member_pro'] = 0;
        		$conditions['deadline_pro <'] = date('Y-m-d H:i:s');
        		}
        	}
        	
        	$conditions['token_device IS NOT'] = null;
        	$listMembers = $modelMembers->find()->where($conditions)->all()->toList();

        	if(!empty($listMembers)){
        		$dataSendNotification= array('id'=>$dataSend['id'],'title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['mess'],'action'=>'productNew');
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