<?php 
global $price_remove_background;
global $price_create_content;
global $name_bank;
global $number_bank;
global $account_holders_bank;
global $link_qr_bank;
global $key_transaction;
global $keyFirebase;
global $urlCreateImage;
global $price_pro;

//$urlCreateImage = 'http://14.225.238.137:3000/convert';
$urlCreateImage = 'http://171.244.16.76:3000/convert';

$number_bank = '06931228668';
$name_bank = 'Tiên Phong Bank (TPB)';
$account_holders_bank = 'Trần Ngọc Mạnh';
$link_qr_bank = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/link_qr_bank.jpg';
$key_transaction = 'ezpics';

$menus= array();
$menus[0]['title']= 'Exc-go';

$menus[0]['sub'][6]= array('title'=>'Cài đặt Font chữ',
                            'url'=>'/plugins/admin/ezpics_api-view-admin-font-listFontAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingsEzpics',
                        );


$menus[1]['title']= 'Thành viên';

$menus[1]['sub'][0]= array('title'=>'Thông tin thành viên',
                            'url'=>'/plugins/admin/exc_go-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listMemberAdmin',
                        );

addMenuAdminMantan($menus);


$price_remove_background = 0;
$price_create_content = 1000;
$price_pro = 999000;

$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function removeBackground($link_image_local='',$create_new= false)
{
    if(!empty($link_image_local)){
        if(function_exists('getKey')){
            $key_remove_bg = getKey(23);
        }else{
            $key_remove_bg = '';
        }
        
        if(!empty($key_remove_bg)){
            include('library/guzzle/vendor/autoload.php');

            // Requires "guzzle" to be installed (see guzzlephp.org)
            // If you have problems with our SSL certificate getting the error 'Uncaught GuzzleHttp\Exception\RequestException: cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://api.remove.bg/v1.0/removebg'
            // follow these steps to use the latest cacert certificate for cURL: https://github.com/guzzle/guzzle/issues/1935#issuecomment-371756738

            $client = new GuzzleHttp\Client();
            $res = $client->post('https://api.remove.bg/v1.0/removebg', [
                'multipart' => [
                    [
                        'name'     => 'image_file',
                        'contents' => fopen(__DIR__.'/../../'.$link_image_local, 'r')
                    ],
                    [
                        'name'     => 'size',
                        'contents' => 'auto'
                    ]
                ],
                'headers' => [
                    'X-Api-Key' => $key_remove_bg
                ]
            ]);

            if($create_new){
                $link = explode('.', $link_image_local);
                $n = count($link)-1;
                $link_image_local = str_replace('.'.$link[$n], '', $link_image_local).'_rb.'.$link[$n];
            }

            $fp = fopen(__DIR__.'/../../'.$link_image_local, "wb");
            
            fwrite($fp, $res->getBody());
            fclose($fp);
        }
    }

    return $link_image_local;
}

function process_add_money($number=0, $order_id=0)
{
    global $modelOption;
    global $key_transaction;
    global $controller;

    $number = (int) $number;
    $order_id = (int) $order_id;

    if($number>=1000){
        $modelOrder = $controller->loadModel('Orders');
        $modelMember = $controller->loadModel('Members');

        if(!empty($order_id)){
            $checkOrder = $modelOrder->find()->where(array('id'=> $order_id))->first();
            
            if(!empty($checkOrder)){
                $data = $modelMember->find()->where(array('id'=>$checkOrder->member_id))->first();

                if(!empty($data)){
                    // cập nhập số dư tài khoản
                    $data->account_balance += $number;
                    $modelMember->save($data);
                    
                    // cập nhập lại trạng thái đơn hàng
                    $checkOrder->total = $number;
                    $checkOrder->status = 2; // 2: đã xử lý xong
                    $checkOrder->updated_at = date('Y-m-d H:i:s');
                    
                    $modelOrder->save($checkOrder);

                    // gửi email
                    if(!empty($data->email) && !empty($data->name)){
                        sendEmailAddMoney($data->email, $data->name, $number);
                    }

                    // gửi thông báo về app
                    $dataSendNotification= array('title'=>'Nạp tiền thành công Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Nạp thành công '.number_format($number).'đ vào tài khoản '.$data->phone,'action'=>'addMoneySuccess');

                    if(!empty($data->token_device)){
                        sendNotification($dataSendNotification, $data->token_device);
                    }

                    return 'Nạp tiền thành công cho tài khoản '.$data->phone;
                
                }else{
                    return 'Tài khoản '.$data->phone.' không tồn tại';
                }
            }else{
                return 'Không tìm thấy yêu cầu nạp tiền có ID là '.$order_id;
            }
        }else{
            return 'Nội dung sai cú pháp';
        }
    }else{
        return 'Số tiền nạp phải lớn hơn 1.000đ';
    }
}

function sendEmailAddMoney($email='', $fullName='', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Ezpics</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
                .logo{

                }
                .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
                .nd{background: white;max-width: 750px;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
                .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
                .main{padding: 10px 20px;}
                .thong_tin{padding: 0 20px 20px;}
                .line{position: relative;height: 2px;}
                .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
                .cty{text-align:  center;margin: 20px 0 30px;}
                .main .fa{color:green;}
                table{margin:auto;}
                @media screen and (max-width: 768px){
                    .bao{margin:0;}
                }
                @media screen and (max-width: 767px){
                    .bao{padding:6px; }
                    .nd{text-align: inherit;}
                }
            </style>
        </head>
        <body>
            <div class="bao">
                <div class="nd">
                    <div class="head">
                        <span>NẠP TIỀN '.number_format($coin).'Đ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống <a href="https://ezpics.vn">https://ezpics.vn</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng thiết kế hình ảnh Ezpics</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://ezpics.vn">https://ezpics.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailCodeForgotPassword($email='', $fullName='', $code= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Mã xác thực cấp lại mật khẩu mới';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Ezpics</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
                .logo{

                }
                .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
                .nd{background: white;max-width: 750px;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
                .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
                .main{padding: 10px 20px;}
                .thong_tin{padding: 0 20px 20px;}
                .line{position: relative;height: 2px;}
                .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
                .cty{text-align:  center;margin: 20px 0 30px;}
                .main .fa{color:green;}
                table{margin:auto;}
                @media screen and (max-width: 768px){
                    .bao{margin:0;}
                }
                @media screen and (max-width: 767px){
                    .bao{padding:6px; }
                    .nd{text-align: inherit;}
                }
            </style>
        </head>
        <body>
            <div class="bao">
                <div class="nd">
                    <div class="head">
                        <span>MÃ XÁC THỰC</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$code.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng thiết kế hình ảnh Ezpics</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://ezpics.vn">https://ezpics.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function listBank()
{
    return [
            ['id'=>1, 'name'=>'An Bình', 'code'=>'ABBANK'],
            ['id'=>2, 'name'=>'ANZ Việt Nam', 'code'=>'ANZVL'],
            ['id'=>3, 'name'=>'Á Châu', 'code'=>'ACB'],
            ['id'=>4, 'name'=>'Bắc Á', 'code'=>'Bac A Bank'],
            ['id'=>5, 'name'=>'Bản Việt', 'code'=>'Viet Capital Bank'],
            ['id'=>6, 'name'=>'Bảo Việt', 'code'=>'BAOVIET Bank'],
            ['id'=>7, 'name'=>'Bưu điện Liên Việt', 'code'=>'LienVietPostBank'],
            ['id'=>8, 'name'=>'Chính sách xã hội Việt Nam', 'code'=>'VBSP'],
            ['id'=>9, 'name'=>'CIMB Việt Nam', 'code'=>'CIMB'],
            ['id'=>10, 'name'=>'Công thương Việt Nam', 'code'=>'VietinBank'],
            ['id'=>11, 'name'=>'Dầu khí toàn cầu', 'code'=>'GPBank'],
            ['id'=>12, 'name'=>'Đại Chúng Việt Nam', 'code'=>'PVcomBank'],
            ['id'=>13, 'name'=>'Đại Dương', 'code'=>'OceanBank'],
            ['id'=>14, 'name'=>'Đầu tư và Phát triển Việt Nam', 'code'=>'BIDV'],
            ['id'=>15, 'name'=>'Đông Á', 'code'=>'DongA Bank'],
            ['id'=>16, 'name'=>'Đông Nam Á', 'code'=>'SeABank'],
            ['id'=>17, 'name'=>'Hàng Hải', 'code'=>'MSB'],
            ['id'=>18, 'name'=>'Hong Leong Việt Nam', 'code'=>'HLBVN'],
            ['id'=>19, 'name'=>'Hợp tác xã Việt Nam', 'code'=>'Co-opBank'],
            ['id'=>20, 'name'=>'HSBC Việt Nam', 'code'=>'HSBC'],
            ['id'=>21, 'name'=>'Indovina', 'code'=>'IVB'],
            ['id'=>22, 'name'=>'Kiên Long', 'code'=>'Kienlongbank'],
            ['id'=>23, 'name'=>'Kỹ Thương', 'code'=>'Techcombank'],
            ['id'=>24, 'name'=>'Liên doanh Việt Nga', 'code'=>'VRB'],
            ['id'=>25, 'name'=>'Nam Á', 'code'=>'Nam A Bank'],
            ['id'=>26, 'name'=>'Ngoại Thương Việt Nam', 'code'=>'Vietcombank'],
            ['id'=>27, 'name'=>'NN&PT Nông thôn Việt Nam', 'code'=>'Agribank'],
            ['id'=>28, 'name'=>'Phát triển Thành phố Hồ Chí Minh', 'code'=>'HDBank'],
            ['id'=>29, 'name'=>'Phát triển Việt Nam', 'code'=>'VDB'],
            ['id'=>30, 'name'=>'Phương Đông', 'code'=>'OCB'],
            ['id'=>31, 'name'=>'Public Bank Việt Nam', 'code'=>'PBVN'],
            ['id'=>32, 'name'=>'Quân Đội', 'code'=>'MB'],
            ['id'=>33, 'name'=>'Quốc dân', 'code'=>'NCB'],
            ['id'=>34, 'name'=>'Quốc Tế', 'code'=>'VIB'],
            ['id'=>35, 'name'=>'Sài Gòn', 'code'=>'SCB'],
            ['id'=>36, 'name'=>'Sài Gòn – Hà Nội', 'code'=>'SHB'],
            ['id'=>37, 'name'=>'Sài Gòn Công Thương', 'code'=>'SAIGONBANK'],
            ['id'=>38, 'name'=>'Sài Gòn Thương Tín', 'code'=>'Sacombank'],
            ['id'=>39, 'name'=>'Shinhan Việt Nam', 'code'=>'SHBVN'],
            ['id'=>40, 'name'=>'Standard Chartered Việt Nam', 'code'=>'SCBVL'],
            ['id'=>41, 'name'=>'Tiên Phong', 'code'=>'TPBank'],
            ['id'=>42, 'name'=>'UOB Việt Nam', 'code'=>'UOB'],
            ['id'=>43, 'name'=>'Việt Á', 'code'=>'VietABank'],
            ['id'=>44, 'name'=>'Việt Nam Thịnh Vượng', 'code'=>'VPBank'],
            ['id'=>45, 'name'=>'Việt Nam Thương Tín', 'code'=>'Vietbank'],
            ['id'=>46, 'name'=>'Woori Việt Nam', 'code'=>'Woori'],
            ['id'=>47, 'name'=>'Xăng dầu Petrolimex', 'code'=>'PG Bank'],
            ['id'=>48, 'name'=>'Xây dựng', 'code'=>'CB'],
            ['id'=>49, 'name'=>'Xuất Nhập Khẩu', 'code'=>'Eximbank'],
            
            ];
}

function sendNotification($data,$target){
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content']];
    
    if(is_array($target)){
        $fields['registration_ids'] = $target;
    }else{
        $fields['to'] = $target;
    }

    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$keyFirebase
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {

    }
    curl_close($ch);

    return $result;
}



function getGianchu()
{
    return [
        'normal'=>'Bình thường',
        '1vw'=>'Giãn 1%',
        '2vw'=>'Giãn 2%',
        '3vw'=>'Giãn 3%',
        '4vw'=>'Giãn 4%',
        '5vw'=>'Giãn 5%',
    ];
}


?>