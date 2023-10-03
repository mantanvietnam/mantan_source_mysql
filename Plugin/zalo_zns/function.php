<?php 
$menus= array();
$menus[0]['title']= 'Zalo ZNS';
$menus[0]['sub'][1]= array('title'=>'Zalo OA',
                            'url'=>'/plugins/admin/zalo_zns-view-admin-listZaloOAAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listZaloOAAdmin',
                        );
$menus[0]['sub'][2]= array('title'=>'Cài đặt ZNS',
                            'url'=>'/plugins/admin/zalo_zns-view-admin-settingZaloZNSAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingZaloZNSAdmin',
                        );
addMenuAdminMantan($menus);

function sendZNSZalo($template_id='', $params='', $phone='', $id_oa='', $app_id='')
{
    global $controller;

    $modelZaloOas = $controller->loadModel('ZaloOas');

    if(!empty($template_id) && !empty($params) && !empty($phone)){
        if (substr($phone, 0, 1) === '0') {
            // Thay thế số 0 đầu tiên bằng "84"
            $phone = '84' . substr($phone, 1);
        }

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
        $modelZaloOas = $controller->loadModel('ZaloOas');

        $zalo_oa = $modelZaloOas->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

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

                $modelZaloOas->save($zalo_oa);
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
        $modelZaloOas = $controller->loadModel('ZaloOas');

        $zalo_oa = $modelZaloOas->find()->where(['id_oa'=>$id_oa, 'id_app'=>$app_id])->first();

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

                $modelZaloOas->save($zalo_oa);
            }

            return $return_zns;
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

?>