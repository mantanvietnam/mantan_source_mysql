<?php 
function createevent($input)
{

    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    global $session;
    global $urlHomes;
    
    $metaTitleMantan = 'Tạo sự kiến';

    $modelevent = $controller->loadModel('events');
    $mess = '';

    if(!empty($session->read('infoUser'))){
        $info = $session->read('infoUser');
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
                $link_ezpics = array('id_ezpics' => @$dataSend['id_ezpics'],
                    'value_name' => @$dataSend['value_name'],
                    'value_avatar' => @$dataSend['value_avatar'],
                    'value_phone' => @$dataSend['value_phone'],
                    'value_code' => @$dataSend['value_code'],
                );
                $data->link_ezpics = json_encode($link_ezpics);
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
                $mess = '<p class="text-success">Bạn đã tạo sự kiện và tạo vé mời thành công. 
                                                Hãy cùng chia sẻ sự kiện đến với mọi người</p>';
                return $controller->redirect('/createevent/?error=create_done');
            }else{
                $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
                return $controller->redirect('/createevent/?error=create_failed');
            }
        
        }
   
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }

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
    if(!empty($session->read('infoUser'))){
        $info = $session->read('infoUser');
        $order = array('id'=>'desc');
        $limit = 8;
        $conditions = array('id_member' => $info->id);
        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }
        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }
        $order = array('id' => 'desc');
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;


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
            ->where( $conditions)
            ->order($order)
            ->all()
            ->toList();

        $eventMap = [];
        foreach ($listDataevent as  $key => $event) {
            $listDataevent[$key]->attended_checkin = $modelattendedevent->find()->where(['id_events'=>$event->id, 'status'=>'Arrived'])->count('*');
            $listDataevent[$key]->attended_count = $modelattendedevent->find()->where(['id_events'=>$event->id])->count('*'); 
        }

        

        $totalData = $modelevents->find()->where($conditions)->all()->toList();
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
    }else{
        return $controller->redirect('/'); 
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
    $limit = 6;
    $conditions = array();
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $order = array('id'=>'desc');
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    $listdataevent =$modelevents->find()->limit($limit)->where($conditions)->page($page)->order($order)->all()->toList() ;
    $numberdata = count($listdataevent);
    $totalData = $modelevents->find()->where()->order($order)->all()->toList();
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
    $modelevents = $controller->loadModel('events');
    $modelMembers = $controller->loadModel('Members');

    $mess = '';
    
    if(!empty($_GET['id'])){
        $infoEvent = $modelevents->find()->where(['id' => (int) $_GET['id']])->first();

        $data =array();

        if(!empty($infoEvent)){
            $data_value = array();
             if(!empty($infoEvent->link_ezpics)){
                $data_value = json_decode($infoEvent->link_ezpics, true);
                $infoEvent->id_ezpics = @$data_value['id_ezpics'];
                $infoEvent->value_name = @$data_value['value_name'];
                $infoEvent->value_avatar = @$data_value['value_avatar'];
                $infoEvent->value_phone = @$data_value['value_phone'];
                $infoEvent->value_code = @$data_value['value_code'];

            }

            if ($isRequestPost) {
                $dataSend = $input['request']->getData();

                $data = $modelattendedevent->newEmptyEntity();

                

                if(!empty($dataSend['name']) && !empty($dataSend['phone']) && !empty($dataSend['email'])){
                    $dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        if(!empty($dataSend['phone'])){
                            $fileName = 'avatar_event'.$dataSend['phone'];
                        }else{
                            $fileName = 'avatar_event'.time().rand(0,1000000);
                        }

                        $banner = uploadImage($dataSend['phone'], 'avatar', $fileName);
                    }
                    if(!empty($banner['linkOnline'])){
                        $value = $banner['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->banner)){
                            $value = 'https://ai.phoenixtech.vn/plugins/phoenix_ai/view/home/assets/img/avatar-default-crm.png';
                        }
                    }

                    if(!empty($session->read('infoUser'))){
                        $checkMember = $session->read('infoUser');
                    }else{
                        $checkMember = $modelMembers->find()->where(['phone' => $dataSend['phone']])->first();
                        
                        if(empty($checkMember)){
                            // tạo người dùng mới
                            $checkMember = $modelMembers->newEmptyEntity();

                            $checkMember->name = $dataSend['name'];
                            $checkMember->phone = $dataSend['phone'];
                            $checkMember->email = $dataSend['email'];
                            $checkMember->pass = md5($dataSend['phone']);
                            $checkMember->status = 'active';
                            $checkMember->avatar = $value;
                            $checkMember->created_at = time();
                            $checkMember->last_login = time();
                            $checkMember->address = '';

                            $modelMembers->save($checkMember);
                        }

                        // thực hiện đăng nhập luôn
                        $session->write('infoUser', $checkMember);
                        
                        setcookie('id_member',$checkMember->id,time()+365*24*60*60, "/");
                    }

                    $checkAttendedEvent = $modelattendedevent->find()->where(['id_member' => $checkMember->id, 'id_events'=>(int) $_GET['id']])->first();

                    if(empty($checkAttendedEvent)){
                        $birthday = 0;
                        if(!empty($dataSend['date'])){
                            $birthday = (new DateTime($dataSend['date']))->getTimestamp();
                        }

                        $data->city = @$dataSend['city'];
                        $data->name = @$dataSend['name'];
                        $data->email = @$dataSend['email'];
                        $data->phone = @$dataSend['phone'];
                        $data->date = $birthday;
                        $data->code_checkin = codecheckin($infoEvent->id);    
                        $data->id_member = $checkMember->id;
                        $data->avatar = $checkMember->avatar;
                        $data->status = 'Pending';
                        $data->id_events = (int) $_GET['id'];
                        $data->sex = @$dataSend['sex'];

                         $link = "https://designer.ezpics.vn/create-image-series/?id=";

                        if(!empty($infoEvent->id_ezpics)){
                            $link .= $infoEvent->id_ezpics;
                        }
                        if(!empty($infoEvent->value_name)){
                            $link .= '&'.$infoEvent->value_name.'='.$data->name;
                        }

                        if(!empty($infoEvent->value_avatar)){
                            $link .= '&'.$infoEvent->value_avatar.'='.$data->avatar;
                        }

                        if(!empty($infoEvent->value_phone)){
                            $link .= '&'.$infoEvent->value_phone.'='.$data->phone;
                        }
                        if(!empty($infoEvent->value_code)){
                             $link .= '&'.$infoEvent->value_code.'='.$data->code_checkin;
                        }
                        if(!empty($infoEvent->id_ezpics)){
                            $data->invitation = $link;
                        }
                        $modelattendedevent->save($data);

                        $mess = '<p class="text-success">Đăng ký tham gia thành công</p>';
                        if(!empty($dataSend['email'])){
                            sendEmailCodeCheckin($dataSend['email'],$infoEvent,$data->code_checkin,$data);
                        }

                    }else{
                        $mess = '<p class="text-danger">Bạn đã đăng ký sự kiện này rồi</p>';
                        $data = @$checkAttendedEvent;
                    }
                }else{
                    $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
                }
            }
            
            setVariable('mess', $mess);
            setVariable('data', $data);
            setVariable('infoEvent', $infoEvent);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }

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

    if(!empty($session->read('infoUser')) && !empty($_GET['id'])){
        $info = $session->read('infoUser');
        $modelattendedevent = $controller->loadModel('attendedevent');
        $modelMembers = $controller->loadModel('Members');
        $modelEvents = $controller->loadModel('events');
        $checkEvents = $modelEvents->find()->where(['id'=>$_GET['id'],'id_member'=>$info->id])->first();

        if(empty($checkEvents)){
            return $controller->redirect('/');
        }

        $limit = 20;
        $conditions = ['id_events'=>$checkEvents->id];
        if(!empty($_GET['code_checkin'])){
            $conditions['code_checkin'] = $_GET['code_checkin'];
        }

        if(!empty($_GET['phone'])){
            $conditions['id_member'] =  $modelMembers->find()->where(['phone'=>$_GET['phone']])->first()->id;
            if(empty($conditions['id_member'])){
                $conditions['phone LIKE'] = '%'. $_GET['phone'].'%';
            }
        }
        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }
        $order = array('id'=>'desc');
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelattendedevent->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Mã checkin', 'type'=>'text', 'width'=>25],
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Giới tính', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'chưa checkin';
                    if($value->status=='active'){ 
                        $status= 'dã checkin';
                    }

                    $dataExcel[] = [
                        $value->code_checkin,   
                        $value->name,   
                        $value->phone,   
                        $value->address,   
                        $value->email,   
                        $value->sex,
                        $status,
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }
        

       
        $listdataattendedevent = $modelattendedevent->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();



        if($listdataattendedevent){
            foreach($listdataattendedevent as $key => $item){
                $listdataattendedevent[$key]->infoMember= $modelMembers->find()->where(['id'=>$item->id_member])->first();
            }
        }


        $numberdata = $modelattendedevent->find()->where(['id_events'=>$checkEvents->id])->count('*');
        $attended_checkin = $modelattendedevent->find()->where(['id_events'=>$checkEvents->id,'status'=>'Arrived'])->count('*');


        $totalData = $modelattendedevent->find()->where($conditions)->count('*');

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

        $mess = '';
        if(!empty($_GET['mess'])){
            if($_GET['mess']=='checkin'){
                $mess= '<p class="text-danger">Check in thành công</p>';
            }
        }
        setVariable('numberdata', $numberdata);
        setVariable('dataEvent', $checkEvents);
        setVariable('mess', $mess);
        setVariable('attended_checkin', $attended_checkin);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('listdataattendedevent', $listdataattendedevent);
    }else{
        return $controller->redirect('/');
    }
}

function checkinMember($input){
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
    if(!empty($session->read('infoUser')) && !empty($_GET['id_events']) && !empty($_GET['id'])) {
        $info = $session->read('infoUser');
        $modelattendedevent = $controller->loadModel('attendedevent');
        $modelEvents = $controller->loadModel('events');
        $checkEvents = $modelEvents->find()->where(['id'=>$_GET['id_events'],'id_member'=>$info->id])->first();

        if(empty($checkEvents)){
            return $controller->redirect('/');
        }

        $conditions = ['id_events'=>$checkEvents->id, 'id'=>$_GET['id']];

        $data = $modelattendedevent->find()->where($conditions)->first();
        if(!empty($data)){
            $data->status = 'Arrived';
            $modelattendedevent->save($data);
            return $controller->redirect('/manageevent?code_checkin='.$data->code_checkin.'&id='.$checkEvents->id.'&mess=checkin');
        }
        return $controller->redirect('/');
    }else{
         return $controller->redirect('/');
    }
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

function editevent($input){
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelOptions;
    global $session;
    global $urlHomes;
     if(!empty($session->read('infoUser'))){
    $info = $session->read('infoUser');
    $metaTitleMantan = 'Sửa sự kiện';

    $modelevent = $controller->loadModel('events');
    $mess = '';
    if(!empty($_GET['id'])){
        $data = $modelevent->get( (int) $_GET['id']);
    }else{
        $data = $modelevent->newEmptyEntity();
    }
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['name'])){
            $data->address = @$dataSend['address'];
            $data->name = @$dataSend['name'];
            $data->time_start = (new DateTime($dataSend['time_start']))->getTimestamp();
            $data->id_member = @$dataSend['id_member'];

            if(!empty($_FILES['banner']) && empty($_FILES['banner']["error"])){
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
            $link_ezpics = array('id_ezpics' => @$dataSend['id_ezpics'],
                'value_name' => @$dataSend['value_name'],
                'value_avatar' => @$dataSend['value_avatar'],
                'value_phone' => @$dataSend['value_phone'],
                'value_code' => @$dataSend['value_code'],
            );
            $data->link_ezpics = json_encode($link_ezpics);
           
            $modelevent->save($data);
            $mess = '<p class="text-success">Đã sửa sự kiện thành công</p>';
           
        }else{
            $mess = '<p class="text-danger">Gửi thiếu dữ liệu</p>';
          
        }
        
    }

    $data_value = array();
    if(!empty($data->link_ezpics)){
        $data_value = json_decode($data->link_ezpics, true);
        $data->id_ezpics = @$data_value['id_ezpics'];
        $data->value_name = @$data_value['value_name'];
        $data->value_avatar = @$data_value['value_avatar'];
        $data->value_phone = @$data_value['value_phone'];
        $data->value_code = @$data_value['value_code'];

    }
    setVariable('data', $data);
    setVariable('mess', $mess);
    }else{
        return $controller->redirect('/');
    }

}

function checkinUser($input){
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
    if(!empty($_GET['id_event'])) {
        $modelattendedevent = $controller->loadModel('attendedevent');
        $modelEvents = $controller->loadModel('events');
        $modelMembers = $controller->loadModel('Members');
        $checkEvents = $modelEvents->find()->where(['id'=>$_GET['id_event']])->first();

        if(empty($checkEvents)){
            return $controller->redirect('/');
        }
        $data = '';
        $mess = '';
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            $conditions = array('id_events'=>$checkEvents->id);
            if(!empty($dataSend['phone'])){
                $conditions['id_member'] =  $modelMembers->find()->where(['phone'=>$dataSend['phone']])->first()->id;
                if(empty($conditions['id_member'])){
                    $conditions['phone'] = $dataSend['phone'];
                }

                $data = $modelattendedevent->find()->where($conditions)->first();
                if(!empty($data)){
                    $data->status = 'Arrived';
                    $modelattendedevent->save($data);
                    $data->info = $modelMembers->find()->where(['id'=>$data->id_member])->first();
                    $mess= 'Bạn checkin thành công';
                }else{
                    $mess= 'Bạn sai số điện thoại hoặc mã Check in ';
                }
            }
        }

        setVariable('dataEvent', $checkEvents);        
        setVariable('data', $data);        
        setVariable('mess', $mess);        
    }else{
         return $controller->redirect('/');
    }
}

?>