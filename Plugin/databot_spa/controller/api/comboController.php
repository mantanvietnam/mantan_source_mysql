<?php 
function searchComboApi($input)
{
	global $controller;
	global $session;
	

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelCombo = $controller->loadModel('Combos');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member, 'id_spa'=>$session->read('id_spa'));
            $conditions['name LIKE'] =  '%'.$_GET['key'].'%';
          
            $order = array('name' => 'asc');

            $listData = $modelCombo->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->price,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'price'=>$data->price,
                    			);
                }
            }
        }
	}

	return $return;
}

function listComboAPI($input){
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlCurrent;
    global $controller;
    global $isRequestPost;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCombo','product');
			if(!empty($infoUser)){
		        $modelCombo = $controller->loadModel('Combos');
				$modelProduct = $controller->loadModel('Products');
				$modelService = $controller->loadModel('Services');

				$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['code'])){
		            $conditions['code'] =  $dataSend['code'];
		        }
		        
		        if(!empty($dataSend['id_category'])){
		            $conditions['id_category'] = $dataSend['id_category'];
		        }

				if(isset($dataSend['status'])){
		            if($dataSend['status']!=''){
		                $conditions['status'] = $dataSend['status'];
		            }
		        }

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}
			    
		        $listData = $modelCombo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		        if(!empty($listData)){
		        	foreach($listData as $key=>$item){
		        		$prod = array();
		        		if(!empty($item->product)){
		        			$product = json_decode($item->product);
		        			foreach($product as $idProduct => $quantityPro){
		        				$pro = $modelProduct->find()->where(array('id'=>$idProduct, 'id_member'=>$infoUser->id_member))->first();
		        				$pro->quantity_combo = $quantityPro;
		        				$prod[]= $pro;
		        			}
		        		}

		        		$listData[$key]->list_product = $prod;
		        		$services = array();
		        		if(!empty($item->service)){
		        			$service = json_decode($item->service);

		        			foreach($service as $idservice => $quanService){
		        				$ser = $modelService->find()->where(array('id'=>$idservice, 'id_member'=>$infoUser->id_member))->first();
		        				$ser->quantity_combo = $quanService;
		        				$services[]= $ser;
		        			}
		        			$listData[$key]->list_service = $services;

		        		}
		        	}
		        }

			    $totalData = $modelCombo->find()->where($conditions)->count();

	    		return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailComboAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelProduct = $controller->loadModel('Products');
	$modelCombo = $controller->loadModel('Combos');
	$modelService = $controller->loadModel('Services');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCombo','product');
			if(!empty($infoUser)){

	        $data = $modelCombo->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
	        	$prod = array();
	        	if(!empty($data->product)){
	        		$product = json_decode($data->product);
	        		foreach($product as $idProduct => $quantityPro){
	        			$pro = $modelProduct->find()->where(array('id'=>$idProduct, 'id_member'=>$infoUser->id_member))->first();
	        			$pro->quantity_combo = $quantityPro;
	        			$prod[] = $pro;
	        		}
	        	}

	        	$data->list_product = $prod;
	        	$services = array();
	        	if(!empty($data->service)){
	        		$service = json_decode($data->service);

	        		foreach($service as $idservice => $quanService){
	        			$ser = $modelService->find()->where(array('id'=>$idservice, 'id_member'=>$infoUser->id_member))->first();
	        			$ser->quantity_combo = $quanService;
	        			$services[]= $ser;
	        		}
	        	}
	        	$data->list_service = $services;

			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addComboAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addCombo','product');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
		        $modelCombo = $controller->loadModel('Combos');
		        $modelProducts = $controller->loadModel('Products');
		        $modelService = $controller->loadModel('Services');
		        $modelTrademarks = $controller->loadModel('Trademarks');
		        
		        $mess= '';

		        // lấy data edit
		        if(!empty($dataSend['id'])){
		            $data = $modelCombo->get( (int) $dataSend['id']);
		        }else{
		            $data = $modelCombo->newEmptyEntity();
		            $data->created_at = time();
		        }


                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
						$image = uploadImage($infoUser->phone, 'image', 'image_combo'.time());
				}
				if(!empty($image['linkOnline'])){
					$data->image = $image['linkOnline'].'?time='.time();
			    }

			    if(empty($data->image)){
			    	$data->image = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.png';
			    }

                // tạo dữ liệu save
                if(!empty($dataSend['name'])){
                	$data->name = @$dataSend['name'];
            	}
                if(!empty($dataSend['price'])){
                	$data->price = (int)@$dataSend['price'];
            	}
                if(!empty($dataSend['description'])){
                	$data->description = @$dataSend['description'];
            	}
                if(!empty($dataSend['status'])){
                	$data->status = @$dataSend['status'];
            	}
                $data->updated_at = time();
                if(!empty($dataSend['quantity'])){
                	$data->quantity = (int) @$dataSend['quantity'];
            	}
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $infoUser->id_spa;
                if(!empty($dataSend['commission_staff_fix'])){
                	$data->commission_staff_fix = (int) @$dataSend['commission_staff_fix'];
            	}
                if(!empty($dataSend['commission_staff_percent'])){
                	$data->commission_staff_percent = (int) @$dataSend['commission_staff_percent'];
            	}
                if(!empty($dataSend['use_time'])){
                	$data->use_time = (int) @$dataSend['use_time'];
                }
                
                $product = array();
                if(!empty($dataSend['data_product'])) {
                	$data_product =  json_decode($dataSend['data_product'], true);
                    foreach($data_product as $key =>$value){
                        if($value['quantity']>0){
                            $product[$value['id_product']]= (double) $value['quantity'];
                        }
                    }

                    $data->product = json_encode($product);
                }

                $service = array();
                if (!empty($dataSend['data_service'])) {
                	$data_service =  json_decode($dataSend['data_service'], true);
                    foreach($data_service as $key=>$value){
                        if($value['quantity']>0){
                            $service[$value['id_service']]= (double) $value['quantity'];
                        }
                    }
                    $data->service = json_encode($service);
                }
              
                $modelCombo->save($data);

               
			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteComboAPI($input){
    global $controller;
    global $isRequestPost;
    global $session;

    $modelService = $controller->loadModel('Services');
    $modelCombo = $controller->loadModel('Combos');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
  	 	if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteCategoryProduct','product');
			if(!empty($infoUser)){
            	$data = $modelCombo->find()->where(['id'=>$dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
            	if(!empty($data)){
            		$modelCombo->delete($data);
             		return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
?>