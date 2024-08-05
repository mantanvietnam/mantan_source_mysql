<?php

$menus = array();
$menus[0]['title'] = 'Exc-go';

$menus[0]['sub'][0] = array(
    'title' => 'Danh sách thành viên',
    'url' => '/plugins/admin/excgo-view-admin-user-listUserAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserAdmin',
);

$menus[0]['sub'][1] = array('title' => 'Danh sách khu vực',
    'url' => '/plugins/admin/excgo-view-admin-province-listProvinceAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listProvinceAdmin',
);

$menus[0]['sub'][2] = array('title' => 'Danh sách cuốc xe',
    'url' => '/plugins/admin/excgo-view-admin-booking-listBookingAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listBookingAdmin',
);

$menus[0]['sub'][3] = array('title' => 'Yêu cầu nâng cấp tài khoản',
    'url' => '/plugins/admin/excgo-view-admin-upgradeRequest-listUpgradeRequestToDriverAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUpgradeRequestToDriverAdmin',
);

$menus[0]['sub'][4] = array('title' => 'Yêu cầu rút tiền',
    'url' => '/plugins/admin/excgo-view-admin-withdrawRequest-listWithdrawRequestAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listWithdrawRequestAdmin',
);

$menus[0]['sub'][5] = array('title' => 'Khiếu nại',
    'url' => '/plugins/admin/excgo-view-admin-complaint-listComplaintAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listComplaintAdmin',
);

$menus[0]['sub'][6] = array('title' => 'Yêu cầu hỗ trợ',
    'url' => '/plugins/admin/excgo-view-admin-support-listSupportAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listSupportAdmin',
);

$menus[0]['sub'][7] = array('title' => 'Quản lí giao dịch',
    'url' => '/plugins/admin/excgo-view-admin-transaction-listTransactionAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listTransactionAdmin',
);

$menus[0]['sub'][8] = array('title' => 'Quản lí mua bán điểm',
    'url' => '/plugins/admin/excgo-view-admin-orderPoint-listOrderPointAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listOrderPointAdmin',
);


$menus[0]['sub'][9] = array('title' => 'Cài đặt phí sàn',
    'url' => '/plugins/admin/excgo-view-admin-config-configServiceFeeAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'configServiceFeeAdmin',
);

$menus[0]['sub'][10] = array('title' => 'Cài đặt gửi email',
    'url' => '/plugins/admin/excgo-view-admin-config-configSendEmailAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'configSendEmailAdmin',
);

$menus[0]['sub'][11] = array('title' => 'Kiểm tra cuốc xe đã hoàn thành',
    'url' => '/plugins/admin/excgo-view-admin-config-checkCompletedBookingAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'checkCompletedBookingAdmin',
);

$menus[0]['sub'][12] = array('title' => 'Gửi thông báo ',
    'url' => '/plugins/admin/excgo-view-admin-notification-addNotificationAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'addNotificationAdmin',
);
$menus[0]['sub'][13] = array('title' => 'Cài đặt thông số',
    'url' => '/plugins/admin/excgo-view-admin-setting-settingAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'settingAdmin',
);
$menus[0]['sub'][14] = array('title' => 'Thống kê tài khoản',
    'url' => '/plugins/admin/excgo-view-admin-user-listUserStatisticAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserStatisticAdmin',
);
$menus[0]['sub'][15] = array('title' => 'Phần thưởng',
    'url' => '/plugins/admin/excgo-view-admin-reward-listRewardAdmin.php',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listRewardAdmin',
);

addMenuAdminMantan($menus);

global $keyFirebase;
$keyFirebase = 'AAAAo-cvWGs:APA91bGtlvHuQ-Dj2bW6KdWNfWkp3fmYZDLv13HfEzevZJ-rSWNs9Ut0wCy6iGF4DKvqNTleRdFYFg4Xx1ry_2x5uQcCOJ8phOxKOVZIDZ1KIJ3ZMafVkGcSELTUEPAd6taLHk27dbBw';

global $typeCar;

$typeCar = ['4' => 'Xe 4 chỗ',
    '5' => 'Xe 5 chỗ',
    '7' => 'Xe 7 chỗ',
    '9' => 'Xe 9 chỗ',
    '16' => 'Xe 16 chỗ',
    '29' => 'Xe 29 chỗ',
    '32' => 'Xe  32 chỗ',
    '96' => 'Xe 96 chỗ',
    '45' => 'Xe 45 chỗ',
    '55' => 'Xe 55 chỗ',
    '65' => 'Xe 65 chỗ',
];

function createToken($length = 30): string
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length) . time();
}


function sendEmailCodeForgotPassword($email = '', $fullName = '', $code = '')
{
    $to = array();

    if (!empty($email)) {
        $to[] = trim($email);

        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực cấp lại mật khẩu mới';

        $content = '<!DOCTYPE html>
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
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào ' . $fullName . ' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>' . $code . '</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng đặt xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: </li>
                            <li>Mobile: </li>
                            <li>Website: <a href="#"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailAddMoney($email = '', $name = '', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$name.' !</em> <br>
                        <br/>
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống <a href="#">https://excgo.vn</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailSubtractMoney($email = '', $name = '', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Bị trừ tiền Khi liên cấp tài xế ';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Bì trừ '.number_format($coin).'Đ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$name.' !</em> <br>
                        <br/>
                        Bạn đã bị '.number_format($coin).'đ  tài khoản của bạn Khi liên cấp tài xế  <a href="#">https://excgo.vn</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailWithdrawRequest($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;

    if(!empty($email)){

        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['listWithdrawRequestAdmin'])){
            $listSupportAdmin = explode(',', $data_value['listWithdrawRequestAdmin']);

            $to += $listSupportAdmin;
        }

        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Tài xế yêu cầu rút tiền từ tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Yêu cầu rút tiền</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Có một yêu cầu rút tiền từ tài xế '.$userName.'. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-withdrawRequest-listWithdrawRequestAdmin.php"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailUpgradeToDriver($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;

    if(!empty($email)){
        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['listUpgradeRequestToDriverAdmin'])){
            $listSupportAdmin = explode(',', $data_value['listUpgradeRequestToDriverAdmin']);

            $to += $listSupportAdmin;
        }

        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Người dùng yêu cầu nâng cấp tài khoản thành tài xế';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Yêu cầu nâng cấp tài khoản</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Có một yêu cầu nâng cấp tài khoản từ tài xế '.$userName.'. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-user-viewUserDetailAdmin.php/?id=' .$requestId.'"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailUpgradeToDriverSuccess($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;

    if(!empty($email)){
        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['listUpgradeRequestToDriverAdmin'])){
            $listSupportAdmin = explode(',', $data_value['listUpgradeRequestToDriverAdmin']);

            $to += $listSupportAdmin;
        }

        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Người dùng chở thành tài xế thành công';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Người dùng chở thành tài xế thành công</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Người dùng chở thành tài xế là '.$userName.'. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-user-listUserAdmin?id=' .$requestId.'"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailSupportRequest($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;

    if(!empty($email)) {
        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['listSupportAdmin'])){
            $listSupportAdmin = explode(',', $data_value['listSupportAdmin']);

            $to += $listSupportAdmin;
        }


        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Người dùng yêu cầu hỗ trợ';

        $content = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Yêu cầu hỗ trợ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Có một yêu cầu hỗ trợ từ tài xế ' . $userName . '. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-support-listSupportAdmin.php/?id=' . $requestId . '"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailComplaint($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;
    

    if(!empty($email)) {
        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['listComplaintAdmin'])){
            $listSupportAdmin = explode(',', $data_value['listComplaintAdmin']);

            $to += $listSupportAdmin;
        }

        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Người dùng yêu cầu khiếu nại';

        $content = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Yêu cầu khiếu nại</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Có một yêu cầu khiếu nại từ tài xế ' . $userName . '. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-complaint-listComplaintAdmin.php/?id=' . $requestId . '"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailnewUserRegistration($userName = '', $requestId = '', $email = 'excgoquanly@gmail.com')
{
    global $controller;
    global $modelOptions;
    

    if(!empty($email)) {
        $to = [trim($email)];

        $configSendEmail = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();
        
        $data_value = array();
        if(!empty($configSendEmail->value)){
            $data_value = json_decode($configSendEmail->value, true);
        }

        if(!empty($data_value['newUserRegistration'])){
            $listSupportAdmin = explode(',', $data_value['newUserRegistration']);

            $to += $listSupportAdmin;
        }

        $cc = array();
        $bcc = array();
        $subject = '[EXC-GO] ' . 'Đăng ký người dùng mới';

        $content = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Đăng ký người dùng mới</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        Có một đăng ký người dùng mới ' . $userName . '. 
                        Xem chi tiết tại <a href="https://apis.exc-go.vn/plugins/admin/excgo-view-admin-user-listUserAdmin?id=' . $requestId . '"> đây</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">EXC-GO</span> <br>
                            <span>Ứng dụng chia sẻ chuyến xe EXC-GO</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Nguyễn Văn A</li>
                            <li>Mobile: 0123456789</li>
                            <li>Website: <a href="#">https://excgo.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function listBank(): array
{
    return [
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
}

function sendNotification($data, $target)
{
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();

    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title' => $data['title'], 'body' => $data['content'], 'sound' => 'default'];

    if (is_array($target)) {
        $fields['registration_ids'] = $target;
    } else {
        $fields['to'] = $target;
    }

    $headers = array(
        'Content-Type:application/json',
        'Authorization:key=' . $keyFirebase
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

function getListCity(): array
{
    return array(
        '1' => array('id' => 1, 'name' => 'Hà Nội', 'gps' => '21.025905,105.846576', 'bsx' => array(29, 30, 31, 32, 33)),
        '2' => array('id' => 2, 'name' => 'TP Hồ Chí Minh', 'gps' => '10.820645,106.632518', 'bsx' => array(50, 51, 52, 53, 54, 55, 56, 57, 58, 59)),
        '3' => array('id' => 3, 'name' => 'Đà Nẵng', 'gps' => '16.053866,108.203836', 'bsx' => array(43)),
        '4' => array('id' => 4, 'name' => 'Hải Phòng', 'gps' => '20.843685,106.694454', 'bsx' => array(15, 16)),
        '5' => array('id' => 5, 'name' => 'Cần Thơ', 'gps' => '10.044264,105.748773', 'bsx' => array(65)),
        '6' => array('id' => 6, 'name' => 'An Giang', 'gps' => '10.503183,105.119829', 'bsx' => array(67)),
        '7' => array('id' => 7, 'name' => 'Bà Rịa - Vũng Tàu', 'gps' => '10.563561,107.276515', 'bsx' => array(72)),
        '8' => array('id' => 8, 'name' => 'Bắc Giang', 'gps' => '21.362262,106.176664', 'bsx' => array(13, 98)),
        '9' => array('id' => 9, 'name' => 'Bắc Kạn', 'gps' => '22.240912,105.819391', 'bsx' => array(97)),
        '10' => array('id' => 10, 'name' => 'Bạc Liêu', 'gps' => '9.291818,105.467610', 'bsx' => array(94)),
        '11' => array('id' => 11, 'name' => 'Bắc Ninh', 'gps' => '21.136271,106.083659', 'bsx' => array(99)),
        '12' => array('id' => 12, 'name' => 'Bến Tre', 'gps' => '10.137806,106.565089', 'bsx' => array(71)),
        '13' => array('id' => 13, 'name' => 'Bình Định', 'gps' => '14.169255,108.899803', 'bsx' => array(77)),
        '14' => array('id' => 14, 'name' => 'Bình Dương', 'gps' => '11.207645,106.578304', 'bsx' => array(61)),
        '15' => array('id' => 15, 'name' => 'Bình Phước', 'gps' => '11.680601,106.825329', 'bsx' => array(93)),
        '16' => array('id' => 16, 'name' => 'Bình Thuận', 'gps' => '10.947979,107.826546', 'bsx' => array(86)),
        '17' => array('id' => 17, 'name' => 'Cà Mau', 'gps' => '8.820449,105.084218', 'bsx' => array(69)),
        '18' => array('id' => 18, 'name' => 'Cao Bằng', 'gps' => '22.803639,105.711757', 'bsx' => array(11)),
        '19' => array('id' => 19, 'name' => 'Đắk Lắk', 'gps' => '12.865012,108.003386', 'bsx' => array(47)),
        '20' => array('id' => 20, 'name' => 'Đắk Nông', 'gps' => '12.107715,107.830821', 'bsx' => array(48)),
        '21' => array('id' => 21, 'name' => 'Điện Biên', 'gps' => '21.752904,103.101496', 'bsx' => array(27)),
        '22' => array('id' => 22, 'name' => 'Đồng Nai', 'gps' => '10.714318,107.005192', 'bsx' => array(60)),
        '23' => array('id' => 23, 'name' => 'Đồng Tháp', 'gps' => '10.581382,105.688341', 'bsx' => array(66)),
        '24' => array('id' => 24, 'name' => 'Gia Lai', 'gps' => '13.870961,108.282026', 'bsx' => array(81)),
        '25' => array('id' => 25, 'name' => 'Hà Giang', 'gps' => '22.522165,104.765151', 'bsx' => array(23)),
        '26' => array('id' => 26, 'name' => 'Hà Nam', 'gps' => '20.447984,105.919875', 'bsx' => array(90)),
        '27' => array('id' => 27, 'name' => 'Hà Tĩnh', 'gps' => '18.264984,105.696628', 'bsx' => array(38)),
        '28' => array('id' => 28, 'name' => 'Hải Dương', 'gps' => '20.781788,106.289502', 'bsx' => array(34)),
        '29' => array('id' => 29, 'name' => 'Hậu Giang', 'gps' => '9.790570,105.576663', 'bsx' => array(95)),
        '30' => array('id' => 30, 'name' => 'Hòa Bình', 'gps' => '20.730707,105.474031', 'bsx' => array(28)),
        '31' => array('id' => 31, 'name' => 'Hưng Yên', 'gps' => '20.833808,106.010205', 'bsx' => array(89)),
        '32' => array('id' => 32, 'name' => 'Khánh Hòa', 'gps' => '12.307491,108.871089', 'bsx' => array(79)),
        '33' => array('id' => 33, 'name' => 'Kiên Giang', 'gps' => '10.009664,105.197401', 'bsx' => array(68)),
        '34' => array('id' => 34, 'name' => 'Kon Tum', 'gps' => '14.313554,107.920630', 'bsx' => array(82)),
        '35' => array('id' => 35, 'name' => 'Lai Châu', 'gps' => '22.324320,102.843735', 'bsx' => array(25)),
        '36' => array('id' => 36, 'name' => 'Lâm Đồng', 'gps' => '11.641015,107.497746', 'bsx' => array(49)),
        '37' => array('id' => 37, 'name' => 'Lạng Sơn', 'gps' => '21.820741,106.547897', 'bsx' => array(12)),
        '38' => array('id' => 38, 'name' => 'Lào Cai', 'gps' => '22.513893,103.856868', 'bsx' => array(24)),
        '39' => array('id' => 39, 'name' => 'Long An', 'gps' => '10.695005,105.960820', 'bsx' => array(62)),
        '40' => array('id' => 40, 'name' => 'Nam Định', 'gps' => '20.413892,106.162605', 'bsx' => array(18)),
        '41' => array('id' => 41, 'name' => 'Nghệ An', 'gps' => '19.395257,104.889498', 'bsx' => array(37)),
        '42' => array('id' => 42, 'name' => 'Ninh Bình', 'gps' => '20.247371,105.970816', 'bsx' => array(35)),
        '43' => array('id' => 43, 'name' => 'Ninh Thuận', 'gps' => '11.708233,108.886415', 'bsx' => array(85)),
        '44' => array('id' => 44, 'name' => 'Phú Thọ', 'gps' => '21.307744,105.125561', 'bsx' => array(19)),
        '45' => array('id' => 45, 'name' => 'Quảng Bình', 'gps' => '17.650996,106.225225', 'bsx' => array(73)),
        '46' => array('id' => 46, 'name' => 'Quảng Nam', 'gps' => '15.582603,107.985250', 'bsx' => array(92)),
        '47' => array('id' => 47, 'name' => 'Quảng Ngãi', 'gps' => '15.033132,108.631560', 'bsx' => array(76)),
        '48' => array('id' => 48, 'name' => 'Quảng Ninh', 'gps' => '21.151562,107.203928', 'bsx' => array(14)),
        '49' => array('id' => 49, 'name' => 'Quảng Trị', 'gps' => '16.725876,107.103291', 'bsx' => array(74)),
        '50' => array('id' => 50, 'name' => 'Sóc Trăng', 'gps' => '9.605473,105.973519', 'bsx' => array(83)),
        '51' => array('id' => 51, 'name' => 'Sơn La', 'gps' => '9.600734,105.978154', 'bsx' => array(26)),
        '52' => array('id' => 52, 'name' => 'Tây Ninh', 'gps' => '11.357658,106.130780', 'bsx' => array(70)),
        '53' => array('id' => 53, 'name' => 'Thái Bình', 'gps' => '20.506917,106.374343', 'bsx' => array(17)),
        '54' => array('id' => 54, 'name' => 'Thái Nguyên', 'gps' => '21.587135,105.824038', 'bsx' => array(20)),
        '55' => array('id' => 55, 'name' => 'Thanh Hóa', 'gps' => '20.091208,105.301704', 'bsx' => array(36)),
        '56' => array('id' => 56, 'name' => 'Thừa Thiên Huế', 'gps' => '16.344361,107.581729', 'bsx' => array(75)),
        '57' => array('id' => 57, 'name' => 'Tiền Giang', 'gps' => '10.438860,106.253686', 'bsx' => array(63)),
        '58' => array('id' => 58, 'name' => 'Trà Vinh', 'gps' => '9.934929,106.336861', 'bsx' => array(84)),
        '59' => array('id' => 59, 'name' => 'Tuyên Quang', 'gps' => '22.058060,105.244858', 'bsx' => array(22)),
        '60' => array('id' => 60, 'name' => 'Vĩnh Long', 'gps' => '10.244966,105.958561', 'bsx' => array(64)),
        '61' => array('id' => 61, 'name' => 'Vĩnh Phúc', 'gps' => '21.301371,105.591167', 'bsx' => array(88)),
        '62' => array('id' => 62, 'name' => 'Yên Bái', 'gps' => '21.718615,104.929472', 'bsx' => array(21)),
        '63' => array('id' => 63, 'name' => 'Phú Yên', 'gps' => '13.096341,109.292911', 'bsx' => array(78)),

    );
}

function createPaginationMetaData($totalItem, $itemPerPage, $currentPage): array
{
    global $urlCurrent;

    $balance = $totalItem % $itemPerPage;
    $totalPage = ($totalItem - $balance) / $itemPerPage;
    if ($balance > 0)
        $totalPage += 1;

    $back = $currentPage - 1;
    $next = $currentPage + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    return [
        'page' => $currentPage,
        'totalPage' => $totalPage,
        'back' => $back,
        'next' => $next,
        'urlPage' => $urlPage
    ];
}

function apiResponse(int $code = 0, $messages = '', $data = [], array $meta = []): array
{
    return [
        'data' => $data ?? [],
        'code' => $code ?? '',
        'messages' => $messages ?? '',
        'meta' => $meta ?? []
    ];
}

function getUserByToken($accessToken, $checkActive = true)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');
    $conditions = [
        'access_token' => $accessToken
    ];

    if ($checkActive) {
        $conditions['status'] = 1;
    }

    $user = $modelUser->find()->where($conditions)->first();

    /*if($user->type==3){
        $user->type = 2;
    }*/
    return $user;
}

function parameter(){
    global $controller;
    global $modelOptions;
    $conditions = array('key_word' => 'settingAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    return $data_value;
}


function processAddMoney($money, $phoneNumber): string
{
    global $controller;
    global $transactionType;

    $modelUser = $controller->loadModel('Users');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');
    $modelDriverRequest = $controller->loadModel('DriverRequests');

    if ($money >= 1000) {
        if($phoneNumber) {
            $user = $modelUser->find()
                ->where(['phone_number' => $phoneNumber])
                ->first();

            if ($user) {
                $user->total_coin += $money;
                $modelUser->save($user);

                // Save transaction
                $newTransaction = $modelTransaction->newEmptyEntity();
                $newTransaction->user_id = $user->id;
                $newTransaction->amount = $money;
                $newTransaction->type = $transactionType['add'];
                $newTransaction->name = 'Nạp EXC-xu thành công';
                $newTransaction->description = '+' . number_format($money) . ' EXC-xu';
                $newTransaction->created_at = date('Y-m-d H:i:s');
                $newTransaction->updated_at = date('Y-m-d H:i:s');
                $modelTransaction->save($newTransaction);

                if ($user->email && $user->name) {
                    sendEmailAddMoney($user->email, $user->name, $money);
                }

                $dataSendNotification= array(
                    'title' => 'Nạp tiền thành công EXC-GO',
                    'time' => date('H:i d/m/Y'),
                    'content' => 'Nạp thành công '.number_format($money).'đ vào tài khoản ' . $user->phone_number,
                    'action' => 'addMoneySuccess'
                );

                if (!empty($user->device_token)) {
                    $newNotification = $modelNotification->newEmptyEntity();
                    
                    $newNotification->user_id = $user->id;
                    $newNotification->title = 'Nạp tiền thành công';
                    $newNotification->content = 'Nạp thành công '.number_format($money).'đ vào tài khoản ' . $user->phone_number;
                    $newNotification->created_at = date('Y-m-d H:i:s');
                    $newNotification->updated_at = date('Y-m-d H:i:s');
                    
                    $modelNotification->save($newNotification);

                    sendNotification($dataSendNotification, $user->device_token);
                }

                $request = $modelDriverRequest->find()->where(['user_id' => $user->id, 'status'=>0])->first();

                $money = (int) parameter()['moneyUpgradeToDriver'];

                if($user->type==1 && !empty($request) && $user->total_coin > $money){

                    $user->type = $memberType['driver'];
                    $user->total_coin -= $money;
                    $modelUser->save($user);

                    
                    $request->status = 1;
                    $request->handled_by = 1;
                    $modelDriverRequest->save($request);
                    sendEmailUpgradeToDriverSuccess($user->name, $user->id);

                    // Save transaction
                    $newTransaction = $modelTransaction->newEmptyEntity();
                    $newTransaction->user_id = $user->id;
                    $newTransaction->amount = $money;
                    $newTransaction->type = $transactionType['subtract'];
                    $newTransaction->name = 'Bị trừ tiền Khi liên cấp tài xế ';
                    $newTransaction->description = '-' . number_format($money) . ' EXC-xu';
                    $newTransaction->created_at = date('Y-m-d H:i:s');
                    $newTransaction->updated_at = date('Y-m-d H:i:s');
                    $modelTransaction->save($newTransaction);

                    if ($user->email && $user->name) {
                        sendEmailSubtractMoney($user->email, $user->name, $money);
                    }

                    if ($user->device_token) {
                        $title = 'Yêu cầu nâng cấp tài khoản được chấp nhận';
                        $content = 'Yêu cầu nâng cấp tài khoản thành tài xế của bạn đã được chấp nhận và bạn bị trừ'.number_format($money).'đ';
                        $dataSendNotification= array(
                            'title' => $title,
                            'time' => date('H:i d/m/Y'),
                            'content' => $content,
                            'action' => 'upgradeToDriverSuccess'
                        );

                        $newNotification = $notificationModel->newEmptyEntity();
                        $newNotification->user_id = $user->id;
                        $newNotification->title = $title;
                        $newNotification->content = $content;
                        $newNotification->created_at = date('Y-m-d H:i:s');
                        $newNotification->updated_at = date('Y-m-d H:i:s');
                        $notificationModel->save($newNotification);
                        sendNotification($dataSendNotification, $user->device_token);
                    }
                }

                return 'Nạp tiền thành công cho tài khoản '. $user->phone_number;
            }

            return 'Tài khoản ' . $user->phone_number . ' không tồn tại';
        }

        return 'Nội dung sai cú pháp';
    }

    return 'Số tiền nạp phải lớn hơn 1.000đ';
}

function getDetailBooking($id)
{
    global $controller;

    $modelBooking = $controller->loadModel('Bookings');

    if (empty($id)) {
        return null;
    }

    $booking = $modelBooking->find()
        ->join([
            [
                'table' => 'users',
                'alias' => 'PostedUsers',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.posted_by = PostedUsers.id',
                ],
            ],
            [
                'table' => 'users',
                'alias' => 'ReceivedUsers',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.received_by = ReceivedUsers.id',
                ],
            ],
            [
                'table' => 'provinces',
                'alias' => 'DepartureProvinces',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.departure_province_id = DepartureProvinces.id',
                ],
            ],
            [
                'table' => 'provinces',
                'alias' => 'DestinationProvinces',
                'type' => 'LEFT',
                'conditions' => [
                    'Bookings.destination_province_id = DestinationProvinces.id',
                ],
            ]
        ])->select([
            'Bookings.id',
            'Bookings.name',
            'Bookings.price',
            'Bookings.start_time',
            'Bookings.finish_time',
            'Bookings.departure',
            'Bookings.destination',
            'Bookings.description',
            'Bookings.introduce_fee',
            'Bookings.deposit',
            'Bookings.status',
            'Bookings.created_at',
            'Bookings.updated_at',
            'Bookings.received_at',
            'Bookings.canceled_at',
            'PostedUsers.id',
            'PostedUsers.name',
            'PostedUsers.phone_number',
            'PostedUsers.avatar',
            'ReceivedUsers.id',
            'ReceivedUsers.name',
            'ReceivedUsers.phone_number',
            'ReceivedUsers.avatar',
            'DepartureProvinces.id',
            'DepartureProvinces.name',
            'DepartureProvinces.parent_id',
            'DestinationProvinces.id',
            'DestinationProvinces.name',
        ])->where(['Bookings.id' => $id])
        ->first();
    $booking->PostedUsers['id'] = (int)$booking->PostedUsers['id'];
    $booking->ReceivedUsers['id'] = (int)$booking->ReceivedUsers['id'];
    $booking->DepartureProvinces['id'] = (int)$booking->DepartureProvinces['id'];
    $booking->DestinationProvinces['id'] = (int)$booking->DestinationProvinces['id'];

    return $booking;
}

function getServiceFee()
{
    global $controller;
    $modelOption = $controller->loadModel('Options');
    $config = $modelOption->find()->where(['key_word' => 'service_fee'])->first();

    return json_decode($config->value ?? '', true)['price'] ?? 0;
}

function checkFinishedBooking(): array
{
    global $controller;
    global $transactionType;
    global $bookingStatus;
    global $bookingFeeStatus;

    $modelBooking = $controller->loadModel('Bookings');
    $modelUser = $controller->loadModel('Users');
    $modelBookingFee = $controller->loadModel('BookingFees');
    $modelTransaction = $controller->loadModel('Transactions');
    $modelNotification = $controller->loadModel('Notifications');

    $now = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $bookingList = $modelBooking->find()
        ->where([
            'status' => $bookingStatus['confirmed'],
            'completed_at <=' => $now->sub(new DateInterval('P1D'))->format('Y-m-d H:i:s'),
        ])->all();

    foreach ($bookingList as $booking) {
        $bookingFee = $modelBookingFee->find()
            ->where(['booking_id' => $booking->id])
            ->first();

        $postedUser = $modelUser->find()
            ->where(['id' => $booking->posted_by])
            ->first();
        $postedUser->total_coin += $bookingFee->received_fee;
        $booking->status = $bookingStatus['paid'];
        $bookingFee->status = $bookingFeeStatus['paid'];

        $modelUser->save($postedUser);
        $modelBooking->save($booking);

        // Save transaction
        $newTransaction = $modelTransaction->newEmptyEntity();
        $newTransaction->user_id = $postedUser->id;
        $newTransaction->booking_id = $booking->id;
        $newTransaction->amount = $bookingFee->received_fee;
        $newTransaction->type = $transactionType['add'];
        $newTransaction->name = "Nhận thanh toán cuốc xe #$booking->id thành công";
        $newTransaction->description = '+' . number_format($bookingFee->received_fee) . ' EXC-xu';
        $newTransaction->created_at = date('Y-m-d H:i:s');
        $newTransaction->updated_at = date('Y-m-d H:i:s');
        $modelTransaction->save($newTransaction);

        // Thông báo cho người đăng
        $title = 'Cộng EXC coin vào tài khoản';
        $content = "Tài khoản của bạn được công thêm $bookingFee->received_fee phí giới thiệu cuốc xe #$booking->id";
        $notification = $modelNotification->newEmptyEntity();
        $notification->user_id = $postedUser->id;
        $notification->booking_id = $booking->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $modelNotification->save($notification);
        if ($postedUser->device_token) {
            $dataSendNotification = array(
                'title' => $title,
                'time' => date('H:i d/m/Y'),
                'content' => $content,
                'action' => 'addMoneySuccess',
                'user_id' => $postedUser->id,
                'booking_id' => $booking->id,
            );
            sendNotification($dataSendNotification, $postedUser->device_token);
        }

        // Thông báo cộng tiền cọc
        if ($booking->deposit) {
            // Người nhận chuyến
            $receivedUser = $modelUser->find()
                ->where(['id' => $booking->received_by])
                ->first();
            $receivedUser->total_coin += $booking->deposit;
            $modelUser->save($receivedUser);

            // Save transaction
            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $receivedUser->id;
            $newTransaction->booking_id = $booking->id;
            $newTransaction->amount = $booking->deposit;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Nhận lại tiền cọc cuốc xe #$booking->id thành công";
            $newTransaction->description = '+' . number_format($booking->deposit) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($newTransaction);

            // Thông báo cho người nhận
            $title = 'Cộng EXC coin vào tài khoản';
            $content = "Tài khoản của bạn được trả lại $booking->deposit tiền cọc cho cuốc xe #$booking->id";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $receivedUser->id;
            $notification->booking_id = $booking->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);
            if ($receivedUser->device_token) {
                $dataSendNotification = array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'addMoneySuccess',
                    'user_id' => $receivedUser->id,
                    'booking_id' => $booking->id,
                );
                sendNotification($dataSendNotification, $receivedUser->device_token);
            }

            // Người đăng chuyến
            $postedUser = $modelUser->find()
                ->where(['id' => $booking->posted_by])
                ->first();
            $postedUser->total_coin += $booking->deposit;
            $modelUser->save($postedUser);

            $newTransaction = $modelTransaction->newEmptyEntity();
            $newTransaction->user_id = $postedUser->id;
            $newTransaction->booking_id = $booking->id;
            $newTransaction->amount = $booking->deposit;
            $newTransaction->type = $transactionType['add'];
            $newTransaction->name = "Nhận lại tiền cọc cuốc xe #$booking->id thành công";
            $newTransaction->description = '+' . number_format($booking->deposit) . ' EXC-xu';
            $newTransaction->created_at = date('Y-m-d H:i:s');
            $newTransaction->updated_at = date('Y-m-d H:i:s');
            $modelTransaction->save($newTransaction);

            // Thông báo cho người đăng
            $title = 'Cộng EXC coin vào tài khoản';
            $content = "Tài khoản của bạn được trả lại $booking->deposit tiền cọc cho cuốc xe #$booking->id";
            $notification = $modelNotification->newEmptyEntity();
            $notification->user_id = $postedUser->id;
            $notification->booking_id = $booking->id;
            $notification->title = $title;
            $notification->content = $content;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->updated_at = date('Y-m-d H:i:s');
            $modelNotification->save($notification);
            if ($postedUser->device_token) {
                $dataSendNotification = array(
                    'title' => $title,
                    'time' => date('H:i d/m/Y'),
                    'content' => $content,
                    'action' => 'addMoneySuccess',
                    'user_id' => $postedUser->id,
                    'booking_id' => $booking->id,
                );
                sendNotification($dataSendNotification, $postedUser->device_token);
            }
        }

        $modelBookingFee->save($bookingFee);
    }
    return apiResponse(0, 'Thanh toán phí thành công', $bookingList->toList());
}

global $bookingStatus;
$bookingStatus = [
    'unreceived' => 0,
    'received' => 1,
    'canceled' => 2,
    'completed' => 3,
    'paid' => 4,
    'confirmed' => 5,
];

global $bookingType;
$bookingType = [
    'post' => 1,
    'receive' => 2
];

global $bookingFeeStatus;
$bookingFeeStatus = [
    'unpaid' => 0,
    'paid' => 1,
];

global $imageType;
$imageType = [
    'id-card-front' => 'id-card-front',
    'id-card-back' => 'id-card-back',
    'car' => 'car',
    'avatar' => 'avatar',
];

global $ownerType;
$ownerType = [
    'users' => 'users',
    'bookings' => 'bookings',
];

global $memberType;
$memberType = [
    'user' => 1,
    'driver' => 2,
];

global $withdrawRequestStatus;
$withdrawRequestStatus = [
    'pending' => 0,
    'done' => 1,
];

global $transactionType;
$transactionType = [
    'add' => 1,
    'subtract' => 2,
];

global $complaintType;
$complaintType = [
    'active' => 1,
    'passive' => 2,
];

global $permissiondata;
$permissiondata =[
    'exportarexcel'=>'Xuất excel',
    'idadmin'=>'Id',
    'avatar'=>'Ảnh đạt diện',
    'fullname'=>'Họ tên',
    'info'=>'Thông tin',
    'type'=>'Loại tài khoản',
    'coin'=>'cộng từ Coin',
    'edit'=>'Sửa',
    'status'=>'Trạng thái',
    
    
];

global $transactionKey;
$transactionKey = 'EXCGO';

global $urlTransaction;
$urlTransaction = 'https://img.vietqr.io/image/TPB-26689898989-compact2.png?';

global $defaultAvatar;
$defaultAvatar = 'https://apis.exc-go.vn/plugins/excgo/view/image/default-avatar.png';


function checkPermission($permission='') {
    global $session;
    global $controller;
    global $permissiondata;

    if(!empty($session->read('infoAdmin'))){
        $infoAdmin = $session->read('infoAdmin');

        if($infoAdmin->type=='staff'){
            if(!empty(@$infoAdmin->permission_data) && in_array($permission,  json_decode(@$infoAdmin->permission_data, true))){
                $return = 1;
            }else{
                $return = 0;
              
            }
            
        }else{
            $return = 1;
          
        }
    }else{
        //$return = 0;
        return $controller->redirect('/admins/logout');
    }
      
    return $return;
}


