<?php 

global $keyFirebase;

$keyFirebase = 'AAAAmV3l9xI:APA91bH_cEaRYEz8d-_JbIDDk32k1aqlt8PgB7ctT8Qx-0ErMU70ja_aT9QTsT5rUG2xdPOxxIhFLGxRpUAIr1LaBxCiRF2KH5aMD0T5NN4kARg1KKwGsPIAl2g3PYF8XYa0FAB0CZYi';

$menus= array();
$menus[0]['title']= 'SAPHAIR';
$menus[0]['sub'][]= array('title'=>'Thành viên',
							'url'=>'/plugins/admin/snaphair-view-admin-user-listUserAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listUserAdmin',
							
						);

$menus[0]['sub'][]= array( 'title'=>'Lịch sử nạp tiền',
                            'url'=>'/plugins/admin/snaphair-view-admin-history-listHistoryPlusAdmin',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'listHistoryPlusAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Lịch sử trừ tiền',
                            'url'=>'/plugins/admin/snaphair-view-admin-history-listHistoryMinusAdmin',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'listHistoryMinusAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Cài đặt thông số',
                            'url'=>'/plugins/admin/snaphair-view-admin-setting-parameterSettingAdmin',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'parameterSettingAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Quản lý danh mục mẫu ảnh',
                            'url'=>'/plugins/admin/snaphair-view-admin-sample-listSampleCategoryAdmin',
                            'classIcon'=>'bx bx-category',
                            'permission'=>'listSampleCategoryAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Quản lý mẫu ảnh',
                        'url'=>'/plugins/admin/snaphair-view-admin-sample-listSamplePhotoAdmin',
                        'classIcon'=>'bx bx-image',
                        'permission'=>'listSamplePhotoAdmin'
                        );

addMenuAdminMantan($menus);



function sendEmailCodeForgotPassword($email = '', $fullName = '', $code = '')
{
    $to = array();

    if (!empty($email)) {
        $to[] = trim($email);

        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực ';

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
                        Mã xác thực của bạn là: <b>' . $code . '</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng Snaphair</span>
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


function createTokenCode($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function getUserByToken($accessToken, $checkActive = true)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');
    $conditions = [
        'access_token' => $accessToken
    ];

    if ($checkActive) {
        $conditions['status'] = 'active';
    }

    $user = $modelUser->find()->where($conditions)->first();
 
    return $user;
}


function apiResponse(int $code = 0, $messages = '', $data = [], $totalData = 1, array $meta = []): array
{
    return [
        'data' => $data ?? [],
        'code' => $code ?? '',
        'messages' => $messages ?? '',
        'meta' => $meta ?? [],
        'totalData' => $totalData ?? 1
    ];
}

function processAddMoney($money = 0, $phone=''){
    global $controller;

    $modelUser = $controller->loadModel('Users');
    $modelTransactionHistory = $controller->loadModel('TransactionHistorys');

    $infoUser = $modelUser->find()->where(['phone'=>$phone])->first();

    if(!empty($infoUser)){
                // cộng tiền tài khoản
        $infoUser->coin += $money;
        $modelUser->save($infoUser);

                // lưu lịch sử giao dịch
        $dataHistories = $modelTransactionHistory->newEmptyEntity();

        $dataHistories->idManager = $infoUser->id;
        $dataHistories->total = $money;
        $dataHistories->coin_user = $infoUser->coin;
        $dataHistories->type = 'plus';
        $dataHistories->note = 'Nạp tiền tài khoản qua chuyển khoản';
        $dataHistories->type_note = 'plus_banking';
        $dataHistories->modified = time();

        $modelTransactionHistory->save($dataHistories);

        if(!empty($infoUser->email)){
            sendEmailAddMoney($infoUser->email, $infoUser->fullname, $money);
        }

        $mess = 'Cộng thành công '.number_format($money).'đ cho tài khoản '.$phone;
    }else{
        $mess = 'Không tìm thấy tài khoản khách hàng';
    }
}

function sendEmailAddMoney($email='', $fullName='', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Snaphair] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Zoom Cheap</title>
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
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng Snaphair</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://zoomcheap.com">https://zoomcheap.com</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function covertbaseimage($base,$phone){

    // Tách phần định dạng và phần dữ liệu base64
    list($type, $data) = explode(';', $base);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    // Xác định phần mở rộng của tệp
    $ext = '';
    if (strpos($type, 'image/png') !== false) {
        $ext = 'png';
    } elseif (strpos($type, 'image/jpeg') !== false) {
        $ext = 'jpg';
    } elseif (strpos($type, 'image/gif') !== false) {
        $ext = 'gif';
    } else {
        return array('code'=>0 , 'link'=>'');
    }

    // Lưu hình ảnh vào tệp
    $file_name = 'output_image.'.time().rand(0,1000000). $ext;
    file_put_contents($file_name, $data);
    $image = uploadImage($phone,$data, $file_name);
    if(!empty($image['linkLocal'])){
        return array('code'=>1, 'link'=>$image['linkLocal']);

    }else{
        return array('code'=>0 , 'link'=>'');
    }
}


function getInfoUser(){
    global $session;
    global $controller;
    $modelUser = $controller->loadModel('Users');
    $infoUser  = $session->read('infoUser');

    if(empty($infoUser)){
        return array();
    }
     $infoUser = $modelUser->find()->where(['id'=>$infoUser->id])->first();

    return $infoUser;
}
?>