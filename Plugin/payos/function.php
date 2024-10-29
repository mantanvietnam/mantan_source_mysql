<?php 
    $menus= array();
    $menus[0]['title']= 'PAYOS';
    $menus[0]['sub'][0]= array( 'title'=>'Cài đặt PAYOS',
                            'url'=>'/plugins/admin/payos-view-admin-settingpayos',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingpayos'
                        );

addMenuAdminMantan($menus);


include(__DIR__.'/library/payos/vendor/autoload.php');

use PayOS\PayOS;

// Keep your PayOS key protected by including it by an env variable

global $payOSClientId;
global $payOSApiKey;

global $payOSChecksumKey;

$payOSClientId = '';
$payOSApiKey = '';
$payOSChecksumKey = '';

$conditions = array('key_word' => 'settingPayos');
$settingPayos = $modelOptions->find()->where($conditions)->first();

if(!empty($settingPayos->value)){
    $data_value = json_decode($settingPayos->value, true);

    $payOSClientId = $data_value['client_id'];
    $payOSApiKey = $data_value['api_key'];
    $payOSChecksumKey = $data_value['checksum_key'];
}

$payOS = new PayOS($payOSClientId, $payOSApiKey, $payOSChecksumKey);


function checkpayos(){
    global $urlHomes;
    $YOUR_DOMAIN = $urlHomes;
    debug($payOS);
    debug($payOSClientId);
    debug($payOSApiKey);
    debug($payOSChecksumKey);
    die;


    $data = [
        "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
        "amount" => 2000,
        "description" => "Thanh toán đơn hàng",
        "items" => [
            0 => [
                'name' => 'Mì tôm Hảo Hảo ly',
                'price' => 2000,
                'quantity' => 1
            ]
        ],
        "returnUrl" => $YOUR_DOMAIN . "/success.html",
        "cancelUrl" => $YOUR_DOMAIN . "/cancel.html"
    ];

    $response = $payOS->createPaymentLink($data);

    return  $response;
}

//header("HTTP/1.1 303 See Other");
//header("Location: " . $response['checkoutUrl'])

    


?>