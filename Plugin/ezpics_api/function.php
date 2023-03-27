<?php 
global $price_remove_background;
global $key_remove_bg;
global $name_bank;
global $number_bank;
global $account_holders_bank;
global $link_qr_bank;
global $key_transaction;

$number_bank = '0693.122.8668';
$name_bank = 'Tiên Phong Bank (TPB)';
$account_holders_bank = 'Trần Ngọc Mạnh';
$link_qr_bank = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/link_qr_bank.jpg';
$key_transaction = 'ezpics';

$price_remove_background = 10000;
$key_remove_bg = 'geBYsERw9PNMJHnQLtu1CE4d';

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function removeBackground($link_image_local='')
{
    if(!empty($link_image_local)){
        global $key_remove_bg;

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

        $fp = fopen(__DIR__.'/../../'.$link_image_local, "wb");
        fwrite($fp, $res->getBody());
        fclose($fp);
    }
}

function process_add_money($number=0, $desc='')
{
    global $modelOption;
    global $key_transaction;
   
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
                    $checkOrder = $modelOrder->find()->where(array('id'=> (int) $orderCode))->first();

                    if(empty($checkOrder)){
                        $data->account_balance += $number;
                        
                        if($modelMember->save($data)){
                            $checkOrder->total = $number;
                            $checkOrder->status = 2;
                            $checkOrder->updated_at = date('Y-m-d H:i:s');
                            
                            $modelOrder->save($checkOrder);

                            sendEmailAddMoney($data->email, $data->name, $number);
                        }
                    }
                }
            }
        }
    }
}

function sendEmailAddMoney($email='', $fullName='', $coin= '')
{
    global $modelOption;
    global $contactSite;
    global $smtpSite;

    $from = array($contactSite['email'] => $smtpSite['Option']['value']['show']);
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

        // $modelOption->sendMail($from, $to, $cc, $bcc, $subject, $content);
    }
}
