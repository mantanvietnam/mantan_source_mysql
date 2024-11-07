<?php

$menus = array();
$menus[0]['title'] = 'Tăng tương tác';
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

function getUIDFacebook($linkFanpage='')
{
    $token = getTokenOngTrum();
    $uid = '';

    if(!empty($token) && !empty($linkFanpage) ){
        $url = 'https://ongtrum.pro/api/getuid';
        
        $dataSend['api_token'] = $token;
        $dataSend['type'] = 'uid';
        $dataSend['uid'] = $linkFanpage;

        $uid = sendDataConnectMantan($url, $dataSend);

        $uid = json_decode($uid, true);
    }

    return $uid;
}
