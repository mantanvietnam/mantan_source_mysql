<?php 
function listCustomer($input)
{
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
	$modelMembers = $controller->loadModel('Members');
	$modelService = $controller->loadModel('Services');
	$modelSpas = $controller->loadModel('Spas');
	$modelProduct = $controller->loadModel('Products');
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		$conditions = array('id_member'=>$infoUser->id_member);
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

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		$conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
		$listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();
	    
	    $listStaff = [];
	    foreach ($listStaffs as $key => $value) {
	    	$listStaff[$value->id] = $value;
	    }

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelCustomer->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
								['name'=>'ID', 'type'=>'text', 'width'=>10],
								['name'=>'Họ tên', 'type'=>'text', 'width'=>25],
								['name'=>'Giới tính', 'type'=>'text', 'width'=>15],
								['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
								['name'=>'Email', 'type'=>'text', 'width'=>35],
								['name'=>'Số CMT', 'type'=>'text', 'width'=>15],
								['name'=>'Địa chỉ', 'type'=>'text', 'width'=>35],
								['name'=>'Ngày sinh', 'type'=>'text', 'width'=>35],
								['name'=>'Nghề nghiệp', 'type'=>'text', 'width'=>35],
								['name'=>'Nhân viên phụ tránh', 'type'=>'text', 'width'=>35],
								['name'=>'Nguồn khách hàng', 'type'=>'text', 'width'=>35],
								['name'=>'Nhóm khách hàng', 'type'=>'text', 'width'=>35],
								['name'=>'Chi nhánh', 'type'=>'text', 'width'=>35],
								['name'=>'Tiền sử bệnh lý dang mắc', 'type'=>'text', 'width'=>35],
								['name'=>'Tiền sử mang thai/ dị ứng thuốc', 'type'=>'text', 'width'=>35],
								['name'=>'Nhu cầu', 'type'=>'text', 'width'=>35],
								['name'=>'Khả năng tư vân hướng dẫn', 'type'=>'text', 'width'=>35],
								['name'=>'Khả năng tư vân hướng tới', 'type'=>'text', 'width'=>35],
								['name'=>'Dịch vụ quan tâm', 'type'=>'text', 'width'=>35],
								['name'=>'Sản phẩm quan tâm', 'type'=>'text', 'width'=>35],
								['name'=>'Nội dung thêm', 'type'=>'text', 'width'=>35],
								['name'=>'Ảnh', 'type'=>'text', 'width'=>35],
								['name'=>'Link facebook', 'type'=>'text', 'width'=>35],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					$sex = 'Nữ';
					if(!empty($value->sex) && $value->sex==1) $sex = 'Nam';
					
					$staff = $modelMembers->find()->where(['id'=>(int)$value->id_staff])->first();
					$nameStaff = '';
					if(!empty($staff)){
						$nameStaff = $staff->name;
					}

					$source = $modelCategories->find()->where(['id'=>(int)$value->source])->first();
					$namesource = '';
					if(!empty($source)){
						$namesource = $source->name;
					}

					$group = $modelCategories->find()->where(['id'=>(int)$value->id_group])->first();
					$namegroup = '';
					if(!empty($group)){
						$namegroup = $group->name;
					}

					$spa = $modelSpas->find()->where(['id'=>(int)$value->id_spa])->first();
					$namespa = '';
					if(!empty($spa)){
						$namespa = $spa->name;
					}

					$service = $modelService->find()->where(['id'=>(int)$value->id_service])->first();
					$nameservice = '';
					if(!empty($service)){
						$nameservice = $service->name;
					}

					$product = $modelProduct->find()->where(['id'=>(int)$value->id_product])->first();
					$nameproduct = '';
					if(!empty($product)){
						$nameproduct = $product->name;
					}

					$dataExcel[] = [
									$value->id, 
									$value->name, 
									$sex,
									$value->phone, 
									$value->email, 
									$value->cmnd,  
									$value->address,  
									$value->birthday,  
									$value->job,  
									$nameStaff,  
									$namesource,
									$namegroup,
									$namespa,
									$value->medical_history,
									$value->drug_allergy_history,
									$value->request_current,
									$value->advisory,
									$value->advise_towards,
									$nameservice,
									$nameproduct,
									$value->note,
									$value->avatar,
									$value->link_facebook,
								];
				}
			}
			
			export_excel($titleExcel, $dataExcel, 'danh-sach-khach-hang'.date('d-m-Y'));
	    }else{
	    	$listData = $modelCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

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
	    setVariable('listStaff', $listStaff);
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
	global $urlHomes;

    $metaTitleMantan = 'Thông tin khách hàng';

	$modelCustomer = $controller->loadModel('Customers');
	$modelService = $controller->loadModel('Services');
	$modelMembers = $controller->loadModel('Members');
	$modelSpa = $controller->loadModel('Spas');
	$modelProducts = $controller->loadModel('Products');
	
	$mess= '';
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelCustomer->get( (int) $_GET['id']);
	    }else{
	        $data = $modelCustomer->newEmptyEntity();
			$data->created_at = date('Y-m-d H:i:s');
			$data->point = 0;
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
	        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
	        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
	        	$checkPhone = $modelCustomer->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->id_member =(int) $infoUser->id_member;
			        $data->id_spa = (int) $dataSend['id_spa'];
			        $data->phone = $dataSend['phone'];
			        $data->email = $dataSend['email'];
			        $data->address = $dataSend['address'];
			        $data->updated_at = date('Y-m-d H:i:s');
			        $data->sex = (int) $dataSend['sex'];
			        $data->avatar = (!empty($dataSend['avatar']))?$dataSend['avatar']:$urlHomes.'/plugins/databot_spa/view/home/assets/img/avatar-default.png';
			        $data->birthday = $dataSend['birthday'];
			        $data->cmnd = $dataSend['cmnd'];
			        $data->link_facebook = $dataSend['link_facebook'];
			        $data->id_staff = (int) $dataSend['id_staff'];
			        $data->source = (int) $dataSend['source'];
			        $data->id_group = (int) $dataSend['id_group'];
			        $data->id_service =(int) $dataSend['id_service'];
			        $data->medical_history = $dataSend['medical_history'];
			        $data->drug_allergy_history = $dataSend['drug_allergy_history'];
			        $data->request_current = $dataSend['request_current'];
			        $data->advisory = $dataSend['advisory'];
			        $data->advise_towards = $dataSend['advise_towards'];
			        $data->note = $dataSend['note'];
			        $data->job = $dataSend['job'];
			        $data->id_product =(int) $dataSend['id_product'];

					if(empty($_GET['id']) || empty($data->referral_code)){
						if(!empty($dataSend['referral_code'])){
							$dataSend['referral_code'] = trim(str_replace(array(' ','.','-'), '', $dataSend['referral_code']));
	        				$dataSend['referral_code'] = str_replace('+84','0',$dataSend['referral_code']);

							$checkAff = $modelCustomer->find()->where(['phone'=>$dataSend['referral_code'], 'id_member'=>$infoUser->id_member])->first();

							if(!empty($checkAff)){
								$data->referral_code = $dataSend['referral_code'];
							}
						}
					}

			        $modelCustomer->save($data);

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	    // danh sách nhân viên
	    $conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
	    $dataMember = $modelMembers->find()->where($conditionsStaff)->all()->toList();
	    
	    // danh sách cơ sở
	    $dataSpa = $modelSpa->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

	    // nhóm khách hàng
	    $category = array('type'=>'category_customer', 'id_member'=>$infoUser->id_member);
	    $dataGroup = $modelCategories->find()->where($category)->order(['name' => 'ASC'])->all()->toList();

	    // danh sách dịch vụ
	    $service = array('id_member'=>$infoUser->id_member, 'id_spa'=>(int) $session->read('id_spa'));
	    $dataService = $modelService->find()->where($service)->order(['name' => 'ASC'])->all()->toList();

	    // danh sách sản phẩm
	    $product = array('id_member'=>$infoUser->id_member, 'id_spa'=>(int) $session->read('id_spa'));
	    $dataProduct = $modelProducts->find()->where($product)->order(['name' => 'ASC'])->all()->toList();

	    // danh sách nguồn khách hàng
	    $source = array('type'=>'category_source_customer', 'id_member'=>$infoUser->id_member);
	    $dataSource = $modelCategories->find()->where($source)->order(['name' => 'ASC'])->all()->toList();
	   	
	   	/*
	    if(empty($dataGroup)){
	    	return $controller->redirect('/listCategoryCustomer/?error=requestCategoryCustomer');
	    }

	    if(empty($dataSource)){
	    	return $controller->redirect('/listSourceCustomer/?error=requestSourceCustomer');
	    }

	    if(empty($dataService)){
	    	return $controller->redirect('/listService/?error=requestService');
	    }

	    if(empty($dataProduct)){
	    	return $controller->redirect('/listProduct/?error=requestProduct');
	    }
	    */

	    setVariable('data', $data);
	    setVariable('dataMember', $dataMember); 
	    setVariable('dataSpa', $dataSpa);
	    setVariable('dataGroup', $dataGroup);
	    setVariable('dataService', $dataService);
	    setVariable('dataProduct', $dataProduct);
	    setVariable('dataSource', $dataSource);
	    setVariable('mess', $mess);
	    setVariable('infoUser', $infoUser);
    }else{
		return $controller->redirect('/login');
	}
}

function deleteCustomer($input){
	global $controller;
	global $session;
	
	$modelCustomer = $controller->loadModel('Customers');
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		if(!empty($_GET['id'])){
			$data = $modelCustomer->get($_GET['id']);
			
			if(!empty($data)){
	         	$modelCustomer->delete($data);
	        }
		}

		return $controller->redirect('/listCustomer');
	}else{
		return $controller->redirect('/login');
	}
}

function listCategoryCustomer($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Nhóm khách hàng';

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestCategoryCustomer':
                    $mess= '<p class="text-danger">Bạn cần tạo nhóm khách hàng trước</p>';
                    break;
            }
        }

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
            $infoCategory->image = '';
            $infoCategory->id_member = $infoUser->id_member;
            $infoCategory->keyword = '';
            $infoCategory->description = '';
            $infoCategory->type = 'category_customer';
            $infoCategory->slug = createSlugMantan($infoCategory->name).'-'.time();

            $modelCategories->save($infoCategory);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }

        $conditions = array('type' => 'category_customer', 'id_member'=>$infoUser->id_member);
        
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function listSourceCustomer($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlHomes;

    $metaTitleMantan = 'Nguồn khách hàng';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestSourceCustomer':
                    $mess= '<p class="text-danger">Bạn cần tạo nguồn khách hàng trước</p>';
                    break;
            }
        }

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
            $infoCategory->image = (!empty($dataSend['image']))?$dataSend['image']:$urlHomes.'/plugins/databot_spa/view/home/assets/img/avatar-default.png';
            $infoCategory->id_member = $infoUser->id_member;
            $infoCategory->keyword = '';
            $infoCategory->description = '';
            $infoCategory->type = 'category_source_customer';
            $infoCategory->slug = createSlugMantan($infoCategory->name).'-'.time();

            $modelCategories->save($infoCategory);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }

        $conditions = array('type' => 'category_source_customer', 'id_member'=>$infoUser->id_member);
        
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryCustomer($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Xóa nhóm khách hàng';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
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