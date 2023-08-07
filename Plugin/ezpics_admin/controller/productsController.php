<?php 
function listProductAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
	//if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
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

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
    	}
    }

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
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function listProductTrendAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
	//if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($_GET['category_id'])){
		$conditions['category_id'] = $_GET['category_id'];
	}

	if(!empty($_GET['type'])){
		$conditions['type'] = $_GET['type'];
	}

	
		$conditions['status'] = 2;
		

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

	$conditions['trend'] = 1;

    $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
    	}
    }

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

	$mess = '';
	 if(@$_GET['mess']==0){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Bỏ mẫu thiết kế thành công</p>';

    }elseif(@$_GET['mess']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mẫu thiết kế thành công</p>';

    }elseif(@$_GET['mess']==2){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sản phẩm này chưa được duyệt</p>';
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
    setVariable('mess', $mess);
}

function lockProductAdmin($input)
{
	global $controller;

	$modelProducts = $controller->loadModel('Products');
	$modelmember = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelProducts->get($_GET['id']);
		if($data){
			$member = $modelmember->get($data->user_id);	

			$data->status = (int) $_GET['status'];
			if($_GET['status']==2){
				$data->approval_date = date('Y-m-d H:i:s');
			}else{
				$data->approval_date = null;
			}

         	$modelProducts->save($data);

         	@$conditions = array();

         	$conditions['user_id'] = (int) $data->user_id;
         	$conditions['status'] = 2;

         	$totalData = $modelProducts->find()->where($conditions)->all()->toList();
    		$totalData = count($totalData);

         	if($_GET['status']==2){
    			if($totalData == 10){
    				$member->level = 1;
    			}elseif($totalData == 30){
    				$member->level = 2;
    			}elseif($totalData == 50){
    				$member->level = 3;
    			}elseif($totalData == 100){
    				$member->level = 4;
    			}elseif($totalData == 300){
    				$member->level = 5;
    			}elseif($totalData == 500){
    				$member->level = 6;
    			}elseif($totalData == 1000){
    				$member->level = 7;
    			}elseif($totalData == 3000){
    				$member->level = 8;
    			}elseif($totalData == 5000){
    				$member->level = 9;
    			}elseif($totalData == 10000){
    				$member->level = 10;
    			}

                $dataSendNotification= array('ìd'=>$data->id, 'title'=>'Sản phẩm mới đã được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Chúng tôi vui mừng thông báo rằng mẫu thiết kế "'.$data->name.'" của bạn đã được duyệt và có thể đăng bán. Cảm ơn bạn vì đã gửi mẫu thiết kế cho chúng tôi !','action'=>'productNew');
                if(!empty($member->token_device)){
                	sendNotification($dataSendNotification, $member->token_device);
                }
                sendEmailsuccessfulProduct($member->email, $member->name,$data->name );
            }else{
            	if($totalData = 9){
    				$member->level = 0;
    			}elseif($totalData == 29){
    				$member->level = 1;
    			}elseif($totalData == 49){
    				$member->level = 2;
    			}elseif($totalData == 99){
    				$member->level = 3;
    			}elseif($totalData == 299){
    				$member->level = 4;
    			}elseif($totalData == 499){
    				$member->level = 5;
    			}elseif($totalData == 999){
    				$member->level = 6;
    			}elseif($totalData == 2999){
    				$member->level = 7;
    			}elseif($totalData == 4999){
    				$member->level = 8;
    			}elseif($totalData == 9999){
    				$member->level = 9;
    			}

    			if(!empty($_GET['note'])){
                	$dataSendNotification= array('title'=>'Mẫu thiết kế không được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Lí do từ chối của mẫu "'.$data->name.'" là: '.$_GET['note'] ,'action'=>'adminSendNotification');
            	}else{
            		$dataSendNotification= array('title'=>'Mẫu thiết kế không được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Rất tiếc vì mẫu thiết kế của bạn chưa được duyệt. Bạn vui lòng kiểm tra lại mẫu thiết kế "'.$data->name.'"','action'=>'adminSendNotification');
            	}
            	if(!empty($member->token_device)){
                	sendNotification($dataSendNotification, $member->token_device);
            	}
                sendEmailunsuccessfulProduct($member->email, $member->name, $data->name, $_GET['note']);
            }
            
            $modelmember->save($member);
            
        }
	}

	if(!empty($_GET['page'])){
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php?page='.$_GET['page']);
	}else{
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
	}

	
}

function deleteProductAdmin($input){
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	
	if(!empty($_GET['id'])){
		$data = $modelProduct->get($_GET['id']);
		
		if($data){
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

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
}

function addTrendProductAdmin($input)
{
	global $controller;

	$modelProducts = $controller->loadModel('Products');
	$modelmember = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelProducts->find()->where(array('id'=>$_GET['id'],'status'=>2))->first();
		if($data){
			if(isset($_GET['status'])){
				$data->trend =$_GET['status'];
         		$modelProducts->save($data);

         		if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess='.$_GET['status'].'&page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess='.$_GET['status'].'&');
				}
        	}
        }else{
        	if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess=2page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess=2');
				}
        }
	}	
}
?>