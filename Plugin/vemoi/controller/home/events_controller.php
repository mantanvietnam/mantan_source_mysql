<?php 
function createevent($input)
{

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    global $session;
    global $urlHomes;
    $info = $session->read('infoUser');
    $metaTitleMantan = 'Tạo sự kiến';

    $modelevent = $controller->loadModel('events');
    $mess = '';
    if ($isRequestPost) {

        $dataSend = $input['request']->getData();

        $data = $modelevent->newEmptyEntity();

        if(!empty($dataSend['name'])){
            $data->address = @$dataSend['address'];
            $data->name = @$dataSend['name'];

            $data->banner = @$dataSend['banner'];
            $data->time_start = (new DateTime($dataSend['time_start']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];

            if(isset($_FILES['banner']) && empty($_FILES['banner']["error"])){
                if(!empty($data->id)){
                    $fileName = 'banner_event'.$data->id;
                }else{
                    $fileName = 'banner_event'.time().rand(0,1000000);
                }

                $banner = uploadImage($info->id, 'banner', $fileName);
            }
            if(!empty($banner['linkOnline'])){
                $data->banner = $banner['linkOnline'].'?time='.time();
            }else{
                if(empty($data->banner)){
                    $data->banner = $urlHomes.'/plugins/vemoi/view/home/assets/img/default-thumb.jpg';
                }
            }


            $data->status = @$dataSend['status'];
            $data->outfits = @$dataSend['outfits'];
            $data->plan = @$dataSend['plan'];
            $data->rule = @$dataSend['rule'];
            $data->info = @$dataSend['info'];
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                	$conditions = array('slug'=>$slugNew);
        			$listData = $modelevent->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

        			if(!empty($listData)){
        				$number++;
        				$slugNew = $slug.'-'.$number;
        			}
                }while (!empty($listData));
            }
            $data->slug = $slugNew;
            $modelevent->save($data);
            $mess = '<p class="text-success">Tạo sự kiện thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
        
    }

    setVariable('mess', $mess);
}
function detailevent($input){
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
    $info = $session->read('infoUser');

    $metaTitleMantan = 'Chi tiết sự kiện';
    
    $modelevents = $controller->loadModel('events');
    $modelattendedevent = $controller->loadModel('attendedevent');
    $order = array('id'=>'desc');
    $listDataevent= $modelevents->find()->where(['show_on_homepage' => 1])->order($order)->all()->toList();
    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }


        
        $events = $modelevents->find()->where($conditions)->first();
        $isRegistered = false;
        if (!empty($info)) {
            $isRegistered = $modelattendedevent->exists([
                'id_member' => $info->id,
                'id_events' => $events->id,
            ]);
        }
        if(!empty($info)){
            setVariable('info', $info);
        }
        setVariable('isRegistered', $isRegistered);
        setVariable('listDataevent', $listDataevent);
        setVariable('events', $events);

    }else{
        return $controller->redirect('/');
    }
}
function myevent($input){
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
    $modelevents = $controller->loadModel('events');
    $modelattendedevent = $controller->loadModel('attendedevent');
    $info = $session->read('infoUser');
    $order = array('id'=>'desc');
    $limit = 8;
    $conditions = array();
    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $order = array('id' => 'desc');
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if(!empty($info->id)){
        $listdataattendedevent = $modelattendedevent->find()
        ->select(['attendedevent.id', 'attendedevent.id_member', 'event.id','event.banner','event.time_start', 'event.name', 'event.address', 'event.slug'])
        ->join([
            'table' => 'events', 
            'alias' => 'event',
            'type' => 'INNER',
            'conditions' => 'event.id = attendedevent.id_events', 
        ])
        ->where(['attendedevent.id_member' => $info->id]) 
        ->order(['event.id' => 'desc'])
        ->all()
        ->toList();
    

    $listDataevent = $modelevents->find()
        ->where(['id_member' => $info->id], $conditions)
        ->order($order)
        ->all()
        ->toList();

    $eventMap = [];
    foreach ($listDataevent as $event) {
        $eventMap[$event->id] = $event;
        $eventMap[$event->id]->attended_count = 0; 
    }

    $counts = $modelattendedevent->find()
        ->select(['id_events', 'count' => $modelattendedevent->find()->func()->count('*')])
        ->where(['id_events IN' => array_keys($eventMap)]) 
        ->group('id_events')
        ->all();


    foreach ($counts as $count) {
        if (isset($eventMap[$count->id_events])) {
            $eventMap[$count->id_events]->attended_count = $count->count;
        }
    }

    $totalData = $modelevents->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
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
    setVariable('eventMap', $eventMap);
    setVariable('listdataattendedevent', $listdataattendedevent);
    setVariable('listDataevent', $listDataevent);
    }
    
  
    
}
function allevent($input){
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
    $info = $session->read('infoUser');
    $modelevents = $controller->loadModel('events');
    $limit = 8;
    $conditions = array();
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $order = array('id'=>'desc');
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $listdataevent = $modelevents->find()->where()->order($order)->all()->toList();
    $numberdata = count($listdataevent);
    $totalData = $modelevents->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
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
    if(!empty($info)){
        setVariable('info', $info);
    }
    setVariable('numberdata', $numberdata);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listdataevent', $listdataevent);
}
function participate($input){
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
    $modelattendedevent = $controller->loadModel('attendedevent');
    $mess = '';
    if ($isRequestPost) {

        $dataSend = $input['request']->getData();

        $data = $modelattendedevent->newEmptyEntity();

        if(!empty($dataSend['name'])){
            $data->city = @$dataSend['city'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->date = (new DateTime($dataSend['date']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];
            $data->status = @$dataSend['status'];
            $data->id_events = isset($_GET['id']) ? $_GET['id'] : null;
            $data->sex = @$dataSend['sex'];


            $modelattendedevent->save($data);
            $mess = '<p class="text-success">đăng ký tham gia thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }

        
    }
    setVariable('mess', $mess);

}
function manageevent($input){
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
    $modelattendedevent = $controller->loadModel('attendedevent');
    $limit = 8;
    $conditions = array();
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $order = array('id'=>'desc');
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $listdataattendedevent = $modelattendedevent->find()->where(['id_events'=>$id])->order($order)->all()->toList();
    $numberdata = count($listdataattendedevent);
    $totalData = $modelattendedevent->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList();
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
    setVariable('numberdata', $numberdata);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('listdataattendedevent', $listdataattendedevent);
}

function editmanagerevent($input){
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
    $modelattendedevent = $controller->loadModel('attendedevent');
    $mess = '';
    if(!empty($_GET['id'])){
        $data = $modelattendedevent->get( (int) $_GET['id']);
    }else{
        $data = $modelattendedevent->newEmptyEntity();
    }
    if ($isRequestPost) {

        $dataSend = $input['request']->getData();

        $data = $modelattendedevent->newEmptyEntity();

        if(!empty($dataSend['name'])){
            $data->city = @$dataSend['city'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->date = (new DateTime($dataSend['date']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];
            $data->status = @$dataSend['status'];
            $data->id_events =@$dataSend['id_events'] ;
            $data->sex = @$dataSend['sex'];
            $modelattendedevent->save($data);
            $mess = '<p class="text-success">sửa thông tin người dùng thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }

        
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}
function infomanagerevent($input){
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
    $modelattendedevent = $controller->loadModel('attendedevent');
    $mess = '';
    if(!empty($_GET['id'])){
        $data = $modelattendedevent->get( (int) $_GET['id']);
    }else{
        $data = $modelattendedevent->newEmptyEntity();
    }
    if ($isRequestPost) {

        $dataSend = $input['request']->getData();

        $data = $modelattendedevent->newEmptyEntity();

        if(!empty($dataSend['name'])){
            $data->city = @$dataSend['city'];
            $data->name = @$dataSend['name'];
            $data->email = @$dataSend['email'];
            $data->date = (new DateTime($dataSend['date']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];
            $data->status = @$dataSend['status'];
            $data->id_events = isset($_GET['id']) ? $_GET['id'] : null;
            $data->sex = @$dataSend['sex'];
            $modelattendedevent->save($data);
            $mess = '<p class="text-success">đăng ký tham gia thành công</p>';
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }

        
    }
    setVariable('data', $data);
    setVariable('mess', $mess);
}
?>