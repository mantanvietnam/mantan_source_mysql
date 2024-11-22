<?php 
$menus= array();
$menus[0]['title']= "Vé Mời";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Khách hàng',
                            'url'=>'/plugins/admin/vemoi-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Sự kiện',
                            'url'=>'/plugins/admin/vemoi-view-admin-event-listEventAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listEventAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Tìm ảnh',
                            'url'=>'/plugins/admin/vemoi-view-admin-event-searchImageAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'searchImageAdmin'
                        );

addMenuAdminMantan($menus);

function sendEmailNewPassword($email='', $fullName='', $pass= '')
{
    global $urlHomes;

    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực cấp lại mật khẩu mới';

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
                        <span>MÃ XÁC THỰC CẤP LẠI MẬT KHẨU</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$pass.'</b>
                        
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

function codecheckin($id_events){
    global $controller;
    $code_checkin = rand(1000,9999);
    $modelattendedevent = $controller->loadModel('attendedevent');

    $checkAttendedEvent = $modelattendedevent->find()->where(['code_checkin' => $code_checkin, 'id_events'=>(int) $id_events])->first();
    if(!empty($checkAttendedEvent)){
        return codecheckin($id_events);
    }else{
         return $code_checkin;
    }


}

?>