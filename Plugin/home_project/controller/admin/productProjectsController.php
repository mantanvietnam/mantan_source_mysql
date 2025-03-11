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
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Dự án';

	$modelProductProjects = $controller->loadModel('ProductProjects');
    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProductProjects->get( (int) $_GET['id']);
        $data->images = json_decode($data->images, true);
        $data->officially = json_decode($data->officially, true);     
        // $data->id_product = json_decode($data->id_product, true);

    }else{
        $data = $modelProductProjects->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        // debug($dataSend);
        // die();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
	        $data->name = $dataSend['name'];
            $data->address = $dataSend['address'];
            $data->description= $dataSend['description'];
            $data->status= $dataSend['status'];
            $data->id_kind = $dataSend['id_kind'];
            $data->id_apart_type = $dataSend['id_apart_type'];
            $data->map = $dataSend['map'];
            $data->investor = $dataSend['investor'];
            $data->direction = $dataSend['direction'];
            $data->ownership_type = $dataSend['ownership_type'];
            $data->ecological_space = $dataSend['ecological_space']; 
            $data->utility_services = $dataSend['utility_services']; 
            $data->price = $dataSend['price'];
            $data->acreage = $dataSend['acreage'];
            $data->text_location = $dataSend['text_location'];
            $data->officially = json_encode($dataSend['officially']);
            // $data->commerce = processCommerceData($data, $dataSend);

            if (!empty($_FILES['image']['name'])) {
                $upload = uploadImage('vinhome_', 'image', 'image_'.time().rand(0, 1000000));
            
                if (!empty($upload['linkOnline'])) {
                    $data->image = $upload['linkOnline'];
                }
            }else{
                $data->image = $data->image;
            }
            
            $uploadedImages = [];

            if (!empty($_FILES['images']['name'][0])) {
                $user_id = 'vinhome_';
                
                foreach ($_FILES['images']['name'] as $key => $value) {
                    $temp_file = [
                        'name' => $_FILES['images']['name'][$key],
                        'type' => $_FILES['images']['type'][$key],
                        'tmp_name' => $_FILES['images']['tmp_name'][$key],
                        'error' => $_FILES['images']['error'][$key],
                        'size' => $_FILES['images']['size'][$key]
                    ];
                    
                    $_FILES['temp_image'] = $temp_file;
                    
                    $upload = uploadImage($user_id, 'temp_image', 'image_'.time().rand(0,1000000));
                    
                    if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                        $uploadedImages[] = $upload['linkOnline'];
                    }
            }
                
            }else {
                $uploadedImages = !empty($data->images) ? (is_array($data->images) ? $data->images : json_decode($data->images, true)) : [];
            }
            
            if (!empty($_FILES['img_map']['name'])) {
               
                $upload = uploadImage('vinhome_', 'img_map', 'image_'.time().rand(0, 1000000));
                if (!empty($upload['linkOnline'])) {
                    $uploadedImages['img_map'] = $upload['linkOnline'];
                }
            } else {
                if (!empty($data->images['img_map'])) {
                    $uploadedImages['img_map'] = $data->images['img_map'];
                }
            }
            
            if (!empty($_FILES['img_premises']['name'])) {
                $upload = uploadImage('vinhome_', 'img_premises', 'image_'.time().rand(0, 1000000));
                if (!empty($upload['linkOnline'])) {
                    $uploadedImages['img_premises'] = $upload['linkOnline'];
                }
            } else {
                if (!empty($data->images['img_premises'])) {
                    $uploadedImages['img_premises'] = $data->images['img_premises'];
                }
            }
            
            $formattedImages = [];
            $index = 1;
            foreach ($uploadedImages as $key => $imageUrl) {
                if ($key === 'img_map' || $key === 'img_premises') {
                    $formattedImages[$key] = $imageUrl;
                } else {
                    $formattedImages[$index++] = $imageUrl;
                }
            }
            
            $data->images = json_encode($formattedImages);            

            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelProductProjects->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;

            $modelProductProjects->save($data);   

            $data->images = json_decode($data->images, true);
            processCommerceData($data->id, $dataSend);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'category_type');
    $listType = $modelCategories->find()->where($conditions)->all()->toList();

    if (!empty($_GET['id'])) {
        $data = $modelProductProjects->get((int) $_GET['id']);
        $data->images = json_decode($data->images, true);
        $data->officially = json_decode($data->officially, true);

        $conditionsCommerce = ['id_product' => $data->id];
        $commerceData = $modelCommerce->find()->where($conditionsCommerce)->first();

        if (!empty($commerceData)) {
            $conditionsItems = ['id_commerce' => $commerceData->id];
            $commerceItems = $modelCommerceItems->find()->where($conditionsItems)->all()->toList();
        } else {
            $commerceData = $modelCommerce->newEmptyEntity();
            $commerceItems = [];
        }
    } else {
        $data = $modelProductProjects->newEmptyEntity();
        $commerceData = $modelCommerce->newEmptyEntity();
        $commerceItems = [];
    }
    // debug($commerceData);
    // debug($commerceItems);
    // die();

    setVariable('commerceData', $commerceData);
    setVariable('commerceItems', $commerceItems);
    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listKind', $listKind);
    setVariable('listType', $listType);
    

}

function processCommerceData($id_product, $dataSend)
{
    global $controller;
    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');

    if (empty($id_product) || empty($dataSend)) {
        return;
    }

    $commerceEntity = $modelCommerce->find()->where(['id_product' => $id_product])->first();
    if (!$commerceEntity) {
        $commerceEntity = $modelCommerce->newEmptyEntity();
        $commerceEntity->id_product = $id_product;
    }

    $commerceEntity->main_title = $dataSend['commerce_main_title'] ?? '';
    $commerceEntity->view_type = (int) ($dataSend['commerce_view_id'] ?? 1);
    $commerceEntity->main_description = $dataSend['commerce_main_description'] ?? '';

    if ($modelCommerce->save($commerceEntity)) {
        $commerceId = $commerceEntity->id;

        $existingItems = $modelCommerceItems->find()->where(['id_commerce' => $commerceId])->toArray();
        
        $existingItemsMap = array_values($existingItems);

        if ($commerceEntity->view_type == 1) {
            for ($i = 0; $i < 3; $i++) {
                if (empty($dataSend["commerce_title_" . ($i + 1)])) continue;

                $itemEntity = $existingItemsMap[$i] ?? $modelCommerceItems->newEmptyEntity();
                $itemEntity->id_commerce = $commerceId;
                $itemEntity->title = $dataSend["commerce_title_" . ($i + 1)];
                $itemEntity->description = $dataSend["commerce_description_" . ($i + 1)] ?? '';

                $fileKey = "commerce_image_" . ($i + 1);
                if (!empty($_FILES[$fileKey]['name'])) {
                    $upload = uploadImage('commerce_', $fileKey, 'commerce_item_' . time() . "_$i");
                    if (!empty($upload['linkOnline'])) {
                        $itemEntity->image = $upload['linkOnline'];
                    }
                } else {
                    if (!empty($existingItemsMap[$i])) {
                        $itemEntity->image = $existingItemsMap[$i]->image;
                    }
                }

                $modelCommerceItems->save($itemEntity);
            }
        }

        // **Nếu View Type là 2**
        if ($commerceEntity->view_type == 2 && !empty($dataSend['commerce_title'])) {
            foreach ($dataSend['commerce_title'] as $index => $title) {
                if (empty($title)) continue;

                $itemEntity = $existingItemsMap[$index] ?? $modelCommerceItems->newEmptyEntity();
                $itemEntity->id_commerce = $commerceId;
                $itemEntity->title = $title;
                $itemEntity->description = $dataSend['commerce_description'][$index] ?? '';

                if (!empty($_FILES['commerce_image']['name'][$index])) {
                    $_FILES["commerce_image_$index"] = [
                        'name' => $_FILES['commerce_image']['name'][$index],
                        'full_path' => $_FILES['commerce_image']['full_path'][$index],
                        'type' => $_FILES['commerce_image']['type'][$index],
                        'tmp_name' => $_FILES['commerce_image']['tmp_name'][$index],
                        'error' => $_FILES['commerce_image']['error'][$index],
                        'size' => $_FILES['commerce_image']['size'][$index],
                    ];

                    $upload = uploadImage('vinhome_', "commerce_image_$index", 'image_' . time() . rand(0, 1000000));

                    if (!empty($upload['linkOnline'])) {
                        $itemEntity->image = $upload['linkOnline'];
                    }
                } else {
                    if (!empty($existingItemsMap[$index])) {
                        $itemEntity->image = $existingItemsMap[$index]->image;
                    }
                }

                $modelCommerceItems->save($itemEntity);
            }
        }
    }
}

function deleteProductProjectAdmin($input){
	global $controller;

	$modelProductProjects = $controller->loadModel('ProductProjects');
	
	if(!empty($_GET['id'])){
		$data = $modelProductProjects->get($_GET['id']);
		
		if($data){
         	$modelProductProjects->delete($data);
         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin');
}

?>