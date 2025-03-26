<?php 
function listCombo($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách combo dịch vụ';

	$modelCombo = $controller->loadModel('Combos');
	$modelProduct = $controller->loadModel('Products');
	$modelService = $controller->loadModel('Services');
	
    setVariable('page_view', 'listCombo');
	if(!empty(checkLoginManager('listCombo', 'combo'))){
		$infoUser = $session->read('infoUser');
		 $mess= '';
		if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestProduct':
                    $mess= '<p class="text-danger">Bạn cần tạo combo trước</p>';
                    break;
                case 'requestDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa combo này</p>';
                    break;
                case 'requestDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

	    $listData = $modelCombo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	  
	  
	    if(!empty($listData)){
		    foreach($listData as $key=>$item){
		    	$prod = array();
	            if(!empty($item->product)){
	                $product = json_decode($item->product);
	                foreach($product as $idProduct => $quantityPro){
	                	$pro = $modelProduct->find()->where(array('id'=>$idProduct, 'id_member'=>$infoUser->id_member))->first();
	                	$pro->quantityCombo = $quantityPro;
    					$prod[$idProduct]= $pro;
	                }
	            }

	            $listData[$key]->product = $prod;
	            $services = array();
	            if(!empty($item->service)){
	                $service = json_decode($item->service);
	                
	                foreach($service as $idservice => $quanService){
	                	$ser = $modelService->find()->where(array('id'=>$idservice, 'id_member'=>$infoUser->id_member))->first();
	                	$ser->quantityCombo = $quanService;
    					$services[$idservice]= $ser;
	                }
	            $listData[$key]->service = $services;
	                
	            }
	        }
    	}
    	

	    $totalData = $modelCombo->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);

	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
        setVariable('mess', $mess);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/');
	}
}

function addCombo($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin combo dịch vụ';
    
    setVariable('page_view', 'addCombo');
    if(!empty(checkLoginManager('addCombo', 'combo'))){
        $modelMembers = $controller->loadModel('Members');
        $modelCombo = $controller->loadModel('Combos');
        $modelProducts = $controller->loadModel('Products');
        $modelService = $controller->loadModel('Services');
        $modelTrademarks = $controller->loadModel('Trademarks');
        
        $infoUser = $session->read('infoUser');
        
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCombo->get( (int) $_GET['id']);
        }else{
            $data = $modelCombo->newEmptyEntity();
            $data->created_at = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->price = (int)@$dataSend['price'];
                $data->description = @$dataSend['description'];
                $data->status = @$dataSend['status'];
                $data->updated_at = time();
                $data->quantity = (int) @$dataSend['quantity'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $session->read('id_spa');
                $data->commission_staff_fix = (int) @$dataSend['commission_staff_fix'];
                $data->commission_staff_percent = (int) @$dataSend['commission_staff_percent'];
                $data->use_time = (int) @$dataSend['use_time'];
                $data->image = (!empty($dataSend['image']))?$dataSend['image']:$urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.jpg';
                
                $product = array();
                if (!empty($dataSend['idHangHoa']) && !empty($dataSend['soluong'])) {
                    foreach($dataSend['idHangHoa'] as $key=>$idHangHoa){
                        if($dataSend['soluong'][$key]>0){
                            $product[$idHangHoa]= (double) $dataSend['soluong'][$key];
                        }
                    }
                }

                $service = array();
                if (!empty($dataSend['idService']) && !empty($dataSend['quantityService'])) {
                    foreach($dataSend['idService'] as $key=>$idService){
                        if($dataSend['quantityService'][$key]>0){
                            $service[$idService]= (double) $dataSend['quantityService'][$key];
                        }
                    }
                }

                $data->product = json_encode($product);
                $data->service = json_encode($service);

                $modelCombo->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên gói combo</p>';
            }
        }

        $conditionsCategorieProduct = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $categoryProduct = $modelCategories->find()->where($conditionsCategorieProduct)->order($order)->all()->toList();

        if(!empty($categoryProduct)){
	    	foreach ($categoryProduct as $key => $value) {
	    		$categoryProduct[$key]->product = $modelProducts->find()->where(array('id_category'=>$value->id, 'id_spa'=>(int) $session->read('id_spa')))->order($order)->all()->toList();
	    	}
	    }

 		$conditionsCategorieService = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $CategoryService = $modelCategories->find()->where($conditionsCategorieService)->order($order)->all()->toList();

        if(!empty($CategoryService)){
	    	foreach ($CategoryService as $key => $Service) {
	    		$CategoryService[$key]->service = $modelService->find()->where(array('id_category'=>$Service->id, 'id_spa'=>(int) $session->read('id_spa')))->order($order)->all()->toList();
	    	}
	    }

	     // danh sách dịch vụ
	    $service = array('id_member'=>$infoUser->id_member, 'id_spa'=>(int) $session->read('id_spa'));
	    $dataService = $modelService->find()->where($service)->order(['name' => 'ASC'])->all()->toList();

	    // danh sách sản phẩm
	    $product = array('id_member'=>$infoUser->id_member, 'id_spa'=>(int) $session->read('id_spa'));
	    $dataProduct = $modelProducts->find()->where($product)->order(['name' => 'ASC'])->all()->toList();


	    if(empty($dataService)){
	    	return $controller->redirect('/listService/?error=requestService');
	    }

	    if(empty($dataProduct)){
	    	return $controller->redirect('/listProduct/?error=requestProduct');
	    }

        setVariable('data', $data);
        setVariable('categoryProduct', $categoryProduct);
        setVariable('CategoryService', $CategoryService);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }
}

function deleteCombo($input){
    global $controller;
    global $session;
    
    setVariable('page_view', 'deleteRoom');
    $modelCombo = $controller->loadModel('Combos');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    if(!empty(checkLoginManager('deleteCombo', 'combo'))){
    	$infoUser = $session->read('infoUser');


        if(!empty($_GET['id'])){
            $data = $modelCombo->get($_GET['id']);

            $checkOrder = $modelOrderDetails->find()->where(array('id_product'=>$data->id,'type'=>'combo','id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkOrder)){
                return $controller->redirect('/listCombo?error=requestDelete');

            }
            
            if($data){
                $modelCombo->delete($data);
                return $controller->redirect('/listCombo?error=requestDeleteSuccess');
            }
        }

        return $controller->redirect('/listCombo');
    }else{
        return $controller->redirect('/');
    }
}
?>