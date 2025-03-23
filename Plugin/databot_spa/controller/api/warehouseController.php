<?php 
function listWarehouseAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$user = getMemberByToken($dataSend['token'], 'listWarehouse','product');
			if(!empty($user)){

				$modelMembers = $controller->loadModel('Members');
				$modelWarehouses = $controller->loadModel('Warehouses');

				$conditions = ['id_member'=>$user->id_member,'id_spa'=>$user->id_spa];
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['warehouse_id'])){
					$conditions['warehouse_id'] = (int) $dataSend['warehouse_id'];
				}

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}

			    $listData = $modelWarehouses->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelWarehouses->find()->where($conditions)->count();

			    return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addWarehouseAPI($input)
{
	global $controller;
	global $isRequestPost;
    global $metaTitleMantan;
   

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addWarehouse','product');
			if(!empty($infoUser)){

		$modelMembers = $controller->loadModel('Members');
		$modelWarehouses = $controller->loadModel('Warehouses');

		$mess= '';

		// lấy data edit
		if(!empty($dataSend['id'])){
			$data = $modelWarehouses->get($dataSend['id']);
		}else{
			$data = $modelWarehouses->newEmptyEntity();
		    $data->created_at = time();
		}
	        	
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->id_member = (int) $infoUser->id_member;
		        $data->id_spa = (int)$infoUser->id_spa;
		        $data->description = $dataSend['description'];

			    $modelWarehouses->save($data);

		        return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}	
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailWarehouseAPI($input){
    global $isRequestPost;
    global $controller;

	$modelWarehouses = $controller->loadModel('Warehouses');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listWarehouse','product');
			if(!empty($infoUser)){
        
	            $conditions = array('id'=> $dataSend['id'], 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelWarehouses->find()->where($conditions)->first();
	            if(!empty($data)){
	               	$modelRoom->delete($data);
	           		return apiResponse(1,'Lấy dữ liệu thành công', $data);
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}



function deleteWarehouseAPI($input)
{
	global $isRequestPost;
    global $controller;

	$modelBed = $controller->loadModel('Beds');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteWarehouse','product');
			if(!empty($infoUser)){
				$modelWarehouses = $controller->loadModel('Warehouses');
				$modelWarehouseProducts = $controller->loadModel('WarehouseProductDetails');
					$data = $modelWarehouses->get($dataSend['id']);

					$checkWarehouseProducts = $modelWarehouseProducts->find()->where(array('id_warehouse'=>$data->id,'id_member'=>$infoUser->id_member))->all()->toList();

					if(empty($checkWarehouseProducts)){
					
					if($data && $data->id_member == $user->id_member){
			         	// xóa kho 
						$modelWarehouses->delete($data);
						return apiResponse(1,'Xóa dữ liệu thành công');
					}
					return apiResponse(4,'Dữ liệu không tồn tại' );
				}
				return apiResponse(4,'kho này không xóa được' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addProductWarehouseAPI($input){
	global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    if($isRequestPost){
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['data_order'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addProductWarehouse','product');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
		        $modelProducts = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelBill = $controller->loadModel('Bills');
		        $modelDebts = $controller->loadModel('Debts');
		        $modelPartner = $controller->loadModel('Partners');

        		$conditionsWarehouse = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
        		$listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

       			
        		$dataSend['data_order'] = json_decode($dataSend['data_order'], true);

	            $warehouse = $modelWarehouses->find()->where(['id'=>$dataSend['id_warehouse'], 'id_member'=>$infoUser->id_member])->first();
	            if(empty($warehouse)){
	            	return  apiResponse(4,'kho này không tồn tại');
	            }
	            $dataWP = $modelWarehouseProducts->newEmptyEntity();
	            $dataWP->id_member = $infoUser->id_member;
	            $dataWP->id_spa = $infoUser->id_spa;
	            $dataWP->id_staff = $infoUser->id;
	            $dataWP->id_warehouse = $warehouse->id;
	            $dataWP->created_at =  time();
	            $dataWP->id_partner = $dataSend['id_partner'];

	            $modelWarehouseProducts->save($dataWP);

	            $total = 0;
	            $details = array();
	            foreach($dataSend['data_order'] as $key => $value){
	                $pro = $modelProducts->find()->where(['id'=>(int) $value['id_product']])->first();

	                if(!empty($pro)){
	                    $total += (int)$value['price']* (int)$value['quantity'];
	                    $product = $modelWarehouseProductDetails->newEmptyEntity();

	                    $product->id_member = $infoUser->id_member;
	                    $product->id_warehouse_product = $dataWP->id;
	                    $product->id_warehouse = $dataWP->id_warehouse;
	                    $product->id_product = $value['id_product'];
	                    $product->impor_price = (int) $value['price'];
	                    $product->quantity = (int) $value['quantity'];
	                    $product->inventory_quantity = (int) $value['quantity'];
	                    $product->created_at = time();

	                    $modelWarehouseProductDetails->save($product);

	                    $pro->quantity += (int)$value['quantity']; 
	                    $modelProducts->save($pro);

	                    $details[] = $product;

	                }
	            }

	             $dataWP->detail = $details;
	            

	            if($dataSend['type_bill']=='cong_no'){
	                // lưu vào công nợ
	                $debt = $modelDebts->newEmptyEntity();
	                
	                $debt->created_at = time();
	                $debt->status = 0;
	                $debt->time = time();
	                $debt->id_member = @$infoUser->id_member;
	                $debt->id_spa = $infoUser->id_spa;
	                $debt->id_staff = $infoUser->id;
	                $debt->total = (int) $total;
	                $debt->note =  'nhập lô hàng có ID là '.$dataWP->id.' vào kho '.$warehouse->name.' ngày '. date('Y-m-d H:i:s');
	                $debt->type = 1; //0: Thu, 1: chi
	                $debt->updated_at = time();
	                $debt->id_customer = (int)@$dataSend['id_partner'];
	                $debt->full_name = @$dataSend['partner_name'];
	                $debt->id_warehouse_product = $dataWP->id;

	                $modelDebts->save($debt);

	                 $dataWP->biil = $debt;
	            }else{
	                // lưu vào bill 
	                $bill = $modelBill->newEmptyEntity();
	                
	                $bill->created_at = time();
	                $bill->time = time();
	                $bill->id_member = @$infoUser->id_member;
	                $bill->id_spa = $infoUser->id_spa;
	                $bill->id_staff = $infoUser->id;
	                $bill->total = (int) $total;
	                $bill->note = 'nhập lô hàng có ID là '.$dataWP->id.' vào kho '.$warehouse->name.' ngày '. date('Y-m-d H:i:s');
	                $bill->type = 1; //0: Thu, 1: chi
	                $bill->updated_at = time();
	                $bill->type_collection_bill = $dataSend['type_bill'];
	                $bill->id_customer = (int)@$dataSend['id_partner'];
	                $bill->full_name = @$dataSend['partner_name'];
	                $bill->id_warehouse_product = $dataWP->id;

	                $modelBill->save($bill);
	                $dataWP->biil = $bill;

	            }

	            return apiResponse(1,'Nhập kho thành công',$dataWP);
            }
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function importHistorytWarehouseAPI($input){
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Lịch sử nhập hàng vào kho';
     if($isRequestPost){
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['data_order'])){
			$infoUser = getMemberByToken($dataSend['token'], 'importHistorytWarehouse','product');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
		        $modelProducts = $controller->loadModel('Products');
		        $modelWarehouses = $controller->loadModel('Warehouses');
		        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
		        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
		        $modelPartner = $controller->loadModel('Partners');


		        $conditions = array('WarehouseProducts.id_member'=>$infoUser->id_member, 'WarehouseProducts.id_spa'=>$infoUser->id_spa);
		        $limit = 20;
		        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		        if($page<1) $page = 1;
		        $order = array('WarehouseProducts.id'=>'desc');

		        if(!empty($dataSend['id'])){
		            $conditions['WarehouseProducts.id'] = $dataSend['id'];
		        }

		        if(!empty($dataSend['id_Warehouse'])){
		            $conditions['id_warehouse'] = $dataSend['id_Warehouse'];
		        }

		        if(!empty($dataSend['id_partner'])){
		            $conditions['id_partner'] = $dataSend['id_partner'];
		        }

		        if(empty($dataSend['searchProduct'])){
		            $dataSend['id_product'] = '';
		        }

		        if(!empty($dataSend['id_product'])){
				    $conditions['wpd.id_product'] = $dataSend['id_product'];
				        
			        $listData = $modelWarehouseProducts->find()->join([
		                            'table' => 'warehouse_product_details',
		                            'alias' => 'wpd',
		                            'type' => 'INNER',
		                            'conditions' => 'wpd.id_warehouse_product = WarehouseProducts.id',
		                        ])->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		            $totalData = $modelWarehouseProducts->find()->join([
		                            'table' => 'warehouse_product_details',
		                            'alias' => 'wpd',
		                            'type' => 'INNER',
		                            'conditions' => 'wpd.id_warehouse_product = WarehouseProducts.id',
		                        ])->where($conditions)->all()->toList();
		            $totalData = count($totalData);
		        }else{
		            $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		            $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
		            $totalData = count($totalData);
		        }

		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $listData[$key]->Warehouse = $modelWarehouses->find()->where(array('id'=>$item->id_warehouse))->first();
		                $listData[$key]->parent = $modelPartner->find()->where(array('id'=>$item->id_partner))->first();
		                $conditionDetailed = array('id_warehouse_product'=>$item->id);

		                if(!empty($dataSend['id_product'])){
		                    $conditionDetailed['id_product'] = $dataSend['id_product'];
		                }

		                $product = $modelWarehouseProductDetails->find()->where($conditionDetailed)->all()->toList();
		                
		                if(!empty($product)){
		                    foreach($product as $k => $value){
		                        $product[$k]->prod = $modelProducts->find()->where(array('id'=>$value->id_product))->first();
		                    }

		                    $listData[$key]->product = $product;
		                }else{
		                    $listData[$key]->product = [];
		                }
		            }
		        }
		        return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


 ?>