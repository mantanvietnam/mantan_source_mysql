<?php 
function listSceneAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách bối cảnh';

    $modelInfoScene = $controller->loadModel('InfoScenes');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }

    if(!empty($_GET['moth'])){
        $conditions['moth'] = $_GET['moth'];
        
    }
    
    $listData = $modelInfoScene->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



    // phân trang
    $totalData = $modelInfoScene->find()->where($conditions)->all()->toList();
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

function addSceneAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin bối cảnh';

    $modelInfoScene = $controller->loadModel('InfoScenes');
    $mess= '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelInfoScene->get( (int) $_GET['id']);
    }else{
        $data = $modelInfoScene->newEmptyEntity();
         $data->time =time();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title_vi'])){

            /*$today= getdate();
            $datePost = explode('/', $dataSend['time_create']);
                
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }*/
            // tạo dữ liệu save
            $data->code = $dataSend['code'];
            $data->title_vi = $dataSend['title_vi'];
            $data->title_en = $dataSend['title_en'];
            $data->title_cn = $dataSend['title_cn'];
            $data->lat = $dataSend['lat'];
            $data->lng = $dataSend['lng'];
            $data->image = $dataSend['image'];
            $data->audio_vi = $dataSend['audio_vi'];
            $data->audio_en = $dataSend['audio_en'];
            $data->audio_cn = $dataSend['audio_cn'];
            $data->hlookat = $dataSend['hlookat'];
            $data->vlookat = $dataSend['vlookat'];
            $data->fovtype = $dataSend['fovtype'];
            $data->fov = $dataSend['fov'];
            $data->maxpixelzoom = $dataSend['maxpixelzoom'];
            $data->fovmin = $dataSend['fovmin'];
            $data->fovmax = $dataSend['fovmax'];
            $data->status = (int) $dataSend['status'];
            $data->info_vn = $dataSend['info_vn'];
            $data->info_en = $dataSend['info_en'];
            $data->info_cn = $dataSend['info_cn'];

            // debug($data);
            // die();

            $modelInfoScene->save($data); 

            if(!empty(createXML())){
                 $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                 $mess= '<p class="text-danger">Bạn bị lỗi xml</p>';
            }   
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteSceneAdmin($input){
    global $controller;

    $modelInfoScene = $controller->loadModel('InfoScenes');
    
    if(!empty($_GET['id'])){
        $data = $modelInfoScene->get($_GET['id']);
        
        if($data){
            $modelInfoScene->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/project-view-admin-InfoScene-listInfoSceneAdmin');
}

function listPlugPointAdmin($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách điểm cắm';

    $modelPlugPoint = $controller->loadModel('PlugPoints');
    $modelInfoScene = $controller->loadModel('InfoScenes');

    if(!empty($_GET['id_scene'])){
        $InfoScene = $modelInfoScene->find()->where(array('id'=> (int) $_GET['id_scene']))->first();
        if(empty($InfoScene)){
            return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
    }
    

    $conditions = array('id_scene'=>$_GET['id_scene']);
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'asc');

   
    
    $listData = $modelPlugPoint->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->InfoScene =  $modelInfoScene->find()->where(array('code'=> $item->code))->first();
        }
    }



    // phân trang
    $totalData = $modelPlugPoint->find()->where($conditions)->all()->toList();
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

function addPlugPointAdmin($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Thông tin điểm cắm';

    $modelPlugPoint = $controller->loadModel('PlugPoints');
    $mess= '';

    $modelInfoScene = $controller->loadModel('InfoScenes');

    if(!empty($_GET['id_scene'])){
        $InfoScene = $modelInfoScene->find()->where(array('id'=> (int) $_GET['id_scene']))->first();
        if(empty($InfoScene)){
            return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
    }

    // lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelPlugPoint->get( (int) $_GET['id']);
    }else{
        $data = $modelPlugPoint->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['code'])){

            /*$today= getdate();
            $datePost = explode('/', $dataSend['time_create']);
                
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }*/
            // tạo dữ liệu save $InfoScene
            $data->code = $dataSend['code'];
            $data->icon = $dataSend['icon'];
            $data->hlookat = $dataSend['hlookat'];
            $data->vlookat = $dataSend['vlookat'];
            $data->status = (int) $dataSend['status'];
            $data->id_scene = (int)$InfoScene->id;
            $data->note = '';

            // debug($data);
            // die();

            $modelPlugPoint->save($data); 

            if(!empty(createXML())){
                 $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                 $mess= '<p class="text-danger">Bạn bị lỗi xml</p>';
            }   
        }else{
            $mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin</p>';
        }
    }

    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deletePlugPointAdmin($input){
    global $controller;

    $modelPlugPoint = $controller->loadModel('PlugPoints');

    $modelInfoScene = $controller->loadModel('InfoScenes');

    if(!empty($_GET['id_scene'])){
        $InfoScene = $modelInfoScene->find()->where(array('id'=> (int) $_GET['id_scene']))->first();
        if(empty($InfoScene)){
            return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
        }
    }else{
        return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin');
    }
    
    if(!empty($_GET['id'])){
        $data = $modelPlugPoint->get($_GET['id']);
        
        if($data){
            $modelPlugPoint->delete($data);
            deleteSlugURL($data->slug);
        }
    }

    return $controller->redirect('/plugins/admin/QuanLyAnh360-view-admin-plugpoint-listPlugPointAdmin?id_scene='.$_GET['id_scene']);
}

function setingPathAdmin($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingPathAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'path' => @$dataSend['path'],
                    );
        $data->key_word = 'setingPathAdmin';
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
?>