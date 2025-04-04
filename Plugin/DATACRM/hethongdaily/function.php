 <?php 
use Google\Auth\Credentials\ServiceAccountCredentials;
//use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

include(__DIR__.'/library/jwt/vendor/autoload.php');
use Firebase\JWT\JWT;
include(__DIR__.'/library/client/vendor/autoload.php');
use GuzzleHttp\Client;


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
$menus[0]['sub'][]= array(  'title'=>'Danh sách trang info',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-member-listThemeInfoAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listThemeInfoAdmin'
                        );
$menus[0]['sub'][]= array(  'title'=>'Cài đặt gói ',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-package-listPackageAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listPackageAdmin'
                        );
$menus[0]['sub'][]= array(  'title'=>'Thông số',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-system-setingParameterAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'setingParameterAdmin'
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

$menus[1]['sub'][]= array( 'title'=>'Giao dịch khách hàng',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-transaction-listTransactionCustomerAdmin',
                            'classIcon'=>'bx bx-cart-add',
                            'permission'=>'listTransactionCustomerAdmin'
                        );

addMenuAdminMantan($menus);

global $keyFirebase;
global $projectId;
global $displayInfo;
global $session;

$displayInfo = array(   1 =>'Giao diện 1',
                        2 =>'Giao diện 2',
                );

//$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';
$keyFirebase = 'AAAAl-zVR38:APA91bG2D6eIYD98YPIAWn5iowWnSfRfItalL1j044xvjhaH15RbWAwLxPtJRgniwNkdRoCZTQUomHmofsP-zuEFsrO414SAgNffjz5BeQWbKnQ61zqahMebNhgSNPLZpkDj5XR09E16';
$projectId = 'phoenix-crm-f6f64';


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

function sendZNSZalo($template_id='', $params=[], $phone='', $id_oa='', $app_id='')
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

function sendZaloUpdateOrder($infoMember, $infoCustomer, $infoOrder, $productDetail='')
{
    global $controller;

    if(!empty($infoCustomer->name)) $infoCustomer->full_name = $infoCustomer->name;

    $modelZalos = $controller->loadModel('Zalos');
    $modelMembers = $controller->loadModel('Members');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');

    $infoMember = $modelMembers->find()->where(['id'=>$infoMember->id])->first();

    $zaloOA = $modelZalos->find()->where(['id_system'=>$infoMember->id_system])->first();

    if(!empty($zaloOA->template_order) && $infoMember->coin >= 500){
        $params['name'] = $infoCustomer->full_name;
        $params['phone_number'] = $infoCustomer->phone;
        $params['address'] = $infoCustomer->address;

        $params['product'] = substr($productDetail, 0, 100);
        $params['order_code'] = $infoOrder->id;
        $params['price'] = number_format($infoOrder->total).'đ';
        $params['date'] = date('H:i d/m/Y', $infoOrder->create_at);

        $status = 'Đơn hàng mới';
        switch ($infoOrder->status) {
            case 'browser': $status = 'Đã duyệt';break;
            case 'delivery': $status = 'Đang giao hàng';break;
            case 'done': $status = 'Đã hoàn thành';break;
            case 'cancel': $status = 'Đã hủy bỏ';break;
        }
        $params['status'] = $status;

        if($infoOrder->discount <= 100){
            $params['discount'] = $infoOrder->discount.'%';
        }else{
            $params['discount'] = number_format($infoOrder->discount).'đ';
        }

        sendZNSZalo($zaloOA->template_order, $params, $infoCustomer->phone, $zaloOA->id_oa, $zaloOA->id_app);

        // trừ tiền tài khoản
        $infoMember->coin -= 500;
        $modelMembers->save($infoMember);

        // tạo lịch sử giao dịch
        $histories = $modelTransactionHistories->newEmptyEntity();

        $histories->id_member = $infoMember->id;
        $histories->id_system = $infoMember->id_system;
        $histories->coin = 500;
        $histories->type = 'minus';
        $histories->note = 'Gửi thông báo Zalo cho khách hàng '.$infoCustomer->full_name.' ('.$infoCustomer->phone.') cập nhập trạng thái đơn hàng ID '.$infoOrder->id.', số dư tài khoản sau giao dịch là '.number_format($infoMember->coin).'đ';
        $histories->create_at = time();
        
        $modelTransactionHistories->save($histories);
    }
    
}

function getMemberById($id='')
{
    global $modelCategories;
    global $controller;

    $modelMember = $controller->loadModel('Members');
    $checkData = [];

    if(!empty($id)){ 
        $conditions = ['id'=>$id];
        $checkData = $modelMember->find()->where($conditions)->first();
        if(!empty($checkData->id_system)){
            $infosystem  = $modelCategories->find()->where(array('id'=>$checkData->id_system ))->first();
            if(!empty($infosystem->description)){
                $data_value = json_decode($infosystem->description, true);
                $infosystem->convertPoint = (int) @$data_value['convertPoint'];
                $infosystem->max_export_mmtc = (int) @$data_value['max_export_mmtc'];
                $infosystem->price_export_mmtc = (int) @$data_value['price_export_mmtc'];
            }
            $checkData->infosystem = $infosystem;
        }
    }

    return $checkData;
}

function getTreeSystem($id_father, $modelMembers)
{
    $listData = $modelMembers->find()->where(['id_father'=>$id_father,'status !='=>'delete'])->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->agentSystem = getTreeSystem($value->id, $modelMembers);
        }
    }

    return $listData;
}

function checkDuplicateSystem($id_father, $modelMembers, $id_check, $i)
{
    $listData = $modelMembers->find()->where(['id_father'=>$id_father])->all()->toList();
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if($id_check==$value->id){
                     $i ++;
                }else{
                   $i += checkDuplicateSystem($value->id, $modelMembers, $id_check, $i);
            
                }
                
            }
        }
    return $i;    
}

function getTreeAffiliater($id_father, $number)
{
    global $controller;
    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomers = $controller->loadModel('Customers');
    $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

    $listData = $modelAffiliaters->find()->where(['id_father'=>$id_father])->all()->toList();
    $number =  (int)$number+1;
     $percent = getPercentAffiliate();
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->Affiliater = getTreeAffiliater($value->id, $number);
            $listData[$key]->level = $number;
            $order = $modelOrders->find()->where(['id_aff'=>$value->id])->all()->toList();
            $customer = $modelCustomers->find()->where(['id_aff'=>$value->id])->all()->toList();
            $moneys = $modelTransactionAffiliateHistories->find()->where(['id_affiliater'=>$value->id, 'status'=>'new'])->all()->toList();

            $money_back = 0;
            if(!empty($moneys)){
                foreach ($moneys as $item) {
                    $money_back += $item->money_back;
                }
            }

            $listData[$key]->number_order = count($order);
            $listData[$key]->number_customer = count($customer);
            $listData[$key]->money_back = $money_back;
            $listData[$key]->percent = @$percent['percent'.$number];

            $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_father])->first();
             
        }
    }

    return $listData;
}

function getPercentAffiliate(){
    global $modelOptions;
    global $session;
    global $session;
    global $controller;
    $data_value = array();
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        $conditions = array('key_word' => 'settingAffiliateAgency'.$user->id);
        $data = $modelOptions->find()->where($conditions)->first();        
        if(!empty($data->value)){
            $data_value = json_decode($data->value, true);
        }
   
    }
    return $data_value;
}

function getInfoCustomerMember($value=0, $type='id')
{
    global $controller;
    global $urlHomes;
    
    $modelCustomers = $controller->loadModel('Customers');

    $infoUser =$modelCustomers->find()->where([$type=>$value])->first();

    $infoUser->linkinfo = $urlHomes.'infoCustomer?id='.$infoUser->id;
    $infoUser->link_codeQR = 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data='.$urlHomes.'infoCustomer?id='.$infoUser->id;
    return $infoUser;
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

            if(!empty($birthday_date)){
                $infoUser->birthday_date = (int) $birthday_date;
            }

            if(!empty($birthday_month)){
                $infoUser->birthday_month = (int) $birthday_month;
            }

            if(!empty($birthday_year)){
                $infoUser->birthday_year = (int) $birthday_year;
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

// Hàm chia nhỏ mảng thành các nhóm 100 token
function splitArrayIntoChunks($array=[], $chunkSize=100) {
    $chunks = [];
    
    if(is_array($array)){
        if(count($array)>=$chunkSize){
            for ($i = 0; $i < count($array); $i += $chunkSize) {
                $chunks[] = array_slice($array, $i, $chunkSize);
            }
        }else{
            $chunks[] = $array;
        }
    }

    return $chunks;
}

function getTokenFirebaseV1()
{
    require __DIR__.'/library/google-auth-library-php/vendor/autoload.php';

    $linkFileJson = __DIR__.'/library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-42139e7d2b.json';

    // Đường dẫn tới file JSON bạn đã tải về từ Firebase
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$linkFileJson);

    // Tạo một handler cho Guzzle
    $handler = HandlerStack::create();

    // Tạo client Guzzle với handler
    $client = new Client(['handler' => $handler]);

    // Sử dụng ServiceAccountCredentials với HTTP handler đúng
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $creds = new ServiceAccountCredentials($scopes, $linkFileJson);

    // Lấy Access Token với HTTP handler là callable hợp lệ
    $authToken = $creds->fetchAuthToken(function ($request) use ($client) {
        try {
            // Trả về đối tượng phản hồi (ResponseInterface) thay vì mảng đã giải mã
            return $client->send($request);
        } catch (RequestException $e) {
            // Xử lý lỗi nếu có
            return null;
        }
    });

    return $authToken['access_token'];
}

function getFirebaseToken()
{
     //$serviceAccountPath = __DIR__ . '/library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-42139e7d2b.json'; // đổi lại nếu tên khác
    $serviceAccountPath = __DIR__ . '/library/phoenix-crm-f6f64-firebase-adminsdk-lhgro-70eecdee1a.json'; // đổi lại nếu tên khác
     // đổi lại nếu tên khác
    $serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);

    if (!$serviceAccount || !isset($serviceAccount['private_key'])) {
        die("Không đọc được file JSON hoặc thiếu private_key.");
    }

    $privateKey = $serviceAccount['private_key'];
    $clientEmail = $serviceAccount['client_email'];

    $now = time();
    $jwtPayload = [
        'iss' => $clientEmail,
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600
    ];

    $jwt = JWT::encode($jwtPayload, $privateKey, 'RS256');

    $client = new Client();

    try {
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'] ?? null;

    } catch (\GuzzleHttp\Exception\ClientException $e) {
       return null;
    }

}


function sendNotification($data=[], $deviceTokens=[])
{
    /*
    $data = [
                'title'=>'Bạn được cộng tiền hoa hồng giới thiệu',
                'time'=>date('H:i d/m/Y'),
                'content'=>'Trần Mạnh ơi. Bạn được cộng 100.000 VND do thành viên Kim Oanh đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.',
                'action'=>'addMoneySuccess',
                'image'=>'',
            ];
    */


    global $keyFirebase;
    global $projectId;

   // $tokenFirebase = getTokenFirebaseV1(); // Bearer token
    $tokenFirebase = getFirebaseToken(); // Bearer token
    $number_error = 0;
    
    if(!empty($tokenFirebase)){
        // Chia danh sách token thành các nhóm 100
        if(is_string($deviceTokens)){
            $deviceTokens = [$deviceTokens];
        }

        $chunks = splitArrayIntoChunks($deviceTokens, 100);
        

        $headers = [
            'Authorization: Bearer ' . $tokenFirebase,
            'Content-Type: application/json'
        ];

        $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

        foreach ($chunks as $chunk) {
            // Tạo thông báo cho mỗi nhóm 100 thiết bị
            $messages = [];
            foreach ($chunk as $token) {
                $messages[] = [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                                            'title' => $data['title'],
                                            'body' => $data['content'],
                                            //'sound' => "default",
                                        ],
                        "data" => $data,
                    ]
                ];
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Gửi từng tin nhắn cho nhóm thiết bị hiện tại
            foreach ($messages as $message) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $result = curl_exec($ch);

                // Xử lý kết quả
                if ($result === FALSE) {
                    $number_error ++;
                }else{
                    //var_dump($result);
                }
            }

            curl_close($ch);
        }
    }

    return $number_error;
}

function getMemberByToken($token='',$permission='')
{
    global $controller;

    $modelMember = $controller->loadModel('Members');
    $modelTokenDevice = $controller->loadModel('TokenDevices');
    $user = [];
    $modelStaff = $controller->loadModel('Staffs');

    $checkToken = $modelTokenDevice->find()->where(['token'=>$token])->first();
    if(!empty($checkToken)){
        if($checkToken->type=="member"){
            $checkBoss = $modelMember->find()->where(array('id'=>$checkToken->id_member, 'deadline >'=>time(), 'status'=>'active' ))->first();
        }elseif($checkToken->type=="staff"){
            $checkStaff = $modelStaff->find()->where(array('id'=>$checkToken->id_member, 'status'=>'active' ))->first();
            $checkDeadline = $modelMember->find()->where(array('id'=>$checkStaff->id_member, 'deadline >'=>time(), 'status'=>'active' ))->first();
            if(empty($checkDeadline)){
                $checkStaff = array();
            }
        }
        if(!empty($checkBoss)){
            $user = $checkBoss;
            // $user->id_member = $user->id;
            $user->token = $checkToken->token;
            $user->type = 'member';
            $user->id_staff = 0;
            $user->type_tv = 'Đại lý';
            $user->grant_permission = 1;
            if(!empty($user->id_father)){
                $user->type_agency ='agency';
            }else{
                $user->type_agency ='boss';
            }
        }elseif(!empty($checkStaff)){
            $user = $checkStaff;
            $user->token = $checkToken->token;
            $user->id_father = $modelMember->find()->where(array('id'=>$user->id_member, 'status'=>'active' ))->first()->id_father;
            if(!empty($user->id_father)){
                $user->type_agency ='agency';
            }else{
                $user->type_agency ='boss';
            }
            $user->type = 'staff';
            $user->type_tv = 'Nhân viên';
            $user->id_staff = $user->id;
            $user->id = $user->id_member;
            $user->noti_new_customer = 1;
            if(!empty($permission)){
                if(!empty($user->permission) && in_array($permission, json_decode($user->permission, true))){
                        $user->grant_permission = 1;
                }else{
                    $user->grant_permission = 0;
                }
            }else{
                $user->grant_permission = 1;
            }        
        }else{
          $user =array();  
        }    

    }

    return $user;
}

function getCustomerByToken($token='')
{
    global $controller;

    $modelCustomer = $controller->loadModel('customers');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelMember = $controller->loadModel('Members');
    $modelVerifyAccount = $controller->loadModel('VerifyAccounts');
    $checkData = [];
    $listPonint =  listPonint();
    if(!empty($token)){                
        $conditions = ['token'=>$token, 'status'=>'active'];
        $checkData = $modelCustomer->find()->where($conditions)->first();
        if(!empty($checkData)){
            $checkData->last_login= time();
            $modelCustomer->save($checkData);
            $member = $modelMember->find()->where(['id_father'=>0])->first();
            $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$checkData->id,'updated_at >'=>strtotime('today 00:00:00')])->first();
                if(empty($checkPointCustomer)){
                    $note = 'bạn được cộng 5 điểm khi bạn dăng nhập đầu tiên trong ngày';
                    accumulatePoint($checkData->id,$listPonint['point_login'],$note);
                    $dataSendNotification= array('title'=>'Bạn được cộng điểm',
                                'time'=>date('H:i d/m/Y'),
                                'content'=>"Bạn được cộng 5 điểm khi bạn đăng nhập lần đâu tiên trong ngày ",
                                'id_friend'=>"$checkData->id",
                                'action'=>'plusPoint');
                    if(!empty($checkData->token_device)){
                        sendNotification($dataSendNotification, $checkData->token_device);
                        saveNotification($dataSendNotification, $checkData->id);
                    }
                }
            $checkData->verifyAccount = $modelVerifyAccount->find()->where(['id_customer'=>$checkData->id])->first();  
        }
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

global $urlTransaction;
$urlTransaction = 'https://img.vietqr.io/image/MB-0816560000-compact2.png?';

function listBank()
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

function typeLink(){
    return [
        ['type'=>'website'],
        ['type'=>'facebook'],
        ['type'=>'instagram'],
        ['type'=>'tiktok'],
        ['type'=>'youtube'],
        ['type'=>'zalo'],
        ['type'=>'linkedin'],
        ['type'=>'twitter']
    ];
}

function listThemeInfo(){
     global $modelOptions;
    $conditions = array('key_word' => 'themeinfo');

    $data = $modelOptions->find()->where($conditions)->first();

    if(!empty($data->value)){
        return json_decode($data->value,true);
    }else{
        return themeInfo();
    }
   
}

 // Hàm chuyển đổi tên thứ từ tiếng Anh sang tiếng Việt
function thu_tieng_viet($thu_tieng_anh) {
    $thu_dich = [
        'Monday' => 'Thứ2',
        'Tuesday' => 'Thứ3',
        'Wednesday' => 'Thứ4',
        'Thursday' => 'Thứ5',
        'Friday' => 'Thứ6',
        'Saturday' => 'Thứ7',
        'Sunday' => 'CN'
    ];
    return $thu_dich[$thu_tieng_anh];
}

function checkStaffTimekeepers($date,$id_staff){
    global $controller;

    $modelStaffTimekeepers = $controller->loadModel('StaffTimekeepers');
    $date = explode('/', $date);
    $date = mktime(0,0,0,$date[1],$date[0],$date[2]);

    $checkdate = $modelStaffTimekeepers->find()->where(['day'=>$date,'id_staff'=>(int)$id_staff])->first();

    return $checkdate;
}

function InstallistThemeInfo(){
    global $modelOptions;
    $conditions = array('key_word' => 'themeinfo');

    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
        $value = themeInfo();
        $data->key_word = 'themeinfo';
        $data->value = json_encode($value);
        $modelOptions->save($data);
    }
}

function themeInfo(){
    return [ 
        ['id' => 1, 'name' => 'Theme info 1 ', 'code' => 'themeifo1', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them1.jpg','price'=>0],
        ['id' => 2, 'name' => 'Theme info 2 ', 'code' => 'themeifo2', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them2.jpg','price'=>499000],
        ['id' => 3, 'name' => 'Theme info 3 ', 'code' => 'themeifo3', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them3.jpg','price'=>499000],
        ['id' => 4, 'name' => 'Theme info 4 ', 'code' => 'themeifo4', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them4.png','price'=>499000],
        ['id' => 5, 'name' => 'Theme info 5 ', 'code' => 'themeifo5', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them5.png','price'=>499000],
        ['id' => 6, 'name' => 'Theme info 6 ', 'code' => 'themeifo6', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them6.png','price'=>499000],
        ['id' => 7, 'name' => 'Theme info 7 ', 'code' => 'themeifo7', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them7.png','price'=>499000],
        ['id' => 8, 'name' => 'Theme info 8 ', 'code' => 'themeifo8', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them8.png','price'=>499000],
        ['id' => 9, 'name' => 'Theme info 9 ', 'code' => 'themeifo9', 'image'=> '/plugins/hethongdaily/view/home/member/themeinfo/image/them9.png','price'=>499000],

    ];
}

function checklogin($permission=''){
    global $session;
    global $controller;

    $modelStaff = $controller->loadModel('Staffs');
    $modelMember = $controller->loadModel('Members');
     $user = '';
    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        // $user->id_member = $user->id;
        $user->type = 'member';
        $user->id_staff = 0;
        $user->type_tv = 'Đại lý';
        $user->grant_permission = 1;
        $father = $modelMember->find()->where(array('id'=>$user->id, 'status'=>'active' ))->first();
        $user->deadline = $father->deadline;

    }elseif(!empty($session->read('infoStaff'))){
        $user = $session->read('infoStaff');
        $info_staff = $modelStaff->find()->where(['id'=>$user->id])->first();
        $father = $modelMember->find()->where(array('id'=>$user->id_member, 'status'=>'active' ))->first();
        if(!empty($info_staff)){
            $user->permission = $info_staff->permission;
            $user->deadline = $father->deadline;
        }
        
        $user->id_father = $father->id_father;
        $user->type = 'staff';
        $user->type_tv = 'Nhân viên';
        $user->id_staff = $user->id;
        $user->id_staff = $user->id;
        $user->id_position = $father->id_position;
        $user->create_agency = $father->create_agency;
        $user->create_order_agency = $father->create_order_agency;
        $user->noti_new_customer = 1;
        if(!empty($permission)){
            if(!empty($user->permission) && in_array($permission, json_decode($user->permission, true))){
                    $user->grant_permission = 1;
            }else{
                $user->grant_permission = 0;
            }
        }else{
            $user->grant_permission = 1;
        }        
    }else{
      $user ='';  
    }    
    if(!empty($user)){
        if($user->deadline < time()){
            $user->grant_permission = 0;
        }
    }
    

    return $user; 
}

function getListPermission()
{
    global $session;

    $permission = [];
       
    $permission[] = array( 'name'=>'Quản lý khách hàng ',
                    'sub'=>array(   array('name'=>'Danh sách khách hàng','permission'=>'listCustomerAgency'),
                                    array('name'=>'Thêm và sửa khách hàng ','permission'=>'editCustomerAgency'),
                                    array('name'=>'Thêm khách hàng bằng Excel ','permission'=>'addDataCustomerAgency'),
                                    array('name'=>'Danh sách nhóm khách hàng ','permission'=>'groupCustomerAgency'),
                                    array('name'=>'Thêm và sửa nhóm khách hàng ','permission'=>'editGroupCustomerAgency'),
                                    array('name'=>'Xóa nhóm khách hàng ','permission'=>'deleteGroupCustomerAgency'),
                                    array('name'=>'Khóa tài khoản khách hàng','permission'=>'lockCustomerAgency'),
                                    array('name'=>'Danh sách Điểm khách hàng ','permission'=>'listPointCustomer'),
                                    array('name'=>'Danh sách lịch hẹn khách hàng','permission'=>'listCustomerHistoriesAgency'),
                                    array('name'=>'Xem dạng lịch lịch hẹn khách hàng','permission'=>'calendarCustomerHistoriesAgency'),
                                    array('name'=>'Xử lý lịch hẹn khách hàng ','permission'=>'treatmentCustomerHistoriesAgency'),
                                    array('name'=>'Thêm và sửa lịch hẹn khách hàng ','permission'=>'addCustomerHistoriesAgency'),
                                    array('name'=>'Xóa lịch hẹn khách hàng ','permission'=>'deleteCustomerHistoriesAgency'),
                                    array('name'=>'Tải file mật mã thành công','permission'=>'downloadMMTC'),
                                    array('name'=>'Tải mật mã thành công','permission'=>'resultMMTC'),
                                    array('name'=>'Danh sách điểm xếp hạng khách hàng','permission'=>'listPointCustomer'),
                                    array('name'=>'Tặng quà cho khách hàng','permission'=>'giveGiftCustomer'),
                                    array('name'=>'Danh sách quà tặng khách hàng','permission'=>'listCustomerGiftAgency'),
                                    array('name'=>'Thêm và sửa quà tặng khách hàng','permission'=>'addCustomerGiftAgency'),
                                    array('name'=>'Xóa quà tặng khách hàng','permission'=>'deleteCustomerGiftAgency'),
                                    array('name'=>'lịch sử đổi quà tặng khách hàng','permission'=>'listHistorieCustomerGiftAgency'),
                                    array('name'=>'Danh sách giao dịch hoa hồng đại lý gới thiệu','permission'=>'listTransactionAgencyHistorie'),
                                    array('name'=>'thanh toán giao dịch hoa hồng đại lý gới thiệu','permission'=>'payTransactionAgency'),
                            ),
                    );
    $permission[] = array( 'name'=>'Quản lý Đơn hàng của đại lý ',
                    'sub'=>array(   array('name'=>'Danh sách yêu cầu nhập hàng vào kho','permission'=>'requestProductAgency'),
                                    array('name'=>'Tạo yêu cầu nhập hàng vào kho','permission'=>'addRequestProductAgency'),
                                    array('name'=>'Tạo đơn hàng cho đại lý tuyến dưới','permission'=>'addOrderAgency'),
                                    array('name'=>'Danh sách đơn hàng của hệ thống','permission'=>'orderMemberAgency'),
                                    array('name'=>'Cập nhập trạng thái đơn hàng','permission'=>'updateOrderMemberAgency'),
                                    array('name'=>'Tự cập nhập trạng thái đơn hàng của mình','permission'=>'updateMyOrderMemberAgency'),
                                    array('name'=>'tạo phiếu in bill','permission'=>'printBillOrderMemberAgency'),
                                    array('name'=>'Sửa đơn hàng','permission'=>'editOrderMemberAgency'),
                            ),
                    );
    $permission[] = array( 'name'=>'Quản lý Đơn hàng của khách lẻ ',
                    'sub'=>array(   array('name'=>'Tạo đơn hàng cho khách lẻ','permission'=>'addOrderCustomer'),
                                    array('name'=>'Danh sách đơn hàng của khách lẻ','permission'=>'orderCustomerAgency'),
                                    array('name'=>'Xóa đơn hàng cho khách lẻ','permission'=>'deleteOrderCustomerAgency'),
                                    array('name'=>'cập nhập trạng thái đơn hàng','permission'=>'updateStatusOrderAgency'),
                                    array('name'=>'Xem chi tiết đơn hàng','permission'=>'viewOrderCustomerAgency'),
                                    array('name'=>'Sửa đơn hàng','permission'=>'editOrderCustomerAgency'),
                                    array('name'=>'tạo phiếu in bill','permission'=>'printBillOrderCustomerAgency')
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý sản phẩm ',
                    'sub'=>array(   array('name'=>'Danh sách sản phẩm','permission'=>'listProductAgency'),
                                    array('name'=>'Thêm và sửa sản phẩm','permission'=>'addProductAgency'),
                                    array('name'=>'Xóa sản phẩn','permission'=>'deleteProductAgency'),
                                    array('name'=>'Thêm sản phẩn bằng Excel','permission'=>'addDataProductAgency'),
                                    array('name'=>'Danh sách nhóm sản phẩm','permission'=>'listCategoryProductAgency'),
                                    array('name'=>'Thêm và sửa nhóm sản phẩm','permission'=>'editCategoryCustomerAgency'),
                                    array('name'=>'Xóa nhóm sản phẩn','permission'=>'deleteCategoryProductAgency')
                            )
                    );

    $permission[] = array( 'name'=>'Quản lý Kho hàng ',
                    'sub'=>array(   array('name'=>' Danh sách hàng hóa trong kho ','permission'=>'warehouseProductAgency'),
                                    array('name'=>'Lịch sử nhập hàng vào kho','permission'=>'historyWarehouseProductAgency'),
                                    array('name'=>'Kho hàng đại lý','permission'=>'viewWarehouseProductAgency'),
                                    array('name'=>'Sửa kho hàng','permission'=>'editProductWarehouse'),
                            )
                    );

     $permission[] = array( 'name'=>'Quản lý đại lý ',
                    'sub'=>array(   array('name'=>'Danh sách đại lý','permission'=>'listMember'),
                                    array('name'=>'Thêm và sửa thông tin đạt lý','permission'=>'addMember'),
                                    array('name'=>'Xóa thông tin đạt lý ','permission'=>'deteleMember'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý nhân viên ',
                    'sub'=>array(   array('name'=>'Danh sách nhân viên','permission'=>'listStaff'),
                                    array('name'=>'Thêm và sửa thông tin nhân viên','permission'=>'addStaff'),
                                    array('name'=>'Xóa nhân viên','permission'=>'deleteStaff'),
                                    array('name'=>'Xem băng chấm công nhân viên','permission'=>'timesheetStaff'),
                                    array('name'=>'Chấm công nhân viên','permission'=>'checktimesheet'),
                                    array('name'=>'Danh sách nhóm nhân viên','permission'=>'listGroupStaff'),
                                    array('name'=>'Thêm và sửa nhóm thông tin nhân viên','permission'=>'addGroupStaff'),
                                    array('name'=>'Xóa nhóm nhân viên','permission'=>'deteleGroupStaff'),
                                    array('name'=>'Xem băng lịch sử hành dộng nhân viên','permission'=>'listActivityHistory'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý thư viện ',
                    'sub'=>array(   array('name'=>'Danh sách hình ảnh','permission'=>'listAlbum'),
                                    array('name'=>'Thêm và sửa thông tin hình ảnh','permission'=>'addAlbum'),
                                    array('name'=>'Xóa thông tin hình ảnh ','permission'=>'deleteAlbum'),
                                    array('name'=>'Xem thông tin chi tiết hình ảnh ','permission'=>'listAlbuminfo'),
                                    array('name'=>'Danh sách Video','permission'=>'listVideo'),
                                    array('name'=>'Thêm và sửa thông tin Video','permission'=>'addVideo'),
                                    array('name'=>'Xóa thông tin Video ','permission'=>'deleteVideo'),
                                    array('name'=>'xem thông tin chi tiết Video ','permission'=>'listVideoinfo'),
                                    array('name'=>'Danh sách tài liệu','permission'=>'listDocument'),
                                    array('name'=>'Thêm và sửa thông tin tài liệu','permission'=>'addDocument'),
                                    array('name'=>'Xóa thông tin tài liệu ','permission'=>'deleteDocument'),
                                    array('name'=>'xem thông tin chi tiết tài liệu ','permission'=>'listDocumentinfo'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý đào tạo ',
                    'sub'=>array(   array('name'=>'danh sách khóa học','permission'=>'listCourseAgency'),
                                    array('name'=>'thêm và sửa khóa học','permission'=>'addCourseAgency'),
                                    array('name'=>'xóa khóa học','permission'=>'deleteCourseAgency'),
                                    array('name'=>'danh mục đào tạo ','permission'=>'listCategoryLessonAgency'),
                                    array('name'=>'Thêm và sửa danh mục bài tập ','permission'=>'addCategoryLessonAgency'),
                                    array('name'=>'Xóa danh mục bài tập ','permission'=>'deleteCategoryLessonAgency'),
                                    array('name'=>'Danh sách bài học','permission'=>'listLessonAgency'),
                                    array('name'=>'Thêm sửa bài học','permission'=>'addLessonAgency'),
                                    array('name'=>'xóa khóa học','permission'=>'deleteLessonAgency'),
                                    array('name'=>'Danh sách bài kiểm tra','permission'=>'listTestAgency'),
                                    array('name'=>'Thêm sửa bài kiểm tra ','permission'=>'addTestAgency'),
                                    array('name'=>'xóa bài kiểm tra','permission'=>'deleteTestAgency'),
                                    array('name'=>'Danh sách câu hỏi','permission'=>'listQuestionAgency'),
                                    array('name'=>'Thêm sửa câu hỏi','permission'=>'addQuestionAgency'),
                                    array('name'=>'Xóa câu hỏi','permission'=>'deleteQuestionAgency'),
                            ),
                    );
    $permission[] = array( 'name'=>'Quản lý sổ quỹ ',
                    'sub'=>array(   array('name'=>'Danh sách phiếu thu','permission'=>'listCollectionBill'),
                                    array('name'=>'thêm phiếu thu','permission'=>'addCollectionBill'),
                                    array('name'=>'Danh sách phiếu chi','permission'=>'listBill'),
                                    array('name'=>'Thêm phiếu chi','permission'=>'addBill'),
                                    array('name'=>'In phiếu thu','permission'=>'printCollectionBill'),
                                    array('name'=>'In phiếu chi','permission'=>'printBill'),
                                    array('name'=>'Danh sách công nợ phải thu','permission'=>'listCollectionDebt'),
                                    array('name'=>'Danh sách công nợ phải chi','permission'=>'listPayableDebt'),
                                    array('name'=>'Thu tiền công nợ ','permission'=>'paymentCollectionBill'),

                                )
                    );
    $permission[] = array( 'name'=>'Quản lý cộng tác viên ',
                    'sub'=>array(   array('name'=>'Danh sách cộng tác viên','permission'=>'listAffiliaterAgency'),
                                    array('name'=>'thêm và sửa cộng tác viên','permission'=>'addAffiliaterAgency'),
                                    array('name'=>'Xóa công tác viên','permission'=>'deleteAffiliaterAgency'),
                                    array('name'=>'Danh sách lịch sử thanh toán cộng tác viên','permission'=>'listTransactionAffiliaterAgency'),
                                    array('name'=>'Thanh toán cho cộng tác viên','permission'=>'payTransactionAffiliaterAgency'),
                                    array('name'=>'cài đạt hoa hông cho cộng tác viên','permission'=>'settingAffiliateAgency'),
                                    

                                )
                    );

    $permission[] = array( 'name'=>'Quản lý tin tức ',
                    'sub'=>array(   array('name'=>'Danh sách tin tức','permission'=>'listPost'),
                                    array('name'=>'Thêm và sửa tin tức','permission'=>'addPost'),
                                    array('name'=>'xóa tin tức','permission'=>'deletePost'),
                                    array('name'=>'Danh sách danh mục tin tức','permission'=>'listCategoryPost'),
                                    array('name'=>'Thêm và sửa danh mục tin tức','permission'=>'addCategoryPost'),
                                    array('name'=>'Xóa danh mục tin tức','permission'=>'deleteCategoryPost'),
                                    

                                )
                    );
    $permission[] = array( 'name'=>'Quản lý thông báo gửi tin nhắn',
                    'sub'=>array(   array('name'=>'Cài đặt Zalo OA','permission'=>'setttingZaloOA'),
                                    array('name'=>'Gửi tin nhắn Zalo OA','permission'=>'sendMessZaloFollow'),
                                    array('name'=>'Gửi tin nhắn bằng điện thoại','permission'=>'sendSMS'),
                                    array('name'=>'Gửi thông báo qua app','permission'=>'sendNotificationMobile'),
                                    array('name'=>'Danh sách tin nhắn gửi','permission'=>'templateZaloZNS'),
                                    array('name'=>'Thêm và sửa tin nhắn gửi','permission'=>'addTemplateZaloZNS'),
                                    array('name'=>'Danhh sách lịch sử nạp tiền','permission'=>'listTransactionHistories'),
                                    array('name'=>'Nạp tiền vào tài khoản','permission'=>'addMoney'),
                                    

                                )
                    );
    $permission[] = array( 'name'=>'Quản lý mạng xã hội',
                    'sub'=>array(   array('name'=>'Danh sách bài viết ','permission'=>'listWallPost'),
                                    array('name'=>'Thêm và sửa bài viết','permission'=>'addWallPost'),
                                    array('name'=>'Xoá bài viết','permission'=>'deleteWallPost'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý công việc ',
                    'sub'=>array(   array('name'=>'Danh sách dự án','permission'=>'listProject'),
                                    array('name'=>'Thêm và sửa dự án','permission'=>'addProject'),
                                    array('name'=>'Xoá dự án','permission'=>'deleteProject'),
                                    array('name'=>'Danh sách nhiệm vụ','permission'=>'listTask'),
                                    array('name'=>'Thêm và sửa nhiệm vụ','permission'=>'addTask'),
                                    array('name'=>'Xoá nhiệm vụ','permission'=>'deleteTask'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý chiến dịch sự kiện',
                    'sub'=>array(   array('name'=>'Danh sách chiến dịch sự kiện','permission'=>'listCampaign'),
                                    array('name'=>'Thêm và sửa chiến dịch sự kiện','permission'=>'addCampaign'),
                                    array('name'=>'Xoá chiến dịch sự kiện','permission'=>'deleteCampaign'),
                                    array('name'=>'Danh sách khách hàng tham gia chiến dịch sự kiện','permission'=>'listCustomerCampaign'),
                                    array('name'=>'Thêm và sửa khách hàng tham gia chiến dịch sự kiện','permission'=>'addCustomerCampaign'),
                                    array('name'=>'Xoá khách hàng tham gia chiến dịch sự kiện','permission'=>'deleteCustomerCampaign'),
                                    array('name'=>'checkin khách hàng tham gia chiến dịch sự kiện','permission'=>'checkinCampaign'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý tăng tương tác',
                    'sub'=>array(   array('name'=>'Lịch sử tăng tương tác','permission'=>'historyUpLike'),
                                    array('name'=>'Lịch sử tăng Tăng like page Facebook ','permission'=>'upLikePageFacebook'),
                                    array('name'=>'Lịch sử tăng tương tác','permission'=>'historyUpLike'),
                                    array('name'=>'Lịch sử tăng tương tác','permission'=>'historyUpLike'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý Xếp hạng thành viên',
                    'sub'=>array(   array('name'=>'Danh sách xếp hạng thành viên','permission'=>'listRatingPoint'),
                                    array('name'=>'Thêm và sửa xếp hạng thành viên','permission'=>'addRatingPoint'),
                                    array('name'=>'Xoá xếp hạng thành viên','permission'=>'deleteRatingPoint'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý đối tác',
                    'sub'=>array(   array('name'=>'Danh sách đối tác','permission'=>'listPartner'),
                                    array('name'=>'Thêm và sửa đối tác','permission'=>'addPartner'),
                                    array('name'=>'Xoá đối tác','permission'=>'deletePartner'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý mã giảm giá ',
                    'sub'=>array(   array('name'=>'Danh sách mã giảm giá','permission'=>'listDiscountCodeAgency'),
                                    array('name'=>'Thêm và sửa mã giảm giá','permission'=>'addDiscountCodeAgency'),
                                    array('name'=>'Xoá mã giảm giá','permission'=>'deleteDiscountCodeAgency'),
                            )
                    );
    $permission[] = array( 'name'=>'Quản lý chức danh ',
                    'sub'=>array(   array('name'=>'Danh sách chức danh','permission'=>'listPosition'),
                                    array('name'=>'Thêm và sửa chức danh','permission'=>'addPosition'),
                                    array('name'=>'Xoá chức danh','permission'=>'deletePosition'),
                            )
                    );
    
    
    return $permission;
}

function addActivityHistory($user=array(),$note='',$keyword='',$id_key=0){
    global $controller;
    $modelActivityHistory = $controller->loadModel('ActivityHistorys');

    $history = $modelActivityHistory->newEmptyEntity();
    $history->note = $note;
    $history->type = $user->type;
    $history->id_staff = $user->id_staff;
    $history->id_member = $user->id;
    $history->keyword = $keyword;
    $history->time = time();
    $history->id_key = $id_key;
    $modelActivityHistory->save($history);
}


function processAddMoney($money = 0, $phone='', $type='', $note=''){
    global $controller;
    $modelCustomer = $controller->loadModel('Customers');
    $modelBill = $controller->loadModel('Bills');
    $modelMember = $controller->loadModel('Members');
    $modelTransactionCustomers = $controller->loadModel('TransactionCustomers');
    $modelPackage = $controller->loadModel('Packages');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $modelUplikeHistories = $controller->loadModel('UplikeHistories');
    $member = $modelMember->find()->where(['id_father'=>0])->first();

    $infoUser = $modelCustomer->find()->where(['phone'=>$phone])->first();

    if(!empty($infoUser)){
        if($type=='MMTC'){
            $data = getMemberById($infoUser->id_parent);
            $quantity = $money/$data->infosystem->price_export_mmtc;

           
            $infoUser->max_export_mmtc +=(int) $quantity;
            $modelCustomer->save($infoUser);
            $time =time();
            $bill = $modelBill->newEmptyEntity();
            $bill->id_member_sell = $data->id;
            $bill->id_member_buy = 0;
            $bill->id_staff_sell =  0;
            $bill->total = $money;
            $bill->id_order = 0;
            $bill->type = 1;
            $bill->type_order = 2; 
            $bill->created_at = $time;
            $bill->updated_at = $time;
            $bill->id_debt = 0;
            $bill->type_collection_bill =  'chuyen_khoan';
            $bill->id_customer = $infoUser->id;
            $bill->note = 'Thanh toán mua bản thần sô học của khách '.@$infoUser->full_name.' '.@$infoUser->phone;
            $modelBill->save($bill);

            $point = listPonint();
            $note = 'bạn được công '.$point['point_deposit_money']*$quantity.'điểm khi thanh toán mua bản thần sô học ';
            accumulatePoint($infoUser->id,$point['point_deposit_money']*$quantity,$note);

            $dataSendNotification= array('title'=>'Thông báo Thanh toán bản thần sô học','time'=>date('H:i d/m/Y'),'content'=>'Bạn Thanh toán bản thần số học thành Công','action'=>'notificationprocessAddMoney');
            if(!empty($infoUser->token_device)){
                sendNotification($dataSendNotification, $infoUser->token_device);
            }

        }elseif($type=='NAPTIEN'){
            $data = getMemberById($infoUser->id_parent);
            $quantity = $money/$data->infosystem->price_export_mmtc;

       
            $infoUser->total_coin +=(int) $money;
            $modelCustomer->save($infoUser);


            $histories = $modelTransactionCustomers->newEmptyEntity();

                $histories->id_customer = $infoUser->id;
                $histories->id_system = $data->id_system;
                $histories->coin = (int) $money;
                $histories->type = 'plus';
                $histories->note = 'Nạp số tiền là : '.number_format($histories->coin).'đ vào tài khoản, số dư tài khoản sau giao dịch là '.number_format($infoUser->total_coin).'đ';
                $histories->create_at = time();

                $modelTransactionCustomers->save($histories);



                return ['code'=> 1, 'mess'=>'<p class="text-success">Tài khoản này nạp tiền thành công</p>', 'data'=> $histories];
        }else{

            $data = getMemberById($infoUser->id_parent);
            $firstChar = $type[0];
            $id = substr($type, 1);
            if($firstChar='P'){
                $histories = $modelTransactionCustomers->find()->where(['id'=>(int)$id])->first();
                if(!empty($histories)){ 
                    if($histories->type_histories=='package'){ 
                        $checkPackage = $modelPackage->find()->where(['id'=>(int)$histories->id_package])->first();
                        if(!empty($checkPackage)){
                            $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$infoUser->id])->first();
                            if(!empty($checkPointCustomer)){
                                $checkPointCustomer->point += $checkPackage->point;
                                $checkPointCustomer->updated_at = time();
                                $rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $checkPointCustomer->point])->order(['point_min' => 'DESC'])->first();
                                if(!empty($rating)){
                                    $checkPointCustomer->id_rating = $rating->id;
                                }
                                $modelPointCustomer->save($checkPointCustomer);
                            }

                            $infoUser->max_export_mmtc +=(int) $checkPackage->numerology;
                            $modelCustomer->save($infoUser);

                            $histories->meta_payment = $note;
                            $histories->status = 'done';
                            $modelTransactionCustomers->save($histories);

                            $dataSendNotification= array('title'=>'Bạn thanh toán thành công',
                                        'time'=>date('H:i d/m/Y'),
                                        'content'=>"Bạn đã thanh toán mua gói $checkPackage->name thành công",
                                        'action'=>'buyPackage');
                            if(!empty($infoUser->token_device)){
                                sendNotification($dataSendNotification, $infoUser->token_device);
                                saveNotification($dataSendNotification, $infoUser->id);
                            }

                        return ['code'=> 1, 'mess'=>'<p class="text-success">Tài khoản này nạp tiền thành công</p>', 'data'=> $infoUser];

                        }
                    }elseif($histories->type_histories=='up_like'){ 
                        $saveRequest = $modelUplikeHistories->find()->where(['id'=>(int)$histories->id_uplike])->first();
                        if(!empty($saveRequest)){
                             $sendOngTrum = sendRequestBuffOngTrum($saveRequest->type_page, $saveRequest->id_page, $saveRequest->chanel, $saveRequest->number_up, $saveRequest->url_page, $histories->id_customer,$histories->minute);
                            if($sendOngTrum['code']==200){

                                $saveRequest->id_request_buff = $sendOngTrum['id'];
                                $saveRequest->note_buff = json_encode($sendOngTrum);
                                $saveRequest->status = 'Running';
                                $modelUplikeHistories->save($saveRequest);
                            

                                $histories->meta_payment = $note;
                                $histories->status = 'done';
                                $modelTransactionCustomers->save($histories);

                                $dataSendNotification= array('title'=>'Bạn thanh toán thành công',
                                            'time'=>date('H:i d/m/Y'),
                                            'content'=>"Bạn đã thanh toán tăng tương tác thành công",
                                            'action'=>'buyPackage');
                                if(!empty($infoUser->token_device)){
                                    sendNotification($dataSendNotification, $infoUser->token_device);
                                    saveNotification($dataSendNotification, $infoUser->id);
                                }

                                return ['code'=> 1, 'mess'=>'<p class="text-success">Tài khoản này nạp tiền thành công</p>', 'data'=> $infoUser];
                            }

                        }

                    }

                }
            }
        }
        
        return array('code'=>1,'mess'=>'ok');
    }else{
        $mess = 'Không tìm thấy tài khoản khách hàng';
    }
}

function listPonint(){
    global $modelCategories;
    global $controller;
    
    $modelMember = $controller->loadModel('Members');
    $member = $modelMember->find()->where(['id_father'=>0])->first();

    $system = $modelCategories->find()->where(array('id'=>$member->id_system ))->first();

    if(!empty($system->description)){
        $description = json_decode($system->description, true);
        return $description;
    }
}


function accumulatePoint($id_customer=0,$point=0,$note=''){
     global $controller;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelMember = $controller->loadModel('Members');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $modelHistoriePointCustomers = $controller->loadModel('HistoriePointCustomers');
  
    $member = $modelMember->find()->where(['id_father'=>0])->first();
    $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$id_customer])->first();
    if(!empty($id_customer) && !empty($point)){
        if(!empty($checkPointCustomer)){
            $checkPointCustomer->point += (int)$point;
            $checkPointCustomer->updated_at = time();
            $modelPointCustomer->save($checkPointCustomer);
            $rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $checkPointCustomer->point])->order(['point_min' => 'DESC'])->first();
            if(!empty($rating)){
                $checkPointCustomer->id_rating = $rating->id;
            }
        }else{
            if(empty($checkPointCustomer)){
                $data = $modelPointCustomer->newEmptyEntity();
                $data->point = (int) $point;
                $data->id_member = $member->id;
                $data->id_customer = $id_customer;
                $data->created_at = time();
                $data->id_rating = 0;
                $data->updated_at = time();
                $modelPointCustomer->save($data);
            }
        }
    
        $data= $modelHistoriePointCustomers->newEmptyEntity();
        $data->point = (int) $point;
        $data->id_member = $member->id;
        $data->id_customer = $id_customer;
        $data->created_at = time();
        $data->note = $note;
        $data->type = 'add';
        $modelHistoriePointCustomers->save($data);

    }

}

function minuAccumulatePoint($id_customer=0,$point=0,$note=''){
     global $controller;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelMember = $controller->loadModel('Members');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $modelHistoriePointCustomers = $controller->loadModel('HistoriePointCustomers');
  
    $member = $modelMember->find()->where(['id_father'=>0])->first();
    $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$id_customer])->first();
   
    if(!empty($checkPointCustomer)){
        $checkPointCustomer->point_now += (int)$point;
        if($checkPointCustomer->point_now < $checkPointCustomer->point){
            $checkPointCustomer->updated_at = time();
            $modelPointCustomer->save($checkPointCustomer);
           
            $data= $modelHistoriePointCustomers->newEmptyEntity();
            $data->point = (int) $point;
            $data->id_member = $member->id;
            $data->id_customer = $id_customer;
            $data->created_at = time();
            $data->note = $note;
            $data->type = 'minu';
            $modelHistoriePointCustomers->save($data);
            return array('code'=>1, 'mess'=>'bạn trừ điểm thành công ');
        }
        return array('code'=>0, 'mess'=>'bạn chưa đủ điểm để trừ ');
    }
     return array('code'=>0, 'mess'=>'bạn chưa đủ điểm để trừ ');

}

function minuAccumulatePointlike($id_customer=0,$point=0,$note=''){
     global $controller;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelMember = $controller->loadModel('Members');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $modelHistoriePointCustomers = $controller->loadModel('HistoriePointCustomers');
  
    $member = $modelMember->find()->where(['id_father'=>0])->first();
    $checkPointCustomer = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$id_customer])->first();
   
    if(!empty($checkPointCustomer)){
        $checkPointCustomer->point -= (int)$point;
        if($checkPointCustomer->point>0){
            $checkPointCustomer->updated_at = time();
            $modelPointCustomer->save($checkPointCustomer);
           
            $data= $modelHistoriePointCustomers->newEmptyEntity();
            $data->point = (int) $point;
            $data->id_member = $member->id;
            $data->id_customer = $id_customer;
            $data->created_at = time();
            $data->note = $note;
            $data->type = 'minu';
            $modelHistoriePointCustomers->save($data);
            return array('code'=>1, 'mess'=>'bạn trừ điểm thành công ');
        }
        return array('code'=>0, 'mess'=>'bạn chưa đủ điểm để trừ ');
    }
     return array('code'=>0, 'mess'=>'bạn chưa đủ điểm để trừ ');

}

global $priceExtend;

$priceExtend = array( 1=> 3600000,3=> 8640000,5=> 12600000);

?>