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
?>