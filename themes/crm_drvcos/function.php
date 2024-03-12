<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/crm_drvcos-admin-settingHomeThemeCRMZikii.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeThemeCRMZikii'
                        );

addMenuAdminMantan($menus);

global $setting_value;
global $modelOptions;

$conditions = array('key_word' => 'settingHomeThemeCRMZikii');
$settingHomeThemeCRMZikii = $modelOptions->find()->where($conditions)->first();

$setting_value = array();
if(!empty($settingHomeThemeCRMZikii->value)){
    $setting_value = json_decode($settingHomeThemeCRMZikii->value, true);
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