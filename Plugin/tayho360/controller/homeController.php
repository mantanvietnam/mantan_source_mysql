<?php 
// sự kệt Event
function listEvent($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelEvent = $controller->loadModel('Events');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

        if(!empty($_GET['month'])){
                $conditions['month']= $_GET['month'];
        }

        if(!empty($_GET['year'])){
            $conditions['year']= $_GET['year'];
        }
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Sự kiện');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailEvent($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelEvent = $controller->loadModel('Events');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelEvent->find()->where($conditions)->first();

        $month=array();
        if(!empty(@$data->month)){
            $month['month']=@$data->month;
        }
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelEvent->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// du lich tour
function listTour($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelTour = $controller->loadModel('Tours');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Tour');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailTour($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelTour = $controller->loadModel('Tours');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelTour->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelTour->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

function booktour($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelBookTour = $controller->loadModel('Booktours');

    $dataSend = $input['request']->getData();
    
    if(!empty($dataSend['name'])){

        $data = $modelBookTour->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idtour = (int) @$dataSend['idtour'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['numberpeople'];
        $data->note = @$dataSend['not'];
        $data->status = 'processing';

      
        $modelBookTour->save($data);
           return $controller->redirect('/chi_tiet_tour/'.$dataSend['urlSlug'].'.html?status=bookTourDone');
       
    }else{
         return $controller->redirect('/chi_tiet_tour/'.$dataSend['urlSlug'].'.html?status=bookTourfailure');
    } 
}

// cơ quan hanh chinh GovernanceAgency
function listGovernanceAgency($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
        $listData = $modelGovernanceAgency->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $conditions_scan = array('id'=>$value->id);
                    $static = $modelGovernanceAgency->find()->where($conditions_scan)->all()->toList();
                    $listData[$key]->number_scan = count($static);
                }
            }

            // phân trang
            $totalData = $modelGovernanceAgency->find()->where($conditions)->all()->toList();
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Cơ quan hành chính');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailGovernanceAgency($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelGovernanceAgency->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelGovernanceAgency->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Dich vụ hỗ trợ Service
function listService($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelService = $controller->loadModel('Services');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Dịch vụ hỗ trợ du lịch');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);



        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailService($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelService = $controller->loadModel('Services');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelService->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelService->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Làng nghề Craftvillage
function listCraftvillage($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Làng nghề');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailCraftvillage($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelCraftvillage = $controller->loadModel('Craftvillages');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelCraftvillage->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelCraftvillage->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Nhà hàng Restaurant
function listRestaurant($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelRestaurant = $controller->loadModel('Restaurants');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Nhà hàng');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailRestaurant($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelRestaurant = $controller->loadModel('Restaurants');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelRestaurant->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelRestaurant->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

function bookTable($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelBooktable = $controller->loadModel('Booktables');

    $dataSend = $input['request']->getData();
    if(!empty($dataSend['timebook'])){
        $data = $modelBooktable->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idrestaurant = (int) @$dataSend['idrestaurant'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['numberpeople'];
        $data->note = @$dataSend['not'];
        $data->status = 'processing';
            $data->timebook = strtotime(str_replace("T", " ", @$dataSend['timebook']));
        
      
        $modelBooktable->save($data);
           return $controller->redirect('/chi_tiet_nha_hang/'.$dataSend['urlSlug'].'.html?status=booktableDone');
       
    }else{
         return $controller->redirect('/chi_tiet_nha_hang/'.$dataSend['urlSlug'].'.html?status=booktablefailure');
    } 
}


//Khách sạn Hotel 
function listHotel($input){

    global $urlNow;
    $_SESSION['urlCallBack']= $urlNow;
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
        
        $order = array('created'=>'desc');
        $conditions = array();
          if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        $keyManMo = '5dc8f2652ac5db08348b4567';
      

     $dataPost= array('key'=>$keyManMo, 'city'=>1, 'lat'=>'','nameHotel'=>@$_GET['name'], 'long'=>'', 'district'=>11, 'limit'=>15,'page'=>$page);
            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/getHotelAroundAPI', $dataPost);



            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);
            

            if(!empty(@$listHotel['data'])){
                $listData= @$listHotel['data'];
                $totalData= $listHotel['total'];
                $_SESSION['totalHotel'] = $listHotel['total'];
            }else{
                $listData= null;
                $totalData= null;
                $_SESSION['totalHotel'] = null;
            }
        

        //$modelHotel->getPage($page, $limit = 15, $conditions, $order =  $order, $fields=null);



        
 
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
            $urlPage = str_replace('&page=' . $_GET['page'], '', $urlNow);
            $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
        } else {
            $urlPage = $urlNow;
        }
        if (strpos($urlPage, '?') !== false) {
            $checkUrl= explode('?', $urlPage);
            if (count($checkUrl) > 1) {
                $urlPage = $urlPage . '&page=';
            } else {
                $urlPage = $urlPage . 'page=';
            }
        } else {
            $urlPage = $urlPage . '?page=';
        }

        global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Khách sạn');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Trung tâm sự kiện và khách sạn', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);

}

function detailHotel($input){
    global $infoSite;
    global $controller;
    global $urlHomes;
     global $urlNow;
     global $metaTitleMantan;
    global $metaImageMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    $_SESSION['urlCallBack']= $urlNow; 
    $keyManMo = '5dc8f2652ac5db08348b4567';
    $listFurniture = getListFurniture();

 

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
       
        $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
       // $data= $modelHotel->getHotelSlug($input['request']->params['pass'][1]);

       
            
            $dataPost= array('key'=>$keyManMo, 'slug'=>$slug, 'lat'=>'', 'long'=>'', 'idUser'=>'');

            $infoHotelMM= sendDataConnectMantan('http://api.quanlyluutru.com/getHotelSluglAPI', $dataPost);
            $infoHotelMM= str_replace('ï»¿', '', utf8_encode($infoHotelMM));
            $infoHotelMM= json_decode($infoHotelMM, true);




            //$conditions['id']=array('$nin'=>explode(',', strtoupper(str_replace(' ', '', $data['Hotel']['id']))));
            //$otherData= $modelHotel->getPage($page = 1, $limit = 3, $conditions, $order = array(), $fields=null);

            $data['HotelManmo'] = $infoHotelMM;

            $metaImageMantan= $data['HotelManmo']['data']['Hotel']['image'][0];

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data['HotelManmo']['data']['Hotel']['name']);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data['HotelManmo']['data']['Hotel']['name'], $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data['HotelManmo']['data']['Hotel']['name'], $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data['HotelManmo']['data']['Hotel']['name'], $metaTitleMantan);

           setVariable('listFurniture', $listFurniture); 



            setVariable('data',$data);
            //setVariable('otherData',$otherData);
        }else{
            $controller->redirect('/');
        }    
}

function bookHotel($input) {
     global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $bookHotel = $controller->loadModel('BookHotels');

    $dataSend = $input['request']->getData();

 

    if(!empty($dataSend['name'])){
         $date_start = explode(' ', @$dataSend['date_start']);
            $date_end = explode(' ', @$dataSend['date_end']);
            $dataPost= array('idHotel'=>  @$dataSend['idhotel'],
                'date_start'=> @$date_start[0],
                'date_end'=> @$date_end[0],
                'typeRoom'=> @$dataSend['typeRoom'],
                'email'=> @$dataSend['email'],
                'phone'=> @$dataSend['phone'],
                'name'=> @$dataSend['name'],
                'typeBooking'=>  6,
                'number_room'=>  @$dataSend['number_room'],
                'number_people'=> @$dataSend['number_people'],
                'deposits'=> @$dataSend['pricePay'],
                'type_register'=> @$dataSend['type_register'],
                'key'=> '60d410dc2ac5db3f758b4567', 
                'timeStart'=>  @$date_start[1],
                'timeEnd'=>  @$date_end[1],
                'textNumberDate'=> @$dataSend['timePay'],
                'codeDiscount'=> '',
                'wed'=> '0',

            );

            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/saveBookingAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);


        $data = $bookHotel->newEmptyEntity();
             $data->created = getdate()[0];

        $data->idhotel = @$dataSend['idhotel'];
        $data->idcustomer = (int) @$dataSend['idcustomer'];
        $data->name = @$dataSend['name'];
        $data->phone = @$dataSend['phone'];
        $data->email = @$dataSend['email'];
        $data->numberpeople = (int) @$dataSend['number_people'];
        $data->note = @$dataSend['not'];
        $data->status = 'processing';
        $data->type_register = @$dataSend['type_register'];
        $data->date_end = @$dataSend['date_end'];
        $data->date_start = @$dataSend['date_start'];
        $data->number_room = (int) @$dataSend['number_room'];
        $data->pricePay =(int) @$dataSend['pricePay'];


      
        $bookHotel->save($data);
           return $controller->redirect('/chi_tiet_khach_san/'.$dataSend['urlSlug'].'.html?status=bookTourDone');
       
    }else{
         return $controller->redirect('/chi_tiet_khach_san/'.$dataSend['urlSlug'].'.html?status=bookTourfailure');
    } 
}

// Trung tâm hội nghị sự kiện Eventcenter
function listEventcenter($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelEventcenter = $controller->loadModel('Eventcenters');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Trung tâm hội nghị sự kiện');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailEventcenter($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelEventcenter = $controller->loadModel('Eventcenters');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelEventcenter->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelEventcenter->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Danh lam Place
function listPlace($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelPlace = $controller->loadModel('Places');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Danh lam thắng cảnh');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailPlace($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelPlace = $controller->loadModel('Places');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelPlace->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelPlace->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Lễ hội Festival
function listFestival($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelFestival = $controller->loadModel('Festivals');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Lễ Hội');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Danh lam thắng cảnh', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function detailFestival($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelFestival = $controller->loadModel('Festivals');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelFestival->find()->where($conditions)->first();

        $month=array();
       
        $month['status']=1;
        

        if(!empty($data)){
           

            $conditions = array('id !='=>$data->id);
            $limit = 4;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');

            $metaTitleMantanDefault= $metaTitleMantan;
            $metaKeywordsMantanDefault= $metaKeywordsMantan;
            $metaDescriptionMantanDefault= $metaDescriptionMantan;

            $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $data->name);
            $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
            $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                
            $metaTitleMantan= str_replace('%productName%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productKeyword%', $data->name, $metaTitleMantan);
            $metaTitleMantan= str_replace('%productDescription%', $data->introductory, $metaTitleMantan);


            $metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $data->introductory);
            $metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
            
            $metaDescriptionMantan= str_replace('%productName%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productKeyword%', @$data->name, $metaDescriptionMantan);
            $metaDescriptionMantan= str_replace('%productDescription%', $data->introductory, $metaDescriptionMantan);

            
            $otherData = $modelFestival->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

function vietnam360(){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelImage360 = $controller->loadModel('Images');
    
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug LIKE']= '%'.$key.'%';
        }

        $conditions['status']= 1;

       
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Việt Nam 360');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Danh lam thắng cảnh', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
}

function listlike(){
     global $urlNow;
    global $controller;
    global $controller;
    global $urlCurrent;
    global $session;
    $infoUser = $session->read('infoUser');
    $modelLike = $controller->loadModel('Likes');
    if(!empty($infoUser)){
    $_SESSION['urlCallBack']= $urlNow;
      
        $page= (isset($_GET['page']))? (int) $_GET['page']:1;
        if($page<=0) $page=1;
        $limit= 15;
         $getmonth   = getmonth();
        
        $order = array('created'=>'desc');
        $conditions = array();

        

        $conditions['idcustomer']= $infoUser['id'];

       
        $listData = $modelLike->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $conditions_scan = array('id'=>$value->id);
                    $static = $modelLike->find()->where($conditions_scan)->all()->toList();
                    $listData[$key]->number_scan = count($static);
                }
            }

            // phân trang
            $totalData = $modelLike->find()->where($conditions)->all()->toList();
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
       global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Điểm đến yêu thích');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

        setVariable('listData',$listData);
        setVariable('getmonth',$getmonth);

        setVariable('page',$page);
        setVariable('totalPage',$totalPage);
        setVariable('back',$back);
        setVariable('next',$next);
        setVariable('urlPage',$urlPage);
    }else{
        return $controller->redirect('/');
    }
}

function ajax_event($input){
   global $urlNow;
    global $controller;
    global $urlCurrent;
    global $urlThemeActive;
    $modelEvent = $controller->loadModel('Events');

        $conditions = array();

        if(!empty($_GET['name'])){
             $key=createSlugMantan($_GET['name']);
            $conditions['urlSlug']= array('$regex' => $key);
        }

        if(!empty($_GET['month'])){
                $conditions['month']= $_GET['month'];
        }
        $order = array('id'=>'desc');
        $listData= $modelEvent->find()->limit(10)->page(1)->where($conditions)->order($order)->all()->toList();

        
        $text = '';
          if(!empty($listData)) {
            foreach ($listData as $keyEvent => $valueEvent) {
        $text .= '<div class="slide-event-home">
                            <div class="item-event-home absolute">
                                <div class="box-img-item-eh">
                                    <img src="'.$valueEvent->image .'" alt="">
                                </div>
                            </div>
                            <div class="info-event-home">
                                <div class="name-event-home">
                                    <p>'.$valueEvent->name .'</p>
                                </div>
                                <div class="description-event-home">
                                    <p class="title-des">Giới thiệu</p>
                                    <p class="text-des">'.$valueEvent->introductory .'</p>
                                </div>
                                <div class="local-event-home">
                                    <ul>
                                        <li>
                                            <i class="fa-solid fa-location-dot"></i>
                                            <p>'.$valueEvent->address .'</p>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <p>'. date("d/m/Y",$valueEvent->datestart) .'</p>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-phone"></i>
                                            <p>'.$valueEvent->phone .'</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
                        $code = 1;

                       } } else { 
                $text .= '           <div class="slide-event-home">
                            <div class="item-event-home absolute">
                                <div class="box-img-item-eh">
                                    <img src="'.$urlThemeActive .'/img/thaianhimg/eventhome.png" alt="">
                                </div>
                            </div>
                            <div class="info-event-home">
                                <div class="name-event-home">
                                    <p>Chưa có sự kiện nào đang diễn ra.</p>
                                </div>
                            </div>
                        </div>';
                          $code = 2;
                     
                        }
        return (array('text'=>$text,'code'=>$code, 'data'=> @$listData));
}

function bookingonline(){
     global $urlNow;
    global $controller;
    global $urlCurrent;
    global $urlThemeActive;
    global $session;
    $infoUser = $session->read('infoUser');
    $bookHotel = $controller->loadModel('BookHotels');
    $modelBookTable = $controller->loadModel('Booktables');
    $modelBookTour = $controller->loadModel('Booktours');
    $conditions =array();
     $conditions['idcustomer']= $infoUser['id'];


    $databookHotel = $bookHotel->find()->where($conditions)->all();
    $databookTable = $modelBookTable->find()->where($conditions)->all();
    $databookTour = $modelBookTour->find()->where($conditions)->all();


     global $metaTitleMantan;
        global $metaKeywordsMantan;
        global $metaDescriptionMantan;

        $metaTitleMantanDefault= $metaTitleMantan;
        $metaKeywordsMantanDefault= $metaKeywordsMantan;
        $metaDescriptionMantanDefault= $metaDescriptionMantan;


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Booking');
        $metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
        $metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Bookinh', $metaTitleMantan);



    setVariable('databookHotel',$databookHotel);
    setVariable('databookTable',$databookTable);
    setVariable('databookTour',$databookTour);



}

function findnear(){

    global $urlHomes;
    global $controller;
       

        $modelGovernanceAgency = $controller->loadModel('Governanceagencys');
        $governanceAgency= $modelGovernanceAgency->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelFestival = $controller->loadModel('Festivals');
        $festival= $modelFestival->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelRestaurant = $controller->loadModel('Restaurants');
        $restaurant= $modelRestaurant->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelTour = $controller->loadModel('Tours');
        $tour= $modelTour->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelHotel = $controller->loadModel('Hotels');
        $hotel= $modelHotel->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();





        $listData = array();

         if(!empty($governanceAgency)){
            foreach($governanceAgency as $keyGovernanceAgency => $listGovernanceAgency){
                $listData[] =  array('name'=> $listGovernanceAgency->name,
                                    'address'=> $listGovernanceAgency->address,
                                    'phone'=> $listGovernanceAgency->phone,
                                    'image'=> $listGovernanceAgency->image,
                                    'lat'=> $listGovernanceAgency->latitude,
                                    'long'=> $listGovernanceAgency->longitude,
                                    'urlSlug'=> 'chi_tiet_co_quan_hanh_chinh/'.$listGovernanceAgency->urlSlug.'.html',
                                    'type'=> 'co_quan_hanh_chinh',

                );
            }
        } 

        if(!empty($festival)){
            foreach($festival as $keyfestival => $listFestival){
                $listData[] =  array('name'=> $listFestival->name,
                                    'address'=> $listFestival->address,
                                    'phone'=> $listFestival->phone,
                                    'image'=> $listFestival->image,
                                    'lat'=> $listFestival->latitude,
                                    'long'=> $listFestival->longitude,
                                    'urlSlug'=> 'chi_tiet_le_hoi/'.$listFestival->urlSlug.'.html',
                                    'type'=> 'le_hoi',

                );
            }
        }
      if(!empty($restaurant)){
            foreach($restaurant as $keyrestaurant => $listRestaurant){
                $listData[] =  array('name'=> $listRestaurant->name,
                                    'address'=> $listRestaurant->address,
                                    'phone'=> $listRestaurant->phone,
                                    'image'=> $listRestaurant->image,
                                    'lat'=> $listRestaurant->latitude,
                                    'long'=> $listRestaurant->longitude,
                                    'urlSlug'=> 'chi_tiet_nha_hang/'.$listRestaurant->urlSlug.'.html',
                                    'type'=> 'nha_hang',

                );
            }
        }
     if(!empty($tour)){
            foreach($tour as $keyTour => $listTour){
                $listData[] =  array('name'=> $listTour->name,
                                    'address'=> $listTour->address,
                                    'phone'=> $listTour->phone,
                                    'image'=> $listTour->image,
                                    'lat'=> $listTour->latitude,
                                    'long'=> $listTour->longitude,
                                    'urlSlug'=> 'chi_tiet_tour/'.$listTour->urlSlug.'.html',
                                    'type'=> 'tour',

                );
            }
        }
        $keyManMo = '5dc8f2652ac5db08348b4567';
        $city = 1;
        $district = 11;

        $dataPost= array('key'=>$keyManMo, 'city'=>1, 'lat'=>'','nameHotel'=> '', 'long'=>'', 'district'=>7, 'limit'=>'','page'=>1);
            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/getHotelAroundAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);

        if(!empty($listHotel['data'])){
            foreach($listHotel['data'] as $keyHotel => $Hotel){
                $listData[] =  array('name'=> $Hotel['Hotel']['name'],
                                    'address'=> $Hotel['Hotel']['address'],
                                    'phone'=> $Hotel['Hotel']['phone'],
                                    'image'=> $Hotel['Hotel']['imageDefault'],
                                    'lat'=> $Hotel['Hotel']['coordinates_x'],
                                    'long'=> $Hotel['Hotel']['coordinates_y'],
                                    'urlSlug'=> 'chi_tiet_khach_san/'.$Hotel['Hotel']['slug'].'.html',
                                    'type'=> 'khach_san',

                );
            }
        }

         setVariable('listData', $listData); 

}
 ?>