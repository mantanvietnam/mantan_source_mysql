<?php 

require_once __DIR__ . '/lib/google/vendor/autoload.php';

global $urlCreateImage;
global $ftp_server_upload_image;
global $ftp_username_upload_image;
global $ftp_password_upload_image;

$ftp_server_upload_image = "171.244.16.76";
$ftp_username_upload_image = "ezpics";
$ftp_password_upload_image = "uImzVeNYgF";

/*
$ftp_server_upload_image = "13.215.88.179";
$ftp_username_upload_image = "admin_apis";
$ftp_password_upload_image = "sIu6v%OHwfmKxcx-";
*/

$urlCreateImage = 'http://14.225.238.137:3000/convert';

$menus= array();
$menus[0]['title']= 'Quản lý SPA';

$menus[0]['sub'][0]= array('title'=>'Tài khoản quản trị SPA',
                            'url'=>'/plugins/admin/databot_spa-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin.php',
                        );
$menus[0]['sub'][1]= array('title'=>'Danh sách SPA',
                            'url'=>'/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listSpaAdmin.php',
                        );

addMenuAdminMantan($menus);

global $urlHomes;
global $google_clientId;
global $google_clientSecret;
global $google_redirectURL;

/*
$google_clientId= '637094275991-k51plafaifed1t08s9h9aukvl8g540md.apps.googleusercontent.com';
$google_clientSecret= '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';
*/
$google_clientId= '637094275991-2f53f5g9ls2d34r05ugshhugb57ng4rm.apps.googleusercontent.com';
$google_clientSecret= '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';

$google_redirectURL= $urlHomes . 'ggCallback';
        

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}





function sendEmailnewpassword($email='', $fullName='', $pass= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[SPA] ' . 'Mã xác thực cấp lại mật khẩu mới';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Mã xác thực cấp lại mật khẩu mới</title>
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
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$pass.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Phần mềm quản lý Spa chuyên nghiệp</span>
                        </div>
                        <ul class="list-unstyled" style=" font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://databot.vn">https://databot.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

       sendEmail($to, $cc, $bcc, $subject, $content);      
    }
}

function getSpa($id)
{
    global $modelOption;
    global $controller;
    
    $modelSpa = $controller->loadModel('Spas');
        
    $data = $modelSpa->find()->where(['id'=>intval($id)])->first();       
    
    return $data;
}
?>