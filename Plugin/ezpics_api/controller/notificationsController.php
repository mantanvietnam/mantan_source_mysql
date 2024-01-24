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


	$product = $modelProduct->find()->where(@$condition)->order('RAND()')->first();

	if(!empty($product)){
		if(!empty($_GET['title'])){
			$title = $_GET['title'];
		}else{
			$title = $product->name;
		}

		if(!empty($_GET['content'])){
			$content = $_GET['content'];
		}else{
			$content = [];
			$content[] = 'Bạn đã xem mẫu thiết kế này chưa? Đây là mẫu thiết kế mới nhất của ngày hôm nay đấy';
			$content[] = 'Mẫu thiết kế này đang giảm giá sốc từ '.number_format($product->price).'đ giờ chỉ còn '.number_format($product->sale_price).'đ, bạn có muốn xem không?';
			$content[] = 'Gửi bạn mẫu thiết kế được xem nhiều nhất ngày hôm nay';
			$content[] = 'Hôm nay bạn đã đăng bài chưa? Nếu chưa thì thử dùng ảnh này để đăng nhé';
			$content[] = 'Hôm nay bạn đã đăng bài chưa? Nếu chưa thì thử dùng ảnh này để đăng nhé';
			$content[] = 'Tôi có một mẫu thiết kế rất đặc biệt, tôi muốn bạn nhìn thấy nó ngay bây giờ';
			$content[] = 'Hôm nay tôi đã thiết kế ra một bức ảnh rất đẹp và muốn chia sẻ với bạn';
			$content[] = 'Bức ảnh này giúp tôi bán được hơn 1.000 đơn hàng, bạn có muốn xem nó không?';
			$content[] = 'Không thể tin nổi tôi đã chụp được khoảnh khắc này, bạn phải xem ngay';
			$content[] = 'Có một sự kiện lớn đã xảy ra, và tôi muốn bạn là người đầu tiên biết';
			$content[] = 'Ảnh này đẹp quá, tôi không thể giữ bí mật nổi';
			$content[] = 'Đang có điều gì đó đặc biệt trong bức ảnh này, bạn đoán được không?';
			$content[] = 'Không ngờ tôi có thể tạo ra được bức hình như thế này, tôi cần phải chia sẻ ngay với bạn';
			$content[] = 'Nếu bạn muốn biết điều mới nhất của tôi, hãy xem ảnh này trước nhé';
			$content[] = 'Có lẽ đây là bức ảnh tốt nhất tôi từng thiết kế, bạn không nên bỏ qua';

			$content = $content[array_rand($content)];
		}

	    $conditions = array();
	    $conditions['token_device IS NOT'] = null;

	    if(isset($_GET['type']) && $_GET['type']!=''){
			$conditions['type'] = (int) $_GET['type'];
		}
	    
	    $listMembers = $modelMembers->find()->where($conditions)->all()->toList();

		if(!empty($listMembers)){
			$dataSendNotification= array('id'=>$product->id,'title'=>$title,'time'=>date('H:i d/m/Y'),'content'=>$content,'action'=>'productNew');
			$number = 0;
			$token_device = [];

	        foreach ($listMembers as $key => $value) {
	            if(!empty($value->token_device && !in_array($value->token_device, $token_device))){
	            	$token_device[] = $value->token_device;
                    $number++;
	            }
	        }

	        if(!empty($token_device)){
	        	$return = sendNotification($dataSendNotification, $token_device);
	        }

	        $mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format($number).' người dùng</p>';
	    }else{
	    	$mess= '<p class="text-danger">Không có thiết bị nào nhận được tin nhắn</p>';
	    }

	   	echo $mess;
	}else{
		echo '<p class="text-danger">Không tìm được sản phẩm</p>';
	}
}

function addNotificationDeadlineProAPI($input){
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo sản phẩm mới cho người dùng';

	$modelMembers = $controller->loadModel('Members');


	$conditions['member_pro'] = 1;
	$conditions['deadline_pro <='] = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 2 days'));
	$conditions['deadline_pro >='] = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' - 3 days'));

    $listData = $modelMembers->find()->where($conditions)->all()->toList();
   
    $number = 0;
    if(!empty($listData)){
    	foreach($listData as $key => $value){
    		 if(!empty($value->token_device)){
				$token_device[] = $value->token_device;
                    $number++;
	        }
    	}
    	$dataSendNotification= array('title'=>'Tài khoản của bạn sắp hết hạn Pro','time'=>date('H:i d/m/Y'),'content'=> 'Tài khoản của bạn sắp hết hạn Pro. Cảm ơn bạn đã tin tương và đồng hành cùng EZPICS.','action'=>'adminSendNotification');

	        if(!empty($token_device)){
	             sendNotification($dataSendNotification, $token_device);
	           
	        }
    }
    return array('code'=>1, 'mess'=>'Đã bắt được '.$number.' thông báo');
}

function addNotificationDeadlineTrialProAPI($input){
	global $controller;
	global $isRequestPost;
	global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo sản phẩm mới cho người dùng';

	$modelMembers = $controller->loadModel('Members');


	$conditions['member_pro'] = 1;
	$conditions['is_use_trial'] = 1;
	$conditions['deadline_pro <='] = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' + 2 days'));
	$conditions['deadline_pro >='] = date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . ' - 3 days'));


    
    $listData = $modelMembers->find()->where($conditions)->all()->toList();

    $number = 0;
    if(!empty($listData)){
    	foreach($listData as $key => $value){
	        if(!empty($value->token_device)){
				$token_device[] = $value->token_device;
                    $number++;
	        }
    	}

    	$dataSendNotification= array('title'=>'Tài khoản của bạn sắp hết hạn dùng thử Pro','time'=>date('H:i d/m/Y'),'content'=> 'Tài khoản của bạn sắp hết hạn dùng thử Pro. Cảm ơn bạn đã tin tương và đồng hành cùng EZPICS.','action'=>'adminSendNotification');
    	if(!empty($token_device)){
    		sendNotification($dataSendNotification, $token_device);	

    	}
    }
    return array('code'=>1, 'mess'=>'Đã bắt được '.$number.' thông báo');
}

 ?>