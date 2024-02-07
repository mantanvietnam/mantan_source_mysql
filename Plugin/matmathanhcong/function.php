<?php

$menus = array();
$menus[0]['title'] = 'Mật mã thành công';
$menus[0]['sub'][0] = array('title' => 'Đăng ký bản FULL',
                            'url'=>'/plugins/admin/matmathanhcong-view-admin-requestExportFull',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'requestExportFull'
);
addMenuAdminMantan($menus);


global $price_full;
global $bank_number;
global $bank_name;
global $key_banking;

$price_full = 500000;
$key_banking = 'MMTC';

$bank_number = '87818938888';
$bank_name = 'Tran Van Toan';

/*
$bank_number = '06931228686';
$bank_name = 'Tran Ngoc Manh';
*/

if(!empty($_GET['aff'])){
    global $session;

    $session->write('aff', $_GET['aff']);
}

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

    $modelRequestExports = $controller->loadModel('RequestExports');

    $info = $modelRequestExports->find()->where(['id'=>(int) $order_id])->first();

    if(!empty($info)){
        $info->status_pay = 'done';
        $modelRequestExports->save($info);

        if(!empty($info->email)){
            sendEmailLinkFull($info->email, $info->name, $info->link_download);
        }

        if(!empty($info->affiliate_phone)){
            $checkNumberOrder = $modelRequestExports->find()->where(['affiliate_phone'=>$info->affiliate_phone, 'status_pay'=>'done'])->all()->toList();

            if(count($checkNumberOrder) >= 3){
                $info_aff = $modelRequestExports->find()->where(['phone'=>$info->affiliate_phone, 'status_pay'=>'wait'])->first();

                if(!empty($info_aff)){
                    $info_aff->status_pay = 'done';
                    $modelRequestExports->save($info_aff);

                    if(!empty($info_aff->email)){
                        sendEmailLinkFull($info_aff->email, $info_aff->name, $info_aff->link_download);
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