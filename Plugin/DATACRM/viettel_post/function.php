<?php 


$menus= array();
$menus[0]['title']= "Viettel Post";
$menus[0]['sub'] = [];

/*$menus[0]['sub'][]= array( 'title'=>'Cài đặt keyword nhạy cảm',
                            'url'=>'/plugins/admin/mangxahoi-view-admin-keyword-listkeywordAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listkeywordAdmin'
                        );*/



addMenuAdminMantan($menus);


function callApiViettelpost($url, $data, $token){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://partnerdev.viettelpost.vn/v2/'.$url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Token: '.$token,
        'Cookie: SERVERID=A; SERVERID=2',
        'X-API-Key: ••••••'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return  json_decode($response, true);
}

?>