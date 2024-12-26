<?php 
function settingHomeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'image_logo' => @$dataSend['image_logo'],
                        'text_logo' => @$dataSend['text_logo'],
                        'background_image' => @$dataSend['background_image'],
                        'title_footer' => @$dataSend['title_footer'],
                        'agency' => @$dataSend['agency'],
                        'address' => @$dataSend['address'],
                        'phone' => @$dataSend['phone'],
                        'email' => @$dataSend['email'],
                        'responsibilityphone' => @$dataSend['responsibilityphone'],
                        'responsibilityemail' => @$dataSend['responsibilityemail'],
                        'follow' => @$dataSend['follow'],
                        'idlink' => @$dataSend['idlink'],
                        'youtube' => @$dataSend['youtube'],
                        'tiktok' => @$dataSend['tiktok'],
                        'zalo' => @$dataSend['zalo'],
                        'facebook' => @$dataSend['facebook'],       
                        'title_introduce_1' => @$dataSend['title_introduce_1'],       
                        'title_introduce_2' => @$dataSend['title_introduce_2'],       
                        'logo_introduce' => @$dataSend['logo_introduce'],       
                        'image_introduce' => @$dataSend['image_introduce'],       
                        'content1_introduce' => @$dataSend['content1_introduce'],       
                        'content2_introduce' => @$dataSend['content2_introduce'],       
                        'content3_introduce' => @$dataSend['content3_introduce'],       
                        'title_why_choose' => @$dataSend['title_why_choose'],       
                        'content1_why_choose' => @$dataSend['content1_why_choose'],       
                        'content2_why_choose' => @$dataSend['content2_why_choose'],       
                        'content3_why_choose' => @$dataSend['content3_why_choose'],       
                        'content4_why_choose' => @$dataSend['content5_why_choose'],       
                        'image1_news_hot' => @$dataSend['image1_news_hot'],       
                        'image2_news_hot' => @$dataSend['image2_news_hot'],     
                        'care_about_1' => @$dataSend['care_about_1'],     
                        'care_about_2' => @$dataSend['care_about_2'],     
                        'care_about_3' => @$dataSend['care_about_3'],     
                        'care_about_4' => @$dataSend['care_about_4'],     
                    );

    

        $data->key_word = 'settingHomeTheme';
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

function indexTheme($input){
    global $controller; 
    global $modelOptions;
    global $metaTitleMantan;
    global $modelpublication;
    global $urlCurrent;
    global $categories;
    $limit = 6;
    $conditions = array();
    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['id_kind'])){
        $conditions['id_kind'] = (int) $_GET['id_kind'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $modelproject = $controller->loadModel('ProductProjects');
    $modelcategory = $controller->loadModel('categories');
    $listDatacategory = $modelcategory->find()->where(['type'=>'category_kind'])->all()->toList();


  
    $order = array('id' => 'desc');
    $listDataproject= $modelproject->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
    $listDataprojectkeypoint = $modelproject->find()->where(['keypoint'=>1])->order($order)->all()->toList();

    $totalData = $modelproject->find()->where($conditions)->all()->toList();
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

    $numberOfProjects = count($listDataproject);
    setVariable('listDataprojectkeypoint', $listDataprojectkeypoint);
    setVariable('listDatacategory', $listDatacategory);
    setVariable('numberOfProjects', $numberOfProjects);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listDataproject', $listDataproject);
}
function project($input){
    global $controller; 
    global $modelOptions;
    global $metaTitleMantan;
    global $modelpublication;
    global $urlCurrent;
    global $categories;
    $limit = 6;
    $conditions = array();
    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['id_kind'])){
        $conditions['id_kind'] = (int) $_GET['id_kind'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $modelproject = $controller->loadModel('ProductProjects');
    $modelcategory = $controller->loadModel('categories');
    $listDatacategory = $modelcategory->find()->where(['type'=>'category_kind'])->all()->toList();


  
    $order = array('id' => 'desc');
    $listDataproject= $modelproject->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
    
    $totalData = $modelproject->find()->where($conditions)->all()->toList();
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

    $numberOfProjects = count($listDataproject);
    setVariable('listDatacategory', $listDatacategory);
    setVariable('numberOfProjects', $numberOfProjects);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listDataproject', $listDataproject);
}
?>