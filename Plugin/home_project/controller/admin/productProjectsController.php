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

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    $conditions = array('type' => 'category_kind');
    $listKind = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'category_type');
    $listType = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('data', $data);
    setVariable('mess', $mess);
    setVariable('listKind', $listKind);
    setVariable('listType', $listType);
    

}

function processCommerceData($data, $dataSend) {
    $commerce = $dataSend['commerce'] ?? [];
    
    if (!empty($data->commerce) && is_string($data->commerce)) {
        $oldData = json_decode($data->commerce, true);
        
        for ($i = 1; $i <= 3; $i++) {
            if (empty($_FILES['commerce']['name']["image$i"]) && !empty($oldData["image$i"])) {
                $commerce["image$i"] = $oldData["image$i"];
            }
        }
        
        if (isset($commerce['id']) && $commerce['id'] == 2 && isset($oldData['items'])) {
            $commerce['items'] = $oldData['items'];
        }
    }
    
    if ($commerce['id'] == 1) {
        for ($i = 1; $i <= 3; $i++) {
            if (!empty($_FILES['commerce']['name']["image$i"])) {
                $temp_file = [
                    'name' => $_FILES['commerce']['name']["image$i"],
        // Preserve 'items' data if View 2 is selected
                    'type' => $_FILES['commerce']['type']["image$i"],
                    'tmp_name' => $_FILES['commerce']['tmp_name']["image$i"],
                    'error' => $_FILES['commerce']['error']["image$i"],
                    'size' => $_FILES['commerce']['size']["image$i"]
                ];
    // Process images for View 1
                
                $_FILES['temp_image'] = $temp_file;
                
                $upload = uploadImage('vinhome_', 'temp_image', "commerce_view1_$i" . time());
                
                if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                    $commerce["image$i"] = $upload['linkOnline'];
                }
            }
        }
    }
    
    // Xử lý cho View 2 (trường động)
    if ($commerce['id'] == 2) {
        // Khởi tạo mảng items nếu chưa có
        if (!isset($commerce['items']) || !is_array($commerce['items'])) {
            $commerce['items'] = [];
        }
        
        // Lấy và xử lý từng item
        if (isset($commerce['title']) && is_array($commerce['title'])) {
            $titles = $commerce['title'];
            $descriptions = $commerce['description'] ?? [];
            
            // Loại bỏ các khóa không cần lưu
            unset($commerce['title']);
            unset($commerce['description']);
            unset($commerce['image']);
            
            $newItems = [];
            
            foreach ($titles as $index => $title) {
                if (empty($title)) continue; // Bỏ qua nếu không có tiêu đề
                
                $item = [
                    'title' => $title,
                    'description' => $descriptions[$index] ?? ''
                ];
                
                // Xử lý hình ảnh
                if (!empty($_FILES['commerce']['name']['image'][$index])) {
                    $temp_file = [
                        'name' => $_FILES['commerce']['name']['image'][$index],
                        'type' => $_FILES['commerce']['type']['image'][$index],
                        'tmp_name' => $_FILES['commerce']['tmp_name']['image'][$index],
                        'error' => $_FILES['commerce']['error']['image'][$index],
                        'size' => $_FILES['commerce']['size']['image'][$index]
                    ];
                    
                    $_FILES['temp_image'] = $temp_file;
                    
                    $upload = uploadImage('vinhome_', 'temp_image', "commerce_view2_" . time() . "_$index");
                    
                    if (isset($upload['code']) && $upload['code'] === 0 && !empty($upload['linkOnline'])) {
                        $item['image'] = $upload['linkOnline'];
                    }
                } 
                // Giữ lại hình ảnh cũ nếu có
                elseif (isset($commerce['items'][$index]['image'])) {
                    $item['image'] = $commerce['items'][$index]['image'];
                }
                
                $newItems[] = $item;
            }
            
            $commerce['items'] = $newItems;
        }
    }
    
    // Lưu dữ liệu
    $data->commerce = json_encode($commerce);
    
    return $data;
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