<?php 
global $price_remove_background;
global $name_bank;
global $number_bank;
global $account_holders_bank;
global $link_qr_bank;
global $key_transaction;
global $keyFirebase;
global $urlCreateImage;

$urlCreateImage = 'http://14.225.238.137:3000/convert';

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


$price_remove_background = 10000;

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

function process_add_money($number=0, $desc='')
{
    global $modelOption;
    global $key_transaction;
    global $controller;
   
    $keyApp= strtoupper($key_transaction);

    if($number>0){
        $desc= explode(' ', $desc);

        if(!empty($desc[0]) && !empty($desc[1]) && !empty($desc[2])   ){
            $phone= $desc[0];
            $nameTool= $desc[1];
            $orderCode= $desc[2];

            if($nameTool==$keyApp){
                $modelOrder = $controller->loadModel('Orders');
                $modelMember = $controller->loadModel('Members');
                
                $data = $modelMember->find()->where(array('phone'=>$phone))->first();
               
                if($data){
                    $checkOrder = $modelOrder->find()->where(array('code'=> $orderCode))->first();

                    if(!empty($checkOrder)){
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
                        $dataSendNotification= array('title'=>'Nạp tiền thành công Ezpics','time'=>date('H:i d/m/Y'),'content'=>'Nạp thành công '.number_format($number).'đ vào tài khoản '.$phone,'action'=>'addMoneySuccess');

                        if(!empty($data->token_device)){
                            sendNotification($dataSendNotification, $data->token_device);
                        }

                        return 'Nạp tiền thành công cho tài khoản '.$phone;
                    }else{
                        return 'Không tìm thấy yêu cầu nạp tiền có mã là '.$orderCode;
                    }
                }else{
                    return 'Tài khoản '.$phone.' không tồn tại';
                }
            }else{
                return 'Nội dung sai cú pháp';
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

        if(!empty($pro->productDetail) && count($pro->productDetail)) {
            $list_layer = array();
            $choose_tab = array();
            $movelayer = array('<div class="thumb-checklayer"><img src="'.$pro->thumn.'" class="img-fluid w-100 img-thumn" alt=""></div>');
            $key = 1;
            $list_layer_check = array();
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
                    if($layer->size>100) $layer->size= 70;
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

                    // link ảnh của layer image
                    if(empty($layer->banner)){
                        $layer->banner = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/avatar-ezpics.png'; 
                    }

                    // độ dãn chữ
                    if(!isset($layer->gianchu)) $layer->gianchu = 'normal'; 
                    if($layer->gianchu=='1px' || $layer->gianchu=='0') $layer->gianchu = 'normal';

                    // độ dãn dòng
                    if(!isset($layer->giandong)) $layer->giandong = 'normal'; 
                    if($layer->giandong=='1px' || $layer->giandong=='0') $layer->giandong = 'normal';

                    // chiều ngang của layer
                    if(empty($layer->width) || $layer->width == '0px' || $layer->width == '0vw'){
                        $layer->width = '80vw';
                    }
                    $layer->width = str_replace('px','',$layer->width);
                    $layer->width = str_replace('vw','',$layer->width);
                    if($layer->width>100) $layer->width= 70;
                    $layer->width = $layer->width.'vw';

                    // chiều cao của layer
                    if(!isset($layer->height)) $layer->height = '10vh'; 

                    // cờ đánh dấu việc có dùng hiệu ứng gradient hay không
                    if(!isset($layer->gradient)){
                        $layer->gradient = 0; 
                    }else{
                        $layer->gradient = (int) $layer->gradient; 
                    }

                    // căn tọa độ lề trái
                    if(!isset($layer->postion_left)){
                        $layer->postion_left = 50; 
                    }else{
                        $layer->postion_left = (double) $layer->postion_left; 
                    }

                    // căn tọa độ lề trên
                    if(!isset($layer->postion_top)){
                        $layer->postion_top = 50; 
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
                    
                    $style = 'text-align:'.$layer->text_align.';left: '.(double)@$layer->postion_left.'%;top: '.(double)@$layer->postion_top.'%;transform: translate(0px) rotate('.$layer->rotate.');filter: brightness('.$brightness.');';


                    
                    
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

                    $movelayer[] = '<div class="drag-drop layer-drag-'.$key.' '.$dnone.'" data-id="'.$item->id.'" data-idproduct="'.$pro->id.'" data-type="'.$layer->type.'" data-layer="'.$item->id.'" data-left="'.@$layer->postion_left.'" data-top="'.@$layer->postion_top.'" style="'.$style.'" data-color="'.@$layer->color.'" data-size="'.$layer->size.'" data-gradient="'.$layer->gradient.'" data-width="'.$layer->width.'" data-pos_gradient="'.$layer->linear_position.'" data-border='.$layer->border.' data-rotate="'.$layer->rotate.'" data-brightness="'.$layer->brightness.'" >
                       
                        <div class="list-selection-choose d-none">
                            <button class="btn-style-design-delete" onclick="deletedinlayer(\''.$pro->id.'\',\''.$item->id.'\')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <button class="btn-style-design-copy" onclick="duplicate();">
                                <i class="fa-solid fa-copy"></i>
                            </button>
                        </div>

                        <img src="'.$layer->banner.'" class="img-fluid '.$img.' image'.$key.'" data-maxw="'.$item->wight.'" data-maxh="'.$item->height.'" style="width: '.$layer->width.';opacity: '.$layer->opacity.';border-radius: '.$layer->border.'px">
                    
                        <span class="'.$text.' text'.$key.'" style="display:inline-block;word-wrap:anywhere;width: '.$layer->width.';color: '.$layer->color.';font-size: '.$layer->size.';font-family: '.$layer->font.';text-decoration: '.$layer->gachchan.';text-transform: '.$layer->uppercase.';font-weight: '.$layer->indam.';letter-spacing: '.$layer->gianchu.';line-height: '.$layer->giandong.';font-style: '.$layer->innghieng.';'.'opacity: '.$layer->opacity.';'.$style_gradient.'">'.$layer->text.'</span>
                    

                    </div>
                    ';
                    $key++;

                    $list_layer[$item->id] = $layer;
                }
            }
            krsort($list_layer_check);

            $category = $modelCategories->find()->where(array('id'=>$pro->category_id))->first();

            if(empty($category)){
                $category = $modelCategories->newEmptyEntity();
            }
            
            return ['type'=>$pro->type,'category'=> $category, 'data' => $pro, 'movelayer' => implode('',$movelayer), 'layer' => $list_layer, 'list_layer_check' => implode('',$list_layer_check)];
        }else{
            return ['error' => ['Sản phẩm chưa xây dựng các Layer']]; 
        }
    }else{
        return ['error' => ['Có lỗi trong quá trình xử lý. Vui lòng thử lại sau']]; 
    }
}

function getLayer($stt, $type = 'text', $link = '', $width = '30', $height = '30', $text = '', $variable='', $variableLabel = '')
{
    if(empty($text)) $text = 'Layer '.$stt;

    return [
        'type' => $type,
        'text' => $text,
        'color' => '#000',
        'size' => '10vw',
        'font' => 'Arial',
        'status' => 1,
        'text_align' => 'left',
        'postion_left' => '50',
        'postion_top' => '50',
        'brightness' => 100,
        'contrast' => 100,
        'saturate' => 100,
        'opacity' => 100,
        'gachchan' => 'none',
        'uppercase' => 'none',
        'innghieng' => 'normal',
        'indam' => 'normal',
        'linear_position' => 'to right',
        'border' => 0,
        'rotate' => '0deg',
        'banner' => $link,
        'gianchu' => 'normal',
        'giandong' => 'normal',
        'opacity' => 1,
        'width' => $width.'vw',
        'height' => $height.'vh',
        'gradient' => 0,
        'gradient_color' => [['position'=>0,'color'=>'#000'],['position'=>1,'color'=>'#000']],
        'variable' => $variable,
        'variableLabel' => $variableLabel,
    ];
}

function getLayertext($stt, $type = 'text', $content= '' , $color = '',$size = '', $font='', $width ='', $height = '')
{

    return [
       'type' => $type,
       'text' => $content,
       'color' => $color,
       'size' => $size,
       'font' => "Arial",
       'status' => 1,
       'text_align' => "left",
       'brightness' => 100,
       'contrast' => 100,
       'saturate' => 100,
       'opacity' => 1,
       'gachchan' => "none",
       'uppercase' => "none",
       'innghieng' => "normal",
       'indam' => "normal",
       'linear_position' => "to right",
       'border' => 0,
       'rotate' => "0deg",
       'banner' => "",
       'gianchu' => "normal",
       'giandong' => "normal",
       'width' => $width,
       'height' => $height,
       'gradient'=>0,
       'postion_left'=>30,
       'postion_top'=>30,
       'gradient_color' => [['position'=>0,'color'=>'#000'],['position'=>1,'color'=>'#000']]
    ];
}

function zipImage($urlLocalFile)
{
    if(function_exists('getKey')){
        $keyTinipng = getKey(22);
    }else{
        $keyTinipng = '';
    }
    
    if(!empty($keyTinipng)){
        require_once("library/tinify/vendor/autoload.php");
        Tinify\setKey($keyTinipng);

        Tinify\fromFile($urlLocalFile)->toFile($urlLocalFile);
    }
}

function createNewProduct($infoUser, $name='', $price=0, $sale_price=0, $type='user_edit', $category_id=1)
{
    global $controller;

    $return = array('code'=>1,
                    'messages'=>array(array('text'=>'Không tồn tại tài khoản người dùng'))
                    );

    if(!empty($infoUser)){
        $modelProduct = $controller->loadModel('Products');
        $modelManagerFile = $controller->loadModel('ManagerFile');
        $modelProductDetail = $controller->loadModel('ProductDetails');

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
        $newproduct->thumn = $thumb; // ảnh background
        $newproduct->thumbnail = $thumbnailUser;
        $newproduct->user_id = $infoUser->id;
        $newproduct->product_id = 0;
        $newproduct->note_admin = '';
        $newproduct->created_at = date('Y-m-d H:i:s');
        $newproduct->views = 0;
        $newproduct->favorites = 0;
        $newproduct->category_id = (int) $category_id;

        $sizeThumb = getimagesize($thumb);

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

        // tạo deep link
        if($type=='user_create'){
            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
                                                'link'=>'https://ezpics.page.link/detailProduct?id='.$newproduct->id,
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
        $sizeBackground = getimagesize($thumb);
        $newLayer = $modelProductDetail->newEmptyEntity();  

        $newLayer->products_id = $newproduct->id;
        $newLayer->name = 'Layer 1';

        $content = getLayer(1, 'text', '', 80, 0, 'Layer 1');
        $newLayer->content = json_encode($content);
        $newLayer->created_at = date('Y-m-d H:i:s');
        $newLayer->sort = 1;
        
        
        $modelProductDetail->save($newLayer);

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
            ['name'=>'Bài thuyết trình (16:9)','width'=>1920,'height'=>1080],
            ['name'=>'Bài thuyết trình (9:16)','width'=>1080,'height'=>1920],
            ['name'=>'Logo','width'=>500,'height'=>500],
            ['name'=>'Poster (dọc)','width'=>4960,'height'=>7015],
            ['name'=>'Bài đăng Instagram (vuông)','width'=>1080,'height'=>1080],
            ['name'=>'Bài đăng Facebook (ngang)','width'=>940,'height'=>788],
            ['name'=>'Ảnh bìa Facebook','width'=>1640,'height'=>924],
            ['name'=>'Hình nền máy tính','width'=>1920,'height'=>1080],
            ['name'=>'A0 (dọc)','width'=>3179,'height'=>4494],
            ['name'=>'A1 (dọc)','width'=>2245,'height'=>3179],
            ['name'=>'A2 (dọc)','width'=>1587,'height'=>2245],
            ['name'=>'A3 (dọc)','width'=>1123,'height'=>1587],
            ['name'=>'A4 (dọc)','width'=>794,'height'=>1123],
            ['name'=>'A5 (dọc)','width'=>559,'height'=>794],
        ];
}