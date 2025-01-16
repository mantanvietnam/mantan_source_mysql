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
global $code_bank;

global $listBank;
    $listBank = [
        ['id' => 1, 'name' => 'An Bình', 'code' => 'ABBANK'],
        ['id' => 2, 'name' => 'ANZ Việt Nam', 'code' => 'ANZVL'],
        ['id' => 3, 'name' => 'Á Châu', 'code' => 'ACB'],
        ['id' => 4, 'name' => 'Bắc Á', 'code' => 'Bac A Bank'],
        ['id' => 5, 'name' => 'Bản Việt', 'code' => 'Viet Capital Bank'],
        ['id' => 6, 'name' => 'Bảo Việt', 'code' => 'BAOVIET Bank'],
        ['id' => 7, 'name' => 'Bưu điện Liên Việt', 'code' => 'LienVietPostBank'],
        ['id' => 8, 'name' => 'Chính sách xã hội Việt Nam', 'code' => 'VBSP'],
        ['id' => 9, 'name' => 'CIMB Việt Nam', 'code' => 'CIMB'],
        ['id' => 10, 'name' => 'Công thương Việt Nam', 'code' => 'VietinBank'],
        ['id' => 11, 'name' => 'Dầu khí toàn cầu', 'code' => 'GPBank'],
        ['id' => 12, 'name' => 'Đại Chúng Việt Nam', 'code' => 'PVcomBank'],
        ['id' => 13, 'name' => 'Đại Dương', 'code' => 'OceanBank'],
        ['id' => 14, 'name' => 'Đầu tư và Phát triển Việt Nam', 'code' => 'BIDV'],
        ['id' => 15, 'name' => 'Đông Á', 'code' => 'DongA Bank'],
        ['id' => 16, 'name' => 'Đông Nam Á', 'code' => 'SeABank'],
        ['id' => 17, 'name' => 'Hàng Hải', 'code' => 'MSB'],
        ['id' => 18, 'name' => 'Hong Leong Việt Nam', 'code' => 'HLBVN'],
        ['id' => 19, 'name' => 'Hợp tác xã Việt Nam', 'code' => 'Co-opBank'],
        ['id' => 20, 'name' => 'HSBC Việt Nam', 'code' => 'HSBC'],
        ['id' => 21, 'name' => 'Indovina', 'code' => 'IVB'],
        ['id' => 22, 'name' => 'Kiên Long', 'code' => 'Kienlongbank'],
        ['id' => 23, 'name' => 'Kỹ Thương', 'code' => 'Techcombank'],
        ['id' => 24, 'name' => 'Liên doanh Việt Nga', 'code' => 'VRB'],
        ['id' => 25, 'name' => 'Nam Á', 'code' => 'Nam A Bank'],
        ['id' => 26, 'name' => 'Ngoại Thương Việt Nam', 'code' => 'Vietcombank'],
        ['id' => 27, 'name' => 'NN&PT Nông thôn Việt Nam', 'code' => 'Agribank'],
        ['id' => 28, 'name' => 'Phát triển Thành phố Hồ Chí Minh', 'code' => 'HDBank'],
        ['id' => 29, 'name' => 'Phát triển Việt Nam', 'code' => 'VDB'],
        ['id' => 30, 'name' => 'Phương Đông', 'code' => 'OCB'],
        ['id' => 31, 'name' => 'Public Bank Việt Nam', 'code' => 'PBVN'],
        ['id' => 32, 'name' => 'Quân Đội', 'code' => 'MB'],
        ['id' => 33, 'name' => 'Quốc dân', 'code' => 'NCB'],
        ['id' => 34, 'name' => 'Quốc Tế', 'code' => 'VIB'],
        ['id' => 35, 'name' => 'Sài Gòn', 'code' => 'SCB'],
        ['id' => 36, 'name' => 'Sài Gòn – Hà Nội', 'code' => 'SHB'],
        ['id' => 37, 'name' => 'Sài Gòn Công Thương', 'code' => 'SAIGONBANK'],
        ['id' => 38, 'name' => 'Sài Gòn Thương Tín', 'code' => 'Sacombank'],
        ['id' => 39, 'name' => 'Shinhan Việt Nam', 'code' => 'SHBVN'],
        ['id' => 40, 'name' => 'Standard Chartered Việt Nam', 'code' => 'SCBVL'],
        ['id' => 41, 'name' => 'Tiên Phong', 'code' => 'TPBank'],
        ['id' => 42, 'name' => 'UOB Việt Nam', 'code' => 'UOB'],
        ['id' => 43, 'name' => 'Việt Á', 'code' => 'VietABank'],
        ['id' => 44, 'name' => 'Việt Nam Thịnh Vượng', 'code' => 'VPBank'],
        ['id' => 45, 'name' => 'Việt Nam Thương Tín', 'code' => 'Vietbank'],
        ['id' => 46, 'name' => 'Woori Việt Nam', 'code' => 'Woori'],
        ['id' => 47, 'name' => 'Xăng dầu Petrolimex', 'code' => 'PG Bank'],
        ['id' => 48, 'name' => 'Xây dựng', 'code' => 'CB'],
        ['id' => 49, 'name' => 'Xuất Nhập Khẩu', 'code' => 'Eximbank'],

    ];



$payOSClientId = '';
$payOSApiKey = '';
$payOSChecksumKey = '';
$code_bank = '';

$conditions = array('key_word' => 'settingPayos');
$settingPayos = $modelOptions->find()->where($conditions)->first();

if(!empty($settingPayos->value)){
    $data_value = json_decode($settingPayos->value, true);

    $payOSClientId = @$data_value['client_id'];
    $payOSApiKey = @$data_value['api_key'];
    $payOSChecksumKey = @$data_value['checksum_key'];
    $code_bank = @$data_value['code_bank'];
}

$payOS = new PayOS($payOSClientId, $payOSApiKey, $payOSChecksumKey);


function checkpayos($amount= 0,$description=''){
    global $urlHomes;
    global $payOSClientId;
    global $payOSApiKey;
    global $payOSChecksumKey;
    global $payOS;
    global $code_bank;
    global $listBank;
    $YOUR_DOMAIN = $urlHomes;
    $amount = (int)$amount;
    $data = [
        "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
        "amount" => $amount,
        "description" => $description,
        "items" => [],
        "returnUrl" => $YOUR_DOMAIN . "/success.html",
        "cancelUrl" => $YOUR_DOMAIN . "/cancel.html"
    ];

    $response = $payOS->createPaymentLink($data);
    if(!empty($listBank)){
        foreach($listBank as $key => $item){
            if(@$code_bank==$item['code']){ 
                $response['code_bank'] = $item['name'].' ('.$item['code'].')';
            }
        }
    }else{
        $response['code_bank'] = $code_bank;
    }
    

    return  $response;
}

//header("HTTP/1.1 303 See Other");
//header("Location: " . $response['checkoutUrl'])

    

?>