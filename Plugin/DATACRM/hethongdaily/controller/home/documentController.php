<?php 
function listAlbum($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Danh sách Album';
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    
	    $conditions = array('id_parent'=>$user->id, 'type'=> 'album');
	     if(!empty($_GET['name'])){
	        $key=createSlugMantan($_GET['name']);

	        $conditions['slug LIKE']= '%'.$key.'%';
	    }


	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    
	    $listData = $modelDocument->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $conditions_scan = array('id_document'=>$value->id);
	            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
	            $listData[$key]->number_document = count($static);
	        }
	    }

	    // phân trang
	    $totalData = $modelDocument->find()->where($conditions)->all()->toList();
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

function addAlbum($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Danh sách Album';
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    $mess= '';
	    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelDocument->get( (int) $_GET['id']);

    }else{
        $data = $modelDocument->newEmptyEntity();
        $data->created_at = time();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
            // tạo dữ liệu save
            $data->title = @$dataSend['title'];
            $data->type = 'album';
            $data->image = @$dataSend['image'];
            $data->id_parent = $user->id;
            $data->status = @$dataSend['status'];
            $data->content = @$dataSend['content'];
            $data->description = @$dataSend['description'];
            $data->slug = createSlugMantan(trim($dataSend['title']));


            $modelDocument->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tiêu đề</p>';
        }
    }
     setVariable('mess', $mess);
     setVariable('data', $data);
	   
	}else{
        return $controller->redirect('/login');
    }
}

function deleteAlbumDocument($input){
    global $controller;
   
	$modelDocument = $controller->loadModel('Documents');
    if(!empty($_GET['id'])){
        $data = $modelDocument->get($_GET['id']);
        
        if($data){
            $modelDocument->delete($data);
        }
    }

    return $controller->redirect('/listAlbumDocument');
}

function listAlbuminfo($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){

	    $metaTitleMantan = 'Danh sách Album';
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    
	    $conditions = array('id_parent'=>$user->id, 'type'=> 'album');
	     if(!empty($_GET['name'])){
	        $key=createSlugMantan($_GET['name']);

	        $conditions['slug LIKE']= '%'.$key.'%';
	    }


	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    
	    $listData = $modelDocument->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    if(!empty($listData)){
	        foreach ($listData as $key => $value) {
	            $conditions_scan = array('id_document'=>$value->id);
	            $static = $modelDocumentinfo->find()->where($conditions_scan)->all()->toList();
	            $listData[$key]->number_document = count($static);
	        }
	    }

	    // phân trang
	    $totalData = $modelDocument->find()->where($conditions)->all()->toList();
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
?>