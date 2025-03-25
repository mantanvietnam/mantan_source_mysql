<?php 
function listProductProjectAdmin($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Dự án';

	$modelProductProjects = $controller->loadModel('ProductProjects');

	$conditions = array();
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

    if(!empty($listData)){
        $kind[0] = $modelCategories->newEmptyEntity();

    	foreach ($listData as $key => $value) {
    		if(empty($kind[$value->id_kind])){
    			$kind[$value->id_kind] = $modelCategories->get( (int) $value->id_kind);
    		}
    		
    		$listData[$key]->name_category = (!empty($kind[$value->id_kind]->name))?$kind[$value->id_kind]->name:'';
    	}
    }
    
    $listData = $modelProductProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'category_type');
    $listType = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
    setVariable('listKind', $listKind);
    setVariable('listType', $listType);

}

function addProductProjectAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Dự án';

    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerce = $controller->loadModel('Commerce');

    $projectId = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $data = $projectId ? $modelProductProjects->get($projectId) : $modelProductProjects->newEmptyEntity();

    if ($projectId && $data) {
        $data->images = json_decode($data->images, true);

    }
    $listKind = $controller->Categories->find()->where(['type' => 'category_kind'])->all()->toList();
    $listType = $controller->Categories->find()->where(['type' => 'category_type'])->all()->toList();

    setVariable('data', $data);
    setVariable('listKind', $listKind);
    setVariable('listType', $listType);
}

function deleteProductProjectAdmin($input){
    global $controller;

    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');
    
    if(!empty($_GET['id'])){
        $data = $modelProductProjects->get($_GET['id']);
        
        if($data){
            $commerceToDelete = $modelCommerce->find()->where(['id_product' => $data->id])->all();
            if ($commerceToDelete) {
                foreach ($commerceToDelete as $commerce) {
                    $modelCommerceItems->deleteAll(['id_detail' => $commerce->id]);
                    $modelCommerce->delete($commerce);
                }
            }

            $modelProductProjects->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin');
}


function deleteProductItemAdmin($input){
    global $controller;

    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');
    
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $data = $modelCommerce->get($id);
        
        if($data){
            $modelCommerceItems->deleteAll(['id_detail' => $data->id]);

            $modelCommerce->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/home_project-view-admin-product_project-details-settingProductDetail?id=' . $data->id_product);
}

function settingProductDetail($input){
    global $isRequestPost;
    global $controller;
    global $metaTitleMantan;
    global $urlCurrent;

    $metaTitleMantan = 'Cài đặt chi tiết dự án';

    $modelCommerce = $controller->loadModel('Commerce');
    $modelProductProjects = $controller->loadModel('ProductProjects');
    
    $mess = '';
    $id_product = 0;
    
    if(!empty($_GET['id'])){
        $id_product = (int) $_GET['id'];
    }
    
    $productInfo = null;
    if($id_product > 0){
        $productInfo = $modelProductProjects->find()->where(['id'=>$id_product])->first();
    }
    
    $commerceData = [];
    if($id_product > 0){
        $commerceData = $modelCommerce->find()
                                    ->where(['id_product'=>$id_product])
                                    ->order(['main_view_id' => 'ASC'])
                                    ->all()
                                    ->toList();
    }
    
    
    setVariable('commerceData', $commerceData);
    setVariable('productInfo', $productInfo); 
    setVariable('id_product', $id_product);
    setVariable('mess', $mess);
}

function addProductDetailView1($input){
    global $isRequestPost;
    global $controller;
    global $metaTitleMantan;
    global $urlCurrent;

    $metaTitleMantan = 'Chi tiết mô tả';

    $modelCommerce = $controller->loadModel('Commerce');
    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerceItems = $controller->loadModel('CommerceItems');

    $mess = '';
    $id_product = 0;

    if(!empty($_GET['id_product'])){
        $id_product = (int) $_GET['id_product'];
    }

    if(!empty($_GET['id'])){
        $commerceData = $modelCommerce->find()->where(['id'=>(int) $_GET['id']])->first();
        if(!empty($commerceData)){
            $id_product = $commerceData->id_product;
        }
        
    }else{
        $commerceData = $modelCommerce->newEmptyEntity();
        $commerceData->id_product = $id_product;
    }

    $commerceItems = [];
    if(!empty($commerceData->id)){
        $commerceItems = $modelCommerceItems->find()->where(['id_detail'=>$commerceData->id])->order(['id' => 'ASC'])->toArray();
    }

    $displayItems = [];
    for($i = 0; $i < 3; $i++) {
        if(isset($commerceItems[$i])) {
            $displayItems[$i] = $commerceItems[$i];
        } else {
            $item = new \stdClass();
            $item->id = 0;
            $item->title = '';
            $item->detail_image = '';
            $item->description = '';
            $displayItems[$i] = $item;
        }
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['main_title'])){
            $commerceData->main_title = $dataSend['main_title'];
            $commerceData->main_view_id = $dataSend['main_view_id'];
            $commerceData->main_description = $dataSend['main_description'];
            $commerceData->view_type = "1";
            $commerceData->id_product = !empty($dataSend['id_product']) ? $dataSend['id_product'] : $id_product;

            $modelCommerce->save($commerceData);

            if(!empty($commerceData->id)){
                for($i = 0; $i < 3; $i++) {
                    $title = !empty($dataSend['title'][$i]) ? $dataSend['title'][$i] : '';
                    $description = !empty($dataSend['description_'.$i]) ? $dataSend['description_'.$i] : '';
                    
                    if(!empty($title)) {
                        if(isset($commerceItems[$i]) && !empty($commerceItems[$i]->id)) {
                            $item = $commerceItems[$i];
                        } else {
                            $item = $modelCommerceItems->newEmptyEntity();
                            $item->id_detail = $commerceData->id;
                        }
                        
                        $item->title = $title;
                        $item->description = $description;
                        
                        if (!empty($_FILES['detail_image']['name'][$i])) {
                            $temp_file = [
                                'name' => $_FILES['detail_image']['name'][$i],
                                'type' => $_FILES['detail_image']['type'][$i],
                                'tmp_name' => $_FILES['detail_image']['tmp_name'][$i],
                                'error' => $_FILES['detail_image']['error'][$i],
                                'size' => $_FILES['detail_image']['size'][$i]
                            ];
                            
                            $_FILES['temp_image'] = $temp_file;
                            
                            $upload = uploadImage('vinhome_', 'temp_image', 'detail_image_'.$i.'_'.time().rand(0, 1000000));
                            
                            if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                                $item->detail_image = $upload['linkOnline'];
                            }
                        }
                        
                        $modelCommerceItems->save($item);
                    }
                }
            }

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Nhập thiếu dữ liệu</p>';
        }
        
        if(!empty($commerceData->id)){
            $commerceItems = $modelCommerceItems->find()->where(['id_detail'=>$commerceData->id])->order(['id' => 'ASC'])->toArray();
            
            for($i = 0; $i < 3; $i++) {
                if(isset($commerceItems[$i])) {
                    $displayItems[$i] = $commerceItems[$i];
                }
            }
        }
    }
    
    setVariable('commerceData', $commerceData);
    setVariable('commerceItems', $displayItems);
    setVariable('mess', $mess);
    setVariable('id_product', $id_product);
}

function addProductDetailView2($input){
    global $isRequestPost;
    global $controller;
    global $metaTitleMantan;
    global $urlCurrent;

    $metaTitleMantan = 'Chi tiết mô tả';

    $modelCommerce = $controller->loadModel('Commerce');
    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerceItems = $controller->loadModel('CommerceItems');

    $mess = '';
    $id_product = 0;

    if(!empty($_GET['id_product'])){
        $id_product = (int) $_GET['id_product'];
    }

    if(!empty($_GET['id'])){
        $commerceData = $modelCommerce->find()->where(['id'=>(int) $_GET['id']])->first();
        if(!empty($commerceData)){
            $id_product = $commerceData->id_product;
        }
        
    }else{
        $commerceData = $modelCommerce->newEmptyEntity();
        $commerceData->id_product = $id_product;
    }

    $commerceItems = [];
    if(!empty($commerceData->id)){
        $commerceItems = $modelCommerceItems->find()->where(['id_detail'=>$commerceData->id])->order(['id' => 'ASC'])->toArray();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
   

        if(!empty($dataSend['main_title'])){
            $commerceData->main_title = $dataSend['main_title'];
            $commerceData->main_view_id = $dataSend['main_view_id'];
            $commerceData->main_description = $dataSend['main_description'];
            $commerceData->view_type = "2";
            $commerceData->id_product = !empty($dataSend['id_product']) ? $dataSend['id_product'] : $id_product;
            
            if (!empty($_FILES['main_image']['name'])) {
                $upload = uploadImage('vinhome_', 'main_image', 'main_image_'.time().rand(0, 1000000));
                if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                    $commerceData->main_image = $upload['linkOnline'];
                }
            }

            $modelCommerce->save($commerceData);

            if(!empty($commerceData->id)){
                $oldItemIds = [];
                foreach($commerceItems as $item) {
                    $oldItemIds[] = $item->id;
                }
                
                if(!empty($dataSend['title']) && is_array($dataSend['title'])) {
                    $existingItemIds = [];
                    
                    foreach($dataSend['title'] as $i => $title) {
                        if(!empty($title)) {
                            $item = null;
                            
                            if(isset($commerceItems[$i]) && !empty($commerceItems[$i]->id)) {
                                $item = $commerceItems[$i];
                                $existingItemIds[] = $item->id;
                            } else {
                                $item = $modelCommerceItems->newEmptyEntity();
                                $item->id_detail = $commerceData->id;
                            }
                            
                            $item->title = $title;
                            if (!empty($dataSend['description'][$i])) {
                                $item->description = $dataSend['description'][$i];
                            } elseif (!empty($dataSend['description_'.$i])) {
                                $item->description = $dataSend['description_'.$i];
                            } else {
                                $item->description = '';
                            }

                            if (!empty($_FILES['detail_image']['name'][$i])) {
                                $temp_file = [
                                    'name' => $_FILES['detail_image']['name'][$i],
                                    'type' => $_FILES['detail_image']['type'][$i],
                                    'tmp_name' => $_FILES['detail_image']['tmp_name'][$i],
                                    'error' => $_FILES['detail_image']['error'][$i],
                                    'size' => $_FILES['detail_image']['size'][$i]
                                ];
                                
                                $_FILES['temp_image'] = $temp_file;
                                
                                $upload = uploadImage('vinhome_', 'temp_image', 'detail_image_'.$i.'_'.time().rand(0, 1000000));
                                
                                if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                                    $item->detail_image = $upload['linkOnline'];
                                }
                            }
                            $modelCommerceItems->save($item);
                        }
                    }
                    
                    foreach($oldItemIds as $oldId) {
                        if(!in_array($oldId, $existingItemIds)) {
                            $itemToDelete = $modelCommerceItems->get($oldId);
                            $modelCommerceItems->delete($itemToDelete);
                        }
                    }
                }
            }

            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Nhập thiếu dữ liệu</p>';
        }
        
        if(!empty($commerceData->id)){
            $commerceItems = $modelCommerceItems->find()->where(['id_detail'=>$commerceData->id])->order(['id' => 'ASC'])->toArray();
        }
    }
    
    setVariable('commerceData', $commerceData);
    setVariable('commerceItems', $commerceItems);
    setVariable('mess', $mess);
    setVariable('id_product', $id_product);
}

function addProductDetailView3($input){
    global $isRequestPost;
    global $controller;
    global $metaTitleMantan;
    global $urlCurrent;

    $metaTitleMantan = 'Chi tiết mô tả';

    $modelCommerce = $controller->loadModel('Commerce');
    $modelProductProjects = $controller->loadModel('ProductProjects');

    $mess = '';
    $id_product = 0;

    if(!empty($_GET['id_product'])){
        $id_product = (int) $_GET['id_product'];
    }

    if(!empty($_GET['id'])){
        $commerceData = $modelCommerce->find()->where(['id'=>(int) $_GET['id']])->first();
        if(!empty($commerceData)){
            $id_product = $commerceData->id_product;
        }
        
    }else{
        $commerceData = $modelCommerce->newEmptyEntity();
        $commerceData->id_product = $id_product;
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['main_title'])){

            $commerceData->main_title = $dataSend['main_title'];
            $commerceData->main_view_id = $dataSend['main_view_id'];
            $commerceData->main_description = $dataSend['main_description'];
            $commerceData->view_type = $dataSend['view_type'];
            $commerceData->id_product = !empty($dataSend['id_product']) ? $dataSend['id_product'] : $id_product;

            if (!empty($_FILES['main_image']['name'])) {
                
                $upload = uploadImage('vinhome_', 'main_image', 'image_'.time().rand(0, 1000000));
                if (!empty($upload['linkOnline'])) {
                    $commerceData->main_image = $upload['linkOnline'];
                }
            }

            $modelCommerce->save($commerceData);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
        }
        }
        setVariable('commerceData', $commerceData);
        setVariable('mess', $mess);
        setVariable('id_product', $id_product);
}

?>