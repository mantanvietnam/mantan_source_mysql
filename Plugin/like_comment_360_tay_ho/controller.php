<?php
	/*Link*/
function addlike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;

    global $session;
    $infoUser = $session->read('infoUser');
    $modelLike = $controller->loadModel('Likes');
    $data = $modelLike->newEmptyEntity();
    if(!empty($_POST)){
        $data->created = getdate()[0];
        $data->idobject=$_POST['idobject'];
        $data->type=$_POST['type'];
        $data->idcustomer=$_POST['idcustomer'];
        $conditions = array('id'=>$data->idobject);
        $modelLike->save($data);
        $return = array('code'=>1,
                            'data' =>$data,
                            'messages'=>'ok'
            );
    }
        return $return;
}

function delelelike ($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
    $modelLike = $controller->loadModel('Likes');
    if(!empty($_POST)){
        $condition['idobject']=$_POST['idobject'];
        $condition['type']=$_POST['type'];
        $condition['idcustomer']=$_POST['idcustomer'];
        $data = $modelLike->find()->where($condition)->first();
        if(!empty($data)){
            $modelLike->delete($data);
            $return = array('code'=>1,
                            'messages'=>'ok'
            );
        }else{
                $return = array('code'=>2,
                        'messages'=>'không ok'
            );
            }
    }
    return $return;
        
}

function addComment($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $infoUser = $session->read('infoUser');
        $modelComment = $controller->loadModel('Comments');
        $data = $modelComment->newEmptyEntity();
       

        if(!empty($_POST)){
            $data->created = getdate()[0];
            $data->idobject=$_POST['idobject'];
            $data->type=$_POST['type'];
            $data->idcustomer=$_POST['idcustomer'];
            $data->comment=$_POST['comment'];

            $modelComment->save($data);
             $return = array('code'=>1, 
                'data'=>$data,
                'messages'=>'ok');
             }
        return $return;
}

function deleleComment($input){

    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelComments = $controller->loadModel('Comments');
        if(!empty($_POST)){
            $data = $modelComments->get($_POST['id']);
           $modelComments->delete($data);
             $return = array('code'=>1);
             }
        return $return;
        
}

function listCommentAdmin(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách Danh sách bình luận';
    $modelComment = $controller->loadModel('Comments');
    $conditions = array();
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
     if(!empty($_GET['name'])){
        $key=createSlugMantan($_GET['name']);

        $conditions['urlSlug LIKE']= '%'.$key.'%';
    }
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelComment->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelComment->find()->where($conditions_scan)->all()->toList();

            $listData[$key]->number_scan = count($static);
          

        }
    }

    // phân trang
    $totalData = $modelComment->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}

function deleleCommentAdmin($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    global $session;
    $mess ="ok";
    $infoUser = $session->read('infoUser');
        $modelComments = $controller->loadModel('Comments');
        if(!empty($_GET['id'])){
            $data = $modelComments->get($_GET['id']);

           $modelComments->delete($data);
             }
        return $controller->redirect('/plugins/admin/like_comment_360_tay_ho-admin-listCommentAdmin?status=3');
        
}

function listlikegetcustom($input){
    global $isRequestPost;
    global $modelUser;
    global $urlHomes;
    global $controller;
    $modelLike = $controller->loadModel('Likes');
    $conditions= array();
    $dataSend = $input['request']->getData();
    $conditions['idcustomer']= $dataSend['idcustomer'];
    $data = $modelLike->find()->where($conditions)->all();
    $listData = array();
    if(!empty($data)){
        foreach ($data as $item) {
        $custom =  getCustomer($item->idcustomer);
            if($item->type=="co_quan_hanh_chinh"){
                $Governance = getGovernanceAgency($item->idobject);
                if(!empty($Governance)){
                    $listData[]= array(
                        'id'=> @$Governance->id,
                        'name'=> @$Governance->name,
                        'address'=> @$Governance->address,
                        'image' =>@$Governance->image,
                        'type'=> "co_quan_hanh_chinh",
                    );
                }

            }elseif($item->type=="dich_vu_ho_tro_du_lich"){
                $Service = getService($item->idobject);
                if(!empty($Service)){
                   $listData[]= array(
                    'id'=> @$Service->id,
                    'name'=> @$Service->name,
                    'address'=> @$Service->address,
                    'image' =>@$Service->image,
                    'type'=> "dich_vu_ho_tro_du_lich",
                );
               }
            }elseif($item->type=="danh_lam"){
                $Place = getPlace($item->idobject);
                if(!empty($Place)){
                    $listData[]= array(
                        'id'=> @$Place->id,
                        'name'=> @$Place->name,
                        'address'=> @$Place->address,
                        'image' =>@$Place->image,
                        'type'=> "danh_lam",
                    );
                }
            }elseif($item->type=="le_hoi"){
                $Festival = getFestival($item->idobject);
                if(!empty($Festival)){
                   $listData[]= array(
                    'id'=> @$Festival->id,
                    'name'=> @$Festival->name,
                    'address'=> @$Festival->address,
                    'image' =>@$Festival->image,
                    'type'=> "le_hoi",
                    );
               }
            }elseif($item->type=="nha_hang"){
                $Restaurant = getRestaurant($item->idobject);
                if(!empty($Restaurant)){
                    $listData[]= array(
                        'id'=> @$Restaurant->id,
                        'name'=> @$Restaurant->name,
                        'address'=> @$Restaurant->address,
                        'image' =>@$Restaurant->image,
                        'type'=> "nha_hang",
                    );
                }
            }elseif($item->type=="tung_tam_hoi_nghi_su_kien"){
                $Eventcenter = getEventcenter($item->idobject);
                if(!empty($Eventcenter)){
                    $listData[]= array(
                        'id'=> @$Eventcenter->id,
                        'name'=> @$Eventcenter->name,
                        'address'=> @$Eventcenter->address,
                        'image' => @$Eventcenter->image,
                        'type'=> "tung_tam_hoi_nghi_su_kien",
                    );
                    }
            }elseif($item->type=="di_tich_lich_su"){
                $Historical = getHistoricalSite($item->idobject);
                if(!empty($Historical)){
                    $listData[]= array(
                        'id'=> @$Historical->id,
                        'name'=> @$Historical->name,
                        'address'=> @$Historical->address,
                        'image' => @$Historical->image,
                        'type'=> "di_tich_lich_su",
                    );
                }
            }elseif($item->type=="khach_san"){
                $Hotel = getHotel($item->idobject);
                if(!empty($Hotel)){
                    $listData[]= array(
                    'id'=> @$Hotel->id,
                    'name'=> @$Hotel->name,
                    'address'=> @$Hotel->address,
                    'image' => @$Hotel->image,
                    'type'=> "khach_san",
                    );
                }
            }elseif($item->type=="tour"){
                $tour = getTour($item->idobject);
                if(!empty($tour)){
                    $listData[]= array(
                    'id'=> @$tour->id,
                    'name'=> @$tour->name,
                    'address'=> @$tour->address,
                    'image' => @$tour->image,
                    'type'=> "tour",
                    );
                }
            }
        }
         $return = array('code'=>1,
                            'data' =>$listData,
                            'messages'=>'bạn lấy data thàng công'
            );

    }else{
       $return = array('code'=>2,
             'messages'=>'bạn lấy data không thàng công',
            );
    }

    return $return;
}

function Listcommentgetobject($input){
    global $controller;

    $modelComment = $controller->loadModel('Comments');
    $dataSend = $input['request']->getData();
    $conditions = array();
    $conditions['idobject']=$dataSend['idobject'];
    $conditions['type']=$dataSend['type'];
    $data = $modelComment->find()->where($conditions)->all();
    $listData = array();

    if(!empty($data)){
        foreach ($data as $item) {
        $custom =  getCustomer($item->idcustomer);
            $listData[] = array(
                    'id'=> $item->id,
                    'idcustomer'=> $item->idcustomer,
                    'idobject'=> $item->idobject,
                    'name'=> @$custom->full_name,
                    'comment'=> @$item->comment,
                    'type'=> @$item->type
            );


        }
    $return = array('code'=>1,
                            'data' =>$listData,
                            'messages'=>'bạn lấy data thàng công'
            );

    }else{
       $return = array('code'=>2,
             'messages'=>'bạn lấy data không thàng công',
            );
   }
   return $return;
}

function getLikeobjectAPI($input){
        global $modelOption;
        global $controller;
        $modelLike = $controller->loadModel('Likes');
        $conditions= array();
        $dataSend = $input['request']->getData();
        $conditions['idcustomer']= $dataSend['idcustomer'];
        $conditions['idobject']= $dataSend['idobject'];
        $conditions['type']= $dataSend['type'];
        $data = $modelLike->find()->where($conditions)->first();
        if(!empty($data)){

            $return = array('code'=>1 );
        }else{
            $return = array('code'=>0 );
        }
        
        return $return;
}

function replyCommentAdmin($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Danh sách Danh sách bình luận';
    $modelComment = $controller->loadModel('Comments');
    if(!empty($_GET['id'])){
        $data = $modelComment->get($_GET['id']);
        $data->reply = $_GET['reply'];
        $data->comment = $_GET['comment'];
        $data->updated_at = time();
        $modelComment->save($data);

         return $controller->redirect('/plugins/admin/like_comment_360_tay_ho-admin-listCommentAdmin?status=2');
    }else{
        return $controller->redirect('/plugins/admin/like_comment_360_tay_ho-admin-listCommentAdmin?status=4');
    }
}

?>