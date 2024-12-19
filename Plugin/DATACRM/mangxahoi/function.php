<?php 


$menus= array();
$menus[0]['title']= "Mạng xã hội";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Cài đặt keyword nhạy cảm',
                            'url'=>'/plugins/admin/mangxahoi-view-admin-keyword-listkeywordAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listkeywordAdmin'
                        );



addMenuAdminMantan($menus);


function getSubComment($id_father, $modelComment,$modelCustomer){
     $listData = $modelComment->find()->where(['id_father'=>$id_father])->all()->toList();
     $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
            $listData[$key]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
        }
    }

    return $listData;
}


function deletelikeIdObject($id_object, $keyword){
    global $controller;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');

    $conditions = ['id_object IN'=>$id_object,'keyword'=>$keyword];
    $modelLike->deleteAll($conditions);
    return 'ok';
}

function deleteCommentIdObject($id_object, $keyword){
    global $controller;
    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');

    $conditions = ['id_object IN'=>$id_object,'keyword'=>$keyword];
    $modelComment->deleteAll($conditions);
    return 'ok';
}

function checkKeyword($keyword){
    global $controller;
     $modelKeyword = $controller->loadModel('Keywords');
     $listData = $modelKeyword->find()->where(array())->order(['id'=>'desc'])->all()->toList();
     if(!empty($listData) && !empty($keyword)){
        foreach($listData as $key => $item){
            $keyword =  str_replace($item->keyword, $item->replacement, $keyword);
        }
     }
    return $keyword;
}


function saveNotification($notification, $id_user, $id=null){
    global $controller;
    if(is_array($id_user)){
        foreach($id_user as $key => $item){
            $id_user[$key] ='"'.$item.'"';
        }
    }else{
         $id_user = ['"'.$id_user.'"'];
    }
    $modelNotification = $controller->loadModel('Notifications');
    $data = $modelNotification->newEmptyEntity();
    $data->id_user = implode(',', $id_user);
    $data->title = $notification['title'];
    $data->created_at = time();
    $data->action = $notification['action'];
    $data->content = $notification['content'];
    $data->id_object = $id;
    $modelNotification->save($data);
    return $data;
}
?>