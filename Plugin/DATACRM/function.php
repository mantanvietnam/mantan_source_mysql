<?php 


$menus= array();
$menus[0]['title']= "Mạng xã hội";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'',
                            'url'=>'',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listCustomerAdmin'
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

?>