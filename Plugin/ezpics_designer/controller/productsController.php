<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách mẫu thiết kế';

		$modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$user = $session->read('infoUser');

		$conditions = array('user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		//if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
		//if(!isset($_GET['status'])) $_GET['status'] = 1;

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['category_id'])){
			$conditions['category_id'] = $_GET['category_id'];
		}

		if(!empty($_GET['type'])){
			$conditions['type'] = $_GET['type'];
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = $_GET['status'];
			}
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

		if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
		}

	    $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelProducts->find()->where($conditions)->all()->toList();
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

	    $conditions = array('type'=>'product_categories');
		$order = array('name'=>'asc');
		$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

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

function deleteProduct($input){
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		$modelProduct = $controller->loadModel('Products');
		$modelMember = $controller->loadModel('Members');
		$modelProductDetail = $controller->loadModel('ProductDetails');
		$modelProductFavorite = $controller->loadModel('ProductFavorite');
		
		if(!empty($_GET['id'])){
			$data = $modelProduct->get($_GET['id']);
			$user = $session->read('infoUser');
			
			if($data && $data->user_id == $user->id){
	         	// xóa mẫu thiết kế
				$modelProduct->delete($data);

				// xóa layer
				$conditions = ['products_id'=>$data->id];
				$modelProductDetail->deleteAll($conditions);

				// xóa yêu thích
				$conditions = ['product_id'=>$data->id];
				$modelProductFavorite->deleteAll($conditions);
	        }
		}

		return $controller->redirect('/listProduct');
	}else{
		return $controller->redirect('/login');
	}
}

function addProduct($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thông tin mẫu thiết kế';

		$modelProduct = $controller->loadModel('Products');
		$modelMember = $controller->loadModel('Members');
		$modelProductDetail = $controller->loadModel('ProductDetails');
		$mess= '';

		// lấy data edit
	    $data = $modelProduct->newEmptyEntity();

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['background'])){
		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->price = (int) $dataSend['price'];
		        $data->sale_price = (int) $dataSend['sale_price'];
		        $data->content = $dataSend['content'];
		        $data->sale = null;
		        $data->related_packages = null;
		        $data->status = (int) $dataSend['status'];
		        $data->type = 'user_create';
		        $data->sold = 0;
		        $data->image = $dataSend['background'];
		        $data->thumn = $dataSend['background'];
		        $data->user_id = $session->read('infoUser')->id;
		        $data->product_id = 0;
		        $data->note_admin = '';
		        $data->created_at = date('Y-m-d H:i:s');
		        $data->views = 0;
		        $data->favorites = 0;
		        $data->category_id = $dataSend['category_id'];
		        $data->thumbnail = $dataSend['thumbnail'];

		        // tạo slug
	            $slug = createSlugMantan($dataSend['name']);
	            $slugNew = $slug;
	            $number = 0;

	            if(empty($data->slug) || $data->slug!=$slugNew){
	                do{
	                	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
	                }while (!empty($listData));
	            }

	            $data->slug = $slugNew;

		        $modelProduct->save($data);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên mẫu thiết kế hoặc ảnh nền</p>';
		    }
	    }

	    $conditions = array('type' => 'product_categories');
	    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listCategory', $listCategory);
	}else{
		return $controller->redirect('/login');
	}
}
?>