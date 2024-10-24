<?php 
function listLibrary($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Library';

    $modelLibrary = $controller->loadModel('Librarys');

    $conditions = array();
    $limit = 2;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelLibrary->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelLibrary->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}

function listAlbum($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    $conditions['id_category'] = 8;

    $category = $modelCategories->find()->where(['id'=>8,'type'=>'album'])->first();

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
        $slug = $slug[0];
        // $slug = explode('-', $slug);
        // $count = count($slug)-1;
        // $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['slug'=>$slug])->first();
        if(!empty($data)){
            $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
       
    }else{
        $data = $modelAlbums->find()->where($conditions)->first();
        if(!empty($data)){
        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }

     setVariable('data', $data);
     setVariable('category', $category);
        setVariable('listData', $listData);

}

function projectPhoto($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    $conditions['id_category'] = 9;

    $category = $modelCategories->find()->where(['id'=>9,'type'=>'album'])->first();

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
        $slug = $slug[0];
        // $slug = explode('-', $slug);
        // $count = count($slug)-1;
        // $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['slug'=>$slug])->first();
        if(!empty($data)){
        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
       
    }else{
        $data = $modelAlbums->find()->where($conditions)->first();

        if(!empty($data)){
        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    setVariable('data', $data);
    setVariable('category', $category);
    setVariable('listData', $listData);

}

function eventPhoto($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    $conditions['id_category'] = 19;

    $category = $modelCategories->find()->where(['id'=>19,'type'=>'album'])->first();

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
        $slug = $slug[0];
        // $slug = explode('-', $slug);
        // $count = count($slug)-1;
        // $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['slug'=>$slug])->first();
        
        if(!empty($data)){
        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
       
    }else{
        $data = $modelAlbums->find()->where($conditions)->first();

        if(!empty($data)){
        $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    setVariable('data', $data);
    setVariable('category', $category);
    setVariable('listData', $listData);

}

function thematicVideo($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    $conditions['id_category'] = 12;

    $category = $modelCategories->find()->where(['id'=>12,'type'=>'album'])->first();

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
        $slug = $slug[0];
        // $slug = explode('-', $slug);
        // $count = count($slug)-1;
        // $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['slug'=>$slug])->first();

        if(!empty($data)){
           $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList(); 
        }
        


        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
       
    }else{
        $data = $modelAlbums->find()->where($conditions)->first();

        if(!empty($data)){
            $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    setVariable('data', $data);
    setVariable('category', $category);
    setVariable('listData', $listData);

}

function projectVideo($input){
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;


    $conditions = array();
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    $conditions['id_category'] = 13;

    $category = $modelCategories->find()->where(['id'=>13,'type'=>'album'])->first();

    if(!empty($input['request']->getAttribute('params')['pass'][1])){
        $slug = explode('.html', $input['request']->getAttribute('params')['pass'][1]);
        $slug = $slug[0];
        // $slug = explode('-', $slug);
        // $count = count($slug)-1;
        // $id = (int) $slug[$count];

        $data = $modelAlbums->find()->where(['slug'=>$slug])->first();

        if(!empty($data)){
            $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
       
    }else{
        $data = $modelAlbums->find()->where($conditions)->first();

        if(!empty($data)){
            $data->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>$data->id])->all()->toList();
        }

        $listData = $modelAlbums->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    setVariable('data', $data);
    setVariable('category', $category);
    setVariable('listData', $listData);

}

function mediapres($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách mediapres';

    $modelMediapre = $controller->loadModel('mediapres');

    $conditions = array('status'=>1);
    $limit = 10;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelMediapre->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelMediapre->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}

function media($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelOptions;

    $modelMediapre = $controller->loadModel('mediapres');
    $order = array('id'=>'desc');
    $conditions = array('key_word' => 'settingMediaAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    $media = $modelMediapre->find()->where(['status'=>1])->order($order)->all()->toList();


    $data_value = json_decode($data->value, true);

    $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    
    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['id_album']])->all()->toList();
    }


    setVariable('slide_home', $slide_home);
    setVariable('data_value', $data_value);
    setVariable('media', $media);

}

function aboutus($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelOptions;

    $modelProjects = $controller->loadModel('Projects');

    $conditions = array('key_word' => 'settingAboutusAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $Project = $modelProjects->find()->where(['status'=>'active'])->all()->toList();


    $data_value = json_decode($data->value, true);

    $slide_home = $modelAlbums->find()->where(['id'=>(int)$data_value['id_album']])->first();

    
    if(!empty($slide_home)){
        $slide_home->imageinfo = $modelAlbuminfos->find()->where(['id_album'=>(int)$data_value['id_album']])->all()->toList();
    }


    setVariable('slide_home', $slide_home);
    setVariable('data_value', $data_value);
    setVariable('Project', $Project);
}

function opportunities($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách opportunities';

    $modelOpportunities = $controller->loadModel('opportunities');

    $conditions = array('status'=>1,'type'=>'opportunities');
    $limit = 70;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelOpportunities->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelOpportunities->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}

function warmteam($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelOptions;


    $conditions = array('key_word' => 'sttingWarmteamAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data = json_decode($data->value, true);

    setVariable('data', $data);
}

function ourproject($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelPosts;
    global $controller;
    global $settingThemes;
    global $modelOptions;

    $modelProjects = $controller->loadModel('Projects');
    $modelMediapre = $controller->loadModel('mediapres');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }

        $data = $modelProjects->find()->where($conditions)->first();

        $listPhoto = $modelAlbuminfos->find()->where(['id_album'=>@$data->id_photo])->all()->toList();
        $Photo = $modelAlbums->find()->where(['id'=>@$data->id_photo])->first();
        $listVideo = $modelAlbuminfos->find()->where(['id_album'=>@$data->id_video])->all()->toList();
        $listPosts =array();
        if(!empty($data->id_post)){
            $id_post = explode(',', @$data->id_post);
            foreach($id_post as $key => $item){
                $Posts = $modelPosts->find()->where(['id'=>@$item])->first();
                 if(!empty($Posts)){
                    $listPosts[$key] = $Posts;
                }
            }
        }
       
        $listPosts2 =array();
        if(!empty($data->id_post2)){
            $id_post2 = explode(',', @$data->id_post2);
            foreach($id_post2 as $k => $item){
            $Mediapre = $modelMediapre->find()->where(['id'=>@$item])->first();
                if(!empty($Mediapre)){
                    $listPosts2[$k] = $Mediapre;
                }
            }
            
        }

        setVariable('data', $data);
        setVariable('listPhoto', $listPhoto);
        setVariable('Photo', $Photo);
        setVariable('listVideo', $listVideo);
        setVariable('listPosts', $listPosts);
        setVariable('listPosts2', $listPosts2);

    }else{
        return $controller->redirect('/');
    }
}

function international($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách International';

    $modelOpportunities = $controller->loadModel('opportunities');

    $conditions = array('status'=>1,'type'=> 'international');
    $limit = 70;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelOpportunities->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelOpportunities->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}
function currentInternational($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách International';

    $modelOpportunities = $controller->loadModel('opportunities');

    $conditions = array('status'=>1,'type'=> 'currentinternational');
    $limit = 70;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelOpportunities->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelOpportunities->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}
function currentOpportunities($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách International';

    $modelOpportunities = $controller->loadModel('opportunities');

    $conditions = array('status'=>1,'type'=> 'currentOpportunities');
    $limit = 70;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(isset($_GET['status'])){
        if($_GET['status']!=''){
            $conditions['status'] = $_GET['status'];
        }
    }
    
    $listData = $modelOpportunities->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelOpportunities->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}
?>