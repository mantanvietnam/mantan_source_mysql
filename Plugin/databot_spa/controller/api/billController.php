<?php 
// Danh sách Phiếu thu
function listCollectionBillAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;
	global $type_collection_bill;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCollectionBill','bill');
			if(!empty($infoUser)){
			    $modelMember = $controller->loadModel('Members');
				$modelBill = $controller->loadModel('Bills');
				
				$conditions = array('type'=>0, 'id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');
				
				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['type_collection_bill'])){
					$conditions['type_collection_bill'] = @$dataSend['type_collection_bill'];
				}

				if(!empty($dataSend['id_debt'])){
					$conditions['id_debt'] = (int) $dataSend['id_debt'];
				}

				if(!empty($dataSend['id_card'])){
					$conditions['id_card'] = (int) $dataSend['id_card'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['full_name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time <='] = $date_end;
				}

				if(!empty($dataSend['id_customer'])){
					$conditions['id_customer'] = (int) $dataSend['id_customer'];
				}

			    $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			    

			    if(!empty($listData)){
					foreach($listData as $key => $item){
						$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
						if(!empty($staff)){
							$listData[$key]->staff = $staff;
						}
					}
				}

				$totalData = $modelBill->find()->where($conditions)->all()->toList();
		
	    		$totalData = count($totalData);

	  			return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function detailCollectionBillAPI($input){
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'detailCollectionBill','bill');
			if(!empty($infoUser)){

		$modelCombo = $controller->loadModel('Combos');
		$modelProduct = $controller->loadModel('Products');
		$modelCustomer = $controller->loadModel('Customers');
		$modelService = $controller->loadModel('Services');
		$modelRoom = $controller->loadModel('Rooms');
        $modelBed = $controller->loadModel('Beds');
        $modelMembers = $controller->loadModel('Members');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetails = $controller->loadModel('OrderDetails');
        $modelBill = $controller->loadModel('Bills');

        $data = $modelBill->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();

        if(!empty($data->id_order)){
        	 $order = $modelOrder->get($data->id_order);

        	$product = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'product'))->all()->toList();
            $service = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'service'))->all()->toList();
            $combo = $modelOrderDetails->find()->where(array('id_order'=>$order->id,'type'=>'combo'))->all()->toList();

        	if(!empty($product)){
                foreach($product as $k => $value){
                    $product[$k]->product = $modelProduct->find()->where(array('id'=>$value->id_product))->first();
                }
                $order->product = $product;
            }

            if(!empty($combo)){
                foreach($combo as $k => $value){
                    $combo[$k]->combo = $modelCombo->find()->where(array('id'=>$value->id_product))->first();
                }
                $order->combo = $combo;
            }

            if(!empty($service)){
                foreach($service as $k => $value){
                    $service[$k]->service = $modelService->find()->where(array('id'=>$value->id_product))->first();
                }
                $order->service = $service;
            }


            if(!empty($data->id_customer)){
                $data->customer = $modelCustomer->find()->where(array('id'=>$data->id_customer))->first();
            }
        }

				return apiResponse(1,'lấy dữ liệu thành công',$data);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function addCollectionBillAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin phiếu thu';
    
	setVariable('page_view', 'addCollectionBill');
    if(!empty(checkLoginManager('addCollectionBill', 'bill'))){
        $modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelBill->get( (int) $_GET['id']);
        }else{
            $data = $modelBill->newEmptyEntity();
            $data->created_at =time();
            $data->time = time();
            $data->id_staff = $infoUser->id;
        }

        $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = (int)@$dataSend['id_staff'];;
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 0; //0: Thu, 1: chi
            $data->updated_at =time();
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('user', $infoUser);
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
    }
}

// Danh sách Phiếu chi
function listBillAPI($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $isRequestPost;
	global $type_collection_bill;

	 if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBill','bill');
			if(!empty($infoUser)){

	    
			    $modelMember = $controller->loadModel('Members');
				$modelBill = $controller->loadModel('Bills');


				$conditions = array('type'=>1, 'id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');
				
				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['id_staff'])){
					$conditions['id_staff'] = (int) $dataSend['id_staff'];
				}

				if(!empty($dataSend['id_debt'])){
					$conditions['id_debt'] = (int) $dataSend['id_debt'];
				}

				if(!empty($dataSend['full_name'])){
					$conditions['full_name LIKE'] = '%'.$dataSend['full_name'].'%';
				}

				if(!empty($dataSend['date_start'])){
					$date_start = explode('/', $dataSend['date_start']);
					$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
					$conditions['time >='] = $date_start;
				}

				if(!empty($dataSend['date_end'])){
					$date_end = explode('/', $dataSend['date_end']);
					$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
					$conditions['time <='] = $date_end;
				}

				if(!empty($dataSend['id_customer'])){
					$conditions['id_customer'] = (int) $dataSend['id_customer'];
				}


			    $listData = $modelBill->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
			    

			    if(!empty($listData)){
					foreach($listData as $key =>$item){
						$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
						if(!empty($staff)){
							$listData[$key]->staff = $staff;
						}
					}
				}

				$totalData = $modelBill->find()->where($conditions)->all()->toList();
				$total = 0;
				if(!empty($totalData)){
					foreach($totalData as $key => $value){
						$total += $value->total;
					}
				}
			    $totalData = count($totalData);

			   return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addBillAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin phiếu chi';
    
	setVariable('page_view', 'addBill');
    if(!empty(checkLoginManager('addBill', 'bill'))){


        $modelMembers = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelBill->get( (int) $_GET['id']);
        }else{
            $data = $modelBill->newEmptyEntity();
            $data->created_at =time();
            $data->time = time();
            $data->id_staff = $infoUser->id;
        }

         $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];

        $listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
                 
            // tạo dữ liệu save
            $data->id_member = @$infoUser->id_member;
            $data->id_spa = $session->read('id_spa');
            $data->id_staff = (int)@$dataSend['id_staff'];
            $data->total = (int)@$dataSend['total'];
            $data->note = @$dataSend['note'];
            $data->type = 1; //0: Thu, 1: chi
            $data->updated_at =time();
            $data->type_collection_bill = @$dataSend['type_collection_bill'];
            $data->id_customer = (int)@$dataSend['id_customer'];
            $data->full_name = @$dataSend['full_name'];

            if(!empty($dataSend['time'])){
            	$time = explode(' ', $dataSend['time']);
            	$date = explode('/', $time[0]);
            	$hour = explode(':', $time[1]);
            	$data->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
            	$data->time = time();
            }
           
            $modelBill->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }	

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listStaffs', $listStaffs);
    }else{
        return $controller->redirect('/');
    }
}

function deleteBillAPI($input){
	global $controller;
    global $session;
    
    $modelBill = $controller->loadModel('Bills');
    
    if(!empty(checkLoginManager('deleteBill', 'bill'))){
    	$infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelBill->get($_GET['id']);
            
            if($data){
                $modelBill->delete($data);
            }
        }
        if($_GET['url']='listCollectionBill'){
        	 return $controller->redirect('/listCollectionBill?mess=3');
        }else{
        	return $controller->redirect('/listBill?mess=3');
        }
       
    }else{
        return $controller->redirect('/');
    }
}

/*function printCollectionBill(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;

	if(!empty(checkLoginManager('printCollectionBill', 'bill'))){
	    $metaTitleMantan = 'Danh sách phiếu thu';

	    $modelMember = $controller->loadModel('Members');
		$modelBill = $controller->loadModel('Bills');

		$user = $session->read('infoUser');

		$data = $modelBill->get( (int) $_GET['id']);

		setVariable('data', $data);

		$data->spa = getSpa($data->id_spa);
		$data->staff = getUserId($data->id_staff);

		$data->date = getdate($data->time);
	}else{
        return $controller->redirect('/');
    }
}*/
 ?>