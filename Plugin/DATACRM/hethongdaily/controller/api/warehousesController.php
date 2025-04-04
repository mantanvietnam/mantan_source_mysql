<?php
// lấy danh sách sản phẩm trong kho
function getProductWarehouseAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelProducts = $controller->loadModel('Products');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'warehouseProductAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
            	$conditions = array('id_member'=>$infoMember->id);
		        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($dataSend['id_product'])){
		            $conditions['id_product'] = (int) $dataSend['id_product'];
		        }

		        $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		        

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
		                $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->first();
		            }
		        }
                
                $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
                
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

// lấy lịch sử xuất nhập của 1 sản phẩm trong kho
function getHistoryWarehouseProductAPI($input)
{
	global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelProducts = $controller->loadModel('Products');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'historyWarehouseProductAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
            	$conditions = array('id_member'=>$infoMember->id);
		        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
		        $order = array('id'=>'desc');

		        if(!empty($dataSend['id_product'])){
		            $conditions['id_product'] = (int) $dataSend['id_product'];
		        }

		        $listData = $modelWarehouseHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		        

		        if(!empty($listData)){
		        	$infoProduct = [];
		            foreach($listData as $key => $item){
		            	if(empty($infoProduct[$item->id_product])){
		            		$infoProduct[$item->id_product] = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
		            	}

		                $listData[$key]->product = $infoProduct[$item->id_product];
		            }
		        }
                
                $totalData = $modelWarehouseHistories->find()->where($conditions)->all()->toList();
                
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

// tạo yêu cầu nhập hàng vào kho
function createRequestImportProductAPI($input){
	global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelProducts = $controller->loadModel('Products');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
    $modelParent = $controller->loadModel('Partners');

    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'addRequestProductAgency');
            $id_parent = 0;
            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                if(empty($infoMember->id_father)){
                    if(empty($dataSend['id_parent'])){
                        return array('code'=>4, 'mess'=>'thiều id đối tác');
                    }
                    $parent = $modelParent->find()->where(['id'=>$dataSend['id_parent']])->first();
                    if(!empty($parent)){
                         $id_parent = $parent->id;
                    }else{
                         return array('code'=>4, 'mess'=>'đối tác không tồn tại');
                    }

                }

	            if(!empty($dataSend['data_order'])){
	            	$dataSend['data_order'] = json_decode($dataSend['data_order'], true);

	                $save = $modelOrderMembers->newEmptyEntity();

                    if(!empty($dataSend['time'])){
                        $time = explode(' ', $dataSend['time']);
                        $date = explode('/', $time[1]);
                        $time = explode(':', $time[0]);
                        $create_at = mktime($time[0], $time[1], 0, $date[1], $date[0], $date[2]);
                    }else{
                        $create_at = time();
                    }

	                $save->id_member_sell = @$infoMember->id_father;
	                $save->id_member_buy = $infoMember->id;
	                $save->note_sell = ''; // ghi chú người bán
	                $save->note_buy = @$dataSend['note']; // ghi chú người mua 
                    $save->status = 'new';
	                $save->id_parent =$id_parent;
	                $save->create_at = $create_at;
	                $save->money = (int) $dataSend['total'];
	                $save->total = (int) $dataSend['totalPays'];
	                $save->status_pay = 'wait';
	                $save->discount = (int) $dataSend['promotion'];

	                $modelOrderMembers->save($save);

	                foreach ($dataSend['data_order'] as $key => $value) {
	                    $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

	                    $saveDetail->id_product = $value['id_product'];
	                    $saveDetail->id_order_member = $save->id;
	                    $saveDetail->quantity = $value['quantity'];
	                    $saveDetail->price = $value['price'];
	                    $saveDetail->id_unit = (!empty($value['id_unit']))?(int)$value['id_unit']:0;

	                    $modelOrderMemberDetails->save($saveDetail);
	                }

	                $return = array('code'=>0, 'mess'=>'Tạo yêu cầu nhập hàng thành công', 'id_order_member'=>$save->id);
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

// lấy danh sách yêu cầu nhập hàng vào kho
function getListRequestImportProductAPI($input)
{
	global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelProducts = $controller->loadModel('Products');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
            	$conditions = array('id_member_buy'=>$infoMember->id);
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

function editProductWarehouseAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost; 
  	  
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['idWarehouseProduct']) && isset($dataSend['number']) && !empty($dataSend['note'])){
            $infoMember = getMemberByToken($dataSend['token'],'editProductWarehouse');

            if(!empty($infoMember)){
                 if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                $modelProducts = $controller->loadModel('Products');
                $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
                $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

                $checkData = $modelWarehouseProducts->find()->where(['id'=>(int) $dataSend['idWarehouseProduct'], 'id_member'=>$infoMember->id])->first();

                if(!empty($checkData)){
                    $quantity_old = $checkData->quantity;

                    $checkData->quantity = (int) $dataSend['number'];

                    $modelWarehouseProducts->save($checkData);

                    // lưu nhật ký
                    if($checkData->quantity >= $quantity_old){
                        $type = 'plus';
                        $quantity = $checkData->quantity - $quantity_old;
                    }else{
                        $type = 'minus';
                        $quantity = $quantity_old - $checkData->quantity;
                    }

                    $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                    $saveWarehouseHistories->id_member = $infoMember->id;
                    $saveWarehouseHistories->id_product = $checkData->id_product;
                    $saveWarehouseHistories->quantity = $quantity;
                    $saveWarehouseHistories->note = 'Chỉnh sửa số lượng hàng trong kho vì: '.$dataSend['note'];
                    $saveWarehouseHistories->create_at = time();
                    $saveWarehouseHistories->type = $type;
                    $saveWarehouseHistories->id_order_member = 0;

                    $modelWarehouseHistories->save($saveWarehouseHistories);

                    $note = $infoMember->type_tv.' '. $infoMember->name.' Chỉnh sửa số lượng sản phẩn '.@$product->title.' trong kho có id là:'.$saveWarehouseHistories->id;

                    addActivityHistory($infoMember,$note,'editProductWarehouse',$saveWarehouseHistories->id);

                    $return = array('code'=>1, 'mess'=>'bạn sửa số lượng hàng trong kho thành công');
                }else{
                   $return = array('code'=>4, 'mess'=>'Sản phẩm này không có trong kho');
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

function viewWarehouseProductAgencyAPI($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;
 

     $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id_agency'])){
            $infoMember = getMemberByToken($dataSend['token'],'historyWarehouseProductAgency');

            if(!empty($infoMember)){


            $modelProducts = $controller->loadModel('Products');
            $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
            $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

            $conditions = array('id_member'=>(int) $dataSend['id_agency']);
            $limit = 20;
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            if(!empty($dataSend['id_product'])){
                $conditions['id_product'] = (int) $dataSend['id_product'];
            }

            $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            

            if(!empty($listData)){
                foreach($listData as $key => $item){
                    $listData[$key]->product = $modelProducts->find()->where(['id'=>$item->id_product ])->first();
                    $listData[$key]->history = $modelWarehouseHistories->find()->where(['id_product'=>$item->id_product, 'id_member'=>$item->id_member ])->order(['id'=>'desc'])->first();
                }
            }

            // phân trang
            $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);

            
            $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>$totalData);
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}
?>