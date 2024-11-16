<?php

$menus = array();
$menus[0]['title'] = 'Tăng tương tác';
$menus[0]['sub'][0] = array('title' => 'Yêu cầu tăng tương tác',
                            'url'=>'/plugins/admin/upLike-view-admin-listUplikeHistoriesAdmin',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'listUplikeHistoriesAdmin'
                        );
$menus[0]['sub'][1] = array('title' => 'Cài đặt',
                            'url'=>'/plugins/admin/upLike-view-admin-settingUpLikeAdmin',
                            'classIcon' => 'menu-icon tf-icons bx bxs-data',
                            'permission'=>'settingUpLikeAdmin'
                        );

addMenuAdminMantan($menus);

function getTokenOngTrum()
{
    global $modelOptions;

    $conditions = array('key_word' => 'settingUpLikeAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    if(!empty($data_value['tokenOngTrum'])){
        return $data_value['tokenOngTrum'];
    }else{
        return '';
    }
}

function getListPriceOngTrum()
{
    $token = getTokenOngTrum();
    $listPrice = [];

    if(!empty($token)){
        $url = 'https://ongtrum.pro/api/price.aspx';
        $dataSend['api_token'] = $token;

        $listPrice = sendDataConnectMantan($url, $dataSend);

        $listPrice = json_decode($listPrice, true);
    }

    return $listPrice;
}

function getUIDFacebook($linkFanpage='', $type='uid', $type_prority='reel')
{
    $token = getTokenOngTrum();
    $uid = '';

    if(!empty($token) && !empty($linkFanpage) ){
        $url = 'https://ongtrum.pro/api/getuid';
        
        $dataSend['api_token'] = $token;
        $dataSend['type'] = $type;
        $dataSend['type_prority'] = $type_prority;
        $dataSend['uid'] = $linkFanpage;

        // -------------------------------
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $dataSend,
        ));

        $uid = curl_exec($curl);

        curl_close($curl);

        $uid = json_decode($uid, true);

        if($uid['code']==500){
            $uid = getUID2($linkFanpage);

            $uid = json_decode($uid, true);

            if(!empty($uid['id'])){
                $uid['data']['uid'] = $uid['id'];
                $uid['data']['name'] = $uid['name'];
                $uid['data']['url'] = 'https://www.facebook.com/profile.php?id='.$uid['id'];
            }
        }
    }

    return $uid;
}

function getUID2($url)
{
    return file_get_contents('https://ffb.vn/api/tool/get-id-fb?idfb='.urlencode($url));
}

function sendRequestBuffOngTrum($type_api='', $uid=0, $chanel=0, $number_up=0, $url_page='', $note='', $minute=0)
{
    $token = getTokenOngTrum();
    $return = [];

    if(!empty($uid) && !empty($chanel) && !empty($number_up) && !empty($token) && !empty($url_page) && !empty($type_api)){
        $url = 'https://ongtrum.pro/api/v2/server.aspx';

        $dataSend['api_token'] = $token;
        $dataSend['url'] = $url_page;
        $dataSend['uid'] = $uid; // id page
        $dataSend['channel'] = $chanel; // id kênh
        $dataSend['type'] = 1;
        $dataSend['max'] = (int) $number_up; // số lượng
        //$dataSend['rate'] = 17;
        $dataSend['type_method'] = 'add';
        $dataSend['type_api'] = $type_api;
        $dataSend['speed'] = 0;
        $dataSend['note'] = $note;
        $dataSend['minute'] = $minute;

        $return = sendDataConnectMantan($url, $dataSend);

        $return = json_decode($return, true);
    }

    return $return;
}

function checkRequestOngTrum($id_request_buff=0, $type_api='')
{
    $token = getTokenOngTrum();
    $return = [];

    if(!empty($id_request_buff) && !empty($type_api)){
        $url = 'https://ongtrum.pro/api/v2/server.aspx';

        $dataSend['api_token'] = $token;
        $dataSend['id'] = $id_request_buff;
        $dataSend['type_method'] = 'view';
        $dataSend['type_api'] = $type_api;

        $return = sendDataConnectMantan($url, $dataSend);

        $return = json_decode($return, true);
    }

    return $return;
}
