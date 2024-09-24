<?php 
function settingHomececad($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';
    $conditions = array('key_word' => 'settingHomececad');
    
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $value = array(
            'logo' =>$dataSend['logo'],
            'slide_home' => $dataSend['slide_home'],
   
            // 
            'title2'=>$dataSend['title2'],
            'countnumber1'=>$dataSend['countnumber1'],
            'contentnumber1' => $dataSend['contentnumber1'],
            'countnumber2'=>$dataSend['countnumber2'],
            'contentnumber2' => $dataSend['contentnumber2'],
            'countnumber3'=>$dataSend['countnumber3'],
            'contentnumber3' => $dataSend['contentnumber3'],
            'countnumber4'=>$dataSend['countnumber4'],
            'contentnumber4' => $dataSend['contentnumber4'],
            'countnumber5'=>$dataSend['countnumber5'],
            'contentnumber5' => $dataSend['contentnumber5'],
            // 
            'facebook'=>$dataSend['facebook'],
            'youtube'=>$dataSend['youtube'],
            // 
            'titlesmall'=>$dataSend['titlesmall'],
            'titlelarge'=>$dataSend['titlelarge'],
            'contenttitle4'=>$dataSend['contenttitle4'],

            'imageactionbeetween'=>$dataSend['imageactionbeetween'],
            // 
            'titlesmal5'=>$dataSend['titlesmal5'],
            'titlelarge5'=>$dataSend['titlelarge5'],
            // 
            'titlesmal6'=>$dataSend['titlesmal6'],
            'titlelarge6'=>$dataSend['titlelarge6'],
            // 
            'slide_partner'=>$dataSend['slide_partner'],
            'titlenlock7'=>$dataSend['titlenlock7'],
            'titlelogofooter'=>$dataSend['titlelogofooter'],
            'address'=>$dataSend['address'],
            'email'=>$dataSend['email'],
            'phone'=>$dataSend['phone'],
            // 
            'imagecontact'=>$dataSend['imagecontact'],
            'map'=>$dataSend['map'],
            'imageheadercontact'=>$dataSend['imageheadercontact'],
            // 
            'logofooter' =>$dataSend['logofooter'],


            //
            'imagebannernews' =>$dataSend['imagebannernews'],
            'imagebannerproject' =>$dataSend['imagebannerproject'],

        );
    $data->key_word = 'settingHomececad';
	$data->value = json_encode($value);
	$modelOptions->save($data);
	$mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    setVariable('data', $data_value);
    setVariable('mess', $mess);
}
function settingAboutusTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    $metaTitleMantan = 'Cài đặt giao diện About ';
    $mess= '';
    $conditions = array('key_word' => 'settingAboutusTheme');
    
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $value = array(
            'bannerhome'=>$dataSend['bannerhome'],
            'titlebanner1'=>$dataSend['titlebanner1'],
            'titlebanner2'=>$dataSend['titlebanner2'],
            'buttonbanner'=>$dataSend['buttonbanner'],
            'contentdeepbanner1'=>$dataSend['contentdeepbanner1'],
            'imageleftabout'=>$dataSend['imageleftabout'],
            'Vision'=>$dataSend['Vision'],
            'bannerfull'=>$dataSend['bannerfull'],
            'ttd'=>$dataSend['ttd'],
            'doimoi'=>$dataSend['doimoi'],
            'ppln'=>$dataSend['ppln'],
            'hieuqua'=>$dataSend['hieuqua'],
          'imagettd'=>$dataSend['imagettd'],
          'imagedm'=>$dataSend['imagedm'],
          'imageppln'=>$dataSend['imageppln'],
          'imagehq'=>$dataSend['imagehq'],
          
// 


// 
        

//            
            'titleteam'=>$dataSend['titleteam'],
            'bannerteam'=>$dataSend['bannerteam'],
            'contenteam'=>$dataSend['contenteam'],
            'namebuttonteam'=>$dataSend['namebuttonteam'],
            'idslidedau'=>$dataSend['idslidedau'],
            'idslidehai'=>$dataSend['idslidehai'],
            'idslideba'=>$dataSend['idslideba'],
            'idslidebon'=>$dataSend['idslidebon'],
            'idslidenam'=>$dataSend['idslidenam'],
  
            // 
            'idslidevolunteers'=>$dataSend['idslidevolunteers'],
      
           
          

// 
            'titlevolunteers'=>$dataSend['titlevolunteers'],
            'bannervolunteers'=>$dataSend['bannervolunteers'],
            'contenvolunteer'=>$dataSend['contenvolunteer'],
            'namebuttonvolunteer'=>$dataSend['namebuttonvolunteer'],
      
        

        );

        $data->key_word = 'settingAboutusTheme';
        $data->value = json_encode($value);
        $modelOptions->save($data);
        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    setVariable('data', $data_value);
    setVariable('mess', $mess);
}
function Aboutus($input){
    global $controller;
    global $modelOptions;
    global $metaTitleMantan;
    global $modelAlbuminfos;
    global $data;
    global $settingThemes;
    global $modelAlbums;
    global $category;
    $order = array('id' => 'desc');
    $metaTitleMantan = 'Trang About';

    $conditions = array('key_word' => 'settingAboutusTheme');
    $modelfield = $controller->loadModel('field');
    $data = $modelOptions->find()->where($conditions)->first();

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $slide_partner = [];
    if(!empty($settingThemes['slide_partner'])){
        $slide_partner = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['slide_partner']])->all()->toList();
    }
    $listDatafield = $modelfield->find()->order($order)->all()->toList();
    setVariable('slide_partner', $slide_partner);
    setVariable('listDatafield', $listDatafield);
    setVariable('setting', $data_value);
   
}
function team($input){
    global $controller;
    global $modelOptions;
    global $metaTitleMantan;
    global $modelAlbuminfos;
    global $data;
    global $modelAlbums;
    $metaTitleMantan = 'Trang team';
    $order = array('id'=>'desc');
    $conditions = array('key_word' => 'settingAboutusTheme');
    $data = $modelOptions->find()->where($conditions)->first();

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
 
    $slide_dau = [];
    if(!empty($data_value['idslidedau'])){
        $slide_dau = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslidedau']])->order($order)->all()->toList();
    }

    $slide_hai = [];
    if(!empty($data_value['idslidehai'])){
        $slide_hai = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslidehai']])->order($order)->all()->toList();
    }
    $slide_ba = [];
    if(!empty($data_value['idslideba'])){
        $slide_ba = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslideba']])->order($order)->all()->toList();
    }
    $slide_bon = [];
    if(!empty($data_value['idslidebon'])){
        $slide_bon = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslidebon']])->order($order)->all()->toList();
    }
    $slide_nam = [];
    if(!empty($data_value['idslidenam'])){
        $slide_nam = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslidenam']])->order($order)->all()->toList();
    }
    $modeltitlealbum1 = $modelAlbums->find()->where(['id' => (int)$data_value['idslidedau']])->first();
    $modeltitlealbum2 = $modelAlbums->find()->where(['id' => (int)$data_value['idslidehai']])->first();
    $modeltitlealbum3 = $modelAlbums->find()->where(['id' => (int)$data_value['idslideba']])->first();
    $modeltitlealbum4 = $modelAlbums->find()->where(['id' => (int)$data_value['idslidebon']])->first();
    $modeltitlealbum5 = $modelAlbums->find()->where(['id' => (int)$data_value['idslidenam']])->first();
    setVariable('modeltitlealbum1', $modeltitlealbum1);
    setVariable('modeltitlealbum2', $modeltitlealbum2);
    setVariable('modeltitlealbum3', $modeltitlealbum3);
    setVariable('modeltitlealbum4', $modeltitlealbum4);
    setVariable('modeltitlealbum5', $modeltitlealbum5);
    setVariable('slide_dau', $slide_dau);
    setVariable('slide_hai', $slide_hai);
    setVariable('slide_ba', $slide_ba);
    setVariable('slide_bon', $slide_bon);
    setVariable('slide_nam', $slide_nam);
    setVariable('setting', $data_value);
   
}
function volunteers($input){
    global $controller;
    global $modelOptions;
    global $metaTitleMantan;
    global $modelAlbuminfos;
    global $data;
    global $modelAlbums;
    $metaTitleMantan = 'Trang volunteers';

    $conditions = array('key_word' => 'settingAboutusTheme');
    $data = $modelOptions->find()->where($conditions)->first();

     $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
 
    $slide_volunteers = [];
    if(!empty($data_value['idslidevolunteers'])){
        $slide_volunteers = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['idslidevolunteers']])->all()->toList();
    }
    $modeltitlealbum1 = $modelAlbums->find()->where(['id' => (int)$data_value['idslidevolunteers']])->first();

    setVariable('modeltitlealbum1', $modeltitlealbum1);
    setVariable('slide_volunteers', $slide_volunteers);
    setVariable('setting', $data_value);
   
}
function indexTheme($input){
    global $modelAlbums;
	global $modelOptions;
	global $modelNotices;
	global $modelPosts;
	global $modelAlbuminfos;
	global $settingThemes;
    global $controller;
    global $modelCategories;
	$conditions = array('key_word' => 'settingHomececad');

    $modelproduct_projects = $controller->loadModel('ProductProjects');
    $modelfield = $controller->loadModel('field');
    $order = array('id'=>'desc');
    $listDataproduct_projects= $modelproduct_projects->find()->limit(4)->order($order)->all()->toList();



    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
   
    $slide_home = [];
    if(!empty($settingThemes['slide_home'])){
        $slide_home = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['slide_home']])->all()->toList();
    }
    $order = array('id'=>'desc');
    $listDatatop= $modelPosts->find()->limit(4)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    $listDataPost= $modelPosts->find()->limit(12)->where(array('type'=>'post'))->order($order)->all()->toList();

    $slide_partner = [];
    if(!empty($settingThemes['slide_partner'])){
        $slide_partner = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['slide_partner']])->all()->toList();
    }

    $listDataslugproject= $modelCategories->find()->limit(6)->where(array('type'=>'category_kind'))->order($order)->all()->toList();
    
    $listDatafield= $modelfield->find()->order($order)->all()->toList();
    setVariable('listDatafield', $listDatafield);

    setVariable('listDataproduct_projects', $listDataproduct_projects);
    setVariable('listDataPost', $listDataPost);
    setVariable('listDatatop', $listDatatop);
    setVariable('slide_home', $slide_home);
    setVariable('slide_partner', $slide_partner);
    setVariable('listDataslugproject',$listDataslugproject);
}

function categoryPostTheme($input){
    global $modelPosts;
    global $modelCategories;
    global $category;
    $conditions = array('type' => 'post');
    $category_post = $modelCategories->find()->where($conditions)->all()->toList();
    $order = array('id'=>'desc');
    $listDatatop2= $modelPosts->find()->limit(2)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    $listDatatop= $modelPosts->find()->limit(12)->where(array('pin'=>1, 'type'=>'post'))->order($order)->all()->toList();
    setVariable('listDatatop2', $listDatatop2);
    setVariable('listDatatop', $listDatatop);
    setVariable('category_post', $category_post);
}
function field($input){
    global $modelPosts;
    global $modelCategories;
    global $category;
    global $controller;
   
   
    $order = array('id'=>'asc');
    $modelfield = $controller->loadModel('field');
    $listDatafield= $modelfield->find()->order($order)->all()->toList();

    setVariable('listDatafield', $listDatafield);
    
   
}
function categoryAlbumTheme($input)
{
    global $modelAlbums;
	global $modelOptions;
	global $modelNotices;
	global $modelPosts;
	global $modelAlbuminfos;
	global $settingThemes;
    global $controller;
    $conditions = array('key_word' => 'settingHomececad');


}
function categoryVideoTheme($input)
{
    global $modelVideos;
	global $modelOptions;
	global $settingThemes;
    global $controller;
    $conditions = array('key_word' => 'settingHomececad');
    
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $category_videos = $modelVideos->find()->all()->toList();
    setVariable('category_videos', $category_videos);

}

function albumTheme($input)
{
    
}
function publication($input){
    global $controller; 
    global $modelOptions;
    global $metaTitleMantan;
    global $modelpublication;
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
    $modelpublication = $controller->loadModel('Publication');
    $order = array('id' => 'desc');
    $listDatapublication= $modelpublication->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
    
    $totalData = $modelpublication->find()->where($conditions)->all()->toList();
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
    setVariable('listDatapublication', $listDatapublication);
    


}

function project($input){
    global $controller; 
    global $modelOptions;
    global $metaTitleMantan;
    global $modelpublication;
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
    $modelproject = $controller->loadModel('ProductProjects');
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


    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listDataproject', $listDataproject);
}
// function projectDetail($input){
//     global $controller;
//     global $modelOptions;
//     global $modelCategories;
//     global $urlCurrent;
//     global $metaTitleMantan;
//     global $metaKeywordsMantan;
//     global $metaDescriptionMantan;
//     global $metaImageMantan;
//     global $session;
//     $metaTitleMantan = 'Chi tiết dự án';
//     $modelproduct_projects = $controller->loadModel('ProductProjects');
//     $order = array('id'=>'desc');
//     $listDataproduct_projects= $modelproduct_projects->find()->limit(3)->order($order)->all()->toList();
//     setVariable('listDataproduct_projects', $listDataproduct_projects);
    
// }
function detailfield($input){
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

    $metaTitleMantan = 'Chi tiết lĩnh lực';
    $modelfield = $controller->loadModel('field');
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }


        
        $field = $modelfield->find()->where($conditions)->first();
        setVariable('field', $field);

    }else{
        return $controller->redirect('/');
    }
}
function detailpublication($input){
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

    $metaTitleMantan = 'Chi tiết ấn phẩm';
    $modelpublication = $controller->loadModel('publication');
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }


        
        $publication = $modelpublication->find()->where($conditions)->first();
        setVariable('publication', $publication);

    }else{
        return $controller->redirect('/');
    }
}

?>