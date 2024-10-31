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
global $payOS;

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


function checkpayos($amount= 0,$description=''){
    global $urlHomes;
    global $payOSClientId;
    global $payOSApiKey;
    global $payOSChecksumKey;
    global $payOS;
    $YOUR_DOMAIN = $urlHomes;
    $data = [
        "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
        "amount" => $amount,
        "description" => $description,
        "items" => [],
        "returnUrl" => $YOUR_DOMAIN . "/success.html",
        "cancelUrl" => $YOUR_DOMAIN . "/cancel.html"
    ];

    $response = $payOS->createPaymentLink($data);

    return  $response;
}

//header("HTTP/1.1 303 See Other");
//header("Location: " . $response['checkoutUrl'])

    


?>