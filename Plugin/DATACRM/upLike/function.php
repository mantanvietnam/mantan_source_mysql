<?php

$menus = array();
$menus[0]['title'] = 'Tăng tương tác';
$menus[0]['sub'][] = array('title' => 'Yêu cầu tăng tương tác',
    'url'=>'/plugins/admin/upLike-view-admin-listUplikeHistoriesAdmin',
    'classIcon' => 'menu-icon tf-icons bx bxs-data',
    'permission'=>'listUplikeHistoriesAdmin'
);
$menus[0]['sub'][] = array('title' => 'Cài đặt',
    'url'=>'/plugins/admin/upLike-view-admin-settingUpLikeAdmin',
    'classIcon' => 'menu-icon tf-icons bx bxs-data',
    'permission'=>'settingUpLikeAdmin'
);
$menus[0]['sub'][] = array('title' => 'Cài đặt tăng tương tác khách hàng ',
    'url'=>'/plugins/admin/upLike-view-admin-settingUpLikeCustomerAdmin',
    'classIcon' => 'menu-icon tf-icons bx bxs-data',
    'permission'=>'settingUpLikeCustomerAdmin'
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

function litsUpOngTrum(){
    return array( 
        'facebook' =>array(
            'buff'=> array(
                'live'=>array('name'=>'Tăng mắt live Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.live', 'type_prority'=>''),
                'likepage'=>array('name'=>'Tăng like Fanpage Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.likepage', 'type_prority'=>''),
                'subpage'=>array('name'=>'Tăng theo dõi fanpage Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.subpage', 'type_prority'=>''),
                'view'=>array('name'=>'Tăng lượng xem video Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.view', 'type_prority'=>'reel'),
                'friend'=>array('name'=>'Tăng bạn bè Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.friend', 'type_prority'=>''),
                'viewstory'=>array('name'=>'Tăng  lượt xem story Facebook', 'type' =>'viewstory', 'full' =>'facebook.buff.viewstory', 'type_prority'=>''),
                'share'=>array('name'=>'Tăng lượt chia sẻ Facebook', 'type' =>'post_id', 'full' =>'facebook.buff.share', 'type_prority'=>''),

            ),
            'ngoai'=> array(
                'livengoai'=>array('name'=>'Tăng mắt live Facebook ngoại', 'type' =>'post_id', 'full' =>'facebook.buff.livengoai', 'type_prority'=>''),
                'likepagengoai'=>array('name'=>'Tăng like Fanpage Facebook ngoại', 'type' =>'post_id', 'full' =>'facebook.buff.likepagengoai', 'type_prority'=>''),
                'subpagengoai'=>array('name'=>'Tăng theo dõi fanpage Facebook ngoại', 'type' =>'post_id', 'full' =>'facebook.buff.subpagengoai', 'type_prority'=>''),
                'viewngoai'=>array('name'=>'Tăng lượng xem video Facebook ngoại', 'type' =>'post_id', 'full' =>'facebook.buff.ngoai', 'type_prority'=>'reel'),
            ),
        ),
    );
}

function listServerSmm(){
    $token = getTokenOngTrum();
    $url = 'https://ongtrum.pro/api/v2/server-smm.aspx';
    $dataSend['key'] = $token;
    $dataSend['action'] = 'services';
    $return = sendDataConnectMantan($url, $dataSend);
    return json_decode($return, true);
}

function listTypeOngtrum(){

    return array(
        ['type_api'=> 'facebook.buff.likepage', 'title'=>'Tăng like Fanpage Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'likepage')],
        ['type_api'=> 'facebook.buff.live', 'title'=>'Tăng mắt live Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'live')],
        ['type_api'=> 'facebook.buff.subpage', 'title'=>'Tăng theo dõi fanpage Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'subpage')],
        ['type_api'=> 'facebook.buff.view', 'title'=>'Tăng lượng xem video Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'view')],
        ['type_api'=> 'facebook.buff.friend', 'title'=>'Tăng theo dõi fanpage Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'friend')],
        ['type_api'=> 'facebook.buff.viewstory', 'title'=>'Tăng theo dõi fanpage Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'viewstory')],
        ['type_api'=> 'facebook.buff.share', 'title'=>'Tăng lượt chia sẻ Facebook', 'listPrice'=>listPriceSocial('facebook', 'buff' , 'share')],
        ['type_api'=> 'tiktok.buff.like', 'title'=>'Tăng like Fanpage Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'like')],
        ['type_api'=> 'tiktok.buff.sub', 'title'=>'Tăng theo dõi Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'sub')],
        ['type_api'=> 'tiktok.buff.share', 'title'=>'Tăng lượt chia sẻ Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'share')],
        ['type_api'=> 'tiktok.buff.view', 'title'=>'Tăng lượt xem video Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'view')],
        ['type_api'=> 'tiktok.buff.cmt', 'title'=>'Tăng lượt bình luật Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'cmt')],
        ['type_api'=> 'tiktok.buff.save', 'title'=>'Tăng lượt yêu thích video Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'save')],
        ['type_api'=> 'tiktok.buff.download', 'title'=>'Tăng lượt tải video Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'download')],
        ['type_api'=> 'tiktok.buff.live', 'title'=>'Tăng lượt xem live Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'live')],
        ['type_api'=> 'tiktok.buff.order', 'title'=>'Tăng lượt mua hàng ảo Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'order')],
        ['type_api'=> 'tiktok.buff.live2', 'title'=>'Tăng lượt xem live 2 Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'live2')],
        ['type_api'=> 'tiktok.buff.like.live', 'title'=>'Tăng lượt like live Tiktok', 'listPrice'=>listPriceSocial('tiktok', 'buff' , 'likelive')],
        ['type_api'=> 'tiktok.buff.share.live', 'title'=>'Tăng lượt chia sẻ live Tiktok','listPrice'=>listPriceSocial('tiktok', 'buff' , 'sharelive')],

    );


}

function listPriceSocial($social, $type , $interact){

      global $modelOptions;

    // kiểm tra cái đặt token
    $multiplier = 1;
    $conditions = array('key_word' => 'settingUpLikeAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    if(!empty($data_value['multiplier'])){
        $multiplier = $data_value['multiplier'];
    }else{
        return $controller->redirect('/chooseUpLike/?error=tokenEmpty');
    }
    $listPrice = getListPriceOngTrum();

    $listData = array();
    if(!empty($listPrice['data'][$social][$type][$interact])){
        foreach ($listPrice['data'][$social][$type][$interact] as $key => $value) {
            $value['id'] =  $key;
            $listData[] = $value; 
        }
    }




    return array('multiplier'=>$multiplier, 'price'=>$listData);
}
?>