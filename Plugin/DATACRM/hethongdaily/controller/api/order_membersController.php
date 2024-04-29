<?php
function getListOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                $conditions = array('id_member_sell'=>$infoMember->id);
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['id'])){
		            $conditions['id'] = (int) $dataSend['id'];
		        }

		        if(!empty($dataSend['status_pay'])){
		            $conditions['status_pay'] = $dataSend['status_pay'];
		        }

		        if(!empty($dataSend['status'])){
		            $conditions['status'] = $dataSend['status'];
		        }

		        if(!empty($dataSend['date_start'])){
		            $date_start = explode('/', $dataSend['date_start']);
		            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		        }

		        if(!empty($dataSend['date_end'])){
		            $date_end = explode('/', $dataSend['date_end']);
		            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		                
		        }

		        if(!empty($dataSend['phone'])){
		            $checkMember = $modelMembers->find()->where(['phone'=>$dataSend['phone'] ])->first();

		            if(!empty($checkMember)){
		                $conditions['id_member_buy'] = $checkMember->id;
		            }else{
		                $conditions['id_member_buy'] = -1;
		            }
		        }

                $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
		                        if(!empty($product)){
		                            $detail_order[$k]->product = $product->title;
		                        }
		                    }

		                    $listData[$key]->detail_order = $detail_order;
		                }else{
		                	$listData[$key]->detail_order = [];
		                }

		                $listData[$key]->buyer = $modelMembers->find()->where(['id'=>$item->id_member_buy ])->first();
		            }
		        }
                
                $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function updateStatusOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
		            $order = $modelOrderMembers->find()->where(['id'=>(int) $dataSend['id'], 'id_member_sell'=>$infoMember->id])->first();

		            if(!empty($order)){
		                if(!empty($dataSend['status'])){
		                    $order->status = $dataSend['status'];

		                    // nhập hàng vào kho
		                    if($dataSend['status'] == 'done'){
		                        $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();
		                
		                        if(!empty($detail_order)){
		                            foreach ($detail_order as $k => $value) {
		                                // cộng hàng vào kho người mua
		                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_buy])->first();

		                                if(empty($checkProductExits)){
		                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
		                                    $checkProductExits->quantity = 0;
		                                }

		                                $checkProductExits->id_member = $order->id_member_buy;
		                                $checkProductExits->id_product = $value->id_product;
		                                $checkProductExits->quantity += $value->quantity;

		                                $modelWarehouseProducts->save($checkProductExits);

		                                // trừ hàng trong kho người bán
		                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$value->id_product, 'id_member'=>$order->id_member_sell])->first();

		                                if(empty($checkProductExits)){
		                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
		                                    $checkProductExits->quantity = 0;
		                                }

		                                $checkProductExits->id_member = $order->id_member_sell;
		                                $checkProductExits->id_product = $value->id_product;
		                                $checkProductExits->quantity -= $value->quantity;

		                                $modelWarehouseProducts->save($checkProductExits);

		                                // lưu lịch sử nhập kho của người mua
		                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

		                                $saveWarehouseHistories->id_member = $order->id_member_buy;
		                                $saveWarehouseHistories->id_product = $value->id_product;
		                                $saveWarehouseHistories->quantity = $value->quantity;
		                                $saveWarehouseHistories->note = 'Nhập hàng vào kho';
		                                $saveWarehouseHistories->create_at = time();
		                                $saveWarehouseHistories->type = 'plus';
		                                $saveWarehouseHistories->id_order_member = $order->id;

		                                $modelWarehouseHistories->save($saveWarehouseHistories);

		                                // lưu lịch sử xuất kho của người bán
		                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

		                                $saveWarehouseHistories->id_member = $order->id_member_sell;
		                                $saveWarehouseHistories->id_product = $value->id_product;
		                                $saveWarehouseHistories->quantity = $value->quantity;
		                                $saveWarehouseHistories->note = 'Xuất hàng cho đại lý tuyến dưới';
		                                $saveWarehouseHistories->create_at = time();
		                                $saveWarehouseHistories->type = 'minus';
		                                $saveWarehouseHistories->id_order_member = $order->id;

		                                $modelWarehouseHistories->save($saveWarehouseHistories);
		                            }
		                        }
		                    }
		                }

		                if(!empty($dataSend['status_pay'])){
		                    $order->status_pay = $dataSend['status_pay'];
		                }

		                $modelOrderMembers->save($order);

		                $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công');
		            }else{
		            	$return = array('code'=>4, 'mess'=>'Không tìm thấy đơn hàng');
		            }
		        }else{
		            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
		        }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getInfoOrderMemberAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelMembers = $controller->loadModel('Members');
    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_order_member'])){
                    $order = $modelOrderMembers->find()->where(['id'=>(int) $dataSend['id_order_member'], 'id_member_sell'=>$infoMember->id])->first();

		            if(!empty($order)){
		                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$order->id])->all()->toList();

		                $order->detail = [];
		                
		                if(!empty($detail_order)){
		                    foreach ($detail_order as $k => $value) {
		                        $value->product = $modelProducts->find()->where(['id'=>(int) $value->id_product])->first();

		                        $order->detail[$k] = $value;
		                    }
		                }

		                $system = $modelCategories->find()->where(['id'=>(int) $infoMember->id_system])->first();

		                $member_sell = $modelMembers->find()->where(['id'=>(int) $order->id_member_sell])->first();
		                $member_buy = $modelMembers->find()->where(['id'=>(int) $order->id_member_buy])->first();

		                $return = array('code'=>0, 'order'=>$order, 'member_sell'=>$member_sell, 'member_buy'=>$member_buy, 'system'=>$system);
		            }else{
		                $return = array('code'=>4, 'mess'=>'Không tìm thấy đơn hàng');
		            }
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}