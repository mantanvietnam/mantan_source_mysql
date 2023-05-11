<?php 
// Cơ quan hành chính GovernanceAgencys
function listGovernanceAgencysAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách cơ quan hành chính';

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
    
    $metaTitleMantan = 'Thông tin cơ quan hành chính';

    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
    $modelCustomer = $controller->loadModel('Customers');
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
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));


            $modelGovernanceAgencys->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php?status=2');
            }else{

                $modelCustomer = $controller->loadModel('Customers');
                $conditions = ['token_device IS NOT'=>null];
                $listMembers = $modelCustomer->find()->where($conditions)->all()->toList();
                 

                if(!empty($listMembers)){
                    $dataSendNotification= array('title'=>'Bạn có cơ quan hành chính Mới','time'=>date('H:i d/m/Y'),'content'=>$dataSend['name'],'action'=>'co_quan_hanh_chinh');

                  

                    foreach ($listMembers as $key => $value) {
                        
                        if(!empty($value->token_device)){
                         $thongban =   sendNotification($dataSendNotification, $value->token_device);
                             
                        }
                    }
                }
                return $controller->redirect('/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}



function addExcelGovernanceAgencysAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin cơ quan hành chính';

    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
    $mess= '';


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['content'])){
            $dataSend['content']= nl2br($dataSend['content']);
            $dataSend['content']= explode('<br />', $dataSend['content']);

            if(!empty($dataSend['content'])){

                foreach($dataSend['content'] as $listData){
                    $listData = str_replace('"','',$listData);
                    $item= preg_split('/[\t]/', trim($listData));
                    
                    if(!empty($item[0])){
                        // tạo dữ liệu save
                        $data = $modelGovernanceAgencys->newEmptyEntity();

                        $data->name = @$item[0];
                        $data->address = @$item[1];
                        $data->phone = @$item[2];
                        $data->email = @$item[3];
                        $data->image = @$item[4];
                        $data->image2 = @$item[5];
                        $data->image3 = @$item[6];
                        $data->image4 = @$item[7];
                        $data->image5 = @$item[8];
                        $data->image6 = @$item[9];
                        $data->image7 = @$item[10];
                        $data->image8 = @$item[11];
                        $data->image9 = @$item[12];
                        $data->image10 = @$item[13];
                        $data->introductory = @$item[14];
                        $data->latitude = @$item[15];
                        $data->longitude = @$item[16];
                        $data->image360 = @$item[17];
                        $data->content = @$item[18];
                        $data->status = (int) @$item[19];
                        $data->urlSlug = createSlugMantan(trim($item[0]));
                        $data->created = getdate()[0];
                        
                        $modelGovernanceAgencys->save($data);
                    }
                }
            }

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu</p>';
        }
    }

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

    $metaTitleMantan = 'Danh sách lễ hội';

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
    
    $metaTitleMantan = 'Thông tin lễ hội';


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
            $data->holdtime = @$dataSend['holdtime'];
            $data->headcommittee = @$dataSend['headcommittee'];
            $data->organizationlevel = @$dataSend['organizationlevel'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelFestival->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php?status=2');
            }else{
                $modelCustomer = $controller->loadModel('Customers');
                $conditions = ['token_device IS NOT'=>null];
                $listMembers = $modelCustomer->find()->where($conditions)->all()->toList();
                 

                if(!empty($listMembers)){
                    $dataSendNotification= array('title'=>'Bạn có tin lễ hội mới','time'=>date('H:i d/m/Y'),'content'=>$dataSend['name'],'action'=>'le_hoi');
                  

                    foreach ($listMembers as $key => $value) {
                        
                        if(!empty($value->token_device)){
                            sendNotification($dataSendNotification, $value->token_device);
                            
                        }
                    }
                }
                return $controller->redirect('/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
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
function listTourAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tour';

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

function addTourAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin tour';


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
            $data->price = @$dataSend['price'];
            $data->timetravel = @$dataSend['timetravel'];
            if(!empty($dataSend['datestart'])){
                $data->datestart = strtotime(str_replace("T", " ", @$dataSend['datestart']));
            }else{
                $data->datestart = '';
            }
            if(!empty($dataSend['dateend'])){
                $data->dateend = strtotime(str_replace("T", " ", @$dataSend['dateend']));
            }else{
                $data->dateend = '';
            }
            
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelTour->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listTourAdmin.php?status=2');
            }else{
                $modelCustomer = $controller->loadModel('Customers');
                $conditions = ['token_device IS NOT'=>null];
                $listMembers = $modelCustomer->find()->where($conditions)->all()->toList();
                 

                if(!empty($listMembers)){
                    $dataSendNotification= array('title'=>'Bạn có tuor mới','time'=>date('H:i d/m/Y'),'content'=>$dataSend['name'],'action'=>'tour');
                  

                    foreach ($listMembers as $key => $value) {
                        
                        if(!empty($value->token_device)){
                            sendNotification($dataSendNotification, $value->token_device);
                            
                        }
                    }
                }
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listTourAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
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

function listBookTourAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đặt tour';

    $modelBookTour = $controller->loadModel('Booktours');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelBookTour->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelBookTour->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelBookTour->find()->where($conditions)->all()->toList();
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

function deleteBookTourAdmin(){
      global $controller;
    $modelBookTour = $controller->loadModel('Booktours');
    if(!empty($_GET['id'])){
        $data = $modelBookTour->get($_GET['id']);
        
        if($data){
            $modelBookTour->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-tour-listBookTourAdmin.php?status=3');
}

// lịch trình
function listReportAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách lịch trình';

    $modelReport = $controller->loadModel('Reports');
    
    $conditions = array();
    $conditions['idtour']=$_GET['idtour'];
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelReport->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelReport->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelReport->find()->where($conditions)->all()->toList();
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

function addReportAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin lịch trình';


    $modelReport = $controller->loadModel('Reports');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelReport->get( (int) $_GET['id']);

    }else{
        $data = $modelReport->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();   

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->time = @$dataSend['time'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->date = @$dataSend['date'];
            $data->idtour = @$dataSend['idtour'];
            $data->status = @$dataSend['status'];

       

            $modelReport->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listReportAdmin.php?status=2&idtour='.$dataSend['idtour']);
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-tour-listReportAdmin.php?status=1&idtour='.$dataSend['idtour']);
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteReportAdmin($input){
    global $controller;
    $modelReport = $controller->loadModel('Reports');
    if(!empty($_GET['id'])){
        $data = $modelReport->get($_GET['id']);
        
        if($data){
            $modelReport->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-tour-listReportAdmin.php?status=3&idtour='.$_GET['idtour']);
}

// Điểm đến làng nghề craftvillage 
function listCraftvillageAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến làng nghề';

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

function addCraftvillageAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin điểm đến làng nghề';


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
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

       

            $modelCraftvillage->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php?status=2');
            }else{
                 $modelCustomer = $controller->loadModel('Customers');
                $conditions = ['token_device IS NOT'=>null];
                $listMembers = $modelCustomer->find()->where($conditions)->all()->toList();
                 

                if(!empty($listMembers)){
                    $dataSendNotification= array('title'=>'Bạn có tin làng nghề mới','time'=>date('H:i d/m/Y'),'content'=>$dataSend['name'],'action'=>'lang_nghe');
                  

                    foreach ($listMembers as $key => $value) {
                        
                        if(!empty($value->token_device)){
                            sendNotification($dataSendNotification, $value->token_device);
                            
                        }
                    }
                }
                return $controller->redirect('/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
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

// Nhà hàng Restaurant
function listRestaurantAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách nhà hàng';

    $modelRestaurant = $controller->loadModel('Restaurants');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelRestaurant->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelRestaurant->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelRestaurant->find()->where($conditions)->all()->toList();
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

function addRestaurantAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin nhà hàng';


    $modelRestaurant = $controller->loadModel('Restaurants');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelRestaurant->get( (int) $_GET['id']);

    }else{
        $data = $modelRestaurant->newEmptyEntity();
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
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            $modelRestaurant->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-restaurant-listRestaurantAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-restaurant-listRestaurantAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteRestaurantAdmin($input){
    global $controller;
    $modelRestaurant = $controller->loadModel('Restaurants');
    if(!empty($_GET['id'])){
        $data = $modelRestaurant->get($_GET['id']);
        
        if($data){
            $modelRestaurant->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-restaurant-listRestaurantAdmin.php?status=3');
}

function listBookTableAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đặt hàng';

    $modelBooktable = $controller->loadModel('Booktables');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelBooktable->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelBooktable->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelBooktable->find()->where($conditions)->all()->toList();
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

function deleteBookTableAdmin(){
      global $controller;
    $modelBooktable = $controller->loadModel('Booktables');
    if(!empty($_GET['id'])){
        $data = $modelBooktable->get($_GET['id']);
        
        if($data){
            $modelBooktable->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-restaurant-listBookTableAdmin.php?status=3');
}

// Khách sạn hotel
function listHotelAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khách sạn';

    $modelHotel = $controller->loadModel('Hotels');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelHotel->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelHotel->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelHotel->find()->where($conditions)->all()->toList();
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

function addHotelAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Cơ quan hành chính';


    $modelHotel = $controller->loadModel('Hotels');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelHotel->get( (int) $_GET['id']);

    }else{
        $data = $modelHotel->newEmptyEntity();
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
            $data->priceday = @$dataSend['priceday'];
            $data->pricehour = @$dataSend['pricehour'];
            $data->pricenight = @$dataSend['pricenight'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            $modelHotel->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-hotel-listHotelAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-hotel-listHotelAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteHotelAdmin($input){
    global $controller;
    $modelHotel = $controller->loadModel('Hotels');
    if(!empty($_GET['id'])){
        $data = $modelHotel->get($_GET['id']);
        
        if($data){
            $modelHotel->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-hotel-listHotelAdmin.php?status=3');
}

function listBookhotelAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đặt phòng khách sạn';

    $modelBookhotel = $controller->loadModel('Bookhotels');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelBookhotel->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelBookhotel->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelBookhotel->find()->where($conditions)->all()->toList();
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

function deleteBookhotelAdmin(){
      global $controller;
    $modelBookhotel = $controller->loadModel('Bookhotels');
    if(!empty($_GET['id'])){
        $data = $modelBookhotel->get($_GET['id']);
        
        if($data){
            $modelBookhotel->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-restaurant-listBookhotelAdmin.php?status=3');
}



// Ảnh 360 Image360
function listImage360Admin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách ảnh 360';

    $modelImage360 = $controller->loadModel('Images');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelImage360->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelImage360->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelImage360->find()->where($conditions)->all()->toList();
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

function addImage360Admin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin ảnh 360';


    $modelImage360 = $controller->loadModel('Images');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelImage360->get( (int) $_GET['id']);

    }else{
        $data = $modelImage360->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->image360 = @$dataSend['image360'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            $modelImage360->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-image360-listImage360Admin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-image360-listImage360Admin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteImage360Admin($input){
    global $controller;
    $modelImage360 = $controller->loadModel('Images');
    if(!empty($_GET['id'])){
        $data = $modelImage360->get($_GET['id']);
        
        if($data){
            $modelImage360->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-image360-listImage360Admin.php?status=3');
}

// Sự kện Event
function listEventAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách sự kiện';

    $modelEvent = $controller->loadModel('Events');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelEvent->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelEvent->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

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

function addEventAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin Sự kiện';


    $modelEvent = $controller->loadModel('Events');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelEvent->get( (int) $_GET['id']);

    }else{
        $data = $modelEvent->newEmptyEntity();
         $data->created = getdate()[0];
    }


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();



        if(!empty($dataSend['name'])){
            // tạo dữ liệu save
            $data->name = @$dataSend['name'];
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
            $data->outstanding = @$dataSend['outstanding'];
            $data->address = @$dataSend['address'];
            if(!empty($dataSend['datestart'])){
                $data->datestart = strtotime(str_replace("T", " ", @$dataSend['datestart']));
            }else{
                $data->datestart = '';
            }
            if(!empty($dataSend['dateend'])){
                $data->dateend = strtotime(str_replace("T", " ", @$dataSend['dateend']));
            }else{
                $data->dateend = '';
            }
            $data->introductory = @$dataSend['introductory'];
            $data->takesplace = @$dataSend['takesplace'];
            $data->year = @$dataSend['year'];
            $data->status = @$dataSend['status'];
            $data->month = @$dataSend['month'];
            $data->content = @$dataSend['content'];
            $data->headcommittee = @$dataSend['headcommittee'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->phone = @$dataSend['phone'];
            $data->organizationlevel = @$dataSend['organizationlevel'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            
            $modelEvent->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-event-listEventAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-event-listEventAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
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
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-event-listEventAdmin.php?status=3');
}

// Danh Lam place
function listPlaceAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách danh lam thắng cảnh';

    $modelPlace = $controller->loadModel('Places');
    
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelPlace->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelPlace->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelPlace->find()->where($conditions)->all()->toList();
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

function addPlaceAdmin($input){
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin danh lam thắng cảnh';


    $modelPlace = $controller->loadModel('Places');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelPlace->get( (int) $_GET['id']);

    }else{
        $data = $modelPlace->newEmptyEntity();
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
            $data->rating = @$dataSend['rating'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            $modelPlace->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-place-listPlaceAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-place-listPlaceAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletePlaceAdmin($input){
    global $controller;
    $modelPlace = $controller->loadModel('Places');
    if(!empty($_GET['id'])){
        $data = $modelPlace->get($_GET['id']);
        
        if($data){
            $modelPlace->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-place-listPlaceAdmin.php?status=3');
}


// dich vụ hỗ trợ service
function listServiceAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = "Danh sách dịch vụ hỗ trợ du lịch";

    $modelService = $controller->loadModel('Services');
    
    $conditions = array();

    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelService->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelService->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelService->find()->where($conditions)->all()->toList();
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

function addServiceAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin dịch vụ hỗ trợ du lịch';

    $modelService = $controller->loadModel('Services');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelService->get( (int) $_GET['id']);

    }else{
        $data = $modelService->newEmptyEntity();
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
            $data->idcategory = @$dataSend['idcategory'];
            $data->status = @$dataSend['status'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));


            $modelService->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-service-listServiceAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-service-listServiceAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function addExceServiceAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin dịch vụ hỗ trợ du lịch';

    $modelService = $controller->loadModel('Services');
    $mess= '';


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['content'])){
            $dataSend['content']= nl2br($dataSend['content']);
            $dataSend['content']= explode('<br />', $dataSend['content']);

            if(!empty($dataSend['content'])){

                foreach($dataSend['content'] as $listData){
                    $item= preg_split('/[\t]/', trim($listData));
                    
                    if(!empty($item[0])){
                        // tạo dữ liệu save
                        $data = $modelService->newEmptyEntity();

                        $data->name = @$item[0];
                        $data->address = @$item[1];
                        $data->phone = @$item[2];
                        $data->email = @$item[3];
                        $data->image = @$item[4];
                        $data->image2 = @$item[5];
                        $data->image3 = @$item[6];
                        $data->image4 = @$item[7];
                        $data->image5 = @$item[8];
                        $data->image6 = @$item[9];
                        $data->image7 = @$item[10];
                        $data->image8 = @$item[11];
                        $data->image9 = @$item[12];
                        $data->image10 = @$item[13];
                        $data->introductory = @$item[14];
                        $data->latitude = @$item[15];
                        $data->longitude = @$item[16];
                        $data->image360 = @$item[17];
                        $data->content = @$item[18];
                        $data->status = (int) @$item[19];
                        $data->urlSlug = createSlugMantan(trim($item[0]));
                        $data->created = getdate()[0];

                        $modelService->save($data);
                    }
                }
            }

         return $controller->redirect('/plugins/admin/tayho360-admin-service-listServiceAdmin.php?status=1');
            
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu</p>';
        }
    }

    setVariable('mess', $mess);
}

function deleteServiceAdmin($input){
    global $controller;
    $modelService = $controller->loadModel('Services');
    if(!empty($_GET['id'])){
        $data = $modelService->get($_GET['id']);
        
        if($data){
            $modelService->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-service-listServiceAdmin.php?status=3');
}

// Trung tâm hội nghị sự kện Eventcenter
function listEventcenterAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách trung tâm hội nghị sự kện';

    $modelEventcenter = $controller->loadModel('Eventcenters');
    
    $conditions = array();

    if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }


    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelEventcenter->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelEventcenter->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelEventcenter->find()->where($conditions)->all()->toList();
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

function addEventcenterAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin trung tâm hội nghị sự kện';

    $modelEventcenter = $controller->loadModel('Eventcenters');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelEventcenter->get( (int) $_GET['id']);

    }else{
        $data = $modelEventcenter->newEmptyEntity();
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
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));


            $modelEventcenter->save($data);

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/tayho360-admin-eventcenter-listEventcenterAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/tayho360-admin-eventcenter-listEventcenterAdmin.php?status=1');
            }
            
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
        }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteEventcenterAdmin($input){
    global $controller;
    $modelEventcenter = $controller->loadModel('Eventcenters');
    if(!empty($_GET['id'])){
        $data = $modelEventcenter->get($_GET['id']);
        
        if($data){
            $modelEventcenter->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/tayho360-admin-eventcenter-listEventcenterAdmin.php?status=3');
}

function addNotificationAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;

    $metaTitleMantan = 'Gửi thông báo cho người dùng';

    $modelCustomer = $controller->loadModel('Customers');
    $mess= '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title']) && !empty($dataSend['mess'])){
            $conditions = ['token_device IS NOT'=>null];
            $listMembers = $modelCustomer->find()->where($conditions)->all()->toList();
             

            if(!empty($listMembers)){
                $dataSendNotification= array('title'=>$dataSend['title'],'time'=>date('H:i d/m/Y'),'content'=>$dataSend['mess'],'action'=>'adminSendNotification');
                $number = 0;

                foreach ($listMembers as $key => $value) {
                    
                    if(!empty($value->token_device)){
                        $return = sendNotification($dataSendNotification, $value->token_device);
                        $number++;
                    }
                }

                $mess= '<p class="text-success">Gửi thông báo thành công cho '.number_format($number).' người dùng</p>';
            }else{
                $mess= '<p class="text-danger">Không có thiết bị nào nhận được tin nhắn</p>';
            }
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
        }
    }

    setVariable('mess', $mess);
}
 ?>