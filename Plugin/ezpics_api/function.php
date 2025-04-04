<?php 
use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

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
global $price_warehouses;
global $price_min_create_warehouses;
global $recommenders;

$urlsCreateImage = [
                    //'http://171.244.16.76:3000/convert',
                    //'http://14.225.53.136:3000/convert',
                    //'http://14.225.53.107:3000/convert',
                    //'http://171.244.16.94:3001/convert',
                    //'http://18.136.118.45:3001//convert',
                    'http://103.74.123.203:3000/convert',
                    ];
$randIndex = array_rand($urlsCreateImage);
$urlCreateImage = $urlsCreateImage[$randIndex];

include(__DIR__.'/library/jwt/vendor/autoload.php');
use Firebase\JWT\JWT;


include(__DIR__.'/library/client/vendor/autoload.php');
use GuzzleHttp\Client;

//$urlCreateImage = 'http://171.244.16.76:3000/convert';

$number_bank = '06931228668';
$name_bank = 'Tiên Phong Bank (TPB)';
$account_holders_bank = 'Trần Ngọc Mạnh';
$link_qr_bank = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/link_qr_bank.jpg';
$key_transaction = 'ezpics';

$menus= array();
$menus[0]['title']= 'Ezpics';
$menus[0]['sub'][6]= array('title'=>'Cài đặt Font chữ',
                            'url'=>'/plugins/admin/ezpics_api-view-admin-font-listFontAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingsEzpics',
                        );
addMenuAdminMantan($menus);


$price_remove_background = 0;
$price_create_content = 1000;
$price_pro = 1999000;
$price_warehouses = 999000;
$recommenders = 5;
$price_min_create_warehouses = 300000;

$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';
$projectId = 'ezpics-91e75';

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function getMemberByToken($token='')
{
    global $controller;

    $modelMember = $controller->loadModel('Members');
    $checkData = [];

    if(!empty($token)){
        $conditions = [ 'OR' => [
                                    ['token'=>$token],
                                    ['token_web'=>$token]
                                ]
                        ];
        $checkData = $modelMember->find()->where($conditions)->first();
    }

    return $checkData;
}

function removeBackground($link_image_local='',$create_new= false)
{
    //$linkImage = removeBackgroundRemoveBG($link_image_local, $create_new);
    $linkImage = removeBackgroundPhotoroom($link_image_local, $create_new);
    $linkLocalNew = __DIR__.'/../../'.$linkImage;

    //cropAutoImagePNG($linkLocalNew, $linkLocalNew);

    //zipImage($linkLocalNew);
    
    return $linkImage;
}

function removeBackgroundRemoveBG($link_image_local='',$create_new= false)
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

function removeBackgroundPhotoroom($link_image_local='',$create_new= false)
{
    if(!empty($link_image_local)){
        if(function_exists('getKey')){
            $key_remove_bg = getKey(38);
        }else{
            $key_remove_bg = '';
        }
        
        if(!empty($key_remove_bg)){
            include('library/guzzle/vendor/autoload.php');

            $client = new GuzzleHttp\Client();
            
            try {
                $res = $client->post('https://sdk.photoroom.com/v1/segment', [
                    'multipart' => [
                        [
                            'name'     => 'image_file',
                            'contents' => fopen(__DIR__.'/../../'.$link_image_local, 'r')
                        ]
                    ],
                    'headers' => [
                        'x-api-key' => $key_remove_bg
                    ]
                ]);

                $http_status = $res->getStatusCode();

                if ($http_status == 200) {
                    if($create_new){
                        $link = explode('.', $link_image_local);
                        $n = count($link)-1;
                        $link_image_local = str_replace('.'.$link[$n], '', $link_image_local).'_rb.png';
                    }

                    $fp = fopen(__DIR__.'/../../'.$link_image_local, "wb");

                    fwrite($fp, $res->getBody());
                    fclose($fp);

                    return $link_image_local;
                } elseif ($http_status == 403) {
                    // Xử lý khi bị từ chối (status code 403)
                    //return 'Lỗi: Truy cập bị từ chối 403';
                    lockKey($key_remove_bg);
                    return removeBackgroundPhotoroom($link_image_local, $create_new);
                } else {
                    // Xử lý các trường hợp khác
                    // return 'Lỗi: Trạng thái HTTP không xác định.';
                    lockKey($key_remove_bg);
                    return removeBackgroundPhotoroom($link_image_local, $create_new);
                }
            } catch (Exception $e) {
                // Xử lý nếu có lỗi trong quá trình gọi API
                // return 'Lỗi: ' . $e->getMessage();
                lockKey($key_remove_bg);
                return removeBackgroundPhotoroom($link_image_local, $create_new);
            }
        }
    }

    return $link_image_local;
}

function removeBackgroundPhotoroomTest($link_image_local='',$create_new= false)
{
    if(!empty($link_image_local)){
        $key_remove_bg = 'abc';
        
        if(!empty($key_remove_bg)){
            include('library/guzzle/vendor/autoload.php');

            $client = new GuzzleHttp\Client();
            
            try {
                $res = $client->post('https://sdk.photoroom.com/v1/segment', [
                    'multipart' => [
                        [
                            'name'     => 'image_file',
                            'contents' => fopen(__DIR__.'/../../'.$link_image_local, 'r')
                        ]
                    ],
                    'headers' => [
                        'x-api-key' => $key_remove_bg
                    ]
                ]);

                if($create_new){
                    $link = explode('.', $link_image_local);
                    $n = count($link)-1;
                    $link_image_local = str_replace('.'.$link[$n], '', $link_image_local).'_rb.png';
                }

                $fp = fopen(__DIR__.'/../../'.$link_image_local, "wb");
                
                $http_status = $res->getStatusCode();
                $response_body = $res->getBody();

                if ($http_status == 200) {
                    fwrite($fp, $res->getBody());
                    fclose($fp);

                    return $res->getBody();
                } elseif ($http_status == 403) {
                    // Xử lý khi bị từ chối (status code 403)
                    return 'Lỗi: Truy cập bị từ chối 403';
                } else {
                    // Xử lý các trường hợp khác
                    return 'Lỗi: Trạng thái HTTP không xác định.';
                }
            } catch (Exception $e) {
                // Xử lý nếu có lỗi trong quá trình gọi API
                return 'Lỗi: ' . $e->getMessage();
            }
        }
    }

    return $link_image_local;
}
//process_add_money
function processAddMoney($number=0, $order_id=0)
{
    global $modelOption;
    global $key_transaction;
    global $controller;
    global $recommenders;

    $number = (int) $number;
    $order_id = (int) $order_id;

    if($number>=1000){
        $modelOrder = $controller->loadModel('Orders');
        $modelMember = $controller->loadModel('Members');
        $modelDiscountCode = $controller->loadModel('DiscountCodes');

        if(!empty($order_id)){
            $checkOrder = $modelOrder->find()->where(array('id'=> $order_id))->first();
            $discount= 0;
            if(!empty($checkOrder->discount_id)){
                $discountCode = $modelDiscountCode->find()->where(array('id'=>$checkOrder->discount_id))->first();

               $discount = ((int) $discountCode->discount / 100) * $number;
            }
            if(!empty($checkOrder)){
                $data = $modelMember->find()->where(array('id'=>$checkOrder->member_id))->first();

                if(!empty($data)){
                    // cập nhập số dư tài khoản
                    $data->account_balance += $number + $discount;
                    $modelMember->save($data);
                    
                    // cập nhập lại trạng thái đơn hàng
                    $checkOrder->total = $number;
                    $checkOrder->status = 2; // 2: đã xử lý xong
                    $checkOrder->updated_at = date('Y-m-d H:i:s');
                    
                    $modelOrder->save($checkOrder);

                    // Cộng tiền cho thằng giới thiệu 
                    if(!empty($data->affsource)){
                        $User = $modelMember->find()->where(array('id'=>$data->affsource))->first();
                        if(!empty($User)){
                            $User->account_balance += ((int) $recommenders / 100) * $number;
                            $modelMember->save($User);

                            $order = $modelOrder->newEmptyEntity();
                            $order->code = 'W'.time().$User->id.rand(0,10000);
                            $order->member_id = $User->id;
                            $order->total = ((int) $recommenders / 100) * $number;
                            $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
                            $order->type = 11; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền, 5: chiết khấu, 6: tạo nội dung, 7: mua kho mẫu thiết kế, 9: nâng cấp bản pro, 10 tạo kho, 11 hoa hông người giới thiệu
                            $order->meta_payment = 'Bạn được công tiền hoa hồng giới thiệu';
                            $order->created_at = date('Y-m-d H:i:s');

                            $modelOrder->save($order);

                            // gửi thông báo về app
                            $dataSendNotification= array('title'=>'Bạn được cộng tiền hoa hồng giới thiệu','time'=>date('H:i d/m/Y'),'content'=>'- '.$User->name.' ơi. Bạn được cộng '.number_format($order->total).' VND do thành viên '.$data->name.' đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.','action'=>'addMoneySuccess');

                            if(!empty($User->token_device)){
                                sendNotification($dataSendNotification, $User->token_device);
                            }
                        }
                    }

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
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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
                        <span>MÃ XÁC THỰC CẤP LẠI MẬT KHẨU</span>
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
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

function sendEmailCodeVerify($email='', $fullName='', $code= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Mã kích hoạt tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Mã kích hoạt tài khoản</title>
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
                        Mã kích hoạt tài khoản của bạn là: <b>'.$code.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

/*
function sendNotification($data,$target)
{
    global $keyFirebase;

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content']];
    
    if(is_array($target)){
        $number_send = count($target)-1;

        if($number_send < 1000){
            $fields['registration_ids'] = $target;
        }else{
            $start_count = 0;
            $end_count = 990;

            do{
                $mini_target = [];

                for($i = $start_count; $i <= $end_count; $i++){
                    $mini_target[] = $target[$i];
                }

                sendNotification($data,$mini_target);

                $start_count = $end_count+1;
                $end_count = $start_count + 990;

                if($start_count < $number_send && $end_count > $number_send){
                    $end_count = $number_send;
                }
            }while ($end_count<=$number_send);
        }
        
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
*/

// Hàm chia nhỏ mảng thành các nhóm 100 token
function splitArrayIntoChunks($array=[], $chunkSize=100) {
    $chunks = [];
    
    if(is_array($array)){
        if(count($array)>=$chunkSize){
            for ($i = 0; $i < count($array); $i += $chunkSize) {
                $chunks[] = array_slice($array, $i, $chunkSize);
            }
        }else{
            $chunks[] = $array;
        }
    }

    return $chunks;
}

function getTokenFirebaseV1()
{
    require __DIR__.'/library/google-auth-library-php/vendor/autoload.php';

    $linkFileJson = __DIR__.'/library/ezpics-91e75-firebase-adminsdk-gjyts-e0c16579ba.json';

    // Đường dẫn tới file JSON bạn đã tải về từ Firebase
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$linkFileJson);

    // Tạo một handler cho Guzzle
    $handler = HandlerStack::create();

    // Tạo client Guzzle với handler
    $client = new Client(['handler' => $handler]);

    // Sử dụng ServiceAccountCredentials với HTTP handler đúng
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $creds = new ServiceAccountCredentials($scopes, $linkFileJson);

    // Lấy Access Token với HTTP handler là callable hợp lệ
    $authToken = $creds->fetchAuthToken(function ($request) use ($client) {
        try {
            // Trả về đối tượng phản hồi (ResponseInterface) thay vì mảng đã giải mã
            return $client->send($request);
        } catch (RequestException $e) {
            // Xử lý lỗi nếu có
            return null;
        }
    });

    return $authToken['access_token'];
}


//-----------------------
function getFirebaseToken()
{
    // $serviceAccountPath = __DIR__ . '/library/ezpics-91e75-firebase-adminsdk-gjyts-e0c16579ba.json';
    $serviceAccountPath = __DIR__ . '/library/ezpics-91e75-firebase-adminsdk-gjyts-f401fd1467.json';
     // đổi lại nếu tên khác
    $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);

    if (!$serviceAccount || !isset($serviceAccount['private_key'])) {
        die("Không đọc được file JSON hoặc thiếu private_key.");
    }

    $privateKey = $serviceAccount['private_key'];
    $clientEmail = $serviceAccount['client_email'];

    $now = time();
    $jwtPayload = [
        'iss' => $clientEmail,
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600
    ];

    $jwt = JWT::encode($jwtPayload, $privateKey, 'RS256');

    $client = new Client();

    try {
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

      

        return $data['access_token'] ?? null;

    } catch (\GuzzleHttp\Exception\ClientException $e) {
        return null;
    }

}


//-----------------------

function sendNotification($data=[], $deviceTokens)
{
    /*
    $data = [
                'title'=>'Bạn được cộng tiền hoa hồng giới thiệu',
                'time'=>date('H:i d/m/Y'),
                'content'=>'Trần Mạnh ơi. Bạn được cộng 100.000 VND do thành viên Kim Oanh đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.',
                'action'=>'addMoneySuccess',
                'image'=>'', getFirebaseToken
            ];
    */


    global $keyFirebase;
    global $projectId;

    //$tokenFirebase = getTokenFirebaseV1(); // Bearer token
    $tokenFirebase = getFirebaseToken(); // Bearer token
    $number_error = 0;
    
    if(!empty($tokenFirebase)){
        // Chia danh sách token thành các nhóm 100
        if(is_string($deviceTokens)){
            $deviceTokens = [$deviceTokens];
        }

        $chunks = splitArrayIntoChunks($deviceTokens, 1000);
        

        $headers = [
            'Authorization: Bearer ' . $tokenFirebase,
            'Content-Type: application/json'
        ];

        $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

        foreach ($chunks as $chunk) {
            // Tạo thông báo cho mỗi nhóm 100 thiết bị
            $messages = [];
            foreach ($chunk as $token) {
                $messages[] = [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                                            'title' => $data['title'],
                                            'body' => $data['content'],
                                            //'sound' => "default",
                                        ],
                        "data" => $data,
                    ]
                ];
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Gửi từng tin nhắn cho nhóm thiết bị hiện tại
            foreach ($messages as $message) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $result = curl_exec($ch);

                // Xử lý kết quả
                if ($result === FALSE) {
                    $number_error ++;
                }
            }

            curl_close($ch);
        }
    }

    return $number_error;
}


function getLinearposition()
{
    return [
        'to top left' => 'Trên trái',
        'to top' => 'Trên',
        'to top right' => 'Trên phải',
        'to right' => 'Phải',
        'to bottom right' => 'Dưới phải',
        'to bottom' => 'Dưới',
        'to bottom left' => 'Dưới trái',
        'to left' => 'Trái',
    ];
}

function getGradientstatus()
{
    return [
        0=>'Không',
        1=>'Có',
    ];
}

function getGachchan()
{
    return [
        'none' => 'không',
        'underline' => 'gạch dưới',
        'line-through' => 'gạch ngang',
        'overline' => 'gạch ngang trên',
    ];
}

function getInnghieng()
{
    return [
        'normal' => 'không',
        'italic' => 'in nghiêng',
        'oblique' => 'nghiêng nhẹ',
    ];
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

function getLayerProductForEdit($idProduct=0)
{
    global $session;
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    $pro = $modelProduct->find()->where(array('id'=>$idProduct))->first();

    if (!empty($pro)) {
        $pro->productDetail = $modelProductDetail->find()->where(array('products_id'=>$pro->id))->order(['sort' => 'ASC'])->all()->toList();

        if($pro->status == 2){
            $pro->status == 1;
        }

        /*
        if(empty($pro->productDetail)){
            $newLayer = $modelProductDetail->newEmptyEntity();  

            $newLayer->products_id = $pro->id;
            $newLayer->name = 'Layer 1';

            $content = getLayer(1, 'text', '', 80, 0, 'Layer 1');
            $newLayer->content = json_encode($content);
            $newLayer->created_at = date('Y-m-d H:i:s');
            $newLayer->sort = 1;
            
            
            $modelProductDetail->save($newLayer);

            $pro->productDetail = $modelProductDetail->find()->where(array('products_id'=>$pro->id))->order(['sort' => 'ASC'])->all()->toList();
        }
        */

        
        $list_layer = array();
        $choose_tab = array();
        $movelayer = array();
        $movelayer = array('<div class="thumb-checklayer"><img src="'.$pro->thumn.'" class="img-fluid w-100 img-thumn" alt=""></div>');
        $key = 1;
        $list_layer_check = array();
        
        if(!empty($pro->productDetail)){
            foreach($pro->productDetail as $k => $item){
                //$item->content = str_replace('\"', '"', $item->content);
                $layer = json_decode(trim($item->content,'"')); 

                if(!empty($layer)){
                    //kiểu layer
                    if(!isset($layer->type)) $layer->type = 'text'; 

                    // tên layer
                    if(!isset($layer->text)) $layer->text = 'Layer '.$item->id; 

                    // mã màu
                    if(!isset($layer->color)) $layer->color = '#000'; 

                    // kích cỡ chữ
                    if(!isset($layer->size)) $layer->size = '10vw'; 
                    $layer->size = str_replace('px','',$layer->size);
                    $layer->size = str_replace('vw','',$layer->size);
                    //if($layer->size>100) $layer->size= 70;
                    $layer->size = $layer->size.'vw';

                    // font chữ
                    if(!isset($layer->font)) $layer->font = 'Arial'; 

                    // trạng thái của layer
                    if(!isset($layer->status)){
                        $layer->status = 1; 
                    }else{
                        $layer->status = (int) $layer->status; 
                    }

                    // căn lề chữ
                    if(!isset($layer->text_align)) $layer->text_align = 'left'; 

                    // độ sáng
                    if(!isset($layer->brightness)){
                        $layer->brightness = 100; 
                    }else{
                        $layer->brightness = (double) $layer->brightness; 
                    }

                    // độ tương phản
                    if(!isset($layer->contrast)){
                        $layer->contrast = 100; 
                    }else{
                        $layer->contrast = (double) $layer->contrast; 
                    }

                    // độ bão hòa màu sắc
                    if(!isset($layer->saturate)){
                        $layer->saturate = 100; 
                    }else{
                        $layer->saturate = (double) $layer->saturate; 
                    }

                    // độ trong
                    if(!isset($layer->opacity)){
                        $layer->opacity = 1; 
                    }else{
                        $layer->opacity = (double) $layer->opacity; 
                    }

                    // gạch chân chữ
                    if(!isset($layer->gachchan)) $layer->gachchan = 'none'; 

                    // viết hoa hết hoặc viết thường hết
                    if(!isset($layer->uppercase)) $layer->uppercase = 'none'; 

                    // hiệu ứng in nghiêng của chữ
                    if(!isset($layer->innghieng)) $layer->innghieng = 'normal'; 

                    // hiệu ứng in đậm của chữ
                    if(!isset($layer->indam)) $layer->indam = 'normal'; 

                    // hướng đổi màu trong hiệu ứng gradient của chữ
                    if(!isset($layer->linear_position)) $layer->linear_position = 'to right'; 
                    $layer->linear_position = 'to right';

                    // độ nghiêng của layer
                    if(!isset($layer->rotate)) $layer->rotate = '0deg'; 

                    // khóa layer
                    if(!isset($layer->lock)){
                        $layer->lock = 0; 
                    }else{
                        $layer->lock = (int) $layer->lock; 
                    }

                    // link ảnh của layer image
                    if(empty($layer->banner)){
                        $layer->banner = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/avatar-ezpics.png'; 
                    }
                    $layer->banner = str_replace('//upload', '/upload', $layer->banner);
                    $layer->banner = str_replace('//upload', '/upload', $layer->banner);

                    // link ảnh svg khung
                    if(empty($layer->image_svg)){
                        $layer->image_svg = ''; 
                    }

                    // chia trang
                    if(empty($layer->page)){
                        $layer->page = 0; 
                    }

                    /*
                    if(!isset($layer->naturalWidth)){
                        if($layer->type=='image'){
                            $sizeImage = @getimagesize($layer->banner);

                            if(!empty($sizeImage[1]) && !empty($sizeImage[0])){
                                $layer->naturalWidth = (int) $sizeImage[0];
                                $layer->naturalHeight = (int) $sizeImage[1];
                            }
                        }else{
                            $layer->naturalWidth = 0;
                            $layer->naturalHeight = 0;
                        }
                    }
                    */

                    // độ dãn chữ
                    if(!isset($layer->gianchu)) $layer->gianchu = 'normal'; 
                    if($layer->gianchu=='1px' || $layer->gianchu=='0') $layer->gianchu = 'normal';
                    
                    $layer->gianchu = (string) $layer->gianchu;

                    // độ dãn dòng
                    if(empty($layer->giandong) || $layer->giandong=='0px' || $layer->giandong=='0' || $layer->giandong=='0vh') $layer->giandong = 'normal';
                    
                    $layer->giandong = (string) $layer->giandong;

                    // chiều ngang của layer
                    if(empty($layer->width) || $layer->width == '0px' || $layer->width == '0vw'){
                        $layer->width = '80vw';
                    }
                    $layer->width = str_replace('px','',$layer->width);
                    $layer->width = str_replace('vw','',$layer->width);
                    //if($layer->width>100) $layer->width= 70;
                    $layer->width = $layer->width.'vw';

                    // cờ đánh dấu việc có dùng hiệu ứng gradient hay không
                    if(!isset($layer->gradient)){
                        $layer->gradient = 0; 
                    }else{
                        $layer->gradient = (int) $layer->gradient; 
                    }

                    // căn tọa độ lề trái
                    if(!isset($layer->postion_left)){
                        $layer->postion_left = (double) 50; 
                    }else{
                        $layer->postion_left = (double) $layer->postion_left; 
                    }

                    // căn tọa độ lề trên
                    if(!isset($layer->postion_top)){
                        $layer->postion_top = (double) 50; 
                    }else{
                        $layer->postion_top = (double) $layer->postion_top; 
                    }

                    // góc bo của layer
                    if(!isset($layer->border)){
                        $layer->border = 0; 
                    }else{
                        $layer->border = (double) $layer->border; 
                    }

                    // mảng chứa danh sách màu gradient
                    if(!isset($layer->gradient_color)) $layer->gradient_color = []; 

                    // tên biến
                    if(empty($layer->variable)){
                        $layer->variable = '';
                    }else{
                        if(!empty($_GET[$layer->variable])){
                            $layer->text = str_replace('%'.$layer->variable.'%', $_GET[$layer->variable], $layer->text);

                            $layer->banner = $_GET[$layer->variable];
                        }
                    }

                    // label hiển thị của biến
                    if(empty($layer->variableLabel)){
                        $layer->variableLabel = '';
                    }

                    // cờ đánh dấu hiệu ứng lật ảnh ngang 
                    if(empty($layer->lat_anh)){
                        $layer->lat_anh = 0;
                        $class_lat_anh = '';
                    }else{
                        $layer->lat_anh = 1;
                        $class_lat_anh = 'lat_anh';
                    }

                     // cờ đánh dấu hiệu ứng lật ảnh dọc
                    if(empty($layer->lat_anh_doc)){
                        $layer->lat_anh_doc = 0;
                        $class_lat_anh_doc = '';
                    }else{
                        $layer->lat_anh_doc = 1;
                        $class_lat_anh_doc = 'lat_anh_doc';
                    }

                    // cách hiển thị của biến chữ
                    if(empty($layer->typeShowTextVariable)){
                        $layer->typeShowTextVariable = '';
                    }

                    // yêu cầu tự xóa nền của biến ảnh
                    if(empty($layer->removeBackgroundAuto)){
                        $layer->removeBackgroundAuto = 0;
                    }
                    
                    $dnone = empty($layer->status) ? 'd-none' : '';
                    
                    if($layer->type == 'text'){
                        $text = '';
                        $img = 'd-none';
                        $selectedtext = 'selected';
                        $selectedimage = '';
                    }else{
                        $img = '';
                        $text =   'd-none';
                        $selectedimage = 'selected';
                        $selectedtext = '';
                    }

                    $link_icon = ($layer->type == 'image') ? $layer->banner : 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-editor/9888807.png';

                    $text_layer = $layer->type == 'image' ? '' : ': '.$layer->text;

                    $list_layer_check[] = '<li class="setlayer list-group-item" data-layer="'.$item->id.'" data-id="'.$item->id.'"><img src="'.$link_icon.'" class="img-fluid img-layer" width="10">&nbsp; Layer '.$item->id.'<span class="oneline">'.$text_layer.'<span style="float: right;" onclick="deletedinlayer('.$pro->id.','.$item->id.')"><i class="fa-regular fa-trash-can"></i></span></span></li>';

                    $gradient_color = [];
                    if(!empty($layer->gradient_color)){
                        foreach($layer->gradient_color as $item_gradient){
                            $position = $item_gradient->position*100;
                            $gradient_color[] = $item_gradient->color.' '.$position.'%';
                        }
                    }

                    $style_gradient = !empty($layer->gradient) ? '-webkit-background-clip:text !important; -webkit-text-fill-color:transparent; background: linear-gradient('.$layer->linear_position.', '.implode(', ', $gradient_color).' );' : '';
                    
                    $brightness = $layer->brightness/100;
                    $contrast = $layer->contrast/100;
                    $saturate = $layer->saturate/100;
                    
                    $style = 'text-align:'.$layer->text_align.';left: '.(double)@$layer->postion_left.'%;top: '.(double)@$layer->postion_top.'%;transform: translate(0px) rotate('.$layer->rotate.');filter: brightness('.$brightness.');filter: contrast('.$contrast.');filter: saturate('.$saturate.');';


                    
                    
                    /*
                    // tính vị trí hiển thị
                    $sizeBackground = @getimagesize($pro->thumn);

                    if(!empty($widthDevice)){
                        $widthWindow = $widthDevice;
                    }elseif(!empty($session->read('widthWindow'))){
                        $widthWindow = $session->read('widthWindow');
                    }else{
                        $widthWindow = 1792;
                    }
                    
                    $heightWindow = $widthWindow;
                    if(!empty($sizeBackground[1]) && !empty($sizeBackground[0])){
                        $heightWindow = $sizeBackground[1]*$widthWindow/$sizeBackground[0];
                    }

                    $layer->postion_x = $layer->postion_left*$widthWindow/100;
                    $layer->postion_y = $layer->postion_top*$heightWindow/100;
                    */

                    if(!isset($layer->naturalWidth)){
                        $layer->naturalWidth = 0;
                        $layer->naturalHeight = 0;
                    }

                    if($layer->type == 'image' && $layer->naturalWidth == 0){
                        $sizeImage = @getimagesize($layer->banner);

                        if(!empty($sizeImage[1]) && !empty($sizeImage[0])){
                            $layer->naturalWidth = (int) $sizeImage[0];
                            $layer->naturalHeight = (int) $sizeImage[1];

                            // cập nhập lại vào db
                            $item->content = json_encode($layer);

                            $modelProductDetail->save($item);
                        }
                    }
                    
                    $movelayer[] = '<div class="drag-drop layer-drag-'.$key.' '.$dnone.'" data-id="'.$item->id.'" data-idproduct="'.$pro->id.'" data-type="'.$layer->type.'" data-layer="'.$item->id.'" data-left="'.@$layer->postion_left.'" data-top="'.@$layer->postion_top.'" style="'.$style.'" data-color="'.@$layer->color.'" data-size="'.$layer->size.'" data-gradient="'.$layer->gradient.'" data-width="'.$layer->width.'" data-pos_gradient="'.$layer->linear_position.'" data-border='.$layer->border.' data-rotate="'.$layer->rotate.'" data-brightness="'.$layer->brightness.'" data-latanh="'.$layer->lat_anh.'" data-giandong="'.$layer->giandong.'" data-latanhdoc="'.$layer->lat_anh_doc.'">
                       
                        <div class="list-selection-choose d-none">
                            <button class="btn-style-design-delete" onclick="deletedinlayer(\''.$pro->id.'\',\''.$item->id.'\')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <button class="btn-style-design-copy" onclick="duplicate();">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                        </div>

                        <img src="'.$layer->banner.'" class="img-fluid '.$img.' image'.$key.' '.$class_lat_anh.' '.$class_lat_anh_doc.'" data-maxw="'.$item->wight.'" data-maxh="'.$item->height.'" style="width: '.$layer->width.';opacity: '.$layer->opacity.';border-radius: '.$layer->border.'px">
                    
                        <span class="'.$text.' text'.$key.'" style="display:inline-block;word-wrap:anywhere;width: '.$layer->width.';color: '.$layer->color.';font-size: '.$layer->size.';font-family: '.$layer->font.';text-decoration: '.$layer->gachchan.';text-transform: '.$layer->uppercase.';font-weight: '.$layer->indam.';letter-spacing: '.$layer->gianchu.';line-height: '.$layer->giandong.';font-style: '.$layer->innghieng.';'.'opacity: '.$layer->opacity.';'.$style_gradient.'">'.$layer->text.'</span>
                    

                    </div>
                    ';

                    

                    $key++;

                    $list_layer[$item->id] = $layer;
                }

                $pro->productDetail[$k]->content = json_encode($layer);
            }

            krsort($list_layer_check);
        }

        $category = $modelCategories->find()->where(array('id'=>$pro->category_id))->first();

        if(empty($category)){
            $category = $modelCategories->newEmptyEntity();
        }
        
        return ['code'=>1,'type'=>$pro->type,'category'=> $category, 'data' => $pro, 'movelayer' => implode('',$movelayer), 'layer' => $list_layer, 'list_layer_check' => implode('',$list_layer_check)];
        
    }else{
        return ['error' => ['Có lỗi trong quá trình xử lý. Vui lòng thử lại sau']]; 
    }
}

function getLayer($stt, $type = 'text', $link = '', $width = '100', $height = '30', $text = '', $variable='', $variableLabel = '', $font='Arial',$code='#000',$size = '10vw', $typeShowTextVariable='', $removeBackgroundAuto = 0, $page = 0)
{
    if(empty($text)) $text = 'Layer '.$stt;

    if($type == 'image'){
        if(!empty($link)){
            $sizeImage = getimagesize($link);

            if(!empty($sizeImage[1]) && !empty($sizeImage[0])){
                $naturalWidth = (int) $sizeImage[0];
                $naturalHeight = (int) $sizeImage[1];
            }
        }
    }else{
        $naturalWidth = 0;
        $naturalHeight = 0;
    }

    $return = [
        'type' => $type,
        'text' => $text,
        'color' => $code,
        'size' => $size,
        'font' => $font,
        'status' => '1',
        'text_align' => 'left',
        'postion_left' => 0,
        'postion_top' => 0,
        'brightness' => '100',
        'contrast' => '100',
        'saturate' => '100',
        'gachchan' => 'none',
        'uppercase' => 'none',
        'innghieng' => 'normal',
        'indam' => 'normal',
        'linear_position' => 'to right',
        'border' => 0,
        'rotate' => '0deg',
        'banner' => $link,
        'image_svg' => '',
        'gianchu' => 'normal',
        'giandong' => 'normal',
        'opacity' => '1',
        'width' => $width.'vw',
        'page' => $page,
        'gradient' => 0,
        'gradient_color' => [['position'=>0,'color'=>'#000'],['position'=>1,'color'=>'#000']],
        'variable' => $variable,
        'variableLabel' => $variableLabel,
        'typeShowTextVariable' => $typeShowTextVariable,
        'removeBackgroundAuto' => (int) $removeBackgroundAuto,
        'lat_anh_doc' => 0,
        'lock' => 0,
        'lat_anh' => 0,
    ];

    if(isset($naturalWidth)){
        $return['naturalWidth'] = $naturalWidth;
        $return['naturalHeight'] = $naturalHeight;
    }

    return $return;
}

function zipImage($urlLocalFile='')
{
    if(!empty($urlLocalFile)){
        if(function_exists('getKey')){
            $keyTinipng = getKey(22);
        }else{
            $keyTinipng = '';
        }
        
        if(!empty($keyTinipng) && file_exists($urlLocalFile)){
            require_once("library/tinify/vendor/autoload.php");
            Tinify\setKey($keyTinipng);

            Tinify\fromFile($urlLocalFile)->toFile($urlLocalFile);
        }
    }
}

function createNewProduct($infoUser, $name='', $price=0, $sale_price=0, $type='user_edit', $category_id=1, $warehouse='', $color='', $backgroundUpload= '', $type_editor=0)
{
    global $controller;
    global $urlHomes;

    $return = array('code'=>1,
                    'messages'=>array(array('text'=>'Không tồn tại tài khoản người dùng'))
                    );

    if(!empty($infoUser)){
        $modelProduct = $controller->loadModel('Products');
        $modelManagerFile = $controller->loadModel('ManagerFile');
        $modelProductDetail = $controller->loadModel('ProductDetails');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');

        $newproduct = $modelProduct->newEmptyEntity();

        $thumb = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
        $thumbnailUser = '';

        if(isset($_FILES['background']) && empty($_FILES['background']["error"])){
            $background = uploadImage($infoUser->id, 'background');

            if(!empty($background['linkOnline'])){
                $thumb = $background['linkOnline'];

                // lưu vào database file
                $dataFile = $modelManagerFile->newEmptyEntity();

                $dataFile->link = $background['linkOnline'];
                $dataFile->user_id = $infoUser->id;
                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
                $dataFile->created_at = date('Y-m-d H:i:s');

                $modelManagerFile->save($dataFile);
            }
        }else{
            if(!empty($backgroundUpload)){
                $thumb = $backgroundUpload;
            }
        }

        if(isset($_FILES['thumbnail']) && empty($_FILES['thumbnail']["error"])){
            $thumbnail = uploadImage($infoUser->id, 'thumbnail');

            if(!empty($thumbnail['linkOnline'])){
                $thumbnailUser = $thumbnail['linkOnline'];

                // lưu vào database file
                $dataFile = $modelManagerFile->newEmptyEntity();

                $dataFile->link = $thumbnail['linkOnline'];
                $dataFile->user_id = $infoUser->id;
                $dataFile->type = 1; // 0 là user up, 1 là cap, 2 là payment
                $dataFile->created_at = date('Y-m-d H:i:s');

                $modelManagerFile->save($dataFile);
            }
        }

        // lấy kích cỡ ảnh background
        $imageWhite = $thumb;
        $sizeThumb = getimagesize($imageWhite);

        // tạo ảnh nền trắng
        $fileNameWhite = $sizeThumb[0].'_'.$sizeThumb[1].'.jpg';
        $imagePath = __DIR__.'/../../upload/admin/images/background_white/'.$fileNameWhite;
        
        if(!file_exists($imagePath)){
            $image = imagecreatetruecolor($sizeThumb[0], $sizeThumb[1]); // Tạo một ảnh trống với kích thước đã xác định
            $white = imagecolorallocate($image, 255, 255, 255); // Tạo màu trắng
            imagefilledrectangle($image, 0, 0, $sizeThumb[0], $sizeThumb[1], $white); // Đổ màu trắng lên toàn bộ ảnh
            imagejpeg($image, $imagePath); // Lưu ảnh dưới dạng JPG
            imagedestroy($image); // Giải phóng bộ nhớ
        }

        $imageWhite = $urlHomes.'upload/admin/images/background_white/'.$fileNameWhite;

        // lưu dữ liệu mới
        $newproduct->name = $name;
        $newproduct->price = (int) $price;
        $newproduct->sale_price = (int) $sale_price;
        $newproduct->content = '';
        $newproduct->sale = null;
        $newproduct->related_packages = '';
        $newproduct->status = 0; // 0: khóa, 1: mở bán
        $newproduct->type = $type;
        $newproduct->sold = 0;
        $newproduct->image = (!empty($thumbnailUser))?$thumbnailUser:$thumb; // ảnh minh họa
        $newproduct->thumn = $imageWhite; // ảnh background
        $newproduct->thumbnail = $thumbnailUser;
        $newproduct->user_id = $infoUser->id;
        $newproduct->product_id = 0;
        $newproduct->note_admin = '';
        $newproduct->created_at = date('Y-m-d H:i:s');
        $newproduct->views = 0;
        $newproduct->favorites = 0;
        $newproduct->color = $color;
        $newproduct->type_editor = $type_editor;
        $newproduct->category_id = (int) $category_id;
        $newproduct->width = $sizeThumb[0];
        $newproduct->height = $sizeThumb[1];

        // tạo slug
        $slug = createSlugMantan($name);
        $slugNew = $slug;
        $number = 0;

        if(empty($newproduct->slug) || $newproduct->slug!=$slugNew){
            do{
                $conditions = array('slug'=>$slugNew);
                $listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));
        }

        $newproduct->slug = $slugNew;

        $modelProduct->save($newproduct);

        // tạo layer ảnh đầu tiên

        // tạo deep link
        if($type=='user_create' || $type=='user_series'){
            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
                                                'link'=>'https://ezpics.page.link/detailProduct?id='.$newproduct->id.'&type='.$newproduct->type,
                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
                                        ]
                        ];
            $header_deep = ['Content-Type: application/json'];
            $typeData='raw';
            $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
            $deep_link = json_decode($deep_link);

            $newproduct->link_open_app = @$deep_link->shortLink;
            $modelProduct->save($newproduct);
        }

        // tạo layer mặc định đầu tiên
        
        $newLayer = $modelProductDetail->newEmptyEntity();  

        $newLayer->products_id = $newproduct->id;
        $newLayer->name = 'Layer 1';

        $content = getLayer(1, 'image', $thumb, '100', '100');
        $newLayer->content = json_encode($content);
        $newLayer->created_at = date('Y-m-d H:i:s');
        $newLayer->sort = 1;
        
        
        $modelProductDetail->save($newLayer);
       
        if(!empty($warehouse)){
            $conditions = ['product_id'=>$newproduct->id, ];
            $modelWarehouseProducts->deleteAll($conditions);

            foreach($warehouse as $warehouse_id) {
                $Warehouses = $modelWarehouses->find()->where(array('id'=>$warehouse_id, 'user_id'=>$infoUser->id))->first();
                if(!empty($Warehouses)){
                    $warehouse_products = $modelWarehouseProducts->newEmptyEntity();
                    $warehouse_products->warehouse_id = $warehouse_id;
                    $warehouse_products->product_id = $newproduct->id;
                    $warehouse_products->user_id = $infoUser->id;
                    $modelWarehouseProducts->save($warehouse_products);

                    $totalProducts = count($modelWarehouseProducts->find()->where(['warehouse_id'=>$warehouse_id])->all()->toList());
                        $listWarehouse = $modelWarehouses->get($warehouse_id);
                        $listWarehouse->number_product = $totalProducts;
                        $modelWarehouses->save($listWarehouse);
                }
            }
            
        }

        $return = array('code'=>0,
                        'product_id'=>$newproduct->id,
                        'messages'=>array(array('text'=>'Tạo mẫu thiết kế thành công'))
                        );
    }

    return $return;
}

function getSizeProduct()
{
    return [
            ['name'=>'Bài thuyết trình (16:9)','width'=>1920,'height'=>1080, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1920-1080.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/presentation.svg'],
            
            ['name'=>'Bài thuyết trình (9:16)','width'=>1080,'height'=>1920, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1080-1920.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/presentation.svg'],
            
            ['name'=>'Logo','width'=>500,'height'=>500, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/500-500.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/image.svg'],
            
            ['name'=>'Poster (dọc)','width'=>4960,'height'=>7015, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/4960-7015.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/poster.svg'],
            
            ['name'=>'Bài đăng Instagram (vuông)','width'=>1080,'height'=>1080, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1080-1080.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/instagram.svg'],
            
            ['name'=>'Bài đăng Facebook (ngang)','width'=>940,'height'=>788, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/940-788.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/facebook.svg'],

            ['name'=>'Avatar Facebook','width'=>761,'height'=>761, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/761-761.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/facebook.svg'],
            
            ['name'=>'Ảnh bìa Facebook','width'=>1640,'height'=>924, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1640-924.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/facebook.svg'],
            
            ['name'=>'Ảnh thumbnail video Youtube','width'=>1280,'height'=>720, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1280-720.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/youtube.svg'],
            
            ['name'=>'Hình nền máy tính','width'=>1920,'height'=>1080, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1920-1080.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/image.svg'],
            
            ['name'=>'A0 (dọc)','width'=>3179,'height'=>4494, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/3179-4494.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
            
            ['name'=>'A1 (dọc)','width'=>2245,'height'=>3179, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/2245-3179.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
            
            ['name'=>'A2 (dọc)','width'=>1587,'height'=>2245, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1587-2245.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
            
            ['name'=>'A3 (dọc)','width'=>1123,'height'=>1587, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/1123-1587.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
            
            ['name'=>'A4 (dọc)','width'=>794,'height'=>1123, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/794-1123.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
            
            ['name'=>'A5 (dọc)','width'=>559,'height'=>794, 'image'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/size/559-794.png', 'icon'=>'https://apis.ezpics.vn/plugins/ezpics_api/view/image/icon-product/docs.svg'],
        ];
}

function exportImageThumb($id = 0)
{
    global $session;
    global $controller;
    global $urlCreateImage;

    $modelProduct = $controller->loadModel('Products');

    if(!empty($id)){
        
        $product = $modelProduct->find()->where(array('id'=>(int) $id))->first();

        if(!empty($product)){
            $url = $urlCreateImage.'?url='.urlencode('https://apis.ezpics.vn/createImageFromTemplate/?id='.$id).'&width='.$product->width.'&height='.$product->height;

            $data = sendDataConnectMantan($url);
            
            /*
            $url = 'http://14.225.238.137:3000/convert';

            $att = [
                    'url' => 'https://apis.ezpics.vn/createImageFromTemplate/?id='.$_GET['id'],
                    'width' => $product->width,
                    'height' => $product->height
                    ];
            
            $data = sendDataConnectMantan($url,$att);

            */

            if(!empty($data)){
                $name = __DIR__.'/../../upload/admin/images/'.$product->user_id.'/thumb_product_'.$product->id.'.png';

                if (!file_exists(__DIR__.'/../../upload/admin/images/'.$product->user_id )) {
                    mkdir(__DIR__.'/../../upload/admin/images/'.$product->user_id, 0755, true);
                }
                
                // unlink($name);

                file_put_contents($name, base64_decode($data));

                $image = 'https://apis.ezpics.vn/upload/admin/images/'.$product->user_id.'/thumb_product_'.$product->id.'.png?time='.time();

                $product->image = $image;
                $product->zipThumb = 0;
            
                $modelProduct->save($product);

                return ['success' => 'Thành công','link' => $image];
            }else{
                return ['error' => 'Chưa tạo được ảnh thumbnail'];
            }
        }else{
            return ['error' => 'Sản phẩm không tồn tại'];
        }
    }else{
        return ['error' => 'Gửi thiếu ID sản phẩm'];
    }
}

function screenshotProduct($url='', $width=1920, $height=1080)
{
    if(function_exists('getKey')){
        $keyScreenshot = getKey(36);
    }else{
        $keyScreenshot = '';
    }

    if(!empty($keyScreenshot) && !empty($url)){
        include('lib/guzzle/vendor/autoload.php');

        $client = new GuzzleHttp\Client();
        
        $headers = [
          'x-api-key' => $keyScreenshot,
          'Content-Type' => 'application/json'
        ];

        $body = '{
          "url": "'.$url.'",
          "device": "desktop",
          "fullPage": true,
          "viewport": {
                "width": '.$width.',
                "height": '.$height.'
            }
        }';

        $request = $client->post('https://api.siterelic.com/screenshot', [
                        'headers' => $headers,
                        'json' => json_decode($body, true), // Sử dụng 'json' để tự động thiết lập 'Content-Type: application/json'
                    ]);
        
        $return = $request->getBody()->getContents();


        $return = json_decode($return, true);

        return @$return['data'];
    }else{
        return '';
    }
}

function cropAutoImagePNG($sourcePath='', $destinationPath='')
{
    global $urlHomes;

    if(!empty($sourcePath)){
        if(empty($destinationPath)) $destinationPath = $sourcePath;

        // Đọc ảnh PNG gốc
        $image = imagecreatefrompng($sourcePath);

        // Tìm giới hạn không gian thừa
        $left = $top = $right = $bottom = null;

        // Xác định giới hạn không gian thừa bằng cách tìm các biên không phải là màu trong suốt (trong trường hợp PNG, màu có giá trị alpha khác 0)
        $width = imagesx($image);
        $height = imagesy($image);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $pixel = imagecolorat($image, $x, $y);
                $alpha = ($pixel >> 24) & 0xFF; // Lấy giá trị alpha

                if ($alpha !== 127 && $alpha !== 0) { // Màu không phải là màu trong suốt (trắng) hoặc đen
                    $left = $x;
                    break 2; // Kết thúc cả hai vòng lặp
                }
            }
        }

        for ($x = $width - 1; $x >= 0; $x--) {
            for ($y = 0; $y < $height; $y++) {
                $pixel = imagecolorat($image, $x, $y);
                $alpha = ($pixel >> 24) & 0xFF;

                if ($alpha !== 127 && $alpha !== 0) {
                    $right = $x;
                    break 2;
                }
            }
        }

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $pixel = imagecolorat($image, $x, $y);
                $alpha = ($pixel >> 24) & 0xFF;

                if ($alpha !== 127 && $alpha !== 0) {
                    $top = $y;
                    break 2;
                }
            }
        }

        for ($y = $height - 1; $y >= 0; $y--) {
            for ($x = 0; $x < $width; $x++) {
                $pixel = imagecolorat($image, $x, $y);
                $alpha = ($pixel >> 24) & 0xFF;

                if ($alpha !== 127 && $alpha !== 0) {
                    $bottom = $y;
                    break 2;
                }
            }
        }

        // Tạo hình ảnh mới với kích thước đã xác định
        $croppedImage = imagecrop($image, [
            'x' => $left,
            'y' => $top,
            'width' => $right - $left + 1,
            'height' => $bottom - $top + 1
        ]);

        imagedestroy($image);

        if ($croppedImage !== false) {
            // Tạo ảnh mới với nền trong suốt (transparent background)
            $resultImage = imagecreatetruecolor($right - $left + 1, $bottom - $top + 1);
            imagesavealpha($resultImage, true);
            $transColor = imagecolorallocatealpha($resultImage, 0, 0, 0, 127);
            imagefill($resultImage, 0, 0, $transColor);

            // Đặt hình ảnh đã cắt vào ảnh mới
            imagecopy($resultImage, $croppedImage, 0, 0, 0, 0, $right - $left + 1, $bottom - $top + 1);

            // Lưu ảnh sau khi cắt
            imagepng($resultImage, $destinationPath);
            imagedestroy($croppedImage);
            imagedestroy($resultImage);
            
            return ['linkOnline'=>$urlHomes.'/'.$destinationPath, 'linkLocal'=>$destinationPath];
        } else {
            return ['linkOnline'=>$urlHomes.'/'.$sourcePath, 'linkLocal'=>$sourcePath];
        }
    }
}


function sendOTPZalo($phone='', $otp='')
{
    if(!empty($phone) && !empty($otp)){
        $id_oa = '256174165105937998';
        $id_app = '3056421570793695754';

        $template_id = 302607;
        $params = ['otp'=>$otp];

        if(function_exists('sendZNSZalo')){
            $return_zns = sendZNSZalo($template_id, $params, $phone, $id_oa, $id_app);

            if(!empty($return_zns['error'])){
                $url_zns = 'http://rest.esms.vn/MainService.svc/json/SendZaloMessage_V4_post_json/';
                $data_send_zns = [
                                    "ApiKey" => "E69EBCCCBD92CC5E403D68E78F605E",
                                    "SecretKey" => "262DC6F859F9EC69B9F6F46388B71E",
                                    "Phone" => $phone,
                                    "Params" => [$otp],
                                    "TempID" => "205644",
                                    "OAID" => "4097311281936189049",
                                    "SendDate" => "",
                                    "Sandbox" => "0",
                                    "RequestId" => time(),
                                    "campaignid" => "EZPICS OTP",
                                    "CallbackUrl" => "https://apis.ezpics.vn/callbackZalo"
                                ];
                $header_zns = ['Content-Type: application/json'];
                $typeData='raw';
                $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
                return json_decode($return_zns, true);
            }

            return $return_zns;
        }
    }
}

function getColor(){
    return array(
         ['name'=>'Black','code'=>'#000000'],
         ['name'=>'White','code'=>'#FFFFFF'],
         ['name'=>'Red','code'=>'#FF0000'],
         ['name'=>'Lime','code'=>'#00FF00'],
         ['name'=>'Blue','code'=>'#0000FF'],
         ['name'=>'Yellow','code'=>'#FFFF00'],
         ['name'=>'Cyan / Aqua','code'=>'#00FFFF'],
         ['name'=>'Magenta / Fuchsia','code'=>'#FF00FF'],
         ['name'=>'Silver','code'=>'#C0C0C0'],
         ['name'=>'Orange','code'=>'#FF6D01'],
         ['name'=>'Pink','code'=>'#FFC0CB'],
    );

}
?>