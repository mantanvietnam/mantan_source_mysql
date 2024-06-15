<?php 
$menus= array();
$menus[0]['title']= "Hệ thống đại lý";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Khách hàng',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-customer-listCustomerAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listCustomerAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Đại lý',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin'
                        );

$menus[0]['sub'][]= array(  'title'=>'Chức danh',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-system-listPositionAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listPositionAdmin'
                        );

$menus[0]['sub'][]= array(	'title'=>'Hệ thống',
							'url'=>'/plugins/admin/hethongdaily-view-admin-system-listSystemAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listSystemAdmin'
						);

$menus[0]['sub'][]= array(  'title'=>'Module chức năng',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-system-moduleSystemAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'moduleSystemAdmin'
                        );

$menus[1]['title']= "Đơn hàng hệ thống";
$menus[1]['sub'] = [];

$menus[1]['sub'][]= array( 'title'=>'Đơn hàng CTV affiliate',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-order-listOrderAffiliateAdmin',
                            'classIcon'=>'bx bx-cart-add',
                            'permission'=>'listOrderAffiliateAdmin'
                        );

$menus[1]['sub'][]= array( 'title'=>'Đơn hàng lẻ đại lý',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-order-listOrderMemberAdmin',
                            'classIcon'=>'bx bx-cart-add',
                            'permission'=>'listOrderMemberAdmin'
                        );

$menus[1]['sub'][]= array( 'title'=>'Đơn trong hệ thống',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-order-listOrderSystemAdmin',
                            'classIcon'=>'bx bx-cart-add',
                            'permission'=>'listOrderSystemAdmin'
                        );

addMenuAdminMantan($menus);

global $keyFirebase;
global $displayInfo;

$displayInfo = array(   1 =>'Giao diện 1',
                        2 =>'Giao diện 2',
                );

//$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';
$keyFirebase = 'AAAAl-zVR38:APA91bG2D6eIYD98YPIAWn5iowWnSfRfItalL1j044xvjhaH15RbWAwLxPtJRgniwNkdRoCZTQUomHmofsP-zuEFsrO414SAgNffjz5BeQWbKnQ61zqahMebNhgSNPLZpkDj5XR09E16';

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

function sendZNSZalo($template_id='', $params='', $phone='', $id_oa='', $app_id='')
{
    global $controller;

    $modelZalos = $controller->loadModel('Zalos');

    if(!empty($template_id) && !empty($params) && !empty($phone)){
        if (substr($phone, 0, 1) === '0') {
            // Thay thế số 0 đầu tiên bằng "84"
            $phone = '84' . substr($phone, 1);
        }

        if(!empty($id_oa) && !empty($app_id)){
            $zalo_oa = $modelZalos->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

            // nếu token hết hạn
            if($zalo_oa->deadline < time()){
                refreshTokenZaloOA($zalo_oa->id_oa, $zalo_oa->id_app);

                $zalo_oa = $modelZalos->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();
            }
        }

        if(!empty($zalo_oa->access_token)){
            $url_zns = 'https://business.openapi.zalo.me/message/template';
            $data_send_zns = [
                                "phone" => $phone,
                                "template_id" => $template_id,
                                "template_data" =>  $params,
                                "tracking_id" => time().rand(0,100),
                            ];
            $header_zns = ['Content-Type: application/json', 'access_token: '.$zalo_oa->access_token];
            $typeData='raw';
            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
            return json_decode($return_zns, true);
        }else{
            return ['error'=>2, 'message'=>'Không tìm được Zalo OA phù hợp'];
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

/*
function sendZNSDataBot($order, $product_name, $name_system, $agency)
{
    $url = 'https://quantri.databot.vn/sendZNS309784';
    $data = [   'phone' => $order->phone,
                'customer_name' => $order->full_name,
                'order_code' => 'OC'.$order->id,
                'payment_status' => 'Đơn hàng mới',
                'product_name' => $product_name,
                'author' => $name_system,
                'cost' => $order->total,
                'note' => 'soạn tin XÁC NHẬN để xác nhận bạn đã tạo đơn hàng này',
            ];

    sendDataConnectMantan($url, $data);
}
*/

function getAccessTokenZaloOA($id_oa='', $app_id='')
{
    global $controller;

    if(!empty($id_oa) && !empty($app_id)){
        $modelZalos = $controller->loadModel('Zalos');

        $zalo_oa = $modelZalos->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

        if(!empty($zalo_oa->secret_key) && !empty($zalo_oa->oauth_code)){
            $url_zns = 'https://oauth.zaloapp.com/v4/oa/access_token';
            $header_zns = ['Content-Type: application/x-www-form-urlencoded', 'secret_key: '.$zalo_oa->secret_key];
            $data_send_zns = [
                                "code" => $zalo_oa->oauth_code,
                                "app_id" => $app_id,
                                "grant_type" =>  'authorization_code',
                                "code_verifier" => time(),
                            ];

            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);
            $return_zns = json_decode($return_zns, true);

            if(!empty($return_zns['access_token']) && !empty($return_zns['refresh_token']) && !empty($return_zns['expires_in'])){
                $zalo_oa->access_token = $return_zns['access_token'];
                $zalo_oa->refresh_token = $return_zns['refresh_token'];
                $zalo_oa->deadline = time() + $return_zns['expires_in'] - 600;

                $modelZalos->save($zalo_oa);
            }

            return $return_zns;
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

function refreshTokenZaloOA($id_oa='', $app_id='')
{
    global $controller;

    if(!empty($id_oa) && !empty($app_id)){
        $modelZalos = $controller->loadModel('Zalos');

        $zalo_oa = $modelZalos->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

        if(!empty($zalo_oa->refresh_token)){
            $url_zns = 'https://oauth.zaloapp.com/v4/oa/access_token';
            $header_zns = ['Content-Type: application/x-www-form-urlencoded', 'secret_key: '.$zalo_oa->secret_key];
            $data_send_zns = [
                                "refresh_token" => $zalo_oa->refresh_token,
                                "app_id" => $app_id,
                                "grant_type" =>  'refresh_token',
                            ];

            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);
            $return_zns = json_decode($return_zns, true);

            if(!empty($return_zns['access_token']) && !empty($return_zns['refresh_token']) && !empty($return_zns['expires_in'])){
                $zalo_oa->access_token = $return_zns['access_token'];
                $zalo_oa->refresh_token = $return_zns['refresh_token'];
                $zalo_oa->deadline = time() + $return_zns['expires_in'] - 600;

                $modelZalos->save($zalo_oa);
            }else{
                $link_access_token = 'https://developers.zalo.me/app/'.$zalo_oa->id_app.'/oa/settings';
                echo 'Lỗi khi lấy mã access token mới, truy cập <a href="'.$link_access_token.'">'.$link_access_token.'</a> để tạo mã access token mới';
                die;
            }

            return $return_zns;
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

function sendMessZalo($id_oa='', $app_id='', $user_id_zalo='', $text='', $image='')
{
    global $controller;

    $modelZaloOas = $controller->loadModel('Zalos');

    if(!empty($user_id_zalo)){

        if(empty($id_oa) || empty($app_id)){
            $zalo_oa = $modelZaloOas->find()->where(['access_token IS NOT'=>null, 'deadline >='=>time()])->first();

            if(empty($zalo_oa)){
                $zalo_oa = $modelZaloOas->find()->where(['access_token IS NOT'=>null])->first();

                refreshTokenZaloOA($zalo_oa->id_oa, $zalo_oa->id_app);

                $zalo_oa = $modelZaloOas->find()->where(['access_token IS NOT'=>null, 'deadline >='=>time()])->first();
            }
        }else{
            $zalo_oa = $modelZaloOas->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

            // nếu token hết hạn
            if($zalo_oa->deadline < time()){
                refreshTokenZaloOA($zalo_oa->id_oa, $zalo_oa->id_app);

                $zalo_oa = $modelZaloOas->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();
            }
        }

        if(!empty($zalo_oa->access_token)){
            $url_zns = 'https://openapi.zalo.me/v3.0/oa/message/cs';
            $data_send_zalo = ["recipient" => ["user_id"=>$user_id_zalo]];
            
            if(!empty($text)){
                $data_send_zalo['message'] = ["text"=>$text];
            }

            if(!empty($image)){
                $data_send_zalo['message'] = ["attachment"=>[   "type"=>"template",
                                                                "payload"=>["template_type"=>"media",
                                                                            "elements"=>[
                                                                                    [
                                                                                        "media_type"=>"image",
                                                                                        "url"=>$image
                                                                                    ]
                                                                                ]
                                                                        ]
                                                            ]

                                            ];

            }

            $header_zns = ['Content-Type: application/json', 'access_token: '.$zalo_oa->access_token];
            $typeData='raw';
            $return_zns = sendDataConnectMantan($url_zns,$data_send_zalo,$header_zns,$typeData);
            
            return json_decode($return_zns, true);
        }else{
            return ['error'=>2, 'message'=>'Không tìm được Zalo OA phù hợp'];
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

function getTreeSystem($id_father, $modelMembers)
{
    $listData = $modelMembers->find()->where(['id_father'=>$id_father])->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->agentSystem = getTreeSystem($value->id, $modelMembers);
        }
    }

    return $listData;
}

function createCustomerNew($full_name='', $phone='', $email='', $address='', $sex=0, $id_city=0, $id_agency=0, $id_aff=0, $name_agency='', $id_messenger='', $avatar='', $birthday_date=0, $birthday_month=0, $birthday_year=0, $id_groups=0, $id_zalo='', $note_history='')
{
    global $controller;
    global $urlHomes;
    global $modelCategoryConnects;

    $modelCustomers = $controller->loadModel('Customers');
    
    $infoUser = $modelCustomers->newEmptyEntity();

    if(!empty($full_name) && !empty($phone)){
        $infoUser = $modelCustomers->find()->where(['phone'=>$phone])->first();
        
        if(empty($infoUser)){
            $infoUser = $modelCustomers->newEmptyEntity();
            
            $infoUser->full_name = $full_name;
            $infoUser->phone = $phone;
            $infoUser->email = (string) @$email;
            $infoUser->address = (string) @$address;
            $infoUser->sex = (int) @$sex;
            $infoUser->id_city = (int) @$id_city;
            $infoUser->id_parent = (int) @$id_agency; // đại lý bán hàng
            $infoUser->id_aff = (int) @$id_aff; // người tiếp thị liên kết
            $infoUser->id_messenger = (string) @$id_messenger;
            $infoUser->id_zalo = (string) @$id_zalo;
            $infoUser->avatar = (!empty($avatar))?$avatar:$urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
            $infoUser->status = 'active';
            $infoUser->pass = md5($phone);
            $infoUser->birthday_date = (int) @$birthday_date;
            $infoUser->birthday_month = (int) @$birthday_month;
            $infoUser->birthday_year = (int) @$birthday_year;
            $infoUser->created_at = time();
            
            if(!empty($id_groups)){
                $id_groups = explode(',', $id_groups);

                $infoUser->id_group = (int) $id_groups[0];
            }else{
                $infoUser->id_group  = 0;
            }

            $modelCustomers->save($infoUser);

            // lưu bảng nhóm khách hàng
            if(!empty($id_groups)){
                foreach ($id_groups as $id_group) {
                    $categoryConnects = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $infoUser->id, 'id_category'=>(int)$id_group])->first();

                    if(empty($categoryConnects)){
                        $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                        $categoryConnects->keyword = 'group_customers';
                        $categoryConnects->id_parent = $infoUser->id;
                        $categoryConnects->id_category = (int) $id_group;

                        $modelCategoryConnects->save($categoryConnects);
                    }
                }
            }

            // lưu bảng đại lý
            if(!empty($id_agency)){
                saveCustomerMember($infoUser->id, $id_agency);
            }

            // lưu lịch sử của khách hàng
            $note_now = 'Đại lý '.@$name_agency.' (ID '.$id_agency.') khởi tạo dữ liệu người dùng mới';

            createCustomerHistoriesNewOrder($infoUser->id, $note_now, $infoUser->id_parent);
        }else{
            $infoUser->full_name = $full_name;
            $note_now = 'Mua đơn hàng mới';
            
            // đại lý bán hàng
            if(!empty($id_agency)){
                $infoUser->id_parent = (int) $id_agency;
                
                $note_now = 'Mua hàng của đại lý '.@$name_agency;
            }

            // người tiếp thị liên kết
            if(!empty($id_aff)){
                $infoUser->id_aff = (int) $id_aff;
                
                $note_now = 'Mua hàng của người tiếp thị liên kết '.@$name_agency;
            }
            
            if(!empty($address)){
                $infoUser->address = (string) $address;
            }

            if(!empty($email)){
                $infoUser->email = (string) $email;
            }

            if(!empty($avatar)){
                $infoUser->avatar = (string) $avatar;
            }

            if(!empty($id_groups)){
                $id_groups = explode(',', $id_groups);

                $infoUser->id_group = (int) $id_groups[0];
            }

            $modelCustomers->save($infoUser);

            // lưu bảng nhóm khách hàng
            if(!empty($id_groups)){
                foreach ($id_groups as $id_group) {
                    $categoryConnects = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $infoUser->id, 'id_category'=>(int)$id_group])->first();

                    if(empty($categoryConnects)){
                        $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                        $categoryConnects->keyword = 'group_customers';
                        $categoryConnects->id_parent = $infoUser->id;
                        $categoryConnects->id_category = (int) $id_group;

                        $modelCategoryConnects->save($categoryConnects);
                    }
                }
            }

            // lưu bảng đại lý
            if(!empty($id_agency)){
                saveCustomerMember($infoUser->id, $id_agency);
            }

            // lưu lịch sử khách hàng
            if(!empty($note_history)) $note_now = $note_history;

            createCustomerHistoriesNewOrder($infoUser->id, $note_now, $infoUser->id_parent);
        }
    }

    return $infoUser;
}

function createCustomerHistoriesNewOrder($id_customer=0, $note_now='', $id_staff_now=0)
{
    global $controller;

    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    if(!empty($id_customer)){
        $customer_histories = $modelCustomerHistories->newEmptyEntity();

        $customer_histories->id_customer = $id_customer;
        
        $customer_histories->time_now = time();
        $customer_histories->note_now = $note_now;
        $customer_histories->action_now = 'create';
        $customer_histories->id_staff_now = $id_staff_now;
        $customer_histories->status = 'done';

        $modelCustomerHistories->save($customer_histories);

        // hành động tiếp theo
        $customer_histories = $modelCustomerHistories->newEmptyEntity();

        $customer_histories->id_customer = $id_customer;
        
        $customer_histories->time_now = time() + 60*15;
        $customer_histories->note_now = 'Gọi điện xác nhận yêu cầu';
        $customer_histories->action_now = 'call';
        $customer_histories->id_staff_now = $id_staff_now;
        $customer_histories->status = 'new';

        $modelCustomerHistories->save($customer_histories);
    }
    
}

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

function sendNotification($data,$target){
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();

    if(empty($data['clickAction'])){
        //$data['clickAction'] = 'phoenixcampcrm://notification';
    }

    $data['navigationId'] = 'notification';
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content'], 'sound'=>'default', 'action'=>$data['action']];
    
    if(is_array($target)){
        if(count($target)<1000){
            $fields['registration_ids'] = $target;
        }else{
            $chunkedArrays = [];
            $chunkSize = 990;

            for ($i = 0; $i < count($target); $i += $chunkSize) {
                $chunkedArrays = array_slice($target, $i, $chunkSize);
                $result = sendNotification($data,$chunkedArrays);
            }
            
            return $result;
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

function getMemberByToken($token='')
{
    global $controller;

    $modelMember = $controller->loadModel('Members');
    $checkData = [];

    if(!empty($token)){
        /*
        $conditions = [ 'OR' => [
                                    ['token'=>$token],
                                    ['token_web'=>$token]
                                ]
                        ];
        */
                        
        $conditions = ['token'=>$token];
        $checkData = $modelMember->find()->where($conditions)->first();
    }

    return $checkData;
}

function convert_number_to_words($number)
{
    $hyphen = ' ';
    $conjunction = ' ';
    $separator = ' ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 =>
            'Không',
        1 => 'Một',
        2 => 'Hai',
        3 => 'Ba',
        4 => 'Bốn',
        5 => 'Năm',
        6 => 'Sáu',
        7 => 'Bảy',
        8 => 'Tám',
        9 => 'Chín',
        10 => 'Mười',
        11 => 'Mười một',
        12 => 'Mười hai',
        13 => 'Mười ba',
        14 => 'Mười bốn',
        15 => 'Mười năm',
        16 => 'Mười sáu',
        17 => 'Mười bảy',
        18 => 'Mười tám',
        19 => 'Mười chín',
        20 => 'Hai mươi',
        30 => 'Ba mươi',
        40 => 'Bốn mươi',
        50 => 'Năm mươi',
        60 => 'Sáu mươi',
        70 => 'Bảy mươi',
        80 => 'Tám mươi',
        90 => 'Chín mươi',
        100 => 'trăm',
        1000 => 'ngàn',
        1000000 => 'triệu',
        1000000000 => 'tỷ',
        1000000000000 => 'nghìn tỷ',
        1000000000000000 => 'ngàn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number <
            21:
            $string = $dictionary[$number];
            break;
        case $number <
            100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number <
            1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = @$dictionary[$hundreds] . ' ' . @$dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder <
                100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string)$fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}

function saveCustomerMember($id_customer=0, $id_member=0)
{
    global $modelCategoryConnects;

    if(!empty($id_customer) && !empty($id_member)){
        // id_parent: id khách hàng, id_category: id đại lý
        $categoryConnects = $modelCategoryConnects->find()->where(['keyword'=>'member_customers', 'id_parent'=>(int) $id_customer, 'id_category'=>(int) $id_member])->first();

        if(empty($categoryConnects)){
            $categoryConnects = $modelCategoryConnects->newEmptyEntity();

            $categoryConnects->keyword = 'member_customers';
            $categoryConnects->id_parent = (int) $id_customer;
            $categoryConnects->id_category = (int) $id_member;

            $modelCategoryConnects->save($categoryConnects);

            return 'new';
        }else{
            return 'old';
        }
    }

    return '';
}

function saveCustomerHistorie($id_customer=0){

    global $controller;

    global $session;

    $modelCustomerHistories = $controller->loadModel('CustomerHistories');
    $modelTokenDevices = $controller->loadModel('TokenDevices');

    $note_now = 'Đại lý '.$session->read('infoUser')->name.' tạo mới thông tin khách hàng';
    $action_now = 'create';
    $customer_histories = $modelCustomerHistories->newEmptyEntity();

    $customer_histories->id_customer = $id_customer;
                    
    $customer_histories->time_now = time();
    $customer_histories->note_now = $note_now;
    $customer_histories->action_now = $action_now;
    $customer_histories->id_staff_now = $session->read('infoUser')->id;
    $customer_histories->status = 'done';

    $modelCustomerHistories->save($customer_histories);

    return 'ok';
}

function saveCustomerCategory($id_customer=0,$idgroup=array()){

    global $modelCategoryConnects;
    if(!empty($idgroup)){
        foreach ($idgroup as $id_group) {
            $categoryConnects = $modelCategoryConnects->newEmptyEntity();
            $categoryConnects->keyword = 'group_customers';
            $categoryConnects->id_parent = $id_customer;
            $categoryConnects->id_category = (int) $id_group;

            $modelCategoryConnects->save($categoryConnects);
        }
    }
    return 'ok';
}

function sendSMSByESMS($phone='', $mess='', $id_history_sms=0)
{
    if(!empty($phone) && !empty($mess)){
        $url = 'https://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/';
        $headers = ['Content-Type: application/json'];
        $data = [  "ApiKey" => "E69EBCCCBD92CC5E403D68E78F605E",
                   "SecretKey" => "262DC6F859F9EC69B9F6F46388B71E",
                   
                   "Content" => $mess,
                   "Phone" => $phone,
                   
                   "SmsType" => "8",
                   "IsUnicode" => 0, // 1 có dấu, 0 không dấu
                   "Sandbox" => 0, // 1 là tets, 0 là chạy thật
                   "campaignid" => "ICHAM CRM",
                   "RequestId" => $id_history_sms,
                   "CallbackUrl" => "",
                   "SendDate" => ""
               ];

        $return = sendDataConnectMantan($url, $data, $headers, 'raw');
        $return = json_decode($return, true);

        if($return['CodeResult'] == 100){
            return 1;
        }
    }

    return 0;
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
                    
                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}


?>