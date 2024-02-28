<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/crm_ligi-admin-settingHomeTheme',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );



addMenuAdminMantan($menus);

function setting(){
    global $controller;
    global $modelOptions;
    $conditions = array('key_word' => 'settingHomeTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    return $data_value;
}

function getCategorieProduct(){
    global $modelCategories;
    $conditionCategorieProduct = array('type' => 'category_product','status'=>'active');
    return  $modelCategories->find()->where($conditionCategorieProduct)->all()->toList();
}

function sendZNSDataBot($data, $product_name, $name_system, $agency)
{
    // gửi Zalo đơn hàng
    $urlZNS = 'https://quantri.databot.vn/sendZNS309784';
    $dataZNS = ['phone'=> $data->phone,
                'customer_name' => $data->full_name,
                'order_code' => 'OD'.$data->id,
                'payment_status' => 'Chờ thanh toán',
                'product_name' => $product_name,
                'author' => $name_system,
                'cost' => $data->money,
                'note' => 'Đơn hàng của đại lý '.$agency
                ];

    $mesZNS = sendDataConnectMantan($urlZNS, $dataZNS);
}
?>