<?php 
function listCategoryService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
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

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'category_service', 'id_member'=>$infoUser->id_member);
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'category_service', 'id_member'=>$infoUser->id_member);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'type' => 'category_service', 'id_member'=>$infoUser->id_member);
            $data = $modelCategories->find()->where($conditions)->first();
            if(!empty($data)){
                $modelCategories->delete($data);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listService($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlCurrent;
    global $controller;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelService = $controller->loadModel('Services');

		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
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

    }else{
        return $controller->redirect('/login');
    }
}

function addService($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelService = $controller->loadModel('Services');
        $infoUser = $session->read('infoUser');
        
        $modelTrademarks = $controller->loadModel('Trademarks');
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
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->image = @$dataSend['image'];
                $data->code = @$dataSend['code'];
                $data->id_category =(int) @$dataSend['id_category'];
                $data->description = @$dataSend['description'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $session->read('id_spa');
                $data->price = (int)@$dataSend['price'];
                $data->price_old = (int) @$dataSend['price_old'];
                $data->hot = (int) @$dataSend['hot'];
                $data->code = @$dataSend['code'];
                $data->status = @$dataSend['status'];
                
                $data->slug = createSlugMantan(trim($dataSend['name']));
                
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

       

        setVariable('data', $data);
        setVariable('listCategory', $listCategory);


        }else{
            return $controller->redirect('/login');
        }
}

function deleteService($input){
      global $controller;
    global $session;
    $modelService = $controller->loadModel('Services');
    $infoUser = $session->read('infoUser');
    if(!empty($infoUser)){
    
        if(!empty($_GET['id'])){
            $data = $modelService->get($_GET['id']);
            
            if($data){
                $modelService->delete($data);
            }
        }

        return $controller->redirect('/listService');
    }else{
        return $controller->redirect('/login');
    }
}
 
?>