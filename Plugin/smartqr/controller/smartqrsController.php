<?php 
function listQR($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách mã QR';

	$modelSmartqr = $controller->loadModel('Smartqrs');
    $modelHistoryscanqr = $controller->loadModel('Historyscanqrs');
    
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(!empty($_GET['id_member'])){
        $conditions['id_member'] = (int) $_GET['id_member'];
    }
    
    $listData = $modelSmartqr->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id_qr'=>$value->id);
            $static = $modelHistoryscanqr->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelSmartqr->find()->where($conditions)->all()->toList();
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
}

function staticQR($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thống kê quét mã QR';

    $modelSmartqr = $controller->loadModel('Smartqrs');
    $modelHistoryscanqr = $controller->loadModel('Historyscanqrs');
    
    if(!empty($_GET['id'])){
        $infoQR = $modelSmartqr->get((int) $_GET['id']);

        $conditions = array('id_qr'=>$_GET['id']);
        $order = array('id'=>'desc');
        
        $listData = $modelHistoryscanqr->find()->where($conditions)->order($order)->all()->toList();
        
        setVariable('listData', $listData);
        setVariable('infoQR', $infoQR);
    }else{
        return $controller->redirect('/plugins/admin/smartqr-view-admin-smartqr-listQR');
    }
}

function addQR($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin mã QR';

	$modelSmartqr = $controller->loadModel('Smartqrs');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelSmartqr->get( (int) $_GET['id']);
    }else{
        $data = $modelSmartqr->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
	        $data->title = $dataSend['title'];
            $data->code = $dataSend['code'];
            $data->link_web = $dataSend['link_web'];
            $data->link_ios = $dataSend['link_ios'];
            $data->link_android = $dataSend['link_android'];
            $data->type = $dataSend['type'];
            $data->status = $dataSend['status'];
            $data->logo = $dataSend['logo'];
            $data->id_member = $dataSend['id_member'];
            $data->color_foreground = $dataSend['color_foreground'];
            $data->color_background = $dataSend['color_background'];

	        $modelSmartqr->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteQR($input){
	global $controller;

	$modelSmartqr = $controller->loadModel('Smartqrs');
	
	if(!empty($_GET['id'])){
		$data = $modelSmartqr->get($_GET['id']);
		
		if($data){
         	$modelSmartqr->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/smartqr-view-admin-smartqr-listQR');
}

// for member -----------------------------------------------------
function mySmartQR($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách mã QR';

        $modelSmartqr = $controller->loadModel('Smartqrs');
        $modelHistoryscanqr = $controller->loadModel('Historyscanqrs');
        
        $conditions = array('id_member '=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['title'])){
            $conditions['title LIKE'] = '%'.$_GET['title'].'%';
        }
        
        $listData = $modelSmartqr->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $conditions_scan = array('id_qr'=>$value->id);
                $static = $modelHistoryscanqr->find()->where($conditions_scan)->all()->toList();
                $listData[$key]->number_scan = count($static);
            }
        }

        // phân trang
        $totalData = $modelSmartqr->find()->where($conditions)->all()->toList();
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

function staticMyQR($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thống kê quét mã QR';

        $modelSmartqr = $controller->loadModel('Smartqrs');
        $modelHistoryscanqr = $controller->loadModel('Historyscanqrs');
        
        if(!empty($_GET['id'])){
            $infoQR = $modelSmartqr->get((int) $_GET['id']);

            $conditions = array('id_qr'=>$_GET['id']);
            $order = array('id'=>'desc');
            
            $listData = $modelHistoryscanqr->find()->where($conditions)->order($order)->all()->toList();
            
            setVariable('listData', $listData);
            setVariable('infoQR', $infoQR);
        }else{
            return $controller->redirect('/mySmartQR');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function editMyQR($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            $metaTitleMantan = 'Thông tin mã QR';

            $modelSmartqr = $controller->loadModel('Smartqrs');
            $mess= '';

            // lấy data edit
            $data = $modelSmartqr->get( (int) $_GET['id']);

            if($data->id_member == $session->read('infoUser')->id){
                if ($isRequestPost) {
                    $dataSend = $input['request']->getData();

                    if(!empty($dataSend['title'])){
                        // tạo dữ liệu save
                        $data->title = $dataSend['title'];
                        //$data->code = $dataSend['code'];
                        $data->link_web = $dataSend['link_web'];
                        $data->link_ios = $dataSend['link_ios'];
                        $data->link_android = $dataSend['link_android'];
                        $data->type = $dataSend['type'];
                        $data->status = $dataSend['status'];
                        $data->logo = $dataSend['logo'];
                        $data->color_foreground = $dataSend['color_foreground'];
                        $data->color_background = $dataSend['color_background'];

                        $modelSmartqr->save($data);

                        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                    }else{
                        $mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
                    }
                }

                setVariable('data', $data);
                setVariable('mess', $mess);
            }else{
                return $controller->redirect('/mySmartQR');
            }
        }else{
            return $controller->redirect('/mySmartQR');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function deleteMyQR($input){
    global $controller;

    if(!empty($session->read('infoUser'))){
        $modelSmartqr = $controller->loadModel('Smartqrs');
        
        if(!empty($_GET['id'])){
            $data = $modelSmartqr->get($_GET['id']);
            
            if($data && $data->id_member == $session->read('infoUser')->id){
                $modelSmartqr->delete($data);
            }
        }

        return $controller->redirect('/mySmartQR');
    }else{
        return $controller->redirect('/login');
    }
}
?>