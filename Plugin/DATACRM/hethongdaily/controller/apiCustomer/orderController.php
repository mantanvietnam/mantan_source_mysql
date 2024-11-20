<?php 
function listOrderCustomerAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelProduct = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
    $modelCustomers = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);

            if (!empty($user)) {
                $conditions = ['id_user' => $user->id];

                if(!empty($dataSend['status'])){
                    if($dataSend['status'] == 'done'){
                        $conditions['status'] = 'done';
                    }else{
                        $conditions['status !='] = 'done';
                    }
                }

            	$listOrder =  $modelOrders->find()->where($conditions)->order(array('id'=>'desc'))->all()->toList();

            	if(!empty($listOrder)){
	            	foreach($listOrder as $key => $item){
		                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product;
		                        }
		                    }


		                    $listOrder[$key]->detail_order = $detail_order;
		                }
	            	}
	            }
                

                return array('code'=>1,'data'=>$listOrder, 'messages'=>'Lấy dữ liệu thành công');
            }

            return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');

}

function getOrderDetailCustomerAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelProduct = $controller->loadModel('Products');
    $modelOrders = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
    $modelCustomers = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id_order'])) {
            $user =  getCustomerByToken($dataSend['token']);

            if (!empty($user)) {

            	$order =  $modelOrders->find()->where(['id_user' => $user->id,'id'=>$dataSend['id_order']])->first();

            	if(!empty($order)){
	                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();
	                
	                if(!empty($detail_order)){
	                    foreach ($detail_order as $k => $value) {
	                        $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
	                        
                            if(!empty($product)){
	                            $detail_order[$k]->product = $product;
	                        }
	                    }


	                    $order->detail_order = $detail_order;
	                }

		            return array('code'=>1,'data'=>$order, 'messages'=>'Lấy dữ liệu thành công');
	            }
	            return array('code'=>4,'data'=>$order, 'messages'=>'Đơn này không phải của bạn');
            }

            return array('code'=>3,'data'=>null, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'data'=>null, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');

}

 ?>