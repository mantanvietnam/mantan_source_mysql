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
            

        $listData= $listHotel['data'];
        //$modelHotel->getPage($page, $limit = 15, $conditions, $order =  $order, $fields=null);



        $totalData= $listHotel['total'];

        $_SESSION['totalHotel'] = $listHotel['total'];
 
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


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Trung tâm sự kiện và khách sạn');
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



function ajax_like($input){

    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách Cơ quan hành chính';

    $modelGovernanceAgencys = $controller->loadModel('Governanceagencys');
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