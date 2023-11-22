<?php 
function listCategoryService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh mục dịch vụ';
    
    if(!empty(checkLoginManager('listCategoryService'))){
        $mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestCategoryService':
                    $mess= '<p class="text-danger">Bạn cần tạo nhóm dịch vụ trước</p>';
                    break;

                case 'requestCategoryDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa danh mục này</p>';
                    break;

                case 'requestCategoryDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

        $infoUser = $session->read('infoUser');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
                $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = 0;
            $infoCategory->image = $dataSend['image'];
            $infoCategory->id_member = $infoUser->id_member;
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'category_service';
            $infoCategory->slug = createSlugMantan($infoCategory->name).'-'.time();

            $modelCategories->save($infoCategory);

            $mess= '<p class="text-success">Lưu thông tin thành công</p>';

        }

        $conditions = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }
}

function deleteCategoryService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa danh mục sản phẩm';
    
    if(!empty(checkLoginManager('deleteCategoryService'))){
        $infoUser = $session->read('infoUser');
        $modelService = $controller->loadModel('Services');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'type' => 'category_service', 'id_member'=>$infoUser->id_member);
            
            $data = $modelCategories->find()->where($conditions)->first();

            $checkSevice = $modelService->find()->where(array('id_category'=>$data->id))->all()->toList();
            if(empty($checkSevice)){
                if(!empty($data)){
                    $modelCategories->delete($data);
                    return array('code'=>1);
                }else{
                    return array('code'=>0);
                 }
            }else{
                return array('code'=>2);
            }
        }
    }else{
        return $controller->redirect('/');
    }
}

function listService($input){
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlCurrent;
    global $controller;

    $metaTitleMantan = 'Danh sách dịch vụ';
    if(!empty(checkLoginManager('listService'))){
        $mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestService':
                    $mess= '<p class="text-danger">Bạn cần tạo dịch vụ trước</p>';
                    break;
                case 'requestDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa dịch vụ này</p>';
                    break;
                case 'requestDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

        $infoUser = $session->read('infoUser');
        
        $modelService = $controller->loadModel('Services');

		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['code'])){
            $conditions['code'] =  $_GET['code'];
        }
        
        if(!empty($_GET['id_category'])){
            $conditions['id_category'] = $_GET['id_category'];
        }

		if(isset($_GET['status'])){
            if($_GET['status']!=''){
                $conditions['status'] = $_GET['status'];
            }
        }

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}
	    
        $listData = $modelService->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelService->find()->where($conditions)->all()->toList();
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
        
        $conditionsCategorie = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategorie)->order($order)->all()->toList();

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    
        setVariable('listData', $listData);
	    setVariable('listCategory', $listCategory);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }
}

function addService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin dịch vụ';
    
    if(!empty(checkLoginManager('addService'))){
        $modelMembers = $controller->loadModel('Members');
        $modelService = $controller->loadModel('Services');
        $modelTrademarks = $controller->loadModel('Trademarks');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelService->get( (int) $_GET['id']);
        }else{
            $data = $modelService->newEmptyEntity();
            $data->created = getdate()[0];
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                if(empty($dataSend['image'])) $dataSend['image'] = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.jpg';
                if(empty($dataSend['code'])) $dataSend['code'] = createToken(10);

                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->image = @$dataSend['image'];
                $data->code = @$dataSend['code'];
                $data->id_category =(int) @$dataSend['id_category'];
                $data->description = @$dataSend['description'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $session->read('id_spa');
                $data->price = (int)@$dataSend['price'];
                $data->status = @$dataSend['status'];
                $data->duration = @$dataSend['duration'];
                $data->commission_staff_fix = (int) @$dataSend['commission_staff_fix'];
                $data->commission_staff_percent = (int) @$dataSend['commission_staff_percent'];
                $data->commission_affiliate_fix = (int) @$dataSend['commission_affiliate_fix'];
                $data->commission_affiliate_percent = (int) @$dataSend['commission_affiliate_percent'];
                
                $data->slug = createSlugMantan(trim($dataSend['name'])).'-'.time();
                
                $modelService->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                if(!empty($_GET['id'])){
                    return $controller->redirect('/listService?mess=2');
                }else{
                    return $controller->redirect('/listService?mess=1');
                }
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
            }
        }
        
        $conditionsCategorie = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategorie)->order($order)->all()->toList();

        if(empty($listCategory)){
            return $controller->redirect('/listCategoryService/?error=requestCategoryService');
        }

        setVariable('data', $data);
        setVariable('listCategory', $listCategory);
    }else{
        return $controller->redirect('/');
    }
}

function deleteService($input){
    global $controller;
    global $session;

    $modelService = $controller->loadModel('Services');
    $modelOrderDetails = $controller->loadModel('OrderDetails');

    if(!empty(checkLoginManager('deleteService'))){
        $infoUser = $session->read('infoUser');
        $modelCombo = $controller->loadModel('Combos');

        

        if(!empty($_GET['id'])){
            $data = $modelService->get($_GET['id']);

            $checkCombo = $modelCombo->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkCombo)){
                foreach($checkCombo as $key => $item){
                    if(!empty($item->service)){
                        $service = json_decode(@$item->service, true);
                        foreach($service as $k => $value){
                            if($k==$data->id){
                                return $controller->redirect('/listService?error=requestDelete');
                            }
                        }
                    }
                }
            }

            $checkOrder = $modelOrderDetails->find()->where(array('id_product'=>$data->id,'type'=>'service','id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkOrder)){
                return $controller->redirect('/listService?error=requestDelete');

            }
            
            if($data){
                $modelService->delete($data);
                return $controller->redirect('/listService?error=requestDeleteSuccess');
            }
        }

        return $controller->redirect('/listService');
    }else{
        return $controller->redirect('/');
    }
}
?>