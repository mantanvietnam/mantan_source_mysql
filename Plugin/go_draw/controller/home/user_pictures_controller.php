<?php
function myGallery($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoMember'))){
	    $metaTitleMantan = 'Hình ảnh của bạn';

		$modelUserPictures = $controller->loadModel('UserPictures');
		
		$user = $session->read('infoMember');

		$conditions = array('user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		$listData = $modelUserPictures->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

		$totalData = $modelUserPictures->find()->where($conditions)->all()->toList();

	    
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
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/');
	}
}

function addImage($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoMember'))){
	    $metaTitleMantan = 'Đăng ảnh';

		$modelUserPictures = $controller->loadModel('UserPictures');
		$modelUserOrders = $controller->loadModel('UserOrders');
		
		$user = $session->read('infoMember');
		$mess= '';

		if($isRequestPost){
			$dataSend = $input['request']->getData();

		    if(!empty($_FILES['image']['name']) && empty($_FILES['image']["error"]) && !empty($dataSend['name']) && !empty($dataSend['order_id'])){

		    	$checkOrder = $modelUserOrders->find()->where(['id'=>(int) $dataSend['order_id'], 'user_id'=>$user->id])->first();
		    	$checkPic = $modelUserPictures->find()->where(['order_id'=>(int) $dataSend['order_id'], 'user_id'=>$user->id])->first();

		    	if(!empty($checkOrder)){
		    		if(empty($checkPic)){
				    	$image = uploadImage($user->id, 'image', 'pic_'.$dataSend['order_id']);

				    	if(!empty($image['linkOnline'])){
				    		$data = $modelUserPictures->newEmptyEntity();

				    		$data->order_id = $dataSend['order_id'];
				    		$data->name = $dataSend['name'];
				    		$data->description = $dataSend['description'];
				    		$data->image = $image['linkOnline'].'?time='.time();
				    		$data->vote = 0;
				    		$data->user_id = $user->id;
				    		$data->created_at = date('Y-m-d H:i:s');
				    		$data->updated_at = date('Y-m-d H:i:s');

				    		$modelUserPictures->save($data);

				    		$mess= '<p class="text-success">Đăng ảnh thành công</p>';
				    	}else{
				    		$mess= '<p class="text-danger">Up ảnh lỗi, vui lòng chọn ảnh dung lượng dưới 5Mb</p>';
				    	}
				    }else{
			    		$mess= '<p class="text-danger">Bạn đã đăng ảnh cho đơn hàng này</p>';
			    	}
				}else{
		    		$mess= '<p class="text-danger">Sai mã đơn hàng</p>';
		    	}
		    }else{
		    	$mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
		    }
		}

		setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}

function topImage($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	
    $metaTitleMantan = 'TOP ảnh yêu thích';

	$modelUserPictures = $controller->loadModel('UserPictures');
	$modelUsers = $controller->loadModel('Users');
	
	$user = $session->read('infoMember');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	$listData = $modelUserPictures->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	if(!empty($listData)){
		foreach ($listData as $key => $value) {
			$user = $modelUsers->find()->where(array('id'=>$value->user_id))->first();

			$listData[$key]->nickname = $user->nickname;
		}
	}

	$totalData = $modelUserPictures->find()->where($conditions)->all()->toList();

    
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
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
}

function detailImage($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;
	global $modelCategories;
	global $session;

	$modelUserPictures = $controller->loadModel('UserPictures');
	$modelUserLikes = $controller->loadModel('UserLikes');

	if(!empty($_GET['id'])){
		$infoImage = $modelUserPictures->find()->where(['id'=>(int) $_GET['id']])->first();

		if(!empty($infoImage)){
			$metaTitleMantan = $infoImage->name;
			$metaDescriptionMantan = $infoImage->description;
			$metaImageMantan = $infoImage->image;

			$user = $session->read('infoMember');

			$checkLike = $modelUserLikes->find()->where(['picture_id'=>(int) $_GET['id'], 'user_id'=>(int) @$user->id])->first();
			
			setVariable('infoImage', $infoImage);
			setVariable('checkLike', $checkLike);
		}else{
			return $controller->redirect('/topImage');
		}
	}else{
		return $controller->redirect('/topImage');
	}
}

function deleteImage($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoMember'))){
		$modelUserPictures = $controller->loadModel('UserPictures');

		$data = $modelUserPictures->find()->where(['id'=>(int) $_GET['id'], 'user_id'=>$session->read('infoMember')->id])->first();

		if(!empty($data)){
			$modelUserPictures->delete($data);
		}

		return $controller->redirect('/myGallery');
	}else{
		return $controller->redirect('/');
	}
}

function addLike($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $isRequestPost;

	if(!empty($session->read('infoMember'))){
		$modelUserPictures = $controller->loadModel('UserPictures');
		$modelUserLikes = $controller->loadModel('UserLikes');

		$user = $session->read('infoMember');

		$data = $modelUserLikes->find()->where(['picture_id'=>(int) $_GET['id'], 'user_id'=>$user->id])->first();
		$picture = $modelUserPictures->find()->where(['id'=>(int) $_GET['id']])->first();

		if(empty($data)){
			$data = $modelUserLikes->newEmptyEntity();

    		$data->picture_id = (int) $_GET['id'];
    		$data->user_id = $user->id;

    		$modelUserLikes->save($data);

    		$picture->vote ++;
    		$modelUserPictures->save($picture);
		}

		return $controller->redirect('/detailImage/?id='.$_GET['id']);
	}else{
		return $controller->redirect('/');
	}
}