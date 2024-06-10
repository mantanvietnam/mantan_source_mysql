<?php 
function listDocument($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){


	    
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    
	    $conditions = array('id_parent'=>$user->id);

		$url= explode('?', $urlCurrent);	    
	    if($url[0]=='/listAlbum'){
	    	$conditions['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/listVideo'){
	    	$conditions['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$conditions['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Danh sách '.$title;


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
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);
	    
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}

function addDocument($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){

    	$url= explode('?', $urlCurrent);
    	if($url[0]=='/addAlbum'){
	    	$type= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    }elseif($url[0] == '/addVideo'){
	    	$type= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    }else{
	    	$type= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    }

	    $metaTitleMantan = 'Thông tin '.$title;
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
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
	            $data->type = $type;
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

	    setVariable('title', $title);
		setVariable('slug', $slug);
	   
	}else{
        return $controller->redirect('/login');
    }
}

function deleteDocument($input){
    global $controller;
   
	$modelDocument = $controller->loadModel('Documents');

	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    if(!empty($_GET['id'])){
        $data = $modelDocument->get($_GET['id']);
        
        if($data){
        	$modelDocumentinfo->deleteAll((['id_document'=>$data->id]));

            $modelDocument->delete($data);


        }
    }
    if($_GET['type']=='album'){
    	return $controller->redirect('/listAlbum');
    }elseif($_GET['type']=='video'){
    	return $controller->redirect('/listVideo');
    }else{
    	return $controller->redirect('/listDocument');
    }
    
}

function listDocumentinfo($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){

    	$url= explode('?', $urlCurrent);	    
	    if($url[0]=='/listAlbuminfo'){
	    	$conditions['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/listVideoinfo'){
	    	$conditions['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$conditions['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Danh sách '.$title;

	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    
	    $conditions = array();

	    if(!empty($_GET['id_document'])){
	    	$conditions['id_document']= $_GET['id_document'];
	    	$data = $modelDocument->find()->where(['id'=>$_GET['id_document'], 'type'=>$type ])->first();

	    	if(empty($data)){
	    		return $controller->redirect('/listAlbum');
	    	}
	    }else{
	    	return $controller->redirect('/listAlbum');
	    }
	     if(!empty($_GET['title'])){
	        $key=createSlugMantan($_GET['title']);

	        $conditions['slug LIKE']= '%'.$key.'%';
	    }


	    $limit = 20;
	    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    
	    $listData = $modelDocumentinfo->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    // phân trang
	    $totalData = $modelDocumentinfo->find()->where($conditions)->all()->toList();
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
	    setVariable('data', $data);
	    setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);
	    
	    setVariable('listData', $listData);
	}else{
        return $controller->redirect('/login');
    }
}

function addDocumentinfo($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){

	    $url= explode('?', $urlCurrent);	    
	    if($url[0]=='/addAlbuminfo'){
	    	$conditions['type']= 'album';
	    	$title = 'Hình ảnh';
	    	$slug = 'Album';
	    	$type ='album';
	    }elseif($url[0]=='/addVideoinfo'){
	    	$conditions['type']= 'video';
	    	$title = 'Video';
	    	$slug = 'Video';
	    	$type ='video';
	    }else{
	    	$conditions['type']= 'document';
	    	$title = 'Tài liệu';
	    	$slug = 'Document';
	    	$type ='document';
	    }

	    $metaTitleMantan = 'Thông tin '.$title;
	    $user = $session->read('infoUser');

	    $modelDocument = $controller->loadModel('Documents');
	    $modelDocumentinfo = $controller->loadModel('Documentinfos');
	    $mess= '';

	     if(!empty($_GET['id_document'])){
	    	$conditions['id_document']= $_GET['id_document'];
	    	$info = $modelDocument->find()->where(['id'=>$_GET['id_document'], 'type'=>$type])->first();

	    	if(empty($info)){
	    		return $controller->redirect('/listAlbum');
	    	}
	    }else{
	    	return $controller->redirect('/listAlbum');
	    }
	    // lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelDocumentinfo->get( (int) $_GET['id']);

	    }else{
	        $data = $modelDocumentinfo->newEmptyEntity();
	        $data->created_at = time();
	    }


	    if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['title'])){
	            // tạo dữ liệu save
	            $data->title = @$dataSend['title'];
	            $data->file = @$dataSend['file'];
	            $data->id_document = $info->id;
	            $data->description = @$dataSend['description'];
	            $data->slug = createSlugMantan(trim($dataSend['title']));


	            $modelDocumentinfo->save($data);

	            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

	             
	            
	        }else{
	            $mess= '<p class="text-danger">Bạn chưa nhập tiêu đề</p>';
	        }
	    }
	    setVariable('mess', $mess);
     	setVariable('data', $data);
     	setVariable('info', $info);
     	setVariable('title', $title);
	    setVariable('slug', $slug);
	    setVariable('type', $type);

	   
	}else{
        return $controller->redirect('/login');
    }
}

function deleteDocumentinfo($input){
    global $controller;
   
	$modelDocument = $controller->loadModel('Documents');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');

	if(!empty($_GET['id_document'])){
	    $info = $modelDocument->find()->where(['id'=>$_GET['id_document']])->first();

	    if(empty($info)){
	    	return $controller->redirect('/listAlbum');
	    }
	}else{
	   	return $controller->redirect('/listAlbum');
	}
    if(!empty($_GET['id'])){
        $data = $modelDocumentinfo->get($_GET['id']);
        
        if($data){
            $modelDocumentinfo->delete($data);
        }
    }
    if($info->type=='album'){
    	return $controller->redirect('/listAlbuminfo?id_document='.$info->id);
    }elseif($info->type=='video'){
    	return $controller->redirect('/listVideoinfo?id_document='.$info->id);
    }else{    	
    	return $controller->redirect('/listDocumentinfo?id_document='.$info->id);
    }
}


?>