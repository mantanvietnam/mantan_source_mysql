<?php 
function listCustomer($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
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

		if(!empty($_GET['phone'])){
			$conditions['phone'] = $_GET['phone'];
		}

		if(!empty($_GET['email'])){
			$conditions['email'] = $_GET['email'];
		}

		if(!empty($_GET['status'])){
			$conditions['status'] = $_GET['status'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

	    $listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelCustomer->find()->where($conditions)->all()->toList();
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

function addCustomer($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;



    $metaTitleMantan = 'Thông tin khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers = $controller->loadModel('Members');
	$modelSpa = $controller->loadModel('Spas');
	$mess= '';
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){



	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCustomer->get( (int) $_GET['id']);
    }else{
        $data = $modelCustomer->newEmptyEntity();
		$data->created_at = date('Y-m-d H:i:s');
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        debug($dataSend);
        die;	

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        	$conditions = ['phone'=>$dataSend['phone']];
        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->avatar = $dataSend['avatar'];
		        $data->phone = $dataSend['phone'];
		        $data->email = $dataSend['email'];
		        $data->cmnd = $dataSend['cmnd'];
		        $data->avatar = $dataSend['avatar'];
		        $data->birthday = $dataSend['birthday'];
		        $data->id_group = $dataSend['id_group'];
		        $data->code = $dataSend['code'];
		        $data->link_facebook = $dataSend['link_facebook'];
		        $data->source = $dataSend['source'];
		        $data->id_spa = $dataSend['id_spa'];
		        $data->medical_history = $dataSend['medical_history'];
		        $data->request_current = $dataSend['request_current'];
		        $data->advise_towards = $dataSend['advise_towards'];
		        $data->drug_allergy_history = $dataSend['drug_allergy_history'];
		        $data->advisory = $dataSend['advisory'];
		        $data->id_service = $dataSend['email'];
		        $data->address = $dataSend['id_service'];
		        $data->id_staff = $dataSend['id_staff'];
		        $data->sex = (int) $dataSend['sex'];
		        $data->id_member = $infoUser->id_member;
				$data->updated_at = date('Y-m-d H:i:s');
            	$data->id_spa = $infoUser->id_spa;

		        $modelCustomer->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
		    }
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
	    }
    }

    $dataMember = $modelMembers->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();
    $dataSpa = $modelSpa->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

    $category = array('type'=>'category_customer', 'id_member'=>$infoUser->id_member);
    $dataGroup = $modelCategories->find()->where($category)->order(['id' => 'DESC'])->all()->toList();
   
    setVariable('data', $data);
    setVariable('dataMember', $dataMember);
    setVariable('dataSpa', $dataSpa);
    setVariable('dataGroup', $dataGroup);
    setVariable('mess', $mess);
    }else{
		return $controller->redirect('/login');
	}
}

function deleteCustomer($input){
	global $controller;
	global $session;
	$modelCustomer = $controller->loadModel('Customers');
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){
	
		if(!empty($_GET['id'])){
			$data = $modelCustomer->get($_GET['id']);
			
			if($data){
	         	$modelCustomer->delete($data);
	        }
		}

		return $controller->redirect('listCustomer.php');
	}else{
		return $controller->redirect('/login');
	}
}

function listCategoryCustomer($input){
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
            $infoCategory->type = 'category_customer';

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'category_customer', 'id_member'=>$infoUser->id_member);
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'category_customer', 'id_member'=>$infoUser->id_member);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryCustomer($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'type' => 'category_customer', 'id_member'=>$infoUser->id_member);
            $data = $modelCategories->find()->where($conditions)->first();
            if(!empty($data)){
                $modelCategories->delete($data);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}
?>