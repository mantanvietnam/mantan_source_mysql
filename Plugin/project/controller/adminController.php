<?php 
function listProjectAdmin($input)
{
	
	global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Project';

	$modelProjects = $controller->loadModel('Projects');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}
    
    $listData = $modelProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelProjects->find()->where($conditions)->all()->toList();
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

function addProjectAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Projects';

	$modelProjects = $controller->loadModel('Projects');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelProjects->get( (int) $_GET['id']);
    }else{
        $data = $modelProjects->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
	        // tạo dữ liệu save
            $data->title = $dataSend['title'];
            $data->image = $dataSend['image'];
            $data->slug_drive = $dataSend['slug_drive'];
            $data->slug = createSlugMantan($dataSend['title']);
            $data->status = $dataSend['status'];
            $data->description= $dataSend['description'];
            $data->name_project= $dataSend['name_project'];
            $data->duration= $dataSend['duration'];
            $data->lead_agency= $dataSend['lead_agency'];
            $data->implementing_agency= $dataSend['implementing_agency'];
            $data->donor= $dataSend['donor'];
            $data->investment= $dataSend['investment'];
            $data->id_photo= $dataSend['id_photo'];
            $data->id_video= $dataSend['id_video'];
            $data->id_post= $dataSend['id_post'];
            $data->id_post2= $dataSend['id_post2'];
            $data->banner= $dataSend['banner'];
            $modelProjects->save($data);     

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteProjectAdmin($input){
	global $controller;

	$modelProjects = $controller->loadModel('Projects');
	
	if(!empty($_GET['id'])){
		$data = $modelProjects->get($_GET['id']);
		
		if($data){
         	$modelProjects->delete($data);
         	deleteSlugURL($data->slug);
        }
	}

	return $controller->redirect('/plugins/admin/project-view-admin-project-listProjectAdmin');
}

function listLibraryAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Library';

    $modelLibrary = $controller->loadModel('Librarys');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelLibrary->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelLibrary->find()->where($conditions)->all()->toList();
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

function addLibraryAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Library';

    $modelLibrary = $controller->loadModel('Librarys');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelLibrary->get( (int) $_GET['id']);
        $data->created_at = date('Y-m-d H:i:s');
    }else{
        $data = $modelLibrary->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->content = $dataSend['content'];
            $data->description = $dataSend['description'];
            $data->link= $dataSend['link'];
            $data->status= $dataSend['status'];
            $data->slug= createSlugMantan($dataSend['name']);
            $modelLibrary->save($data);     

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteLibraryAdmin($input){
    global $controller;

    $modelLibrary = $controller->loadModel('Librarys');
    
    if(!empty($_GET['id'])){
        $data = $modelLibrary->get($_GET['id']);
        
        if($data){
            $modelLibrary->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/project-view-admin-library-listLibraryAdmin');
}

function listMediapreAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Mediapres';

    $modelMediapres = $controller->loadModel('Mediapres');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelMediapres->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelMediapres->find()->where($conditions)->all()->toList();
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

function addMediapreAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Mediapres';

    $modelMediapres = $controller->loadModel('Mediapres');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelMediapres->get( (int) $_GET['id']);
        $data->created_at = date('Y-m-d H:i:s');
    }else{
        $data = $modelMediapres->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        

        if(!empty($dataSend['name'])){

            $today= getdate();
            $datePost = explode('/', $dataSend['time_create']);
                
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->link = $dataSend['link'];
            $data->description = $dataSend['description'];
            $data->link= $dataSend['link'];
            $data->time_create= $time;
            $data->status= $dataSend['status'];
            $data->slug= createSlugMantan($dataSend['name']);
            $modelMediapres->save($data);     

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteMediapreAdmin($input){
    global $controller;

    $modelMediapre= $controller->loadModel('Mediapres');
    
    if(!empty($_GET['id'])){
        $data = $modelMediapre->get($_GET['id']);
        
        if($data){
            $modelMediapre->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/project-view-admin-mediapre-listMediapreAdmin');
}

function settingMediaAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingMediaAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }


    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'content' => $dataSend['content'],
                        'title' => $dataSend['title'],
                        'description' => $dataSend['description'],
                        'video' => $dataSend['video'],
                        'id_album' => $dataSend['id_album'],
                );

        $data->key_word = 'settingMediaAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function settingAboutusAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingAboutusAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'content' => $dataSend['content'],
                        'title' => $dataSend['title'],
                        'video' => $dataSend['video'],
                        'id_album' => $dataSend['id_album'],
                );

        $data->key_word = 'settingAboutusAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function listOpportunitiesAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Opportunities';

    $modelOpportunities = $controller->loadModel('Opportunities');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelOpportunities->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelOpportunities->find()->where($conditions)->all()->toList();
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

function addOpportunitiesAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Opportunities';

    $modelOpportunities = $controller->loadModel('Opportunities');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelOpportunities->get( (int) $_GET['id']);
        $data->created_at = date('Y-m-d H:i:s');
    }else{
        $data = $modelOpportunities->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        

        if(!empty($dataSend['name'])){

            $today= getdate();
            $datePost = explode('/', $dataSend['time_create']);
                
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->link = $dataSend['link'];
            $data->description = $dataSend['description'];
            $data->time_create= (int)$time;
            $data->status=(int) $dataSend['status'];
            $data->slug= createSlugMantan($dataSend['name']);
           
            $modelOpportunities->save($data);     

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteOpportunitiesAdmin($input){
    global $controller;

    $modelOpportunities= $controller->loadModel('Opportunities');
    
    if(!empty($_GET['id'])){
        $data = $modelOpportunities->get($_GET['id']);
        
        if($data){
            $modelOpportunities->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/project-view-admin-Opportunities-listOpportunitiesAdmin');
}

function sttingWarmteamAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện Warm team';
    $mess= '';

    $conditions = array('key_word' => 'sttingWarmteamAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'content' => $dataSend['content'],
                        'title' => $dataSend['title'],
                );

        $data->key_word = 'sttingWarmteamAdmin';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function listEventAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Event';

    $modelEvent = $controller->loadModel('Events');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['moth'])){
        $conditions['moth'] = $_GET['moth'];
        
    }
    
    $listData = $modelEvent->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelEvent->find()->where($conditions)->all()->toList();
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

function addEventAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin Event';

    $modelEvent = $controller->loadModel('Events');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelEvent->get( (int) $_GET['id']);
    }else{
        $data = $modelEvent->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){

            $today= getdate();
            $datePost = explode('/', $dataSend['time_create']);
                
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }
            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->moth = (int)$dataSend['moth'];
            $data->time_create = (int)@$time;
            $data->content =@$dataSend['content'];
            $data->year =(int) @$dataSend['year'];
            $modelEvent->save($data);     

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteEventAdmin($input){
    global $controller;

    $modelEvent = $controller->loadModel('Events');
    
    if(!empty($_GET['id'])){
        $data = $modelEvent->get($_GET['id']);
        
        if($data){
            $modelEvent->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/project-view-admin-event-listEventAdmin');
}
?>