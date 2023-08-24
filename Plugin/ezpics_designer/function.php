<?php 
require_once __DIR__ . '/lib/google/vendor/autoload.php';

global $urlCreateImage;
global $ftp_server_upload_image;
global $ftp_username_upload_image;
global $ftp_password_upload_image;
global $ftp_password_upload_image;
global $price_warehouses;
$ftp_server_upload_image = "171.244.16.76";
$ftp_username_upload_image = "ezpics";
$ftp_password_upload_image = "uImzVeNYgF";

global $urlCreateImage;
global $price_pro;
global $price_min_create_warehouses;
global $price_remove_background;
global $recommenders;

$price_remove_background = 0;
$price_create_content = 1000;
$price_pro = 1999000;
$price_warehouses = 999000;
$recommenders = 5;
$price_min_create_warehouses = 300000;
/*
$ftp_server_upload_image = "13.215.88.179";
$ftp_username_upload_image = "admin_apis";
$ftp_password_upload_image = "sIu6v%OHwfmKxcx-";
*/

/*
$urlsCreateImage = ['http://14.225.238.137:3000/convert','http://171.244.16.76:3000/convert'];
$randIndex = array_rand($urlsCreateImage);
$urlCreateImage = $urlsCreateImage[$randIndex];
*/
$urlCreateImage = 'http://171.244.16.76:3000/convert';

$menus= array();
$menus[0]['title']= 'Ezpics';

$menus[0]['sub'][0]= array('title'=>'Thông tin đăng ký design',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-designRegistration-listDesignRegistrationAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
                        );
$menus[0]['sub'][1]= array('title'=>'Thông tin Người dùng',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
                        );
$menus[0]['sub'][2]= array('title'=>'Order mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_designer-view-admin-orderProduct-listOrderProductAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDesignRegistrationAdmin',
                            
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

function getCustomer($id)
{
    global $modelOption;
    global $controller;
    $modelCustomer = $controller->loadModel('customers');
        $data = $modelCustomer->find()->where(['id'=>intval($id)])->first();       
        return $data;
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

function sendEmailnewpassword($email='', $fullName='', $pass= '')
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

function compressImageBase64($base64Image)
{
    if(function_exists('getKey')){
        $keyTinipng = getKey(22);
    }else{
        $keyTinipng = '';
    }
    
    if(!empty($keyTinipng)){
        require_once("lib/tinify/vendor/autoload.php");
        Tinify\setKey($keyTinipng);

        try {
            Tinify\validate();

            $sourceData = base64_decode($base64Image);
            $source = Tinify\fromBuffer($sourceData);

            $compressed = $source->toBuffer();
            $compressedBase64 = base64_encode($compressed);

            return $compressedBase64;
        } catch (\Tinify\AccountException $e) {
            // Xử lý lỗi tài khoản TinyPNG
            return false;
        } catch (\Tinify\ClientException $e) {
            // Xử lý lỗi máy chủ hoặc kết nối
            return false;
        } catch (\Tinify\ServerException $e) {
            // Xử lý lỗi máy chủ TinyPNG
            return false;
        } catch (\Tinify\ConnectionException $e) {
            // Xử lý lỗi kết nối
            return false;
        }
    }

    return false;
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

function screenshotProduct2($url='', $width=1920, $height=1080)
{
    if(function_exists('getKey')){
        $keyScreenshot = getKey(37);
    }else{
        $keyScreenshot = '';
    }

    if(!empty($keyScreenshot) && !empty($url)){
        require_once __DIR__ . '/lib/screenshotmachine/vendor/screenshotmachine/screenshotmachine-php/ScreenshotMachine.php';

        $secret_phrase = ""; //leave secret phrase empty, if not needed

        $machine = new ScreenshotMachine($keyScreenshot, $secret_phrase);

        //mandatory parameter

        $options['url'] = $url;

        // all next parameters are optional, see our website screenshot API guide for more details
        $options['dimension'] = $width."x".$height;  // or "1366xfull" for full length screenshot
        $options['device'] = "desktop";
        $options['format'] = "png";
        $options['cacheLimit'] = "0";
        $options['delay'] = "200";
        $options['zoom'] = "100";

        return $machine->generate_screenshot_api_url($options);
    }else{
        return '';
    }
}
?>