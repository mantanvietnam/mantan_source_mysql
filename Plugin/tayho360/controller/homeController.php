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

            
            $otherData = $modelEvent->find()->limit($limit)->page($page)->where($month)->order($order)->all()->toList();


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

            
            $otherData = $modelTour->find()->limit($limit)->page($page)->where($month)->order($order)->all()->toList();


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

            
            $otherData = $modelGovernanceAgency->find()->limit($limit)->page($page)->where($month)->order($order)->all()->toList();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}

// Lễ Hội Festival
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
                    
        $metaTitleMantan= str_replace('%categoryName%', 'Sự kiện', $metaTitleMantan);

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

            
            $otherData = $modelFestival->find()->limit($limit)->page($page)->where($month)->order($order)->all()->toList();


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

            
            $otherData = $modelCraftvillage->find()->limit($limit)->page($page)->where($month)->order($order)->all()->toList();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
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
        if(!empty($hotel)){
            foreach($hotel as $keyHotel => $listHotel){
                $listData[] =  array('name'=> $listHotel->name,
                                    'address'=> $listHotel->address,
                                    'phone'=> $listHotel->phone,
                                    'image'=> $listHotel->image,
                                    'lat'=> $listHotel->latitude,
                                    'long'=> $listHotel->longitude,
                                    'urlSlug'=> 'chi_tiet_khach_san/'.$listHotel->urlSlug.'.html',
                                    'type'=> 'khach_san',

                );
            }
        }

         setVariable('listData', $listData); 

}
 ?>