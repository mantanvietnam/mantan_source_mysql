<?php 
function settingHomeThemeSnagGolf($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeSnagGolf');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'logo' => $dataSend['logo'],

                        'welcome_title_1' => $dataSend['welcome_title_1'],
                        'welcome_title_2' => $dataSend['welcome_title_2'],
                        'welcome_title_3' => $dataSend['welcome_title_3'],
                        'welcome_title_4' => $dataSend['welcome_title_4'],
                        'welcome_title_main' => $dataSend['welcome_title_main'],

                        'course_title' => $dataSend['course_title'],
                       


                        'trainer_name' => $dataSend['trainer_name'],

                        'course_info_header' => $dataSend['course_info_header'],
                       

                        'footer_content' => $dataSend['footer_content'],
                    );

        $data->key_word = 'settingHomeThemeSnagGolf';
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






function indexTheme($input)
{
    global $modelPosts;
    global $settingThemes;
    global $controller;
    global $modelAlbuminfos;
    global $urlCurrent;
    $limit = 8;
    $conditions = array();
    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $modelcourse = $controller->loadModel('course');
    $order = array('id' => 'asc');
    $listDatacourse= $modelcourse->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
    $totalData = $modelcourse->find()->where($conditions)->all()->toList();
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
    $listDatatop= $modelPosts->find()->limit(3)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listDatacourse', $listDatacourse);
    setVariable('listDatatop', $listDatatop);
}
function settingtrainer($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingtrainer');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 
            'banner' =>$dataSend['banner'],
            'contentbanner' =>$dataSend['contentbanner'],
            'titledeepbanner'=>$dataSend['titledeepbanner'],
            'contentbanner2'=>$dataSend['contentbanner2'],    
            'li1' => $dataSend['li1'],
            'li2' => $dataSend['li2'],
            'li3' => $dataSend['li3'],
            'li4' => $dataSend['li4'],
            'li5' => $dataSend['li5'],
            'li6' => $dataSend['li6'],
            'li7' => $dataSend['li7'],
            'li8' => $dataSend['li8'],
            'li9' => $dataSend['li9'],
            'li10' => $dataSend['li10'],
            'li11' => $dataSend['li11'],
            'li12' => $dataSend['li12'],
            'li13' => $dataSend['li13'],
            'li14' => $dataSend['li14'],
            'li15' => $dataSend['li15'],
            'li16' => $dataSend['li16'],
        
        );

        $data->key_word = 'settingtrainer';
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
function trainer($input){

}
function courses($input){
    global $modelPosts;
    global $controller;
    global $urlCurrent;
    $limit = 8;
    $conditions = array();
    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $modelcourse = $controller->loadModel('course');
    $order = array('id' => 'asc');
    $listDatacourse= $modelcourse->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
    $totalData = $modelcourse->find()->where($conditions)->all()->toList();
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
    setVariable('listDatacourse', $listDatacourse);
   

}
function detailcourse($input){
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;
    global $session;
    global $modelPosts;
    $metaTitleMantan = 'Chi tiết khóa học';
    $modelcourse = $controller->loadModel('course');
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(3)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }
        $course = $modelcourse->find()->where($conditions)->first();
        setVariable('course', $course);

    }else{
        return $controller->redirect('/');
    }
    setVariable('listDatatop', $listDatatop);
}
function tool($input){
    global $modelPosts;
    global $settingThemes;
    global $controller;
    global $modelAlbuminfos;
    global $modelCategory;

    $modeltool = $controller->loadModel('products');
    
    $listDatatool = $modeltool->find()->all()->toList();
   
    setVariable('listDatatool', $listDatatool);
}
function postTheme($input)
{
    global $controller;
    global $modelCategories;

    

     // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

    

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('category_post', $category_post);
    
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $controller;
    global $modelCategories;

    

    // SẢN PHẨM MỚI
    $conditions = array();
    $limit = 6;
    $page = 1;
    $order = array('id'=>'desc');

 

    // DANH MỤC TIN TỨC
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();

   
    setVariable('category_post', $category_post);
}

function categoryAlbumTheme($input)
{

}

function categoryVideoTheme($input)
{

}

function albumTheme($input)
{
    
}

function videoTheme($input)
{
    
}

?>