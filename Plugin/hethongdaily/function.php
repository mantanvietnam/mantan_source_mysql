<?php 
$menus= array();
$menus[0]['title']= "Hệ thống đại lý";

$menus[0]['sub'][0]= array(	'title'=>'Đại lý',
							'url'=>'/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listMemberAdmin'
						);

$menus[0]['sub'][]= array( 'title'=>'Khách hàng',
                            'url'=>'/plugins/admin/hethongdaily-view-admin-customer-listCustomerAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listCustomerAdmin'
                        );

$menus[0]['sub'][]= array(	'title'=>'Hệ thống',
							'url'=>'/plugins/admin/hethongdaily-view-admin-system-listSystemAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listSystemAdmin'
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
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 081.656.0000</li>
                            <li>Website: <a href="'.$urlHomes.'">'.$urlHomes.'</a></li>
                        </ul>
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
            }

            return $return_zns;
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

function createCustomerHistories($id_customer=0, $note_now='', $id_staff_now=0, $time_next=0, $action_next='', $id_staff_next=0)
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
        
        $customer_histories->time_next = $time_next;
        $customer_histories->action_next = $action_next;
        $customer_histories->id_staff_next = $id_staff_next;

        $modelCustomerHistories->save($customer_histories);
    }
    
}
?>