<?php

$menus = array();
$menus[0]['title'] = 'Liên hệ';
$menus[0]['sub'][0] = array('title' => 'Danh sách liên hệ',
                            'url'=>'/plugins/admin/contact-views-admin-listContactAdmin',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'listContactAdmin'
);
addMenuAdminMantan($menus);

$categoryMenu[0]['title'] = 'Liên hệ';
$categoryMenu[0]['sub'] = array(array ( 'url' => '/contact',
                                        'name' => 'Liên hệ'
                                    ),
                            );


addMenusAppearance($categoryMenu);

function sendEmailContact($email='',$fullName='',$phone='', $contacht='')
{

    global $modelOptions;

    $conditions = array('key_word' => 'seo_site');
    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = 'Liên hệ mới từ ['.@$data_value['title'].']';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Liên hệ mới từ [Web Bumas]</title>
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
                    <div class="main" style=" font-size: 16px;">
                        Full name: '.$fullName.'<br/> 
                        Email: '.$email.'<br/> 
                        Phone: '.$phone.'<br/>
                        contacht: '.$contacht.'<br>
                        <br/>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                   

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}
?>