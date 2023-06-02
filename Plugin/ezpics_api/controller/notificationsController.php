<?php 
function addNotificationProductAPI($input){

	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo sản phẩm mới cho người dùng';

	$modelMembers = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$mess= '';

	$condition = array('status'=>2,'type'=>'user_create');
	if(!empty($_GET['idCategory'])){
		$condition['category_id'] = $_GET['idCategory'];
	}

	if(!empty($_GET['idproduct'])){
		$condition['id'] = $_GET['idproduct'];
	}

	if(!empty($_GET['title'])){
		$title = $_GET['title'];
	}else{
		$title = 'Mẫu thiết kế đẹp dành riêng cho bạn';
	}

	if(!empty($_GET['content'])){
		$content = $_GET['content'];
	}else{
		$content = 'Đây là mẫu thiết kế Ezpics lựa chọn dành riêng cho bạn ngày hôm nay. Bấm để xem chi tiết';
	}


	$product = $modelProduct->find()->where(@$condition)->first();

    $conditions = array();
    $conditions['token_device IS NOT'] = null;

    if(isset($_GET['type']) && $_GET['type']!=''){
		$conditions['type'] = (int) $_GET['type'];
	}
    
    $listMembers = $modelMembers->find()->where($conditions)->all()->toList();

	if(!empty($listMembers)){
		$dataSendNotification= array('id'=>$product->id,'title'=>$title,'time'=>date('H:i d/m/Y'),'content'=>$content,'action'=>'productNew');
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

   	echo $mess;

} ?>