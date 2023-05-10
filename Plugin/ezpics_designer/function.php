<?php 
$menus= array();
$menus[0]['title']= 'Ezpics';

$menus[0]['sub'][0]= array('title'=>'Thông tin đăng ký design',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-designRegistration-listDesignRegistrationAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
                        );
$menus[0]['sub'][1]= array('title'=>'Thông tin Người dùng',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
                        );
$menus[0]['sub'][2]= array('title'=>'Order mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-orderProduct-listOrderProductAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
                        );
addMenuAdminMantan($menus);

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function getCustomer($id){
    global $modelOption;
    global $controller;
    $modelCustomer = $controller->loadModel('customers');
        $data = $modelCustomer->find()->where(['id'=>intval($id)])->first();       
        return $data;
}


?>

