<?php 
/*di tich lich sử */
function listHistoricalSitesAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến di tích lịch sử';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
    
	$conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

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
    
    $metaTitleMantan = 'Thông tin điểm đến di tích lịch sử';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');

    $modelWard = $controller->loadModel('Wards');
    $conditions = array();
    $listWard = $modelWard->find()->where($conditions)->all()->toList();

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
            $data->image2 = @$dataSend['image2'];
            $data->image3 = @$dataSend['image3'];
            $data->image4 = @$dataSend['image4'];
            $data->image5 = @$dataSend['image5'];
            $data->image6 = @$dataSend['image6'];
            $data->image7 = @$dataSend['image7'];
            $data->image8 = @$dataSend['image8'];
            $data->image9 = @$dataSend['image9'];
            $data->image10 = @$dataSend['image10'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->status = @$dataSend['status'];
            $data->idward = @$dataSend['idward'];
            $data->rating = @$dataSend['rating'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));




	        $modelHistoricalsite->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=1');
            }
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
	    }
    }



    setVariable('data', $data);
    setVariable('listWard', $listWard);
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

	return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=3');
}

/*Xã Phường ward */
function listWardAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách phường';

    $modelWard = $controller->loadModel('Wards');
    
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelWard->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelWard->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelWard->find()->where($conditions)->all()->toList();
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


function addWardAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin phường';

    $modelWard = $controller->loadModel('Wards');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelWard->get( (int) $_GET['id']);

    }else{
        $data = $modelWard->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
           
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            


            $modelWard->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteWardAdmin($input){
    global $controller;

    $modelWard = $controller->loadModel('Wards');
    if(!empty($_GET['id'])){
        $data = $modelWard->get($_GET['id']);
        
        if($data){
            $modelWard->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin.php?status=3');
}

/*hiện vật artifact */
function listArtifactAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách hiện vật';

    $modelArtifact = $controller->loadModel('Artifacts');
    
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelArtifact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelArtifact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelArtifact->find()->where($conditions)->all()->toList();
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


function addArtifactAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin hiện vật';

    $modelArtifact = $controller->loadModel('Artifacts');
    $mess= '';

    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $modelCategoryartifact = $controller->loadModel('Categoryartifacts');

    $conditions = array();
    $listHistoricalsite = $modelHistoricalsite->find()->where($conditions)->all()->toList();
    $listCategoryartifact = $modelCategoryartifact->find()->where($conditions)->all()->toList();

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelArtifact->get( (int) $_GET['id']);

    }else{
        $data = $modelArtifact->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

   // debug($dataSend);
        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->status = @$dataSend['status'];
            $data->material = @$dataSend['material'];
            $data->idHistoricalsite = @$dataSend['idHistoricalsite'];
            $data->idcategory = @$dataSend['idcategory'];
            $data->excavation = @$dataSend['excavation'];
            $data->period = @$dataSend['period'];
            $data->century = @$dataSend['century'];
            $data->location = @$dataSend['location'];
            $data->color = @$dataSend['color'];
             if(!empty($dataSend['registrationdate'])){
                $data->registrationdate = strtotime(str_replace("T", " ", @$dataSend['registrationdate']));
            }else{
                $data->registrationdate = '';
            }
            $data->shape = @$dataSend['shape'];
            $data->technique = @$dataSend['technique'];
            $data->classify = @$dataSend['classify'];
            $data->voter = @$dataSend['voter'];
            $data->source = @$dataSend['source'];
            $data->file = @$dataSend['file'];
            $data->image = @$dataSend['image'];
            $data->image2 = @$dataSend['image2'];
            $data->image3 = @$dataSend['image3'];
            $data->image4 = @$dataSend['image4'];
            $data->image5 = @$dataSend['image5'];
            $data->image6 = @$dataSend['image6'];
            $data->image7 = @$dataSend['image7'];
            $data->image8 = @$dataSend['image8'];
            $data->image9 = @$dataSend['image9'];
            $data->image10 = @$dataSend['image10'];
            $data->image360 = @$dataSend['image360'];
            $data->number = @$dataSend['number'];
            $data->quantity = @$dataSend['quantity'];
            $data->sign = @$dataSend['sign'];
            $data->weight = @$dataSend['weight'];
            $data->size = @$dataSend['size'];
            $data->introductory = @$dataSend['introductory'];
            $data->current = @$dataSend['current'];
            $data->certification = @$dataSend['certification'];
            $data->exposure = @$dataSend['exposure'];
            $data->intensity = @$dataSend['intensity'];
            $data->softness = @$dataSend['softness'];
            $data->counterclockwise = @$dataSend['counterclockwise'];
            $data->clockwiselimit = @$dataSend['clockwiselimit'];
            $data->topdownlimit = @$dataSend['topdownlimit'];
            $data->bottomuplimit = @$dataSend['bottomuplimit'];
            $data->doctitle = @$dataSend['doctitle'];
            $data->docauthor = @$dataSend['docauthor'];
            $data->doctype = @$dataSend['doctype'];
            $data->doclink = @$dataSend['doclink'];
              if(!empty($dataSend['docdate'])){
                $data->docdate = strtotime(str_replace("T", " ", @$dataSend['docdate']));
            }else{
                $data->docdate = '';
            }
            $data->docifile = @$dataSend['docifile'];
            $data->docdescribe = @$dataSend['docdescribe'];
            $data->address = @$dataSend['address'];
            
            $data->videotitle = @$dataSend['videotitle'];
            $data->videoauthor = @$dataSend['videoauthor'];
            $data->videotype = @$dataSend['videotype'];
            $data->videolink = @$dataSend['videolink'];
            $data->videofile = @$dataSend['videofile'];
            $data->videodescribe = @$dataSend['videodescribe'];

            $data->presenttitle = @$dataSend['presenttitle'];
            $data->presentauthor = @$dataSend['presentauthor'];
            $data->presenttype = @$dataSend['presenttype'];
            $data->presentlink = @$dataSend['presentlink'];
            $data->presentfile = @$dataSend['presentfile'];
            $data->presentdescribe = @$dataSend['presentdescribe'];
            $data->environmentimage = @$dataSend['environmentimage'];
            $data->backgroundcolor = @$dataSend['backgroundcolor'];
            $data->fileusdz = @$dataSend['fileusdz'];
            $data->filegle = @$dataSend['filegle'];

            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            //  debug($data);
              //die;

            $modelArtifact->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
        }
    }



    setVariable('data', $data);
    setVariable('listHistoricalsite', $listHistoricalsite);
    setVariable('listCategoryartifact', $listCategoryartifact);
    setVariable('mess', $mess);
}

function deleteArtifactAdmin($input){
    global $controller;

    $modelArtifact = $controller->loadModel('Artifacts');
    if(!empty($_GET['id'])){
        $data = $modelArtifact->get($_GET['id']);
        
        if($data){
            $modelArtifact->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin.php?status=3');
}


/*Danh muc categoryartifact */
function listCategoryartifactAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách danh mục hiện vật';

    $modelCategoryartifact = $controller->loadModel('Categoryartifacts');
    
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelCategoryartifact->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelCategoryartifact->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelCategoryartifact->find()->where($conditions)->all()->toList();
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


function addCategoryartifactAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin danh mục hiện vật';

    $modelCategoryartifact = $controller->loadModel('Categoryartifacts');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelCategoryartifact->get( (int) $_GET['id']);

    }else{
        $data = $modelCategoryartifact->newEmptyEntity();
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
           
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            


            $modelCategoryartifact->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteCategoryartifactAdmin($input){
    global $controller;

    $modelCategoryartifact = $controller->loadModel('Categoryartifacts');
    if(!empty($_GET['id'])){
        $data = $modelCategoryartifact->get($_GET['id']);
        
        if($data){
            $modelCategoryartifact->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin.php?status=3');
}
 ?>