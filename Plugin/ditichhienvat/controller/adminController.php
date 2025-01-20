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

    $typeHistoricalSites = $modelCategories->find()->where(['type' => 'typeHistoricalSites'])->all()->toList();
    
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
    setVariable('typeHistoricalSites', $typeHistoricalSites);
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
    $typeHistoricalSites = $modelCategories->find()->where(['type' => 'typeHistoricalSites'])->all()->toList();

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
        $dataSend['id_ward'] = (int) $dataSend['idward'];

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
            $data->idward = @$dataSend['id_ward'];
            $data->idTypeHistoricalSites = @$dataSend['idTypeHistoricalSites'];
            $data->rating = @$dataSend['rating'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));




	        $modelHistoricalsite->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin?status=1');
            }
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
	    }
    }



    setVariable('data', $data);
    setVariable('listWard', $listWard);
    setVariable('mess', $mess);
    setVariable('typeHistoricalSites', $typeHistoricalSites);
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

	return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin?status=3');
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
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin?status=1');
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

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-ward-listWardAdmin?status=3');
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
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $conditions = array();
    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    if(!empty($_GET['sign'])){

        $conditions['sign LIKE']= '%'.$_GET['sign'].'%';
    }

    if(!empty($_GET['idHistoricalsite'])){

        $conditions['idHistoricalsite']= (int)$_GET['idHistoricalsite'];
    }

    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['excel']) && $_GET['excel']=='Xuất excel'){
            $listData = $modelArtifact->find()->where($conditions)->order(['id' => 'desc'])->all()->toList();
            $titleExcel =   [
                ['name'=>'STT', 'type'=>'text', 'width'=>10],
                ['name'=>'MÃ SỐ HIỆN VẬT', 'type'=>'text', 'width'=>25],
                ['name'=>'TÊN HIỆN VẬT', 'type'=>'text', 'width'=>25],
                ['name'=>' SỐ LƯỢNG', 'type'=>'text', 'width'=>25],
                ['name'=>'CHẤT LIỆU', 'type'=>'text', 'width'=>25],  
                ['name'=>'NIÊN ĐẠI', 'type'=>'text', 'width'=>25],  
                ['name'=>'VỊ TRI', 'type'=>'text', 'width'=>25],  
                ['name'=>'THUỘC DI TÍCHTHUỘC DI TÍCH', 'type'=>'text', 'width'=>25],  
            ];
            $dataExcel = [];
            if(!empty($listData)){
                
                foreach ($listData as $key => $value) {
                   $dataHistoricalsite = getHistoricalSite($value->idHistoricalsite);
                    $dataExcel[] = [
                                    $key+1,
                                    @$value->sign,   
                                    @$value->name,   
                                    @$value->quantity,   
                                    @$value->material,   
                                    @$value->period,   
                                    @$value->location,   
                                    @$dataHistoricalsite->name,   
                            ];
                }
            }            
            export_excel($titleExcel,$dataExcel,'danh_sach_hien_vat');
        }

    
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
    $Historicalsite = $modelHistoricalsite->find()->where()->all()->toList();
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
    setVariable('Historicalsite', $Historicalsite);
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
         if(empty($_GET['id'])){
            $data->urlSlug = createSlugMantan(trim(@$dataSend['name'].' '.@$dataSend['sign']));
        }
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

            

            //  debug($data);
              //die;

            $modelArtifact->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin?status=1');
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

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin?status=3');
}

function addWordArtfactAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin hiện vật';
     $mess= '';
    $modelArtifact = $controller->loadModel('Artifacts');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        
            $dataSend['content']= nl2br($dataSend['content']);
            $dataSend['content']= explode('HỒ SƠ KHOA HỌC HIỆN VẬT', $dataSend['content']);

        
        
        if(!empty($dataSend['content'])){
            foreach($dataSend['content'] as $listData){
                if(!empty($listData)){
                    $listData = str_replace('"','',$listData);
                    $item= preg_split('/[\t]/', trim($listData));

                    $name = explode(':', $item[2]);        
                    $address = explode(':', $item[1]);        
                    $sign = explode('<br />', $item[2]);    
                    $sign = trim($sign[1]);
                    $code = explode('.', $sign);
                    $location = explode(':', $item[3]);
                    $quantity = explode(':', $item[4]);
                    $introductory = explode(':<br />', $item[5]);
                    $introductory = trim(@$introductory[1]);
                    $number =  explode(':', $item[6]);
                    $color =  explode(':', $item[8]);
                    $material = explode(':', $item[10]);
                    $file = explode(':', $item[12]);
                    $technique = explode(':', $item[20]);
                    $current =  explode(':', $item[25]);
                    $source =explode(':', $item[27]);
               //   debug($item);
                  // debug($introductory);

                    if($item[28]=='A: X  '){
                        $classify = 'A';
                    }elseif($item[29]=='B: X  '){
                        $classify = 'B';
                    }else{
                        $classify = 'C';
                    }
                 
                     $data = $modelArtifact->newEmptyEntity();                  
                    // tạo dữ liệu save
                    $data->name = @$name[2];
                    $data->status =  1;
                    $data->material = @$material[1];
                    $data->idHistoricalsite = 44;
                    $data->idcategory = @$dataSend['idcategory'];
                    $data->excavation = @$dataSend['excavation'];
                    $data->period = @$item[15].', '.$item[18];
                    $data->century = @$dataSend['century'];
                    $data->location = @$location[1];
                    $data->color = @$color[1];
                     if(!empty($dataSend['registrationdate'])){
                        $data->registrationdate = strtotime(str_replace("T", " ", @$dataSend['registrationdate']));
                    }else{
                        $data->registrationdate = '';
                    }


                    $data->shape = @$dataSend['shape'];
                    $data->technique = @$technique[1];
                    $data->classify = @$classify;
                    $data->voter = @$item[31];
                    $data->source = @$source[2];
                    $data->file = @$file[1];
                    $data->image = 'https://tayho360.vn/upload/admin/files/PTH_'.$code[1].'.jpg';
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
                    $data->number = (int) @$number[1];
                    $data->quantity = (int) @$quantity[1];
                    $data->sign = $sign;
                    $data->weight = @$dataSend['weight'];
                    $data->size = str_replace(array("<br />", "<br />", "\t"), "",@$item[23]);
                    $data->introductory = @$introductory;
                    $data->current = @$current[1];
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
                    $data->address = @$address[1];
                    
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

                    $data->urlSlug = createSlugMantan(trim(@$name[2].' '.@$sign));

                   // debug($data);
                      //die;

                 $modelArtifact->save($data);

                }
            }
        }
       // die;
        return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin?status=1');

    }

     setVariable('mess', $mess);

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
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin?status=1');
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

    return $controller->redirect('/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin?status=3');
}

function listTypeHistoricalSites($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Loại hình di tích';

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
        $infoCategory->status = '';
        $infoCategory->keyword = '';
        $infoCategory->description = '';
        $infoCategory->type = 'typeHistoricalSites';

        // tạo slug
        $slug = createSlugMantan($infoCategory->name);
        $slugNew = $slug;
        $number = 0;
        do{
            $conditions = array('slug'=>$slugNew,'type'=>'typeHistoricalSites');
            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

            if(!empty($listData)){
                $number++;
                $slugNew = $slug.'-'.$number;
            }
        }while (!empty($listData));

        $infoCategory->slug = $slugNew;

        $modelCategories->save($infoCategory);

    }

    $conditions = array('type' => 'typeHistoricalSites');

    if(!empty($_GET['name'])){
        $conditions['name LIKE']= '%'.$_GET['name'].'%';
    }


    $listData = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('listData', $listData);
}


function updatetechnique($input){
    global $controller;

    $conditions['status']= 1;
   // $conditions['sign LIKE']= '%CVN.%';

    $modelArtifact = $controller->loadModel('Artifacts');
        $data = $modelArtifact->find()->where($conditions)->all();
       
          debug($data);
          die;
        
        foreach($data as $listData){
                if(!empty($listData)){
                    $code = explode('.', $listData->sign);
                    $listData->sign = 'CVG.'.$code[1];
                    $listData->image = 'https://tayho360.vn/upload/admin/files/CVG_'.$code[1].'.jpg';

                   $listData->urlSlug = createSlugMantan(trim(@$listData->name.' '.$listData->sign));
               //
                debug($listData);     
              //    $modelArtifact->save($listData);
        

                }
            }
         die;

        return $controller->redirect('/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin?status=1');
}

 ?>