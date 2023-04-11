<?php 
// Dich tích HistoricalSite
function listHistoricalSite($input){
    global $urlNow;
    global $controller;
    global $urlCurrent;
    $modelHistoricalSite = $controller->loadModel('HistoricalSites');
    
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

       
        $listData = $modelHistoricalSite->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $conditions_scan = array('id'=>$value->id);
                    $static = $modelHistoricalSite->find()->where($conditions_scan)->all()->toList();
                    $listData[$key]->number_scan = count($static);
                }
            }

            // phân trang
            $totalData = $modelHistoricalSite->find()->where($conditions)->all()->toList();
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


        $metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, 'Di tích lịch sử');
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

function detailHistoricalSite($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;

        $modelHistoricalSite = $controller->loadModel('HistoricalSites');

        if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
            if(!empty($_GET['id'])){
                $conditions = array('id'=>$_GET['id']);
            }else{
                $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
                $conditions = array('urlSlug'=>$slug);
            }
        }



        $data = $modelHistoricalSite->find()->where($conditions)->first();

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

            
            $otherData = $modelHistoricalSite->find()->where($month)->all();


            setVariable('data', $data);
            setVariable('otherData', $otherData);
        }else{
            return $controller->redirect('/');
        }         
}
 ?>