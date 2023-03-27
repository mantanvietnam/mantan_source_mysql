<?php 
/*di tich lich sử */
/*function listHistoricalSitesAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến di tích và danh lam';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
    
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelHistoricalsite->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelHistoricalsite->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelHistoricalsite->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function addHistoricalSitesAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin điểm đến di tích và danh lam';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelHistoricalsite->get( (int) $_GET['id']);

    }else{
        $data = $modelHistoricalsite->newEmptyEntity();
         $data->created = getdate()[0];
    }


	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            


	        $modelHistoricalsite->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-historicalSites-listHistoricalSitesAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-historicalSites-listHistoricalSitesAdmin.php?status=1');
            }
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
	    }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteHistoricalSitesAdmin($input){
	global $controller;

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
	if(!empty($_GET['id'])){
		$data = $modelHistoricalsite->get($_GET['id']);
		
		if($data){
         	$modelHistoricalsite->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/tayho360-admin-historicalSites-listHistoricalSitesAdmin.php?status=3');
}*/

// Cơ quan hành chính GovernanceAgencys

function listGovernanceAgencysAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cơ quan hành chính';

    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
    
    $conditions = array();

    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelGovernanceAgencys->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelGovernanceAgencys->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelGovernanceAgencys->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function addGovernanceAgencysAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Cơ quan hành chính';

    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelGovernanceAgencys->get( (int) $_GET['id']);

    }else{
        $data = $modelGovernanceAgencys->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));


            $modelGovernanceAgencys->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteGovernanceAgencysAdmin($input){
    global $controller;
    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
    if(!empty($_GET['id'])){
        $data = $modelGovernanceAgencys->get($_GET['id']);
        
        if($data){
            $modelGovernanceAgencys->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php?status=3');
}

// Lễ Hội Festival

function listFestivalAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cơ quan hành chính';

    $modelFestival = $controller->loadModel('Festivals');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelFestival->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelFestival->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelFestival->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function addFestivalAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Cơ quan hành chính';


    $modelFestival = $controller->loadModel('Festivals');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelFestival->get( (int) $_GET['id']);

    }else{
        $data = $modelFestival->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelFestival->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteFestivalAdmin($input){
    global $controller;
    $modelFestival = $controller->loadModel('Festivals');
    if(!empty($_GET['id'])){
        $data = $modelFestival->get($_GET['id']);
        
        if($data){
            $modelFestival->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php?status=3');
}


// Dịch vụ hỗ trợ du lịch Tour

function listTourAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cơ quan hành chính';

    $modelTour = $controller->loadModel('Tours');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelTour->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelTour->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelTour->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function addTourAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Cơ quan hành chính';


    $modelTour = $controller->loadModel('Tours');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelTour->get( (int) $_GET['id']);

    }else{
        $data = $modelTour->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelTour->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listTourAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listTourAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteTourAdmin($input){
    global $controller;
    $modelTour = $controller->loadModel('Tours');
    if(!empty($_GET['id'])){
        $data = $modelTour->get($_GET['id']);
        
        if($data){
            $modelTour->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-tour-listTourAdmin.php?status=3');
}

// Điểm đến làng nghề craftvillage 

function listCraftvillageAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Điểm đến làng nghề';

    $modelCraftvillage = $controller->loadModel('Craftvillages');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelCraftvillage->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelCraftvillage->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelCraftvillage->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function addCraftvillageAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Cơ quan hành chính';


    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCraftvillage->get( (int) $_GET['id']);

    }else{
        $data = $modelCraftvillage->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelCraftvillage->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteCraftvillageAdmin($input){
    global $controller;
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    if(!empty($_GET['id'])){
        $data = $modelCraftvillage->get($_GET['id']);
        
        if($data){
            $modelCraftvillage->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php?status=3');
}
 ?>