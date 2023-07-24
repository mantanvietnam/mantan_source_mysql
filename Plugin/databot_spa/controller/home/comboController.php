<?php 
function listCombo($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelCombo = $controller->loadModel('Combos');
	$modelProduct = $controller->loadModel('Products');
	$modelService = $controller->loadModel('Services');
	$modelCombo = $controller->loadModel('Combos');
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){
		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
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
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function addCombo($input){
     global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelCombo = $controller->loadModel('Combos');
        $modelProducts = $controller->loadModel('Products');
        $infoUser = $session->read('infoUser');
        $modelService = $controller->loadModel('Services');
        $modelTrademarks = $controller->loadModel('Trademarks');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCombo->get( (int) $_GET['id']);

        }else{
            $data = $modelCombo->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->image = @$dataSend['image'];
                $data->quantity = @$dataSend['quantity'];
                $data->description = @$dataSend['description'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $infoUser->id_spa;
                $data->price = (int)@$dataSend['price'];
                $data->price_old = (int) @$dataSend['price_old'];
                $data->status = @$dataSend['status'];
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

                 $data->product = json_encode(@$product);
                 $data->service = json_encode(@$service);

				$data->updated_at = date('Y-m-d H:i:s');

                $modelCombo->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                 if(!empty($_GET['id'])){
                    return $controller->redirect('/listCombo?mess=2');
                }else{
                    return $controller->redirect('/listCombo?mess=1');
                }
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
            }
        }
        $conditionsCategorieProduct = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $categoryProduct = $modelCategories->find()->where($conditionsCategorieProduct)->order($order)->all()->toList();

        if(!empty($categoryProduct)){
    	foreach ($categoryProduct as $key => $value) {
    		$categoryProduct[$key]->product = $modelProducts->find()->where(array('id_category'=>$value->id))->order($order)->all()->toList();
    		}
    	}

 		$conditionsCategorieService = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $CategoryService = $modelCategories->find()->where($conditionsCategorieService)->order($order)->all()->toList();

        if(!empty($CategoryService)){
    	foreach ($CategoryService as $key => $Service) {
    		$CategoryService[$key]->service = $modelService->find()->where(array('id_category'=>$Service->id))->order($order)->all()->toList();
    		}
    	}


        $conditionsTrademar = array('id_member'=>$infoUser->id_member);
        $listTrademar = $modelTrademarks->find()->where($conditionsTrademar)->all()->toList();

        setVariable('data', $data);
        setVariable('categoryProduct', $categoryProduct);
        setVariable('CategoryService', $CategoryService);
        setVariable('listTrademar', $listTrademar);


        }else{
            return $controller->redirect('/login');
        }
}

function deleteCombo($input){
    global $controller;
    global $session;
    $modelCombo = $controller->loadModel('Combos');
    $infoUser = $session->read('infoUser');
    if(!empty($infoUser)){
    
        if(!empty($_GET['id'])){
            $data = $modelCombo->get($_GET['id']);
            
            if($data){
                $modelCombo->delete($data);
            }
        }

        return $controller->redirect('listCombo.php');
    }else{
        return $controller->redirect('/login');
    }
}
?>
