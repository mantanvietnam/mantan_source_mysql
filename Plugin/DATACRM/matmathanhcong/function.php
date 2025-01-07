<?php

$menus = array();
$menus[0]['title'] = 'Mật mã thành công';
$menus[0]['sub'][0] = array('title' => 'Đăng ký bản FULL',
                            'url'=>'/plugins/admin/matmathanhcong-view-admin-requestExportFull',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'requestExportFull'
                        );

$menus[0]['sub'][1] = array('title' => 'Cài đặt',
                            'url'=>'/plugins/admin/matmathanhcong-view-admin-settingMMTCAPI',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'settingMMTCAPI'
                        );

addMenuAdminMantan($menus);


global $price_full;
global $bank_number;
global $bank_name;
global $key_banking;
global $idBot;
global $tokenBot;
global $idBlockConfirm;
global $idBlockDownload;
global $modelOptions;

global $urlAPI;
global $userAPI;
global $passAPI;
global $maxExport;
global $numberExport;

$urlAPI = 'https://quanly.matmathanhcong.vn';
$userAPI = '';
$passAPI = '';
$maxExport = 0;
$numberExport = 0;

$price_full = 0;
$bank_number = '87818938888';
$bank_name = 'Tran%20Van%20Toan';
$key_banking = 'MMTC';
$idBot = '63edf5c2642152d701d5739b';
$tokenBot = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYzZWRmNWMyNjQyMTUyZDcwMWQ1NzM5YiIsIm5hbWUiOiJCTEFOSyBCT1QgLSBDb3B5IiwiaWF0IjoxNjc2NTM5MzMwLCJleHAiOjE5OTE4OTkzMzB9.6GeoT8QLvvUvyzBJ_zeyLlMq4iAXhHnV2UtjVJhUR9M';
$idBlockConfirm = '65c50e2f287c4a2b9722030c';
$idBlockDownload = '65c5f0a246761a8554da9468';

$conditions = array('key_word' => 'settingMMTCAPI');
$settingMMTCAPI = $modelOptions->find()->where($conditions)->first();

if(!empty($settingMMTCAPI->value)){
    $data_value = json_decode($settingMMTCAPI->value, true);

    $userAPI = @$data_value['userAPI'];
    $passAPI = @$data_value['passAPI'];
    $maxExport = (int) @$data_value['maxExport'];
    $numberExport = (int) @$data_value['numberExport'];

    $price_full = (int) @$data_value['price'];

    $bank_number = @$data_value['number_bank'];
    $bank_name = @$data_value['account_bank'];
    $key_banking = @$data_value['key_bank'];

    $idBot = @$data_value['idBot'];
    $tokenBot = @$data_value['tokenBot'];
    $idBlockConfirm = @$data_value['idBlockConfirm'];
    $idBlockDownload = @$data_value['idBlockDownload'];
}

/*
$bank_number = '06931228686';
$bank_name = 'Tran Ngoc Manh';
*/

if(!empty($_GET['aff'])){
    global $session;

    $session->write('aff', $_GET['aff']);
}

function getTokenMMTCAPI()
{
    global $urlAPI;
    global $userAPI;
    global $passAPI;
    global $modelOptions;

    $conditions = array('key_word' => 'tokenAPIMMTC');
    $data = $modelOptions->find()->where($conditions)->first();
    
    if(!empty($data->value)){
        $value = json_decode($data->value, true);

        if($value['deadline'] > time()+86400){
            return $value['token'];
        }
    }

    // lấy token mới
    $dataSend = ['username'=>$userAPI, 'password'=>$passAPI];
    $header = ['Content-Type: application/x-www-form-urlencoded'];
    $typeData = 'x-www-form-urlencoded';

    $token = sendDataConnectMantan($urlAPI.'/api/GetToken', $dataSend, $header, $typeData);

    if(!empty($token)){
        $token = json_decode(trim($token), true);

        if(!empty($token['access_token'])){
            if(empty($data)){
                $data = $modelOptions->newEmptyEntity();
            }

            $data->key_word = 'tokenAPIMMTC';
            $data->value = json_encode(['token'=>$token['access_token'], 'deadline'=>time()+30*86400]);

            $modelOptions->save($data);

            return $token['access_token'];
        }
    }
    
    return '';
}

function getListProductMMTCAPI()
{
    global $urlAPI;

    $token = getTokenMMTCAPI();

    if(!empty($token)){
        $dataSend = [];
        $header = ['Authorization: '.$token];

        $listData = sendDataConnectMantan($urlAPI.'/api/GetListProduct', $dataSend, $header);

        if(!empty($listData)){
            return json_decode($listData, true);
        }
    }

    return [];
}

function getLinkFullMMTCAPI($name='', $birthdate='', $phone='', $email='', $address='', $avatar='', $gender=1, $id_category = 0, $checkMaxConfig = 1)
{
    global $urlAPI;
    global $maxExport;
    global $numberExport;
    global $modelOptions;

    if($numberExport < $maxExport || $checkMaxConfig == 0){
        $categories = getListProductMMTCAPI();
        $token = getTokenMMTCAPI();
        
        if(!empty($token) && !empty($categories[$id_category]['category_id'])){
            if(empty($email)) $email = 'tranmanhbk179@gmail.com';
            if(empty($address)) $address = '18 Thanh Bình, Mộ Lao, Hà Đông, Hà Nội';

            if(!empty($name) && !empty($birthdate) && !empty($phone)){
                $birthdate = str_replace('/', '_', $birthdate);

                $dataSend = [   'category_id' => $categories[$id_category]['category_id'],
                                'customer_name' => $name,
                                'customer_birthdate' => $birthdate,
                                'customer_phone' => $phone,
                                'customer_email' => $email,
                                'customer_address' => $address,
                                'customer_avatar' => $avatar,
                                'customer_gender' => $gender,
                                'user_avatar' => '',
                                'source'=>'ICHAM CRM'
                            ];

                $header = ['Authorization: '.$token, 'Content-Type: application/x-www-form-urlencoded'];
                $typeData = 'x-www-form-urlencoded';
                $typeSend = 'GET';

                $linkFull = sendDataConnectMantan($urlAPI.'/api/GetLink', $dataSend, $header, $typeData, $typeSend);
                
                // debug($linkFull);
                // debug($dataSend);
                
                if(!empty($linkFull)){
                    if(substr($linkFull, 0, 8) === "https://" OR substr($linkFull, 0, 7) === "http://"){
                        // cập nhập lại số lượt xuất
                        $conditions = array('key_word' => 'settingMMTCAPI');
                        $data = $modelOptions->find()->where($conditions)->first();
                       
                        if(!empty($data->value)){
                            $value = json_decode($data->value, true);

                            if(empty($value['numberExport'])){
                                $value['numberExport'] = 0;
                            }

                            $value['numberExport'] ++;

                            $data->value = json_encode($value);

                            $modelOptions->save($data);
                        }

                        return trim($linkFull, '"');
                    }else{
                        //echo $linkFull;die;
                        return '';
                    }
                }

                return '';
            }else{
                return '';
            }
        }else{
            return '';
        }
    }else{
        echo 'Bạn đã xuất quá giới hạn cho phép, tối đa bạn chỉ có thể xuất '.number_format($maxExport).' bản thần số học.';die;
    }

    return '';
}

//getLinkFullMMTCAPI('Trần Ngọc Mạnh', '17/09/1989', '0816560000', 'tranmanhbk179@gmail.com', 'Hà Nội', 'https://matmathanhcong.vn/upload/admin/images/logo-phoenix-1.png', 1);

function ketquapheptinhcong($str)
{   
    $return = 0;
    if(!empty($str)){
        foreach ($str as $key => $value) {
            $return += (int) $value;
        }
    }

    if($return>9){
        $return = (string) $return;
        $return = str_split($return);

        return ketquapheptinhcong($return);
    }else{
        return $return;
    }
}

function process_send_link($order_id = 0)
{
    global $controller;
    global $idBot;
    global $tokenBot;
    global $idBlockConfirm;
    global $idBlockDownload;

    $modelRequestExports = $controller->loadModel('RequestExports');

    $info = $modelRequestExports->find()->where(['id'=>(int) $order_id])->first();

    if(!empty($info)){
        $info->status_pay = 'done';
        $modelRequestExports->save($info);

        if(!empty($info->email)){
            sendEmailLinkFull($info->email, $info->name, $info->link_download);
        }

        // gửi FB
        if(!empty($info->idMessenger)){
            $attributesSmax = [];
            $attributesSmax['linkDownloadMMTC']= $info->link_download;
            
            $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$info->idMessenger.'/send?bot_token='.$tokenBot.'&block_id='.$idBlockDownload.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
            
            $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
        }

        // gửi zalo
        if(!empty($info->idZalo)){
            // gửi tin nhắn chatbot Zalo
            if(function_exists('sendMessZalo')){
                $id_oa = '';
                $app_id = '';
                $user_id_zalo = $info->idZalo;
                $text = 'Link tải bản đầy đủ Mật Mã Thành Công của '.$info->name.': '.$info->link_download;
                //$text = 'Chúng tôi sẽ gửi link tải bản đầy đủ Thần Số Học về email của bạn ngay khi hệ thống xử lý xong yêu cầu';
                $image = '';

                sendMessZalo($id_oa, $app_id, $user_id_zalo, $text, $image);
            }
        }

        if(!empty($info->affiliate_phone)){
            $checkNumberOrder = $modelRequestExports->find()->where(['affiliate_phone'=>$info->affiliate_phone, 'status_pay'=>'done'])->all()->toList();

            if(count($checkNumberOrder) >= 3){
                $info_aff = $modelRequestExports->find()->where(['phone'=>$info->affiliate_phone, 'status_pay'=>'wait'])->first();

                if(!empty($info_aff)){
                    $info_aff->status_pay = 'done';
                    $modelRequestExports->save($info_aff);

                    // gửi email
                    if(!empty($info_aff->email)){
                        sendEmailLinkFull($info_aff->email, $info_aff->name, $info_aff->link_download);
                    }

                    // gửi FB
                    if(!empty($info_aff->idMessenger)){
                        $attributesSmax = [];
                        $attributesSmax['linkDownloadMMTC']= $info_aff->link_download;
                        
                        $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$dataSend['idMessenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockDownload.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                        
                        $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                    }

                    // gửi zalo
                    if(!empty($info_aff->idZalo)){
                        // gửi tin nhắn chatbot Zalo
                        if(function_exists('sendMessZalo')){
                            $id_oa = '';
                            $app_id = '';
                            $user_id_zalo = $info_aff->idZalo;
                            $text = 'Link tải bản đầy đủ Mật Mã Thành Công của '.$info_aff->name.': '.$info_aff->link_download;
                            //$text = 'Chúng tôi sẽ gửi link tải bản đầy đủ Thần Số Học về email của bạn ngay khi hệ thống xử lý xong yêu cầu';
                            $image = '';

                            sendMessZalo($id_oa, $app_id, $user_id_zalo, $text, $image);

                        }
                    }
                }
            }
        }
    }
}

function sendEmailLinkFull($email='', $name='bạn', $link_download='')
{
    $to = array();
    $to[]= trim($email);
        
    $cc = array();
    $bcc = array();
    $subject = '[MMTC] ' . 'Link tải bản luận giải đầy đủ Mật Mã Thành Công của '.$name;

    $content='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Link tải bản luận giải đầy đủ Mật Mã Thành Công của bạn</title>
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
                    <span>MẬT MÃ THÀNH CÔNG</span>
                </div>
                <div class="main">
                    <em style="margin: 10px 0 10px;display: inline-block;">Xin chào '.$name.' !</em> <br>
                    <br/>
                    Link tải bản luận giải đầy đủ MẬT MÃ THÀNH CÔNG của bạn là <a href="'.$link_download.'">'.$link_download.'</a>
                    
                    <br><br>
                    
                    Trân trọng ./
                </div>
                <div class="thong_tin">
                    <div class="line"><div class="line1"></div></div>
                    <div class="cty">
                        <span style="font-weight: bold;">MẬT MÃ THÀNH CÔNG</span> <br>
                        <span>Con số gắn với cuộc đời của bạn</span>
                    </div>
                    <ul class="list-unstyled" style="    font-size: 15px;">
                        <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                        <li>Mobile: 081.656.0000</li>
                        <li>Website: <a href="https://matmathanhcong.vn">https://matmathanhcong.vn</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </body>
    </html>';

    sendEmail($to, $cc, $bcc, $subject, $content);
}
?>